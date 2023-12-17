<?php
    session_start();
    include("./includes/header.php");
    $username = $_SESSION['username'];
    $query = "SELECT * FROM Follow WHERE follower='$username'";
    $result = mysqli_query($db, $query);
    $querypost = "SELECT * FROM Post ORDER BY postDate DESC";
    $resultpost = mysqli_query($db, $querypost);
    function inres(string $username, mysqli_result $res) {
        foreach ($res as $row) {
            if ($row["following"] == $username){
                return true;
            }
        }
        return false;
    }
?>
<main>
    <?php
    if ($result->num_rows > 0) {
        foreach ($resultpost as $post) {
            if(inres($post["username"], $result)){
                $lid = $post["lanID"];
                $query2 = "SELECT * FROM Proglan WHERE ID='$lid'";
                $result2 = mysqli_fetch_assoc(mysqli_query($db, $query2));
                $username = $post["username"];
                $q3 = "SELECT * FROM user WHERE username='$username'";
                $result3 = mysqli_query($db, $q3);
                $user = mysqli_fetch_assoc($result3);
                ?>
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
                        <a href="singlepost.php?pid=<?php echo $post['ID']?>">بیشتر...</a>
                    </div>
                </div>
                <?php
            }
        }
    } else {
        ?>
        <h3>شما کسی را دنبال نکرده اید</h3>
        <?php
    }
    ?>
</main>

<?php
    include("./includes/footer.php");
?>