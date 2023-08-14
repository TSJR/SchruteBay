<?php

namespace controllers;

use function validateStr;
use function validateLen;
use models\User;

class SignUpController {
    protected $data;

    function __construct() {
        require_once __DIR__ . "/../helpers.php";
        include_once __DIR__ . "/../models/User.php";
        require_once __DIR__ . "/../models/User.php";

        $this->data = [
            "username" => "",
            "password" => "",
            "conf-password" => "",
            "email" => "",
            "errors" => [
                "username" => "",
                "password" => "",
                "conf-password" => "",
                "email" => "",
            ]
        ];

        //Setting each component
        $fields = ["username", "password", "conf-password", "email"];
        foreach( $fields as $field) {
            $this->data[$field] = isset($_POST[$field]) ? $_POST[$field] : "";
        }
    }


    function validateUsername() {
        $username = filter_var($this->data["username"], FILTER_UNSAFE_RAW);
        if (!validateStr($username)) {
            $this->data["errors"]["username"] .= "Username has invalid characters<br>";
        }
        if (!validateLen($username)) {
            $this->data["errors"]["username"] .= "Username must be between 4 and 12 characters<br>";
        }
        return $username;
    }

    function validatePassword() {
        $password = filter_var($this->data["password"], FILTER_UNSAFE_RAW);
        if (!validateStr($password)) {
            $this->data["errors"]["password"] .= "Password has invalid characters<br>";
        }
        if (!validateLen($password)) {
            $this->data["errors"]["password"] .= "Password must be between 4 and 12 characters<br>";
        }
        $regex = "^(?=.*\d)(?=.*[!@#\$%&*()<>?])^";
        if (!preg_match($regex, $this->data["password"])) {
            $this->data["errors"]["password"] .= "Password must contain at least one digit and one special character<br>";
        }
        $this->data["password"] = $password;

        return $password;
    }

    function validateConfPassword() {
        $confPassword = filter_var($this->data["conf-password"], FILTER_UNSAFE_RAW);
        if ($confPassword != $this->data["password"]) {
            $this->data["errors"]["conf-password"] .= "Passwords must match<br>";
        }

        return $confPassword;
    }

    function validateEmail() {
        $email = filter_var($this->data["email"], FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->data["errors"]["email"] .= "Invalid email<br>";
        }
        if (!validateLen($email, 5, 100)) {
            $this->data["errors"]["email"] .= "Email must be between 4 and 12 characters<br>";
        }

        return $email;
    }

    function getErrors() {
        return $this->data["errors"];
    }

    function signUp() {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        $hashed = hash("md5", $this->data["password"]);
        $user = new User(null, $this->data["username"], $hashed, $this->data["email"], false, 100);
        $url = isset($_GET["location"]) ? urldecode($_GET["location"]) : "index.php";
        echo $url;
        if (User::getRowByUsername($this->data["username"])) {
            $this->data["errors"]["username"] .= "Username already taken<br>";
        }
        else {
            $user->save();
            $user->setId(User::getUserByUsername($user->getUsername())->getId());
            setcookie("user-id", User::getUserByUsername($user->getUsername())->getId());
            setcookie("signed-in", "true");

            $url = isset($_GET["location"]) ? urldecode($_GET["location"]) : "index.php";
            header("Location: " . $url);
        }
    }
}