<?php

namespace Controller;

use MVC\Router;
use Model\ActiveRecord;

class CustomerController {
    public static function bookAppointment(Router $router) {
        isAuth();
        
        session_start();

        $query = "
            SELECT 
                employees.id, 
                CONCAT(users.name, ' ', users.lastname) as name,
                users.phone,
                users.email,
                roles.id as roleId,
                roles.name as role,
                employees.image 
                    
            FROM employees 
                
            INNER JOIN users ON users.id = employees.userId 
            INNER JOIN roles ON roles.id = employees.roleId;
        ";

        $employees = ActiveRecord::makeQueryArray($query);

        $router->render("customer/bookAppointment", [
            "name" => $_SESSION["name"] . " " . $_SESSION["lastname"],
            "id" => $_SESSION["id"],
            "employees" => $employees,
            "css" => "
                <link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css\">
                <link rel=\"stylesheet\" type=\"text/css\" href=\"https://npmcdn.com/flatpickr/dist/themes/dark.css\">
            ",
            "script" => "
                <script src=\"/build/js/helper.js\"></script>  
                <script src=\"/build/js/svg.js\"></script>  
                <script src=\"/build/js/users/customer/book-appointment.js\"></script>
                <script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@11\"></script>
                <script src=\"https://cdn.jsdelivr.net/npm/keen-slider@6.8.5/keen-slider.min.js\"></script>
                <script src=\"https://cdn.jsdelivr.net/npm/flatpickr\"></script>
            "
        ]);
    }

    public static function bookedAppointments(Router $router) {
        isAuth();
        
        session_start();

        $router->render("customer/bookedAppointments", [
            "name" => $_SESSION["name"] . " " . $_SESSION["lastname"],
            "id" => $_SESSION["id"],
            "css" => "
                <link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css\">
                <link rel=\"stylesheet\" type=\"text/css\" href=\"https://npmcdn.com/flatpickr/dist/themes/dark.css\">
            ",
            "script" => "
                <script src=\"/build/js/helper.js\"></script> 
                <script src=\"/build/js/users/customer/my-appointments.js\"></script>
                <script src=\"/build/js/appointments.js\"></script>
                <script src=\"/build/js/svg.js\"></script>
                <script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@11\"></script>
                <script src=\"https://cdn.jsdelivr.net/npm/keen-slider@6.8.5/keen-slider.min.js\"></script>
                <script src=\"https://cdn.jsdelivr.net/npm/flatpickr\"></script>
            "
        ]);
    }
}