<?php
    include("./includes/dbconfig.php");
    $langid = $_GET['id'];
    $query = "DELETE FROM Proglan WHERE ID='$langid'";
    mysqli_query($db, $query);
    header("Location:admin.php");
    exit();
?>