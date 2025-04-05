<?php
require '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $livre_id = $_POST['livre_id'];
    $etudiant_id = $_POST['etudiant_id'];

    $stmt = $conn->prepare("UPDATE Emprunter SET status = 'retourné' WHERE livre_id = ? AND etudiant_id = ? AND status = 'en cours'");
    $stmt->bind_param("ii", $livre_id, $etudiant_id);

    if ($stmt->execute()) {
        $conn->query("UPDATE livres SET disponible = 1 WHERE id = $livre_id");
        header("Location: ../public/listeEmprunts.php");
        exit();
    } else {
        echo "Erreur: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
