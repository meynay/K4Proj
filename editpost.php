<?php
    session_start();
    include("./includes/header.php");
    $username = $_SESSION["username"];
    if(isset($_GET["edited"])){
        $description = $_GET['desc'];
        $title = $_GET['title'];
        $pid = $_GET['pid'];
        $query1 = "UPDATE Post SET Post.TItle='$title' AND Post.description='$description' WHERE Post.ID='$pid'";
        mysqli_query($db, $query1);
        header("Location:userpage.php");
        exit();
    }
?>
<main>
    <?php
    if (isset($_GET['pid'])) {
        $pid = $_GET['pid'];
        $query = "SELECT * FROM Post WHERE ID='$pid'";
        $result = mysqli_fetch_assoc(mysqli_query($db, $query));
        ?>
            <form action="editpost.php" method="get" class="editpost">
                <div>
                    <label for="title" style="margin-left:10px;">عنوان:</label>
                    <input type="text" name="title" value="<?php echo $result['TItle']?>">
                </div>
                <div class="textareacontainer">
                    <label for="desc">توضیحات:</label>
                    <textarea name="desc"cols="50" rows="5"><?php echo $result['description']?></textarea>
                </div>
                <input type="number" name="pid" id="" value="<?php echo $pid;?>" style="visibility: hidden;">
                <button type="submit" name="edited">ثبت تغییرات</button>
            </form>
        <?php
    } else {
        $query = "SELECT * FROM Proglan";
        $result = mysqli_query($db, $query);
        ?>
         <form action="addpost.php" method="get" class="editpost">
                <div>
                    <label for="title" style="margin-left:10px;">عنوان:</label>
                    <input type="text" name="title">
                </div>
                <div class="textareacontainer">
                    <label for="desc">توضیحات:</label>
                    <textarea name="desc"cols="50" rows="5"></textarea>
                </div>
                <div>
                    <label for="PLid" style="margin-left:10px;">زبان برنامه نویسی</label>
                    <select name="PLid" id="">
                        <?php
                        foreach ($result as $row) {
                            ?>
                            <option value="<?php echo $row['ID']?>"><?php echo $row['Name']?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" name="edited">اضافه کردن پست</button>
            </form>
        <?php
    }
    ?>

</main>
<?php
    include("./includes/footer.php");
?>