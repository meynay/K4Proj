<?php
    try {
        $db = new PDO("mysql:host=localhost;dbname=HeapUnderFlow","root","");
    } catch (PDOException $e) {
        echo "sss". $e->getMessage();
    }
?>