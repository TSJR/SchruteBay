<?php

namespace controllers;
include_once __DIR__ . "/../conn.php";
include_once __DIR__ . "/../helpers.php";
include_once __DIR__ . "/../models/User.php";
include_once __DIR__ . "/../models/Item.php";
use models\User;
use models\Item;

class BuyController
{
    static function render()
    {
        $logged_in = isset($_COOKIE["signed-in"]) ? $_COOKIE["signed-in"] : "";
        $user = isset($_COOKIE["user-id"]) ? User::getUserById($_COOKIE["user-id"]) : null;

        $conn = connect();
        //Fetches ~all~ items that are NOT user's

        $sql = $logged_in == "true" ? "SELECT name, cost, id FROM items WHERE seller_id != ? AND selling = 1" : "SELECT name, cost, id FROM items WHERE selling = 1";
        $stmt = $conn->prepare($sql);

        if ($logged_in == "true") {
            $id = $user->getId();
            $stmt->bind_param("i", $id);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $items = formatRows($result);

        echo '<div id="full-inventory">';
        foreach ($items as $item) {
            echo '<div class="inventory-item">';
            echo '<img src="https://picsum.photos/200">';
            echo '<div class=item-text>';
            echo '<p class="item-title">' . $item["name"] . '</p>';
            echo '<p class="item-cost">' . $item["cost"] . ' SB</p>';
            echo '</div>';
            echo '<a href="../public/view_item.php?item_id=' . $item["id"] . '"></a>';
            echo '</div>';
        }
        echo '</div>';

    }
}