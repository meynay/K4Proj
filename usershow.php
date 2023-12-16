<?php
    session_start();
    include("./includes/header.php");
    $username = $_GET['user'];
    $queryuser = "SELECT * FROM user WHERE username='$username'";
    $queryposts = "SELECT * FROM Post WHERE username='$username'";
    $res1 = mysqli_query($db, $queryuser);
    $res2 = mysqli_query($db, $queryposts);
    $user = mysqli_fetch_assoc($res1);
    if (isset($_SESSION['username']))
    {
        $userName = $_SESSION['username'];
        $quer = "SELECT * FROM user WHERE username='$userName'";
        $theuserinside = mysqli_fetch_assoc(mysqli_query($db, $quer));
        $queryy = "SELECT * FROM Follow WHERE follower='$userName' and Follow.following='$username'";
        $followed = mysqli_fetch_assoc(mysqli_query($db, $queryy));
    }
?>
    <main>
        <div class="theuserpaging">
            <div class="usershowUname">
                <h2><?php echo $user['username']; ?></h2>
                <img class="usershowprofileimage" src="./assets/profiles/<?php echo isset($user['image'])? $user['image']: "default.jpeg";?>" alt="">
            </div>
            <?php
            if (isset($_SESSION['username'])) {
            ?>
            <div class="usershowbuttonfollow">
                <a href="follow.php?follower=<?php echo $userName;?>&following=<?php echo $username;?>">
                <button class="
                <?php
                    if (isset($followed)) {
                        echo "unfollow";
                    } else {
                        echo "follow";
                    }
                ?>">
                    <?php
                    if (isset($followed)) {
                        echo "Unfollow";
                    } else {
                        echo "Follow";
                    }
                    ?>
                </button>
                </a>
            </div>
            <?php
            }
            ?>
            <div>
                <p><?php ?></p>
            </div>
        </div>
    </main>
<?php
    include("./includes/footer.php")
?>