<?php

namespace Controller;

use MVC\Router;

class AdminController {
    public static function index(Router $router) {
        session_start();

        isAdmin();

        $router->render("admin/index", [
            "name" => $_SESSION["name"] . " " . $_SESSION["lastname"],
            "id" => $_SESSION["id"]
        ]);
    }
}