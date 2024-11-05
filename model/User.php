<?php

namespace Model;
use Classes\Email;

class User extends ActiveRecord {
    protected static $columns = ["id", "name", "lastname", "phone", "email", "password", "type", "verified", "token"];
    protected static $tableName = "users";
    public $id;
    public $name;
    public $lastname;
    public $phone;
    public $email;
    public $password;
    public $confirmPassword;
    public $type;
    public $verified;
    public $token;

    public function __construct($args = []) {
        $this->id = $args["id"] ?? null;
        $this->name = $args["name"] ?? "";
        $this->lastname = $args["lastname"] ?? "";
        $this->phone = $args["phone"] ?? "";
        $this->email = strtolower($args["email"]) ?? "";
        $this->password = $args["password"] ?? "";
        $this->confirmPassword = $args["confirmPassword"] ?? "";
        $this->type = $args["type"] ?? "customer";
        $this->verified = $args["verified"] ?? "0";
        $this->token = $args["token"] ?? "";
    }

    public function register(): bool {
        if (!$this->validate(VALIDATE_REGISTER))
            return false;

        // Eliminando la contraseña de confirmación, pues son las mismas. Medida de seguridad.
        $this->confirmPassword = "";

        // Hasheamos el password y generamos un token.
        $this->hashPassword();
        $this->generateToken();

        // Insertamos en el usuario SIN CONFIRMAR en la base de datos.
        if (!self::$database->insert(self::$tableName, $this))
            return false;

        // Enviamos el email de confirmación.
        if (!$this->sendEmailVerification())
            return false;

        return true;
    }

    public function login(): bool {
        // Validamos que la información introducida por el usuario sea válida.
        if (!$this->validate(VALIDATE_LOGIN))
            return false;

        // La información dada por el usuario en el form es válida, por lo tanto
        // vamos a revisar si hay un usuario que exista y esté confirmado. En caso
        // de que no se cumpla un caso o el otro, mostrar un error personalizado
        // a cada uno.
        $user = User::getByEmail($this->email);

        if ($user->verified == "0") {
            $this->alerts = [];
            $this->alerts["error"][] = USER_ISNT_VERIFIED;

            return false;
        }

        // Una vez que ya sabemos que existe ese usuario y esté confirmado, solo
        // queda comprobar que la contraseña ingresada por el usuario y la contraseña
        // del usuario obtenido en la base de datos sean iguales.

        if (!password_verify($this->password, $user->password)) {
            $this->alerts = [];
            $this->alerts["error"][] = PASSWORD_DOESNT_EXIST_ERROR;

            return false;
        }

        // En este punto ya solo falta autenticar el usuario.
        session_start();
        session_regenerate_id(true);

        $_SESSION["id"] = $user->id;
        $_SESSION["name"] = $user->name;
        $_SESSION["lastname"] = $user->lastname;
        $_SESSION["email"] = $user->email;
        $_SESSION["phone"] = $user->phone;
        $_SESSION["auth"] = true;
        $_SESSION["type"] = $user->type;

        if ($user->type === "employee" || $user->type === "admin") {
            $employee = Employee::where("userId", $user->id, true);
            $role = Role::find($employee->roleId);

            $_SESSION["employeeId"] = $employee->id;
            $_SESSION["employeeImage"] = $employee->image;
            $_SESSION["roleId"] = $role->id;
            $_SESSION["roleName"] = $role->name;
        }

        return true;
    }

    public function forgot(): bool {
        if (!$this->validate(VALIDATE_FORGOT))
            return false;

        $user = User::getByEmail($this->email);

        if ($user->verified == "0") {
            $this->alerts = [];
            $this->alerts["error"][] = USER_ISNT_VERIFIED;

            return false;
        }

        $user->generateToken();

        if (!self::$database->update(self::$tableName, $user))
            return false;

        $user->sendEmailRecovery();

        return true;
    }

