<?php
    include("./includes/header.php");
    $query = "SELECT * FROM Post ORDER BY RAND() LIMIT 20";
    $result = mysqli_query($db, $query);
?>
<main>
    <?php
        foreach ($result as $row) {
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
                    <a href="usershow.php?user=<?php echo $row["username"];?>">
                    <img class="userheaderimage" src="./assets/profiles/<?php echo (isset($user['image'])? $user['image'] : "default.jpeg");?>" alt="">
                    <?php echo $row["username"];?></a>
                    <h3><?php echo $row["TItle"];?></h3>
                </div>
                <?php 
                if (isset($row["image"])) {
                    ?>
                    <img class="post-image" src="./assets/posts/<?php echo $row["image"];?>" alt="">
                    <?php
                }
                ?>
                <p><?php echo $row["description"];?></p>
                <div class="postfoot">
                    <p class="postdate"><?php echo $row["postDate"];?></p>
                    <i><?php echo $row2["Name"];?></i>
                    <a href="singlepost.php?pid=<?php echo $row['ID']?>">بیشتر</a>
                </div>
                
            </div>
            <?php
            }
        }
    ?>
    <h1>index.php</h1>
</main>
<?php
    include("./includes/footer.php");
?>