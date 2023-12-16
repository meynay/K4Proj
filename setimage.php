<?php
    session_start();
    $username = $_SESSION["username"];
    $userquery = "SELECT * FROM user WHERE username='$username'";
    include("./includes/dbconfig.php");
    $res = mysqli_fetch_assoc(mysqli_query($db,$userquery));
    $target_dir = "./assets/profiles/";
    if(isset($res['image'])){
        $existedfile = $target_dir . $res['image'];
        unlink($existedfile);
    }
    $filename = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $filename;
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    $query = "UPDATE user SET user.image='$filename' WHERE username='$username'";
    mysqli_query($db, $query);
    header("Location:userpage.php");
    exit();
?>