    public function recovery($newUser): bool {
        if (!$newUser->validate(VALIDATE_RECOVERY))
            return false;

        $this->password = $newUser->password;

        $newUser->confirmPassword = "";
        $newUser->password = "";

        $this->token = null;
        $this->hashPassword();

        return $this->save();
    }

    public function validate($type = VALIDATE_DEFAULT): bool {
        $this->alerts = [];

        if ($type === VALIDATE_LOGIN) {
            return $this->validateLogin();
        } else if ($type === VALIDATE_REGISTER) {
            return $this->validateRegister();
        } else if ($type === VALIDATE_FORGOT) {
            return $this->validateForgot();
        } else if ($type === VALIDATE_RECOVERY) {
            return $this->validateRecovery();
        } else if ($type === VALIDATE_DEFAULT) {
            return $this->validateDefault();
        } else {
            return false;
        }
    }

    public function exists(): bool {
        return self::$database->where(self::$tableName, "email", $this->email)->num_rows === 1;
    }

    public static function getFullName($id) {
        $id = ActiveRecord::escapeString($id);

        $user = User::find($id);

        return "$user->name $user->lastname";
    }

    public static function getByToken($token) {
        if ($token === null || $token === "")
            return null;

        $result = self::$database->where(self::$tableName, "token", $token);

        if ($result->num_rows === 1) {
            return new User($result->fetch_assoc());
        } else {
            return null;
        }
    }

    public static function getByEmail($email) {
        if ($email === null || $email === "")
            return null;

        $result = self::$database->where(self::$tableName, "email", $email);

        if ($result->num_rows === 1) {
            return new User($result->fetch_assoc());
        } else {
            return null;
        }
    }

