<?php
require '../config/config.php';

$nom = htmlspecialchars(trim($_POST['nom']));
$prenom = htmlspecialchars(trim($_POST['prenom']));
$email = htmlspecialchars(trim($_POST['email']));
$cne = htmlspecialchars(trim($_POST['cne']));
$adresse = htmlspecialchars(trim($_POST['adresse']));
$classe = htmlspecialchars(trim($_POST['classe']));

$stmt = $conn->prepare("INSERT INTO Etudiant (nom, prenom, email, cne, adresse, classe) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $nom, $prenom, $email, $cne, $adresse, $classe);

if ($stmt->execute()) {
    echo "Nouvel étudiant ajouté avec succès";
} else {
    echo "Erreur: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>