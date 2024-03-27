<?php
session_start();
if (!isset($_SESSION['username'])) {

    header("Location: login.php");
    exit();
}

require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $tweet = $_POST["tweet"];


    $db = new Database("localhost", "root", "", "cse348");

    $sql = "INSERT INTO tweets (username, text) VALUES ('$username', '$tweet')";
    $db->query($sql);


    $sql = "UPDATE users SET t_c= t_c + 1 WHERE username = '$username'";
    $db->query($sql);

    if ($db->query($sql) === true) {

        header("Location: profile.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $db->conn->error;
    }

    $db->close();
}
?>