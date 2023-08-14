<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In</title>
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/navbar.css">
</head>
<body>
<?php
setcookie("signed-in", "false");
setcookie("user-id", "null");
include_once "common/navbar.php";
require_once "../private/controllers/SignInController.php";
use \controllers\SignInController as SignInController;

$username = "";
$password = "";

$errors = [
    "username" => "",
    "password" => "",
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new SignInController();

    $username = $controller->validateUsername();
    $password = $controller->validatePassword();

    $errors = $controller->getErrors();

    //No errors, good to sign in
    if (!implode($errors)) {
        $controller->checkCredentials();
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
<form action="<?='sign_in.php' . $url?>" method="post">
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
    <button id="submit-btn" type="submit">Sign in</button>
    <p>No account? <a href=<?="sign_up.php" . $url?>>Sign up</a></p>
</form>
</main>
</body>
</html>