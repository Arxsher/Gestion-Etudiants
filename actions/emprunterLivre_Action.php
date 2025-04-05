<?php
require '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $etudiant_id = $_POST['etudiant_id'];
    $livre_id = $_POST['livre_id'];
    $date_emprunt = $_POST['date_emprunt'];

    $checkAvailability = $conn->query("SELECT disponible FROM livres WHERE id = $livre_id");
    $book = $checkAvailability->fetch_assoc();

    if ($book['disponible']) {
        $checkBorrowed = $conn->query("SELECT COUNT(*) AS count FROM Emprunter WHERE livre_id = $livre_id AND status = 'en cours'");
        $borrowed = $checkBorrowed->fetch_assoc();

        if ($borrowed['count'] == 0) {
            $stmt = $conn->prepare("INSERT INTO Emprunter (etudiant_id, livre_id, date_emprunt, status) VALUES (?, ?, ?, 'en cours')");
            $stmt->bind_param("iis", $etudiant_id, $livre_id, $date_emprunt);
            
            if ($stmt->execute()) {
                $conn->query("UPDATE livres SET disponible = 0 WHERE id = $livre_id");
                header("Location: ../public/listeEmprunts.php");
                exit();
            } else {
                echo "Erreur: " . $stmt->error;
            }
        } else {
            echo "Le livre est déjà emprunté.";
        }
    } else {
        echo "Le livre n'est pas disponible.";
    }
}
$conn->close();
?>