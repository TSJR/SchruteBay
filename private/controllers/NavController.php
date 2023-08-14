<?php

namespace controllers;
include_once __DIR__ . "/../models/User.php";
use models\User;

class NavController {
    static function render() {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $logged_in = isset($_COOKIE["signed-in"]) ? $_COOKIE["signed-in"] : "false";
        $user = isset($_COOKIE["user-id"]) ? User::getUserById($_COOKIE["user-id"]) : null;

        if ($logged_in == "true") {
            return $user->getSB();
        }
        else {
            return "0";
        }
    }
}