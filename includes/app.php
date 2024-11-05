<?php 

require __DIR__ . "/../vendor/autoload.php";
require "functions.php";
require "errors.php";

// Conectarnos a la base de datos
use Model\ActiveRecord;
use Model\Database;

// Variables de entorno
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// Constantes.
define("VALIDATE_DEFAULT", "default");
define("VALIDATE_LOGIN", "login");
define("VALIDATE_REGISTER", "register");
define("VALIDATE_FORGOT", "forgot");
define("VALIDATE_RECOVERY", "recovery");

ActiveRecord::setDatabase(
    new Database(
        $_ENV["DB_HOST"], 
        $_ENV["DB_USER"], 
        $_ENV["DB_PASSWORD"], 
        $_ENV["DB_NAME"]
    )
);