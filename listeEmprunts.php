<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

include('connexion.php');


$query = "SELECT Etudiant.nom , Etudiant.prenom, Livre.titre, Livre.auteur , Emprunter.codeEtudiant, Emprunter.codeLivre, Emprunter.dateEmprunt
          FROM Emprunter
          INNER JOIN Etudiant ON Emprunter.codeEtudiant = Etudiant.codeEtudiant
          INNER JOIN Livre  ON Emprunter.codeLivre = Livre.codeLivre";
$stmt = $conn->query($query);
$emprunts = $stmt->fetchAll();


if (isset($_GET['supprimerEtudiant']) && isset($_GET['supprimerLivre'])) {
    $codeEtudiant = $_GET['supprimerEtudiant'];
    $codeLivre = $_GET['supprimerLivre'];
    $deleteQuery = "DELETE FROM Emprunter WHERE codeEtudiant = :codeEtudiant AND codeLivre = :codeLivre";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bindParam(':codeEtudiant', $codeEtudiant, PDO::PARAM_INT);
    $stmt->bindParam(':codeLivre', $codeLivre, PDO::PARAM_INT);
    if ($stmt->execute()) {
        header('Location: listeEmprunts.php');  
        exit;
    } else {
        echo "Erreur lors de la suppression.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Emprunts</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #ffe6f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 900px;
            background: white;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
            padding: 30px;
            border-left: 8px solid #ff66b2;
        }

        .container h2 {
            text-align: center;
            color: #ff66b2;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #ff66b2;
            color: white;
        }

        td {
            background-color: #f9f9f9;
        }

        .delete-btn {
            color: red;
            font-weight: bold;
            cursor: pointer;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>📚 Liste des Emprunts</h2>

        <table>
            <tr>
                <th>Nom </th>
                <th>Prenom </th>
                <th>Titre </th>
                <th>Auteur </th>
                <th>Date Emprunt</th>
                <th>Supprimer</th> <!-- إضافة عمود الحذف -->
            </tr>
            <?php foreach ($emprunts as $emprunt) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($emprunt['nom']); ?></td>
                    <td><?php echo htmlspecialchars($emprunt['prenom']); ?></td>
                    <td><?php echo htmlspecialchars($emprunt['titre']); ?></td>
                    <td><?php echo htmlspecialchars($emprunt['auteur']); ?></td>
                    <td><?php echo htmlspecialchars($emprunt['dateEmprunt']); ?></td>
                    <td>
                        <a href="?supprimerEtudiant=<?php echo $emprunt['codeEtudiant']; ?>&supprimerLivre=<?php echo $emprunt['codeLivre']; ?>" class="delete-btn"> ␥ Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>