    protected function hashPassword(): void {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    protected function isHashed($password): bool {
        return strlen($password) === 60;
    }

    protected function generateToken(): void {
        $this->token = uniqid();
    }

    protected function sendEmailVerification(): bool {
        // Preparamos y enviamos un email.

        $this->name = trim($this->name);

        $appURL = $_ENV["APP_URL"];

        $body = <<<EOD
            <html style="font-size:20px;font-family: Arial, sans-serif">
                <h2 style="margin-bottom: 16px">Hola $this->name.</h2>
                <p style="margin-top:0">
                    Estás a un paso de crear tu cuenta en <a href="$appURL">Barbershop</a>. Haz click en el siguiente enlace para confirmar tu cuenta.
                </p>
                <a href="$appURL/confirmar?token=$this->token">Confirmar cuenta</a>
                <br>
                <p style="margin-bottom: 0">Si no has sido tú, puedes ignorar el mensaje.</p>
            </html>
        EOD;

        $altBody = <<<EOD
            Hola $this->name.

            Estás a un paso de crear tu cuenta en Barbershop. Haz click en el siguiente enlace para confirmar tu cuenta.
            $appURL/confirmar?token=$this->token

            Si no has sido tú, puedes ignorar el mensaje.
            Pasa un feliz resto del día.
        EOD;

        $result = Email::send(
            "cuentas@barbershop.com",
            "Barbershop",
            $this->email,
            $this->name,
            "Barbershop | Confirma tu cuenta.",
            $body,
            $altBody,
            true
        );

        return $result;
    }

    protected function sendEmailRecovery(): bool {
        // Preparamos y enviamos un email.

        $this->name = trim($this->name);
        $appURL = $_ENV["APP_URL"];

        $body = <<<EOD
            <html style="font-size:20px;font-family: Arial, sans-serif">
                <h2 style="margin-bottom: 16px">Hola $this->name.</h2>
                <p style="margin-top:0">
                    Has solicitado un cambio de contraseña en tu cuenta de <a href="$appURL">Barbershop</a>. Haz click en el siguiente enlace para reestablecerla.
                </p>
                <a href="$appURL/recuperar?token=$this->token">Reestablecer contraseña</a>
                <br>
                <p style="margin-bottom: 4px">Si no has sido tú, puedes ignorar este mensaje.</p>
            </html>
        EOD;

        $altBody = <<<EOD
            Hola $this->name.

            Has solicitado un cambio de contraseña en tu cuenta de Barbershop. Haz click en el siguiente enlace para reestablecerla.
            $appURL/recuperar?token=$this->token

            Si no has sido tú, cambia tu contraseña a una más segura para evitar cualquier incidente.
        EOD;

        $result = Email::send(
            "cuentas@barbershop.com",
            "Barbershop",
            $this->email,
            $this->name,
            "Barbershop | Reestablecer contraseña.",
            $body,
            $altBody,
            true
        );

        return $result;
    }

    protected function validateDefault(): bool {
        $this->alerts = [];

        if (strlen($this->name) < 2 || strlen($this->name) > 45) {
            $this->alerts["error"][] = NAME_ERROR;
        }

        if (strlen($this->lastname) < 2 || strlen($this->lastname) > 45) {
            $this->alerts["error"][] = LASTNAME_ERROR;
        }

        if (!preg_match("/[0-9]{10}/", $this->phone)) {
            $this->alerts["error"][] = PHONE_ERROR;
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->alerts["error"][] = EMAIL_INVALID_ERROR;
        }

        if (!$this->isHashed($this->password)) {
            if ((strlen($this->password) < 8 || strlen($this->password) > 12)) {
                $this->alerts["error"][] = PASSWORD_INVALID_ERROR;
            }
        }

        return empty($this->alerts);
    }

    protected function validateLogin(): bool {
        $this->alerts = [];

        if (!$this->exists()) {
            $this->alerts["error"][] = USER_DOESNT_EXIST_ERROR;

            return false;
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->alerts["error"][] = EMAIL_INVALID_ERROR;
        }

        if ((strlen($this->password) < 8 || strlen($this->password) > 12)) {
            $this->alerts["error"][] = PASSWORD_INVALID_ERROR;
        }

        return empty($this->alerts);
    }

    protected function validateRegister(): bool {
        $this->alerts = [];

        if ($this->exists()) {
            $this->alerts["error"][] = USER_EXIST_ERROR;

            return false;
        }

        if (strlen($this->name) < 2 || strlen($this->name) > 45) {
            $this->alerts["error"][] = NAME_ERROR;
        }

        if (strlen($this->lastname) < 2 || strlen($this->lastname) > 45) {
            $this->alerts["error"][] = LASTNAME_ERROR;
        }

        if (!preg_match("/[0-9]{10}/", $this->phone)) {
            $this->alerts["error"][] = PHONE_ERROR;
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->alerts["error"][] = EMAIL_INVALID_ERROR;
        }

        if ((strlen($this->password) < 8 || strlen($this->password) > 12)) {
            $this->alerts["error"][] = PASSWORD_INVALID_ERROR;
        }

        if ($this->password && !$this->confirmPassword) {
            $this->alerts["error"][] = CONFIRM_PASSWORD_ERROR;
        }

        if ($this->password && $this->confirmPassword && strcmp($this->password, $this->confirmPassword) != 0) {
            $this->alerts["error"][] = DIFFERENT_PASSWORD_ERROR;
        }

        return empty($this->alerts);
    }

    protected function validateForgot(): bool {
        $this->alerts = [];

        if (!$this->exists()) {
            $this->alerts["error"][] = USER_DOESNT_EXIST_ERROR;

            return false;
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->alerts["error"][] = EMAIL_INVALID_ERROR;
        }

        return empty($this->alerts);
    }

    protected function validateRecovery(): bool {
        $this->alerts = [];

        if ((strlen($this->password) < 8 || strlen($this->password) > 12)) {
            $this->alerts["error"][] = PASSWORD_INVALID_ERROR;
        }

        if ($this->password && !$this->confirmPassword) {
            $this->alerts["error"][] = CONFIRM_PASSWORD_ERROR;
        }

        if ($this->password && $this->confirmPassword && strcmp($this->password, $this->confirmPassword) != 0) {
            $this->alerts["error"][] = DIFFERENT_PASSWORD_ERROR;
        }

        return empty($this->alerts);
    }
}