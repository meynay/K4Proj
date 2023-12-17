<?php
    session_start();
    include("./includes/header.php");
    $querylangs = "SELECT * FROM Proglan";
    $queryusers = "SELECT * FROM user WHERE isAdmin='0'";
    $resultusers = mysqli_query($db, $queryusers);
    $resultlangs = mysqli_query($db, $querylangs);
    if (isset($_GET["addlang"])) {
        $name = $_GET['name'];
        $addlang = "INSERT INTO Proglan(Name) VALUES ('$name')";
        mysqli_query($db, $addlang);
        header("Location:admin.php");
        exit();
    }
    if (isset($_GET["user"])) {
        $user = $_GET["user"];
        $quers = "UPDATE user SET isAdmin=1 WHERE username='$user'";
        mysqli_query($db,$quers);
        header("Location:admin.php");
        exit();
    }
?>
<main>
    <div class="thepage">
        <div class="languages">
            <?php
            foreach($resultlangs as $lang) {
                ?>
                <div class="language">
                    <p styel="margin-right:50px;"><?php echo $lang['Name'];?></p>
                    <a class="delete" href="deletelang?id=<?php echo $lang['ID'];?>">حذف زبان</a>
                </div>
                <?php
            }
            ?>
            <div class="addlan">
                <form action="admin.php" method="get">
                    <label for="name">نام زبان:</label>
                    <input type="text" name="name" id="">
                    <button type="submit" name="addlang">اضافه کردن</button>
                </form>
            </div>
        </div>
        <div class="users">
            <?php
            foreach($resultusers as $user) {
                ?>
                <div class="oneuser">
                    <p><?php echo $user['username']?></p>
                    <a class="add-admin" href="admin.php?user=<?php echo $user['username']?>">ادمین کردن کاربر</a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <a href="./userpage.php">اکانت عادی</a>
    <a href="./logout.php">خروج از اکانت</a>
</main>
<?php
    include("./includes/footer.php");
?>