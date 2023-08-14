<?php

namespace controllers;
include_once __DIR__ . "/../models/User.php";
use models\User;
include_once __DIR__ . "/../models/Item.php";
use models\Item;

class ItemController
{
    static function render() {

        $item_id = isset($_GET["item_id"])  ? $_GET["item_id"] : "";
        if (!$item_id) {
            echo 'Something went wrong. Return to <a href="index.php">homepage</a>';
            return;
        }
        else {

            $item = Item::getItemById($item_id);
            echo '<main>';
            echo '<h1>' . $item->getName() . '</h1>';
            echo '<div class="row">';
            echo '<img class="item-img" src="https://picsum.photos/500">';
            echo '<p class="item-desc">' . $item->getDescription() . '</p>';
            echo '</div>';
            echo '<button onclick="location.href = \'../public/confirm_buy.php?item_id=' . $item_id . '\';"class="purchase-btn">Purchase for ' . $item->getCost() . ' SB</button>';
            echo '</main>';
        }

    }
    static function render_title() {
        $item_id = isset($_GET["item_id"])  ? $_GET["item_id"] : "";
        if (!$item_id) {
            echo 'Error';
            return;
        }
        $item = Item::getItemById($item_id);
        echo 'Buy ' . $item->getName();
    }
}