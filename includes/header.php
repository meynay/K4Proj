<?php
    session_start();
    include("dbconfig.php");
    if (isset($_SESSION["username"])) {
        $user = $db->query("");
        $user->execute();
        foreach ($user->fetchAll(PDO::FETCH_ASSOC) as $row){
            $name = $row["name"];
            $admin = $row["isAdmin"];
            $image = $row["image"];
        }
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
    <nav>
        <div>
            <ul class="topnavigation">
                <li><a href="index.php">خانه</a></li>
                <li><a href="search.php">جستجو</a></li>
                <li><a href="followings.php">دنبال شوندگان</a></li>
            </ul>
        </div>
        <div class="navgroup2">
            <a class="headeruser" href="<?php
                if(isset($_SESSION["username"])){
                    if($admin){
                        echo "../admin/admin.php";
                    }else {
                        echo "../userpage.php";
                    }
                } else {
                    echo "signup.php";
                }
            ?>">
                <p><?php
                if (isset($name)){
                    echo $name;
                } else {
                    echo "حساب کاربری";
                }
                ?></p>
                <img class="userheaderimage" src="../assets/profiles/<?php
                    if (isset($image)){
                        echo $image;
                    } else {
                        echo "default.jpeg";
                    }
                ?>" alt="">
            </a>
        </div>
    </nav>
    
