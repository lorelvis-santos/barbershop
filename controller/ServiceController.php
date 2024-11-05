<?php 

namespace Controller;

use Model\ActiveRecord;
use MVC\Router;
use Model\Role;
use Model\Service;

class ServiceController {
    public static function read(Router $router) {
        isAdmin();
        
        session_start();

        $services = ActiveRecord::makeQueryArray(
            "SELECT 
                        services.id,
                        services.name,
                        services.price,
                        services.roleId,
                        roles.name as roleName
                    FROM services 
                    INNER JOIN roles ON roles.id = services.roleId 
                    ORDER BY roles.name;"
        );

        $router->render("crud/services/read", [
            "id" => $_SESSION["id"],
            "name" => $_SESSION["name"] . " " . $_SESSION["lastname"],
            "services" => $services,
            "script" => "<script src=\"/build/js/table.js\"></script>"
        ]);
    }

    public static function create(Router $router) {
        isAdmin();
        
        session_start();

        $roles = Role::all();
        $service = new Service;
        $alerts = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $service->sync($_POST);

            if ($service->save()) {
                header("Location: /administracion/servicios");
            } else {
                $alerts = $service->getAlerts();
            }
        }
        
        $router->render("crud/services/create", [
            "id" => $_SESSION["id"],
            "name" => $_SESSION["name"] . " " . $_SESSION["lastname"],
            "alerts" => $alerts,
            "service" => $service,
            "roles" => $roles
        ]);
    }

    public static function update(Router $router) {
        isAdmin();
        
        session_start();

        $id = $_GET["id"];

        if (!filter_var($id, FILTER_VALIDATE_INT))
            header("Location: /administracion/servicios");

        $service = Service::find($id);

        if (!$service)
            header("Location: /administracion/servicios");

        $roles = Role::all();
        $alerts = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $service->sync($_POST);

            if ($service->save()) {
                header("Location: /administracion/servicios");
            } else {
                $alerts = $service->getAlerts();
            }
        }

        $router->render("crud/services/update", [
            "id" => $_SESSION["id"],
            "name" => $_SESSION["name"] . " " . $_SESSION["lastname"],
            "alerts" => $alerts,
            "service" => $service,
            "roles" => $roles
        ]);
    }

    public static function delete(Router $router) {
        isAdmin();
        
        session_start();
    }
}