<?php

namespace controllers;
include_once __DIR__ . "/../models/User.php";
use models\User;

class HomeController {

    static function render() {
        $logged_in = isset($_COOKIE["signed-in"]) ? $_COOKIE["signed-in"] : "false";

        $user = isset($_COOKIE["user-id"]) ? User::getUserById($_COOKIE["user-id"]) : null;

        if ($logged_in == "true") {
            echo 'Hello, ' . $user->getUsername() . '<br><a href="sign_in.php">Sign out</a><br>';
        }
        else {
            echo 'Hello, guest. Sign in <a href="../public/sign_in.php">here</a>';
        }
    }
}