<?php
// Adatbázis kapcsolódás
require_once('../db.php');

// Ellenőrizzük, hogy POST kérés érkezett-e
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Ellenőrizzük, hogy az összes mező ki van-e töltve
    if (isset($_POST['id']) && isset($_POST['code'])) {

        $id = $_POST['id'];
        $new_short_url = $_POST['code'];

        // Ellenőrizzük, hogy a módosított short URL már létezik-e az adatbázisban
        $sql = "SELECT COUNT(*) AS count FROM links WHERE code = '$new_short_url'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $count = $row['count'];
        if ($count > 0) {
            // Ha a módosított short URL már létezik, jelenítsünk meg egy értesítést
            echo 'Ez a rövid URL már foglalt! Kérjük, válasszon másikat!';
    
            exit(); // Kilépés a kódból
        } else {
            // Ha az új short URL szabad, módosítsuk az adatbázisban
            $sql = "UPDATE links SET code = '$new_short_url' WHERE id = '$id'";
            $conn->query($sql);
            echo 'Sikeres módosítás!';  // Visszairányítás a dashboard-ra üzenet után!
            exit(); // Kilépés a kódból
        }

    } else {
        echo 'Kérjük, töltse ki az összes mezőt!';  // Visszairányítás a dashboard-ra üzenet után!
        exit(); // Kilépés a kódból
    }
}

// Ha nem POST kérés érkezett, visszairányítjuk a felhasználót a dashboard-ra
header("Location: http://$_SERVER[SERVER_NAME]/projekt");
exit(); // Kilépés a kódból
