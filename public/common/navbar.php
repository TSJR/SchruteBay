<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../css/navbar.css">
</head>
<body>
<?php
require_once "../private/controllers/NavController.php";
?>
<a href="index.php">
<nav>
    <div id="logo">
        <img src="images/schrute.png" alt="logo">
        <p id="logo-text"></p>
    </div>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="buy.php">Buy</a></li>
        <li><a href="sell.php">Sell</a></li>
    </ul>
    <div id="s-buck-counter"><?=\controllers\NavController::render()?> SchruteBucks</div>
</nav>
</a>
</body>
<script>
    let str = "schruteBay";
    let logo = document.querySelector("#logo-text");

    for (let i = 0; i < str.length; i++) {
        let col = "red";
        switch (i % 4) {
            case 1:
                col = "blue";
                break;
            case 2:
                col = "yellow";
                break;
            case 3:
                col = "green";
                break;
            default:
                col = "red";
                break
        }

        let span = document.createElement("span");
        span.setAttribute("class", col);
        span.innerText = str[i];
        logo.appendChild(span);

    }
</script>
</html>