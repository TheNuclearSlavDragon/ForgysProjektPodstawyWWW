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
        $title=$_POST['nazwa'];
        $description=$_POST['opis'];

        if(isset($title)){
            $file = "./arts/" . basename($_FILES['file']['name']);
            move_uploaded_file($_FILES['file']['tmp_name'], $file);
            $sql = "INSERT INTO `arts` (`title`, `description`, `image_url`, `user_id`, `is_adult_content`)
                    VALUES ('$title', '$description', '$file', '$user_id', 0)";
            $conn->query($sql);
        }
        $conn->close()
    ?>

    <div class="container">
        <form method="POST" enctype="multipart/form-data">
            <label for="nazwa">Tytuł utworu:</label><br>
            <input type="text" id="nazwa" name="nazwa" placeholder="Tytuł"><br>

            <label for="opis">Opis utworu:</label><br>
            <input type="text" id="opis" name="opis" placeholder="Opis"><br>

            <label for="file">Plik obrazu:</label><br>
            <input type="file" id="file" name="file"><br>

            <input type="submit" name="submit" value="Wyślij">
        </form>
    </div>
</body>
</html>