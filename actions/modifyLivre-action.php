<?php
require '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $isbn = $_POST['isbn'];
    $editeur = $_POST['editeur'];
    $annee = $_POST['annee'];

    $stmt = $conn->prepare("UPDATE livres SET titre = ?, auteur = ?, isbn = ?, editeur = ?, annee = ? WHERE id = ?");
    $stmt->bind_param("ssssii", $titre, $auteur, $isbn, $editeur, $annee, $id);

    if ($stmt->execute()) {
        header("Location:../public/listLivre.php");
        echo "Informations du livre mises à jour avec succès";
    } else {
        echo "Erreur: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
