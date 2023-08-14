<?php

namespace models;
require_once __DIR__ . "/../helpers.php";
require_once __DIR__ . "/User.php";
require_once __DIR__ . "/../conn.php";
use models\User;
use function formatRow;
use function formatRows;

class Item {
    private $id;
    private $sellerId;
    private $name;
    private $cost;
    private $description;
    private $imgPath;
    private $selling;

    function __construct($id, $sellerId, $name, $cost, $description, $imgPath, $selling) {
        $this->id = $id;
        $this->sellerId = $sellerId;
        $this->name = $name;
        $this->cost = $cost;
        $this->description = $description;
        $this->imgPath = $imgPath;
        $this->selling = $selling;
    }

    //Getters
    function getId() {
        return $this->id;
    }
    function getSellerId() {
        return $this->sellerId;
    }
    function getName() {
        return $this->name;
    }
    function getCost() {
        return $this->cost;
    }
    function getDescription() {
        return $this->description;
    }
    function getImgPath() {
        return $this->imgPath;
    }
    function getSelling() {
        return $this->selling;
    }

    //Setters
    function setId($id) {
        $this->id = $id;
    }
    function setSellerId($sellerId) {
        $this->sellerId = $sellerId;
    }
    function setName($name) {
        $this->name = $name;
    }
    function setCost($cost) {
        $this->cost= $cost;
    }
    function setDescription($description) {
        $this->description = $description;
    }
    function setImgPath($imgPath) {
        $this->imgPath = $imgPath;
    }
    function setSelling($selling) {
        $this->selling = $selling;
    }
    function load($row) {
        $this->id = $row["id"];
        $this->sellerId = $row["seller_id"];
        $this->name = $row["name"];
        $this->cost = $row["cost"];
        $this->description = $row["description"];
        $this->imgPath = $row["img_path"];
        $this->selling = $row["selling"];
    }

    function save() {
        $conn = connect();
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        if (!$this->id) {
            $sql = "INSERT INTO items (seller_id, name, cost, description, img_path, selling) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);document.querySelector("#positives").classList.add("gone");
            $stmt->bind_param("isdssi", $this->id, $this->sellerId, $this->name, $this->cost, $this->description, $this->imgPath, $this->selling);
        }
        else {
            $sql = "UPDATE items SET seller_id = ?, name = ?, cost = ?, description = ?, img_path = ?, selling = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isdssii", $this->sellerId, $this->name, $this->cost, $this->description, $this->imgPath, $this->selling, $this->id);
        }
        $stmt->execute();
        $conn->close();
    }

    //Utils
    static function getRowByName($name) {
        $conn = connect();

        $sql = "SELECT * FROM items WHERE name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        return formatRow($result);
    }
    static function getRowById($id) {
        $conn = connect();

        $sql = "SELECT * FROM items WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return formatRow($result);
    }
    static function getItemById($id) {
        $item = new Item(null, null, null, null, null, null, null);
        $row = self::getRowById($id);
        $item->load($row);
        return $item;
    }
    static function getItemByName($name) {
        $item = new Item(null, null, null, null, null, null, null);
        $row = self::getRowByName($name);
        $item->load($row);
        return $item;
    }
}