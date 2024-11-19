<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/main_style.css">
    <link rel="stylesheet" href="./styles/form_style.css">
    <title>Forgys</title>
    <?php
        require("navbar.php");
        require("session.php");
    ?>
</head>
<body>
    <?php
        $user_id = $_SESSION["id"];
        $artid = $_GET["id"];
        $title=$_POST['nazwa'];
        $description=$_POST['opis'];

        if(isset($title)){
            $sql = "UPDATE `arts` SET `title` = '$title', `description` = '$description' WHERE `art_id` = '$artid'";
            $conn->query($sql);
            header("Location: details.php?artid=$artid");
        }
        $conn->close()
    ?>

    <div class="container">
        <form method="POST" enctype="multipart/form-data">
            <label for="nazwa">Tytuł utworu:</label><br>
            <input type="text" id="nazwa" name="nazwa" placeholder="Tytuł"><br>

            <label for="opis">Opis utworu:</label><br>
            <input type="text" id="opis" name="opis" placeholder="Opis"><br>

            <input type="submit" name="submit" value="Wyślij">
        </form>
    </div>
</body>
</html>