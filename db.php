<?php
    $conn = new mysqli("localhost", "root", "", "Forgys2");
    if ($conn->connect_error) {
    exit("Connection failed: " . $conn->connect_error);
    }
?>