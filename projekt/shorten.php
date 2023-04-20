<?php
require_once 'db.php'; // Adatbázis kapcsolat

if (isset($_POST['url']) && $_POST['url'] != '') { // Ellenőrizzük, hogy van-e érvényes URL

    $url = $_POST['url'];
    if (strpos($url, 'http://') !== 0 && strpos($url, 'https://') !== 0) {
        // Ha a URL nem tartalmazza a "http://" vagy "https://" protokollt, hibaüzenetet jelenítünk meg
        echo '<script>alert("Az URL-nek a http:// vagy https:// protokollal kell kezdődnie."); window.location.href = "http://localhost/projekt";</script>';
    } else {
        // Generálunk egy véletlenszerű short url-t
        $short_url = substr(md5(uniqid(rand(), true)), 0, 6);

        // Hozzáadjuk az adatokat az adatbázishoz
        $url = mysqli_real_escape_string($conn, $url);
        $query = "INSERT INTO links (url, code, created_at) VALUES ('$url', '$short_url', NOW())";
        $result = $conn->query($query);

        if ($result) { // Ha sikeres az adatbázis művelet
            $short_url = "http://$_SERVER[SERVER_NAME]/projekt/" . $short_url;
            echo "<p>Az rövidített URL: <a href='$short_url' target='_blank'>$short_url</a></p>";
        } else {
            echo "<p>Hiba történt az adatbázis művelet során.</p>";
        }
    }
}
?>
