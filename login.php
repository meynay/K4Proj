<?php
    session_start();
    include("./includes/header.php");
    if (isset($_POST["login"])) {
        if (isset($_POST["username"]) && isset( $_POST["password"])){
            $username = $_POST["username"];
            $password = $_POST["password"];
            $query = "SELECT * FROM user WHERE username=$username and password=$password";
            $result = mysqli_query($conn, $query);
            if ($result->num_rows == 1) {
                $_SESSION["username"] = $username;
                header("Location:index.php");
                exit();
            } else {
                $err = "نام کاربری یا رمزعبور اشتباه است!!";
                header("Location:login.php?err=$err");
                exit();
            }
        }
    }
?>
<main>
    <?php
        if (isset($_GET["err"])){
            ?>
            <p class="error"><?php echo $_GET["err"]; ?></p>
            <?php
        }
    ?>
    <form class="SLform" action="login.php" method="post">
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