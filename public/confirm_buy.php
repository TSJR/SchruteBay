<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/confirm_buy.css">
    <script src="js/confirm_buy.js" defer></script>
</head>
<body>
<?php
include_once "common/navbar.php";
require_once "../private/controllers/ConfirmBuyController.php";
?>
<main>
    <?php
    \controllers\ConfirmBuyController::render();
    ?>
</main>
</body>
</html>