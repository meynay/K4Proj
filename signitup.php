<?php
    session_start();
    include("./includes/dbconfig.php");
    $username = $_GET["u"];
    $password = $_GET["p"];
    $email = $_GET["e"];
    $isadmin = $_GET["i"];
    $name = $_GET["n"];
    $query = "INSERT INTO user(username, name, email, isAdmin, password) VALUES ($username, $name, $email, $isadmin, $password)";
    mysqli_query($db, $query);
    $_SESSION["username"] = $username;
    header("index.php");
    exit();
?>