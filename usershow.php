<?php
    include("./includes/header.php");
    $username = $_GET['user'];
    $queryuser = "SELECT * FROM user WHERE username='$username'";
    $queryposts = "SELECT * FROM Post WHERE username='$username'";
    $res1 = mysqli_query($db, $queryuser);
    $res2 = mysqli_query($db, $queryposts);
    $user = mysqli_fetch_array($res1);
?>

<?php
    include("./includes/footer.php")
?>