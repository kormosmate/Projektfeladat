<?php
include_once 'db.php';

if (isset($_GET['code'])) {
    $code = $_GET['code'];
    $sql = "SELECT url FROM links WHERE code = '$code'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $url = $row['url'];
        header("Location: $url");
    } else {
        echo "Az URL nem található";
    }
} else {
    echo "Nincs URL megadva";
}
