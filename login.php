<?php
require_once "config.php";

$db = new Database("localhost", "root", "", "cse348");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];


    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $db->query($sql);

    if ($result->num_rows == 1) {

        $_SESSION['username'] = $username;
        header("Location: HomePage.php");
        exit();
    } else {

        echo "Invalid username or password. Please try again.";
    }
}

$db->close();
?>
