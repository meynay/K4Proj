<?php
    session_start();
    include("./includes/header.php");
    $username = $_SESSION['username'];
    $queryuser = "SELECT * FROM user WHERE username='$username'";
    $queryposts = "SELECT * FROM Post WHERE username='$username' ORDER BY postDate DESC";
    $user = mysqli_fetch_assoc(mysqli_query($db, $queryuser));
    $res2 = mysqli_query($db, $queryposts);
    if (isset($_GET['pid'])) {
        $pid = $_GET['pid'];
        $q = "DELETE FROM Post WHERE ID='$pid'";
        mysqli_query($db, $q);
        header("Location:userpage.php");
        exit();
    }
    if(isset($_POST['submitname'])) {
        $newname = $_POST['name'];
        $queryuser = "UPDATE user SET user.name='$newname' WHERE username='$username'";
        mysqli_query($db, $queryuser);
        header("Location:userpage.php");
        exit();
    }
    if(isset($_POST["changepass"])) {
        $oldpass = $_POST["oldpass"];
        $newpass = $_POST["newpass"];
        $thepass = $user["password"];
        $didwechanged = false;
        if($thepass == $oldpass) {
            $didwechanged = true;
            $querrr = "UPDATE user SET password='$newpass' WHERE username='$username'";
            mysqli_query($db, $querrr);
        } 
    }
?>
<main>
    <div class="theuserpaging">
        <div>
            <div class="thetwoup">
                <img class="usershowprofileimage" src="./assets/profiles/<?php echo isset($user['image'])? $user['image']: "default.jpeg";?>" alt="">
                <h3><?php echo $user['username'];?></h3>
            </div>
            
            <form action="./setimage.php" method="post" enctype="multipart/form-data">
                <input type="file" name="image" accept="image/*">
                <button type="submit">تایید عکس</button>
            </form>
        </div>
        <div>
            <form action="userpage.php" method="post" class="nameform">
                <label for="name" style="margin-left:20px;">نام:</label>
                <input type="text" style="margin-left:20px;" name="name" value="<?php echo $user['name'];?>">
                <button type="submit" name="submitname">تغییر نام</button>
            </form>
        </div>
        <?php
        if (isset($_POST["changepass"])){
            if  ($didwechanged ) {
                ?>
                <p class="success">رمز عبور با موفقیت تغییر یافت</p>
                <?php
            } else {
                ?>
                <p class="error">رمز قبلی اشتباه است!!!</p>
                <?php
            }
        }
        ?>
        <div>
            <form action="userpage.php" method="post" class="nameform">
                <div>
                    <label for="oldpass" style="margin-left:20px;">رمز عبور قبلی</label>
                    <input type="password" style="margin-left:20px;" name="oldpass">
                </div>
                <div>
                    <label for="newpass" style="margin-left:20px;">رمز عبور جدید</label>
                    <input type="password" style="margin-left:20px;" name="newpass">
                </div>
                <button type="submit" name="changepass">تغییر رمز عبور</button>
            </form>
        </div>
        <div class="userpageposts">
            <?php
            foreach($res2 as $row) {
                $lid = $row["lanID"];
                $query2 = "SELECT * FROM Proglan WHERE ID='$lid'";
                $result2 = mysqli_fetch_assoc(mysqli_query($db, $query2));
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
                        <i><?php echo $result2["Name"];?></i>
                        <a href="singlepost.php?pid=<?php echo $row['ID']?>">بیشتر...</a>
                    </div>
                    <div class="chaningpost">
                        <a href="userpage.php?pid=<?php echo $row['ID'];?>">حذف پست</a>
                        <a href="editpost.php?pid=<?php echo $row['ID'];?>">ویرایش پست</a>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <a href="../logout.php">خروج از اکانت</a>
</main>
<?php
    include("./includes/footer.php");
?>