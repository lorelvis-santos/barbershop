<?php 

namespace Controller;

use MVC\Router;
use Model\Role;

class RoleController {
    public static function read(Router $router) {
        isAdmin();

        session_start();

        $roles = Role::all(1000);

        $router->render("crud/roles/read", [
            "id" => $_SESSION["id"],
            "name" => $_SESSION["name"] . " " . $_SESSION["lastname"],
            "roles" => $roles,
            "script" => "<script src=\"/build/js/table.js\"></script>"
        ]);
    }

    public static function create(Router $router) {
        isAdmin();
        
        session_start();

        $role = new Role;
        $alerts = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $role->sync($_POST);

            if ($role->save()) {
                header("Location: /administracion/roles");
            } else {
                $alerts = $role->getAlerts();
            }
        }
        
        $router->render("crud/roles/create", [
            "id" => $_SESSION["id"],
            "name" => $_SESSION["name"] . " " . $_SESSION["lastname"],
            "alerts" => $alerts,
            "role" => $role
        ]);
    }

    public static function update(Router $router) {
        isAdmin();
        
        session_start();

        $id = $_GET["id"];

        if (!filter_var($id, FILTER_VALIDATE_INT))
            header("Location: /administracion/roles");

        $role = Role::find($id);

        if (!$role)
            header("Location: /administracion/roles");

        $alerts = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $role->sync($_POST);

            if ($role->save()) {
                header("Location: /administracion/roles");
            } else {
                $alerts = $role->getAlerts();
            }
        }

        $router->render("crud/roles/update", [
            "id" => $_SESSION["id"],
            "name" => $_SESSION["name"] . " " . $_SESSION["lastname"],
            "alerts" => $alerts,
            "role" => $role
        ]);
    }

    public static function delete(Router $router) {
        session_start();
        
        isAdmin();
    }
}