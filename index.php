<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/main_style.css">
    <link rel="stylesheet" href="./styles/index_style.css">
    <title>Forgys</title>
    <?php 
        require("navbar.php");
    ?>
</head>
<body>
    <div class="container">
        <h2>Najnowsze obrazy</h2>
        <div class="artgallery">
        <?php
            $sql="SELECT arts.image_url, arts.title, users.username, arts.art_id FROM arts, users WHERE arts.user_id = users.user_id AND arts.is_adult_content = FALSE ORDER BY  arts.created_at DESC LIMIT 15;";
            $result=mysqli_query($conn,$sql);

            while($row=mysqli_fetch_array($result)){
                echo "<a href='details.php?artid=$row[3]'><div class='smallimage'>
                <img src='$row[0]' height='200px'>
                <p>$row[1]</p>
                <p>$row[2]</p>
            </div></a>";
            }
        ?>
        </div>
    </div>
</body>
</html>