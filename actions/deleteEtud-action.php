<?php
require '../config/config.php';
include '../public/index.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM Etudiant WHERE id = ?;");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location:../public/listEtud.php");
        echo "<div class='container'><p>Etudiant supprimé avec succès</p></div>";
    } else {
        echo "<div class='container'><p>Erreur: " . $stmt->error . "</p></div>";
    }
    $stmt->close();
}
$conn->close();
?>