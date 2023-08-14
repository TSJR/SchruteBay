<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/navbar.css">
</head>
<body>
<?php
include_once "common/navbar.php";

require_once "../private/controllers/SignUpController.php";
require_once "../private/models/User.php";
use \controllers\SignUpController as SignUpController;
use models\User;

$username = "";
$password = "";
$confPassword = "";
$email = "";

$errors = [
    "username" => "",
    "password" => "",
    "conf-password" => "",
    "email" => ""
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new SignUpController();

    $username = $controller->validateUsername();
    $password = $controller->validatePassword();
    $confPassword = $controller->validateConfPassword();
    $email = $controller->validateEmail();

    $errors = $controller->getErrors();

    //No errors, good to check database
    if (!implode($errors)) {
        $controller->signUp();
    }
    $errors = $controller->getErrors();
}

//Consider moving to controller
$url = (isset($_GET["location"]) ?  $_GET["location"] : "");
if (urldecode($url) == $url) {
    $url = urlencode($url);
}
if ($url) {
    $url = "?location=" . $url;
}
?>
<main>
<form action="<?='sign_up.php' . $url?>" method="post">
    <label for="username">Username</label>
    <input type="text" class="form-input" name="username" id="username" value=<?=$username?>>
    <br>
    <p class="error" id="username-error"><?=$errors["username"]?></p>
    <br>

    <label for="password">Password</label>
    <input type="password" class="form-input" name="password" id="password" value=<?=$password?>>
    <br>
    <p class="error" id="password-error"><?=$errors["password"]?></p>
    <br>

    <label for="conf-password">Confirm password</label>
    <input type="password" class="form-input" name="conf-password" id="conf-password" value=<?=$confPassword?>>
    <br>
    <p class="error" id="conf-password-error"><?=$errors["conf-password"]?></p>
    <br>

    <label for="email">Email</label>
    <input type="email" class="form-input" name="email" id="email" value=<?=$email?>>
    <br>
    <p class="error" id="email-error"><?=$errors["email"]?></p>
    <br>

    <button id="submit-btn" type="submit">Sign up</button>
</form>
</main>
</body>
</html>