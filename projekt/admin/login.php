<?php
session_start();

require_once '../db.php';

// Ellenőrizzük, hogy a felhasználó elküldte-e a bejelentkezési adatokat
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ellenőrizzük, hogy az adatok helyesek-e
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // Sikeres bejelentkezés
        $_SESSION['login_user'] = $username;
        header("Location: http://$_SERVER[SERVER_NAME]/projekt/dashboard");
        exit();
    } else {
        // Sikertelen bejelentkezés
        $error = "Hibás felhasználónév vagy jelszó!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bejelentkezés</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Bejelentkezés</h2>
        <?php if (isset($error)) { ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>
        <form method="POST">
            <div class="form-group">
                <label for="username">Felhasználónév:</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="password">Jelszó:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-default">Bejelentkezés</button>
        </form>
    </div>
</body>
</html>
