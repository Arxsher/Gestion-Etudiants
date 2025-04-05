<?php
require '../config/config.php';
include '../public/index.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $cne = $_POST['cne'];
    $adresse = $_POST['adresse'];
    $classe = $_POST['classe'];

    $stmt = $conn->prepare("UPDATE Etudiant SET nom = ?, prenom = ?, email = ?, cne = ?, adresse = ?, classe = ? WHERE id = ?");
    $stmt->bind_param("ssssssi", $nom, $prenom, $email, $cne, $adresse, $classe, $id);

    if ($stmt->execute()) {
        header("Location:../public/listEtud.php");
        echo "<div class='container'><p>Informations de l'étudiant mises à jour avec succès</p></div>";
    } else {
        echo "<div class='container'><p>Erreur: " . $stmt->error . "</p></div>";
    }
    $stmt->close();
}
$conn->close();
?>