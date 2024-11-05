<?php

require_once __DIR__ . "/../includes/app.php";

use MVC\Router;
use Controller\APIController;
use Controller\LoginController;
use Controller\AdminController;
use Controller\CustomerController;
use Controller\EmployeeController;
use Controller\RoleController;
use Controller\ServiceController;

$router = new Router();

// AUTHENTICATION PAGES -----------------------------------------------------------------------------------------------------

// User registering.
$router->get("/registrar", [LoginController::class, "register"]);
$router->post("/registrar", [LoginController::class, "register"]);
$router->get("/confirmar", [LoginController::class, "verify"]);
$router->get("/mensaje", [LoginController::class, "message"]);

// Login & logout.
$router->get("/", [LoginController::class, "login"]);
$router->post("/", [LoginController::class, "login"]);

$router->get("/logout", [LoginController::class, "logout"]);

// Password recovery.
$router->get("/olvide", [LoginController::class, "forgot"]);
$router->post("/olvide", [LoginController::class, "forgot"]);

$router->get("/recuperar", [LoginController::class, "recovery"]);
$router->post("/recuperar", [LoginController::class, "recovery"]);

// PRIVATE ZONE -------------------------------------------------------------------------------------------------------------

// Admins.

$router->get("/administracion", [AdminController::class, "index"]);

// CRUD.

// Services.

$router->get("/administracion/servicios", [ServiceController::class, "read"]);
$router->get("/administracion/servicios/crear", [ServiceController::class, "create"]);
$router->post("/administracion/servicios/crear", [ServiceController::class, "create"]);
$router->get("/administracion/servicios/actualizar", [ServiceController::class, "update"]);
$router->post("/administracion/servicios/actualizar", [ServiceController::class, "update"]);
$router->get("/administracion/servicios/eliminar", [ServiceController::class, "delete"]);

// Roles.

$router->get("/administracion/roles", [RoleController::class, "read"]);
$router->get("/administracion/roles/crear", [RoleController::class, "create"]);
$router->post("/administracion/roles/crear", [RoleController::class, "create"]);
$router->get("/administracion/roles/actualizar", [RoleController::class, "update"]);
$router->post("/administracion/roles/actualizar", [RoleController::class, "update"]);
$router->get("/administracion/roles/eliminar", [RoleController::class, "delete"]);

// Employees.

$router->get("/administracion/empleados", [EmployeeController::class, "read"]);
$router->get("/administracion/empleados/crear", [EmployeeController::class, "create"]);
$router->post("/administracion/empleados/crear", [EmployeeController::class, "create"]);
$router->get("/administracion/empleados/actualizar", [EmployeeController::class, "update"]);
$router->post("/administracion/empleados/actualizar", [EmployeeController::class, "update"]);
$router->get("/administracion/empleados/eliminar", [EmployeeController::class, "delete"]);

// Employee private zone.

$router->get("/empleado/agenda", [EmployeeController::class, "agenda"]);
$router->get("/empleado/configuracion", [EmployeeController::class, "settings"]);

// Customers.

$router->get("/cliente/agendar-cita", [CustomerController::class, "bookAppointment"]);
$router->get("/cliente/mis-citas", [CustomerController::class, "bookedAppointments"]);

// Appointments API.
$router->get ("/api/employees", [APIController::class, "employees"]);
$router->post ("/api/employees", [APIController::class, "employees"]);
$router->get ("/api/employees/bookedappointments", [APIController::class, "bookedAppointments"]);
$router->get ("/api/employees/availabletimes", [APIController::class, "availableTimes"]);

$router->get("/api/customers/bookedappointments", [APIController::class, "bookedAppointments"]);

$router->get ("/api/roles", [APIController::class, "roles"]);
$router->post("/api/roles", [APIController::class, "roles"]);

$router->get ("/api/services", [APIController::class, "services"]);
$router->post ("/api/services", [APIController::class, "services"]);

$router->get ("/api/appointments", [APIController::class, "appointments"]);
$router->post("/api/appointments", [APIController::class, "appointments"]);

$router->get("/api/search/employees", [APIController::class, "searchEmployees"]);

// Check the URLS, if the url is registered, it's going to assign it a controller.
$router->checkRoutes();