<?php
require '../config/config.php';

$titre = htmlspecialchars(trim($_POST['titre']));
$auteur = htmlspecialchars(trim($_POST['auteur']));
$isbn = htmlspecialchars(trim($_POST['isbn']));
$editeur = htmlspecialchars(trim($_POST['editeur']));
$annee = htmlspecialchars(trim($_POST['annee']));

$stmt = $conn->prepare("INSERT INTO livres (titre, auteur, isbn, editeur, annee) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssssi", $titre, $auteur, $isbn, $editeur, $annee);

if ($stmt->execute()) {
    header("Location:../public/listLivre.php");
    echo "Nouveau livre ajouté avec succès";
} else {
    echo "Erreur: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>