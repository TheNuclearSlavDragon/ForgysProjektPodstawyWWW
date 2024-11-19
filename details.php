<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/main_style.css">
    <link rel="stylesheet" href="./styles/details_style.css">
    <script src="./scripts/script.js"></script>
    <title>Forgys -> Szczegóły</title>
    <?php
        require("navbar.php");
    ?>
</head>
<body>
    <div class="container">
        <div class="details">
            <?php
                $id = $_SESSION['id'];            
                $artid = $_GET["artid"];

                $sql = "SELECT * FROM arts WHERE art_id = $artid";
                $result=mysqli_query($conn,$sql);
                while($row=mysqli_fetch_array($result)){
                    echo "<div class='obraz'><img src='$row[3]'></div>";
                ?>
                <hr>
            <?php
                echo "<div class='tytul'>$row[1]</div> <hr> <div class='opis'>$row[2]</div> <hr>";
                $superid = $row[5];
                }

                $isFavoriteQuery = "SELECT * FROM likes WHERE user_id = $id AND art_id = $artid";
                $isFavoriteResult = mysqli_query($conn, $isFavoriteQuery);
                $isFavorite = mysqli_num_rows($isFavoriteResult) > 0;
            ?>
            <div class="opcje">
                <a onclick="history.go(-1);">Wróć</a>
                <a href="./details.php?artid=<?php echo $artid-1?>">Poprzedni</a>
                <?php
                        if($superid==$id){
                            echo "<a href='edit.php?id=$artid'>Edycja</a>
                            <a href='delete.php?id=$artid'>Usuń</a>";
                        }
                ?>
                <a href="./details.php?artid=<?php echo $artid+1?>">Następny</a>
                <button id="favorite-btn-<?php echo $artid; ?>" onclick="toggleFavorite(<?php echo $artid; ?>)">
                    <?php echo $isFavorite ? 'Usuń z ulubionych' : 'Dodaj do ulubionych'; ?>
                </button>
            </div>
            <hr>
            <div class="komentarze">
                <h3>Komentarze:</h3>
                <?php
                $com=$_POST['komentarz'];

                if(!isset($_SESSION['id']))
                {
                    echo '<a href="login.php" class="nologin">Zaloguj się by móc dodać komentarze</a>';
                }
                else {
                    echo '<form method="POST">
                    <input type="text" name="komentarz" placeholder="Komentarz">
                    <input type="submit" name="submit" value="Wyślij">
                    </form>';

                    $com=$_POST['komentarz'];
                    if(!empty($com))
                    {
                        $comsql = "INSERT INTO `comments` (`content`, `user_id`, `art_id`) VALUES ('$com', $id, $artid)";
                        $comresult = mysqli_query($conn,$comsql);
                    }
                }
                ?>

                <?php 
                    $guestsql="SELECT users.username, comments.content FROM comments, users WHERE comments.user_id=users.user_id AND comments.art_id=$artid"; 
                    $guestresult=mysqli_query(  $conn,$guestsql);
                    while($guestrow=mysqli_fetch_array($guestresult)){
                        echo "<div class='minikomentarz'>$guestrow[0]<br> $guestrow[1]</div>";
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>