<?php
// Constants.

define("TEMPLATES_URL", __DIR__ . "/templates/");
define("FUNCTIONS_URL", __DIR__ . "functions.php");

// Database tablenames.

function includeTemplate(string $templateName, bool $isHome = false) : void {
    include TEMPLATES_URL . "$templateName.php";
}

function isAuth() : void {
    session_start();

    if (!$_SESSION["auth"])
        header("Location: /");
}

function isAdmin() : void {
    session_start();

    if (!$_SESSION["type"] || !$_SESSION["type"] === "admin") 
        header("Location: /");
}

function isType($type) : bool {
    session_start();

    return $_SESSION["type"] === $type;
}

function randomName($suffix = "") : string {
    // md5 repeats the hash when the name is the same.
    // uniqid makes it random, and rand helps even more.

    return md5(uniqid(rand())) . $suffix;
}

function debug($variable) : void{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";

    exit;
}

function escape_html($html) : string {
    return trim(htmlspecialchars($html));
}

function verifyIdInUrl($urlToRedirect) {
    $id = $_GET["id"];

    if (!filter_var($id, FILTER_VALIDATE_INT)) {
        header("Location: $urlToRedirect");
    }

    return $id;
}