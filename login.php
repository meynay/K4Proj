<?php
    session_start();
    include("./includes/header.php");
    $quey = "SELECT * FROM user";
    $res =  $db->query($quey);
    if (isset($_POST["login"])) {
        if ($_POST["username"] != "" && $_POST["pass"] != "") {
            $username = $_POST["username"];
            $password = $_POST["pass"];
            foreach ($res as $row) {
                if ($row["username"] == $username) {
                    if ($row["password"] == $password) {
                        $_SESSION["username"] = $username;
                        header("Location:./index.php");
                        exit();
                    } else {
                        $err = "رمزعبور اشتباه است!!";
                        header("Location:./login.php?err=$err");
                        exit();
                    }
                }
            }
            $err = "نام کاربری اشتباه است!!";
            header("Location:login.php?err=$err");
            exit();
        } else{
            $err = "لطفا تمام فیلدها را پر کنید!!";
            echo $err;
            header("Location:login.php?err=$err");
            exit();
        }
    }
?>
<main>
    <form class="SLform" action="login.php" method="post">
        <?php
            if (isset($_GET["err"])){
                ?>
                <p class="error"><?php echo $_GET["err"]; ?></p>
                <?php
            }
        ?>
        <div class="SLfield">
            <label for="">نام کاربری:</label>
            <input type="text" name="username">
        </div>
        <div class="SLfield">
            <label for="">رمز عبور:</label>
            <input type="password" name="pass">
        </div>
        <button type="submit" name="login">ورود</button>
        <a href="signup.php">حساب کاربری ندارید؟</a>
    </form>
</main>
<?php
    include("./includes/footer.php");
?>