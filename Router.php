<?php

namespace MVC;

class Router {
    public $GET = [];
    public $POST = [];

    public function get($url, $function) {
        $this->GET[$url] = $function;
    }

    public function post($url, $function) {
        $this->POST[$url] = $function;
    }

    public function checkRoutes() {
        // session_start();

        // $auth = $_SESSION["auth"] ?? null;

        // $protectedUrls = [
            
        // ];

        //debug($_SERVER);

        $currentUrl = strtok($_SERVER["REQUEST_URI"], "?") ?? "/";
        $method = $_SERVER["REQUEST_METHOD"];

        if ($method === "GET") {
            $function = $this->GET[$currentUrl] ?? null;
        } else if ($method === "POST") {
            $function = $this->POST[$currentUrl] ?? null;
        }

        // if (in_array($currentUrl, $protectedUrls) && !$auth) {
        //     header("Location: /");
        // }

        if ($function) {
            // Page exists.
            call_user_func($function, $this);
        } else {
            echo "404";
        }
    }

    public function render($view, $data = []) {
        foreach($data as $key => $value) {
            $$key = $value;
        }

        ob_start();

        include_once __DIR__ . "/views/$view.php";
        $content = ob_get_clean();
        include_once __DIR__ . "/views/layout.php";
    }
}