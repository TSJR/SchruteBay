<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buy</title>
    <link rel="stylesheet" href="css/inventory.css">
    <link rel="stylesheet" href="css/navbar.css">
</head>
<body>
<?php
include_once "common/navbar.php";
require_once "../private/controllers/BuyController.php";
?>
<main>
    <?php
        \controllers\BuyController::render();
    ?>
</main>
</body>
</html>