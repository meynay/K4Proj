<?php
    include("./db.php");
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $user = $db->prepare("SELECT * FROM user WHERE username = :username");
        $user->execute(['username'=> $username]);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heap Underflow</title>
    <link rel="shortcut icon" href="../assets/LOGO.png" type="image/x-icon">
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="navitems">
            <a href="#">صفحه اصلی</a>
            <a href="#">دنبال شوندگان</a>
            <a href="#">صفحه من</a>
        </div>
        <div class="navitems">
            <input type="text" name="" id="">
            <button class="search-button">جستجو</button>
        </div>
        <div class="navitems useraccountEnter">
            <a class="prof-tag" href="<?php
                if (isset($_SESSION['username'])) {
                   echo '../userpage.php';
                } else{
                    echo '../signup.php';
                }
            ?>">
                <img class="profile-pic" src="../assets/profiles/<?php if (isset($_SESSION['username'])){ echo $user['image']; }else { echo 'default.jpeg';}?>" alt="">
                <!-- <p><?php
                    if (isset($_SESSION['username'])) {
                        echo $user['name'];
                    } else {
                        echo 'حساب کاربری';
                    }
                ?></p> -->
            </a>
        </div>
    </nav>