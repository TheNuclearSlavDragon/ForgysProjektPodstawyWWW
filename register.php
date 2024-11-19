<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Forgys - rejestracja</title>
    <link rel="stylesheet" href="./styles/login_style.css">
    <?php
        require('db.php');
        session_start();

        if (isset($_SESSION["username"])) {
            header("Location: index.php");
        }
    ?>
</head>
<body>
    <article>
        <div class="container">
            <h1>Rejestracja</h1>
            <form method="POST">
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="username" placeholder="Login" required>
                <input type="password" name="password" placeholder="Hasło" required>
                <button type="submit">Zarejestruj się</button>
            </form>
            <?php
                $username = $_POST["username"];
                $password = md5($_POST["password"]);
                $email = $_POST["email"];          
                $sql = "INSERT INTO `users` (`username`, `email`, `password_hash`) VALUES ('$username', '$email', '$password')";
                $conn->query($sql);

                header("Location: login.php");
                $conn->close()
            ?>
        </div>
    </article>
</body>
</html>