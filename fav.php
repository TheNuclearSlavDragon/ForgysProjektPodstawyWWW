<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/main_style.css">
    <link rel="stylesheet" href="./styles/yourarts_style.css">
    <title>Forgys</title>
    <?php 
        require("navbar.php");
        require("session.php");
    ?>
</head>
<body>
    <div class="container">
        <h2>Ulubione obrazy</h2>
        <div class="artgallery">
        <?php
            $id = $_SESSION["id"];
            $sql="SELECT 
                arts.image_url, 
                arts.title, 
                arts.description, 
                arts.art_id
            FROM 
                likes
            JOIN 
                arts ON likes.art_id = arts.art_id
            WHERE 
                likes.user_id = $id";
            $result=mysqli_query($conn,$sql);

            while($row=mysqli_fetch_array($result)){
                echo "<a href='details.php?artid=$row[3]'><div class='smallimage'>
                <img src='$row[0]' height='200px'>
                <ul class='text'>
                <li>$row[1]</li>
                <li>$row[2]</li>
                </ul>
            </div></a>";
            }

            $conn->close();
        ?>
        </div>
    </div>
</body>
</html>