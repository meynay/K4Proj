<?php
    include("./includes/dbconfig.php");
    session_start();
    $username = $_SESSION['username'];
    $desc = $_GET['desc'];
    $title = $_GET['title'];
    $plid = $_GET['PLid'];
    $query = "INSERT INTO Post(TItle, username, lanID, Post.description) VALUES('$title', '$username', '$plid', '$desc')";
    mysqli_query($db, $query);
    header("Location:index.php");
    exit();
?>