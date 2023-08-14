<?php
include_once "models/User.php";
include_once "conn.php";
use models\User;

//General validation
function validateLen($str, $min = 4, $max = 12)
{
    return strlen($str) >= $min && strlen($str) <= $max;
}
function validateStr($str)
{
    return preg_match('/^[a-z0-9\~\!\@\#\$\%\^\&\*\(\)\_\-\+\=\{\}\[\]\|\\\:\;\"\'\<\>\?\,\.\/]*$/i', $str);
}

//General SQL
function formatRow($result)
{
    $entry = null;
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $entry = $row;
    }
    return $entry;
}
function formatRows($result) {
    $entries = [];
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $entries[] = $row;
    }
    return $entries;
}

//User (consider adding to User model)


//Item (consider adding to Item model)
function getRowByItemName($item_name) {
    $conn = connect();

    $sql = "SELECT * FROM items WHERE name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $item_name);
    $stmt->execute();
    $result = $stmt->get_result();
    return formatRow($result);
}
function getRowByItemId() {}