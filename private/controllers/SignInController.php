<?php

namespace controllers;

require_once "SignUpController.php";
require_once __DIR__ . "/../conn.php";
require_once __DIR__. "/../helpers.php";
require_once __DIR__ . "/../models/User.php";
use models\User;

class SignInController extends SignUpController {
    function checkCredentials() {
        $conn = connect();
        $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
        $hashed = hash("md5", $this->data["password"]);
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $this->data["username"], $hashed);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = formatRow($result);

        if (!$row) {
            $this->data["errors"]["username"] .= "Invalid username or password<br>";
            $this->data["errors"]["password"] .= "Invalid username or password<br>";
        }
        else {
            $user = User::getUserByUsername($this->data["username"]);

            setcookie("user-id", $user->getId());
            setcookie("signed-in", "true");

            $url = isset($_GET["location"]) ? urldecode($_GET["location"]) : "index.php";

            header("Location: " . $url);

        }
    }

    function validateUsername() {
        $username = filter_var($this->data["username"], FILTER_UNSAFE_RAW);
        if (!validateStr($username)) {
            $this->data["errors"]["username"] .= "Username has invalid characters<br>";
        }
        return $username;
    }

    function validatePassword() {
        $password = filter_var($this->data["password"], FILTER_UNSAFE_RAW);
        if (!validateStr($password)) {
            $this->data["errors"]["password"] .= "Password has invalid characters<br>";
        }
        $this->data["password"] = $password;

        return $password;
    }
}