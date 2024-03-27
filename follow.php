
<?php
require_once "config.php";

$db = new Database("localhost", "root", "", "cse348");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $follower_n = $_SESSION['username'];
    $following_n= $_POST['following_n'];


    $sqlFollow = "INSERT INTO follows (follower_n, following_n) VALUES ('$follower_n', '$following_n')";
    $db->query($sqlFollow);


    $sqlFollowersCount = "UPDATE users SET followers = followers + 1 WHERE username = '$following_n'";
    $db->query($sqlFollowersCount);

    $sqlFollowingCount = "UPDATE users SET following = following + 1 WHERE username = '$follower_n'";
    $db->query($sqlFollowingCount);


    header("Location: homepage.php");
    exit();
}

$db->close();
?>