<?php 
    require("navbar.php");

    $id=$_GET['id'];
    $sql = "DELETE FROM arts WHERE art_id=$id";
    $conn->query($sql);
    
    header("Location: index.php");
?>