<?php
    require("db.php");
    session_start();
?>

<link rel="stylesheet" href="./styles/navbar_style.css">
<div class="navbar">
    <header>
        <h1><a href="index.php">FORGYS</a></h1>
        <div class="login">
            <ul>
                <?php
                    if(!isset($_SESSION["username"])){
                        echo "<a href='login.php'><li>Zaloguj sie</li><a href='register.php'><li>Zarejestruj sie</li></a>";
                    }
                    else{
                        $username = $_SESSION["username"];
                        echo "<li>Witam $username!</li><a href='logout.php'><li>Wyloguj sie</li></a>";
                    }
                ?>
            </ul>
        </div>
    </header>
    <nav>
        <ul>
            <li><a href="search.php">Przeglądaj</a></li>
            <li><a href="upload.php">Wyślij</a></li>
        </ul>
        <ul>
            <li><a href="fav.php">Ulubione</a></li>
            <li><a href="yourarts.php">Twoje arty</a></li>
        </ul>
    </nav>
</div>