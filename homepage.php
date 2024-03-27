<div class="container">
    <?php
    session_start();
    $username = $_SESSION['username'];
    ?>

    <h1>@ <?php echo $username; ?></h1>


    <form method="get" action="homepage.php">
        <div class="form-group">
            <input type="text" name="search" placeholder="Search for a user" required />
            <input type="submit" value="Search" />
        </div>
    </form>

    <?php
    if (isset($_GET['search'])) {
        $searchedUser = $_GET['search'];

        require_once "config.php";

        $db = new Database("localhost", "root", "", "cse348");


        $sql = "SELECT * FROM users WHERE username = '$searchedUser'";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $fullName = $user['name'];


            $sqlC_f = "SELECT * FROM follows WHERE follower_n = '$username' AND following_n = '$searchedUser'";
            $resultC_f= $db->query($sqlC_f);

            if ($resultC_f->num_rows > 0) {

                echo "<h2>Search Results:</h2>";
                echo "<p>Username: $searchedUser</p>";
                echo "<p>Full Name: $fullName</p>";
                echo "<button class='btn btn-passive'>Following</button>";

            } else {

                echo "<h2>Search Results:</h2>";
                echo "<p>Username: $searchedUser</p>";
                echo "<p>Full Name: $fullName</p>";
                echo "<form method='post' action='follow.php'>";
                echo "<input type='hidden' name='following_n' value='$searchedUser' />";
                echo "<input type='submit' class='btn' value='Follow' />";
                echo "</form>";
            }

        } else {
            echo "<h2>User Not Found</h2>";
        }

        $db->close();
    }
    ?>
    <?php
    if (!isset($_GET['search'])) {

        echo "<h2>Tweets</h2>";
        echo "<div class='tweet-container'>";

        require_once "config.php";

        $db = new Database("localhost", "root", "", "cse348");


        $tweets = $db->callProcedure("get_followed_tweets", [$username]);

        foreach ($tweets as $tweet) {
            echo "<div class='tweet'>";
            echo "<p>@" . $tweet['username'] . "</p>";
            echo "<p>Content: " . $tweet['text'] . "</p>";
            echo "<p>Created at: " . $tweet['date'] . "</p>";
            echo "<br>";
            echo "</div>";
        }
        $db->close();
        echo "</div>";
    }
    ?>

    <form method="post" action="profile.php">
        <div class="form-group">
            <input type="submit" value="Profile" />
        </div>
    </form>


    <form method="post" action="logout.php">
        <div class="form-group">
            <input type="submit" value="Logout" />
        </div>
    </form>
</div>