<?php
require_once "config.php";

$db = new Database("localhost", "root", "", "cse348");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "INSERT INTO users (name, username, password) VALUES ('$name', '$username', '$password')";

    if ($db->query($sql) === true) {

        header("Location: index.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $db->query($sql);
    }
}

$db->close();
?>