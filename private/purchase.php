<?php

include_once __DIR__ . "/conn.php";
include_once __DIR__ . "/helpers.php";
include_once __DIR__ . "/models/User.php";
include_once __DIR__ . "/models/Item.php";
use models\User;
use models\Item;

$user = isset($_POST["userId"]) ? User::getUserById($_POST["userId"]) : null;
$item = isset($_POST["itemId"]) ? Item::getItemById($_POST["itemId"]) : null;

if ($user and $item) {
    $curSB = $user->getSB();
    $itemCost = $item->getCost();
    $user->setSB($curSB - $itemCost);
    $user->save();

    $item->setSelling(0);
    $item->save();

    echo "success";
}
else {
    echo "error";
}