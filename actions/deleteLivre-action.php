<?php
require '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM livres WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location:../public/listLivres.php");
        echo "Livre supprimé avec succès";
    } else {
        echo "Erreur: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
