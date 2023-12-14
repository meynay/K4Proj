<?php
    include("./includes/header.php");
    $query = "SELECT * FROM user";
    $users = mysqli_query($db, $query);
    if(isset($_POST["signup"])){
        if ($_POST["username"] != "" && $_POST["name"] != "" && $_POST["password"] != "" && $_POST["email"] != ""){
            $username = $_POST["username"];
            $email = $_POST["email"];
            foreach($users as $user){
                if($user["username"] == $username){
                    $err = "این نام کاربری قبلا انتخاب شده است!!";
                    header("Location:signup.php?err=$err");
                    exit();
                } elseif($user["email"] == $email){
                    $err = "این ایمیل قبلا انتخاب شده است!!";
                    header("Location:signup.php?err=$err");
                    exit();
                }
            }
            $name = $_POST["name"];
            $isadmin = 0;
            $password = $_POST["password"];
            $query2 = "INSERT INTO user(username, user.name, email, isAdmin, user.password) VALUES ('$username', '$name', '$email', '$isadmin', '$password')";
            mysqli_query($db, $query2);
            $_SESSION["username"] = $username;
            header("index.php");
            exit();
        } else {
            $err = "لطفا تمام فیلدها را پر کنید!!";
            header("Location:signup.php?err=$err");
            exit();
        }
    }
?>
<main>
    <form class="SLform" action="signup.php" method="post">
        <?php
        if (isset($_GET["err"])){
            ?>
            <p class="error"><?php echo $_GET["err"];?></p>
            <?php             
        }
        ?>
        <div class="SLfield">
        </div>
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