<?php
    session_start();
    include("./includes/header.php");
    $query = "SELECT * FROM user";
    $users = mysqli_query($db, $query);
    if(isset($_POST["signup"])){
        $username = $_POST["username"];
        $email = $_POST["email"];
        $query1 = "SELECT * FROM user WHERE username=$username";
        $query2 = "SELECT * FROM user WHERE email=$email";
        $result1 = mysqli_query($db, $query1);
        if(mysqli_num_rows($result1) ==  1){
            $err = "این نام کاربری قبلا انتخاب شده است!!";
            header("Location:signup.php?err=$err");
            exit();
        } else {
            $result2 = mysqli_query($db, $query2);
            if(mysqli_num_rows($result2) == 1){
                $err = "این ایمیل قبلا انتخاب شده است!!";
                header("Location:signup.php?err=$err");
                exit();
            } else {
                $name = $_POST["name"];
                $isadmin = 0;
                $email = $_POST["email"];
                $newquery = "INSERT INTO user (username, name, email, password, isAdmin) VALUES ($username, $name, $email, $password, $isadmin";
                $adduser = mysqli_query($db, $newquery);
                $_SESSION["username"] = $username;
                header("Location:index.php");
                exit();
            }
        }
    }
?>
<main>
    <?php
    if (isset($_GET["err"])){
        ?>
        <p class="error"><?php echo $_GET["err"];?></p>
        <?php             
    }
    ?>
    <form class="SLform" action="signup.php" method="post">
        <div class="SLfield">
            <label for="username">نام کاربری:</label>
            <input type="text" name="username">
        </div>
        <div class="SLfield">
            <label for="name">نام:</label>
            <input type="text" name="name">
        </div>
        <div class="SLfield">
            <label for="email">ایمیل:</label>
            <input type="email" name="email">
        </div>
        <div class="SLfield">
            <label for="password">رمز عبور:</label>
            <input type="password" name="password">
        </div>
        <button type="submit" name="signup">عضویت</button>
        <a href="login.php">حساب کاربری دارید؟</a>
    </form>
</main>
<?php
    include("./includes/footer.php");
?>