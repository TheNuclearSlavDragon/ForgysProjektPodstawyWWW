<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Forgys - logowanie</title>
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
            <h1>Logowanie</h1>
                <?php
                    if(isset($_POST["username"])) {
                        $username = $_POST["username"];
                        $password = $_POST["password"];
                        $sql = "SELECT * FROM users WHERE username='$username' AND password_hash='".md5($password)."'";
                        $result = $conn->query($sql);
                        if ($result->num_rows==1) {
                            $_SESSION["username"] = $username;
                            $_SESSION["id"] = $result->fetch_object()->user_id;
                            header("Location: index.php");
                        }
                        else {
                            echo "<div class='form'>
                            <h3 style='color: red;'>Nieprawidłowy login lub hasło.</h3> ";
                        }
                    }

                    mysqli_close($conn);
                ?>
            <form method="POST">
                <input type="text" name="username" placeholder="Login" required>
                <input type="password" name="password" placeholder="Hasło" required>
                <button type="submit">Zaloguj się</button>
            </form>
            <div class="links">
                <a href="dokumentacja.html">O projekcie</a>
                <a href="register.php">Załóż konto</a>
            </div>
        </div>
    </article>
</body>
</html>