<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/view_item.css">
    <?php
        require_once "../private/controllers/ItemController.php";
    ?>
    <title><?php
        \controllers\ItemController::render_title()
        ?></title>
</head>
<body>
<?php
include_once "common/navbar.php";
\controllers\ItemController::render()
?>
</body>
</html>