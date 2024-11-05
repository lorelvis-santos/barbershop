<?php

namespace Controller;

use MVC\Router;
use Model\User;

class LoginController
{
    public static function register(Router $router)
    {
        $user = new User;
        $alerts = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $user->sync($_POST);

            $result = $user->register();

            if ($result) {
                header("Location: /mensaje");
            } else {
                $alerts = $user->getAlerts();
            }
        }

        $router->render("auth/register", [
            "user" => $user,
            "alerts" => $alerts
        ]);
    }

    public static function verify(Router $router)
    {
        $token = escape_html($_GET["token"]);
        $user = User::getByToken($token);
        $alerts = [];

        if ($user) {
            $user->verified = 1;
            $user->token = null;

            $user->update();

            $alerts["success"][] = "La cuenta ha sido confirmada";
        } else {
            $alerts["error"][] = INVALID_TOKEN;
        }

        $router->render("auth/verify", [
            "alerts" => $alerts
        ]);
    }

    public static function message(Router $router)
    {
        $router->render("auth/message");
    }

    public static function login(Router $router)
    {
        $alerts = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $user = new User($_POST);

            if ($user->login()) {
                if (isType("employee") || isType("admin")){
                    header("Location: /empleado/agenda");
                } else if (isType("customer")) {
                    header("Location: /cliente/mis-citas");
                }
            } else {
                $alerts = $user->getAlerts();
            }
        }

        $router->render("auth/login", [
            "alerts" => $alerts,
            "user" => $user
        ]);
    }

    public static function logout(Router $router)
    {
        session_start();

        $_SESSION = [];

        header("Location: /");
    }

    public static function forgot(Router $router)
    {
        $alerts = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $user = new User($_POST);

            if ($user->forgot()) {
                $alerts["success"][] = "Revisa la bandeja de tu correo electrónico";
            } else {
                $alerts = $user->getAlerts();
            }
        }

        $router->render("auth/forgot", [
            "alerts" => $alerts
        ]);
    }

    public static function recovery(Router $router)
    {
        // Por hacer:
        // 1. Verificar que el usuario obtenido por el token exista.
        //    En caso de que no, anular totalmente el acceso al contenido de esta página.
        // 2. Un formulario donde se introduzca una nueva contraseña con confirmación y validación.
        // 3. En caso de que las contraseñas sean correctas, actualizar y darle feedback al usuario de
        //    que la operación ha sido un éxito.
        $token = escape_html($_GET["token"]);
        $user = User::getByToken($token);
        $error = false;
        $alerts = [];

        if (!$user) {
            $alerts["error"][] = INVALID_TOKEN;
            $error = true;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (!$error) {
                $newUser = new User($_POST);

                if ($user->recovery($newUser)) {
                    header("Location: /");
                } else {
                    $alerts = $newUser->getAlerts();
                }
            }
        }

        $router->render("auth/recovery", [
            "alerts" => $alerts,
            "error" => $error
        ]);
    }
}
