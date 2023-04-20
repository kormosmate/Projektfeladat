<?php
require_once '../db.php'; // Adatbázis kapcsolat

if(isset($_POST['id'])){ // Ellenőrizzük, hogy van-e érvényes ID
    $id = $_POST['id'];

    // Töröljük az adatbázisból
    $query = "DELETE FROM links WHERE id = $id";
    $result = $conn->query($query);
    
    if($result){ // Ha sikeres az adatbázis művelet
        echo 'Az elem sikeresen törölve lett!';
    } else {
        echo "Hiba történt az adatbázis művelet során.";
    }
}
?>
