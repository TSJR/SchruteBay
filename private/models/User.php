<?php

namespace models;
require_once __DIR__ . "/../helpers.php";
require_once __DIR__ . "/../conn.php";
use function formatRow;
use function formatRows;

class User {
    private $id;
    private $username;
    private $password;
    private $email;
    private $confirmed;
    private $schrute_bucks;

    function __construct($id, $username, $password, $email, $confirmed, $schrute_bucks=0) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->confirmed = $confirmed;
        $this->schrute_bucks = $schrute_bucks;
    }

    //Getters
    function getId() {
        return $this->id;
    }
    function getUsername() {
        return $this->username;
    }
    function getPassword() {
        return $this->password;
    }
    function getEmail() {
        return $this->email;
}
    function isConfirmed() {
        return $this->confirmed;
    }
    function getSB() {
        if ($this->schrute_bucks) {
            return $this->schrute_bucks;
        }
        else {
            return 0;
        }
    }
    function getAllData() {
        return ["id" => $this->getId(), "username" => $this->getUsername(), "password" => $this->getPassword(), "email" => $this->getEmail(), "confirmed" => $this->isConfirmed(), "schrutebucks" => $this->getSB()];
    }

    //Setters
    function setId($id) {
        $this->id = $id;
    }
    function setUsername($username) {
        $this->username = $username;
    }
    function setPassword($password) {
        $this->password = $password;
    }
    function setEmail($email) {
        $this->email = $email;
    }
    function confirm() {
        $this->confirmed = true;
    }
    function setSB($sb) {
        $this->schrute_bucks = $sb;
    }
    function load($row) {
        $this->id = $row["id"];
        $this->username = $row["username"];
        $this->password = $row["password"];
        $this->email = $row["email"];
        $this->confirmed = $row["confirmed"];
        $this->schrute_bucks = $row["sb"];
    }

    function save() {
        $conn = connect();
        if (!$this->id) {
            $sql = "INSERT INTO users (username, password, email, confirmed, sb) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssid", $this->username, $this->password, $this->email, $this->confirmed, $this->schrute_bucks);
        }
        else {
            $sql = "UPDATE users SET username = ?, password = ?, email = ?, confirmed = ?, sb = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssidi", $this->username, $this->password, $this->email, $this->confirmed, $this->schrute_bucks, $this->id);
        }
        $stmt->execute();
        $conn->close();
    }

    //Utils
    static function getRowByUsername($username)
    {
        $conn = connect();

        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return formatRow($result);
    }
    static function getRowById($id) {
        $conn = connect();

        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return formatRow($result);
    }
    static function getUserById($id)
    {
        $user = new User(null, null, null, null, null, null);
        $row = self::getRowById($id);
        if ($row) {
            $user->load($row);
        }
        return $user;
    }
    static function getUserByUsername($username)
    {
        $user = new User(null, null, null, null, null, null);
        $row = self::getRowByUsername($username);
        if ($row) {
            $user->load($row);
        }
        return $user;
    }
}