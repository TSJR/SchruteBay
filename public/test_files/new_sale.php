<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../css/new_sale.css">
    <link rel="stylesheet" href="../css/navbar.css">
</head>
<body>

<main>
    <form>
    <h1>Create new listing</h1>
        <br>
    <label for="title">Title</label>
    <input class="form-input" name="title" id="title">
        <br>
        <br>
    <label for="desc">Description</label>
    <textarea class="form-input" name="desc" id="desc" oninput="autoResize()"></textarea>
        <br>
        <br>
    <label for="cost">Cost</label>
    <input class="form-input" type="text" id="cost" onfocus="this.select();" placeholder="">
        <br>
        <br>
        <div class="row">
    <label for="img">Image</label>
    <input type="file" name="img" id="img" accept="image/*" style="color:transparent" onchange="loadFile(event)">
            <img src="#">
        </div>
        <br>
        <br>
    </form>

</main>

<script src="../js/new_sale.js"></script>

</body>
</html>