<?php
    include("./includes/dbconfig.php");
    $follower = $_GET['follower'];
    $following = $_GET['following'];
    $query = "SELECT * FROM Follow WHERE follower='$follower' and Follow.following='$following'";
    $res = mysqli_fetch_assoc(mysqli_query($db, $query));
    if (isset($res)) {
        $query = "DELETE FROM Follow WHERE follower='$follower' and Follow.following='$following'";
        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO Follow (follower, Follow.following) VALUES ('$follower', '$following')";
        mysqli_query($db, $query);
    }
    header("Location:usershow.php?user=$following");
    exit();
?>