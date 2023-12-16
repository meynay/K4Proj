<?php
    session_start();
    include("dbconfig.php");
    $query = "SELECT * FROM user";
    $result = mysqli_query($db, $query);
    if (isset($_SESSION["username"])) {
        foreach($result as $row) {
            if ($row["username"] == $_SESSION["username"]) {
                $name = $row["name"];
                $image = $row["image"];
                $admin = $row["isAdmin"];
            }
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lalezar&family=Lato:wght@300;400;700&display=swap" rel="stylesheet"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lalezar&family=Lato:wght@300;400;700&family=Vazirmatn:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <nav>
        <div>
            <ul class="topnavigation">
                <li><a href="index.php">خانه</a></li>
                <li><a href="search.php">جستجو</a></li>
                <?php
                    if (isset($_SESSION["username"])) {
                        ?>
                        <li><a href="followings.php">دنبال شوندگان</a></li>
                        <?php
                    }
                ?>
            </ul>
        </div>
        <div class="navgroup2">
            <a class="headeruser" href="<?php
                if(isset($_SESSION["username"])){
                    if($admin){
                        echo "../admin.php";
                    }else {
                        echo "../userpage.php";
                    }
                } else {
                    echo "signup.php";
                }
            ?>">
                <p><?php
                if (isset( $_SESSION["username"])){
                    echo $name;
                } else {
                    echo "ورود/ساخت اکانت";
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
    
