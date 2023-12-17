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
        if($username == $userName) {
            header("Location:userpage.php");
        }
        $quer = "SELECT * FROM user WHERE username='$userName'";
        $theuserinside = mysqli_fetch_assoc(mysqli_query($db, $quer));
        $queryy = "SELECT * FROM Follow WHERE follower='$userName' and Follow.following='$username'";
        $followed = mysqli_fetch_assoc(mysqli_query($db, $queryy));
    }
    $queryer = "SELECT * FROM Follow WHERE following='$username'";
    $resultyer = mysqli_query($db, $queryer);
    $querying = "SELECT * FROM Follow WHERE follower='$username'";
    $resulting = mysqli_query($db, $querying);
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
            <div>
                <p>دنبال کنندگان: <?php echo $resultyer->num_rows;?></p>
                <p>دنبال شوندگان: <?php echo $resulting->num_rows;?></p>
            </div>
            <?php
            }
            ?>
            <div>
                <h4><?php echo $user['name'];?></h4>
            </div>
            <div class="userpageposts">
                <?php
                foreach($res2 as $row) {
                    $lid = $row["lanID"];
                    $query2 = "SELECT * FROM Proglan WHERE ID='$lid'";
                    $result2 = mysqli_query($db, $query2);
                    $username = $row["username"];
                    $q3 = "SELECT * FROM user WHERE username='$username'";
                    $result3 = mysqli_query($db, $q3);
                    $user = mysqli_fetch_array($result3);
                    foreach ($result2 as $row2) {
                    ?>
                    <div class="posts">
                        <div class="posthead">
                            <a class="Theposthead" href="usershow.php?user=<?php echo $row["username"];?>">
                            <img class="userheaderimage" src="./assets/profiles/<?php echo (isset($user['image'])? $user['image'] : "default.jpeg");?>" alt="">
                            <?php echo $row["username"];?></a>
                            <h3><?php echo $row["TItle"];?></h3>
                        </div>
                        <p><?php echo $row["description"];?></p>
                        <div class="postfoot">
                            <p class="postdate"><?php echo $row["postDate"];?></p>
                            <i><?php echo $row2["Name"];?></i>
                            <a href="singlepost.php?pid=<?php echo $row['ID']?>">بیشتر...</a>
                        </div>
                    </div>
                    <?php
                    }
                }
                ?>
            </div>
        </div>
    </main>
<?php
    include("./includes/footer.php")
?>