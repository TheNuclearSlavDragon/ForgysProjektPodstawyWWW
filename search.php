<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/main_style.css">
    <link rel="stylesheet" href="./styles/search_style.css">
    <title>Forgys -> Szczegóły</title>
    <?php
        require("navbar.php");
    ?>
</head>
<body>
    <div class="container">
        <form method="GET">
        <fieldset>
            <legend>Wybierz typ wyszukiwania:</legend>

            <div>
                <input type="radio" id="tytul" name="wybor" value="1" checked />
                <label for="tytul">Po tytule</label>
            </div>

            <div>
                <input type="radio" id="user" name="wybor" value="2" />
                <label for="user">Po użytkowniku</label>
            </div>

            <div>
                <input type="radio" id="opis" name="wybor" value="3" />
                <label for="opis">Po opisie</label>
            </div>
        </fieldset>
        <input type="text" name="text" placeholder="Wpisz co chcesz wyszukać">
        <input type="submit" value="Wyślij">
        </form>
        <div class="arts">
        <?php
            $text=$_GET['text']."%";
            switch($_GET['wybor']){
                case '1':
                    $sql = "SELECT arts.image_url, arts.title, users.username, arts.art_id FROM arts, users WHERE arts.user_id = users.user_id AND arts.title LIKE '$text'";
                    break;
                case '2':
                    $sql = "SELECT arts.image_url, arts.title, users.username, arts.art_id FROM arts, users WHERE arts.user_id = users.user_id AND users.username LIKE '$text'";
                    break;
                case '3':
                    $sql = "SELECT arts.image_url, arts.title, users.username, arts.art_id FROM arts, users WHERE arts.user_id = users.user_id AND arts.description LIKE '$text'";
                    break;
            }

            $result=mysqli_query($conn, $sql);
            while($row=mysqli_fetch_array($result)){
                echo "<a href='details.php?artid=$row[3]'><div class='smallimage'>
                <img src='$row[0]' height='200px'>
                <ul class='text'>
                <li>$row[1]</li>
                <li>$row[2]</li>
                </ul>
            </div></a>";
            }
            
        ?>
        </div>
    </div>
</body>
</html>