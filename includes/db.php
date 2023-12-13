<?php
    define("DB_HOST","mysql:host=localhost;dbname=HeapUnderFlow;charset=utf8");
    define("DB_USER","root");
    define("DB_PASS","");
    $db = new PDO(DB_HOST, DB_USER, DB_PASS);
?>