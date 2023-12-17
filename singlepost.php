<?php
    session_start();
    include("./includes/header.php");
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    }
    $pid = $_GET['pid'];
    if(isset($_GET["delcom"])) {
        $comid = $_GET["delcom"];
        $delquery = "DELETE FROM Comment WHERE ID='$comid'";
        mysqli_query($db, $delquery);
        header("Location:singlepost.php?pid=$pid");
        exit();
    }
    if (isset($_GET['subcom'])) {
        $desc = $_GET['comment'];
        $insertquery = "INSERT INTO Comment (username, postid, description) VALUES ('$username', '$pid', '$desc')";
        mysqli_query($db, $insertquery);
        header("Location:singlepost.php?pid=$pid");
        exit();
    }
    $pid = $_GET['pid'];
    $querypost = "SELECT * FROM Post WHERE ID='$pid'";
    $post = mysqli_fetch_assoc(mysqli_query($db, $querypost));
    $querycomments = "SELECT * FROM Comment WHERE postid='$pid'";
    $comments = mysqli_query($db, $querycomments);
    $lid = $post["lanID"];
    $query2 = "SELECT * FROM Proglan WHERE ID='$lid'";
    $result2 = mysqli_fetch_assoc(mysqli_query($db, $query2));
    $usernam = $post["username"];
    $q3 = "SELECT * FROM user WHERE username='$usernam'";
    $result3 = mysqli_query($db, $q3);
    $user = mysqli_fetch_assoc($result3);
?>
<main>
    <div class="posts">
        <div class="posthead">
            <a class="Theposthead" href="usershow.php?user=<?php echo $post["username"];?>">
            <img class="userheaderimage" src="./assets/profiles/<?php echo (isset($user['image'])? $user['image'] : "default.jpeg");?>" alt="">
            <?php echo $post["username"];?></a>
            <h3><?php echo $post["TItle"];?></h3>
        </div>
        <p><?php echo $post["description"];?></p>
        <div class="postfoot">
            <p class="postdate"><?php echo $post["postDate"];?></p>
            <i><?php echo $result2["Name"];?></i>
        </div>
    </div>
    <?php
    foreach($comments as $comment) {
        $commenter = $comment['username'];
        $querycommenter = "SELECT * FROM user WHERE username='$commenter'";
        $commenteruser = mysqli_fetch_assoc(mysqli_query($db, $querycommenter));
        ?>
        <div class="comment">
            <div class="commenthead">
                <a class="Theposthead" href="usershow.php?user=<?php echo $commenteruser["username"];?>">
                <img class="userheaderimage" src="./assets/profiles/<?php echo isset($commenteruser['image'])? $commenteruser['image']: "default.jpeg";?>" alt="">
                <?php echo $commenteruser["username"];?></a>
            </div>
            <div class="commentbody">
                <p><?php echo $comment['description']?></p>
            </div>
            <?php
            if (isset($_SESSION['username'])){
                if ($username == $usernam) {
                    ?>
                    <a class="delete" href="singlepost.php?pid=<?php echo $_GET['pid']?>&delcom=<?php echo $comment['ID'];?>">حذف کامنت</a>
                    <?php
                }
            }
            ?>
        </div>
        <?php
    }
    if (isset($_SESSION['username'])){
    ?>
    <div class="addcomment">
        <form action="singlepost.php" method="get" class="commentform">
            <div class="commentinput">
                <label for="comment">کامنت:</label>
                <textarea name="comment" id="" cols="30" rows="5"></textarea>
            </div>
            <input type="text" name="pid" value="<?php echo $pid;?>" style="visibility: hidden;">
            <button type="submit" name="subcom">ارسال کامنت</button>
        </form>
    </div>
    <?php
    }
    ?>
</main>
<?php
    include("./includes/footer.php");
?>