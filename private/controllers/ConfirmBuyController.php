<?php

namespace controllers;
include_once __DIR__ . "/../conn.php";
include_once __DIR__ . "/../helpers.php";
include_once __DIR__ . "/../models/User.php";
include_once __DIR__ . "/../models/Item.php";
use models\User;
use models\Item;

class ConfirmBuyController
{
    static function render() {
        $item_id = isset($_GET["item_id"])  ? $_GET["item_id"] : "";
        $logged_in = isset($_COOKIE["signed-in"]) ? $_COOKIE["signed-in"] : "";
        $user = isset($_COOKIE["user-id"]) ? User::getUserById($_COOKIE["user-id"]) : null;
        $success = isset($_GET["success"]) ? $_GET["success"] : "";

        if ($success == "true") {
            echo 'Successfully purchased!';
            return;
        }
        elseif ($success == "false") {
            echo 'Something went wrong, sorry!';
            return;
        }

        if (!$item_id or !$user) {
            echo 'Something went wrong. Return to <a href="index.php">homepage</a>';
            return;
        }
        if ($logged_in == "true") {
            $item = Item::getItemById($item_id);
            echo '<h1>' . $item->getName() . '</h1>';
            echo '<div class="row">';
            echo '<img src="https://picsum.photos/200">';
            echo '<p class="item-cost">' . $item->getCost() . 'SB</p>';
            echo '</div>';
            echo '<hr>';
            echo '<p class="balance">You have ' . $user->getSB() . ' SB</p>';
            echo '<button class="purchase-btn" data-user-id="' . $user->getId() . '" data-item-id="' . $item->getId() . '">Confirm purchase</button>';
        }
        else {
            $url = "confirm_buy.php?item_id=" . $item_id;
            $encoded = urlencode($url);
            $new_url = "sign_in.php?location=" . $encoded;
            echo 'Please <a href="' . $new_url . '">sign in</a> to purchase this';
        }
    }
}