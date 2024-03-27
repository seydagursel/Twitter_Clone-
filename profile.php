<div class="container">
    <?php
    session_start();
    $username = $_SESSION['username'];
    ?>

    <div class="profile-info" >
        <?php

        require_once "config.php";

        $db = new Database("localhost", "root", "", "cse348");

        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            echo "<h1>Welcome," . $user['name'] . " !</h1>";
            echo "<p>Username: " . $user['username'] . "</p>";
            echo "<p>Followers: " . $user['followers'] . "</p>";
            echo "<p>Following: " . $user['following'] . "</p>";
            echo "<p>Creation Date: " . $user['date'] . "</p>";
        } else {
            echo "User not found.";
        }

        $db->close();
        ?>
    </div>


    <h2>Post a Tweet</h2>
    <form method="post" action="tweet.php">
        <div class="form-group">
            <textarea name="tweet" placeholder="Write a tweet" required></textarea>
        </div>
        <div class="form-group">
            <input type="submit" value="Post" />
        </div>
    </form>


    <h2>Your Tweets</h2>
    <div class="tweet-container">
        <?php
        require_once "config.php";

        $db = new Database("localhost", "root", "", "cse348");

        $tweets = $db->callProcedure("get_user_tweets", [$username]);

        foreach ($tweets as $tweet) {
            echo "<div class='tweet'>";
            echo "<p>Content: " . $tweet['text'] . "</p>";
            echo "<p class='tweet-info'>Created At: " . $tweet['date'] . "</p>";
            echo "<br>";
            echo "</div>";
        }

        $db->close();
        ?>
    </div>

    <form method="post" action="homepage.php">
        <div class="form-group">
            <input type="submit" value="Homepage" />
        </div>
    </form>


    <form method="post" action="logout.php">
        <div class="form-group">
            <input type="submit" value="Logout" />
        </div>
    </form>
</div>