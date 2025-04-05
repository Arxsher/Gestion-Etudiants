<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include('connexion.php');

$query1 = "SELECT COUNT(*) AS totalEtudiants FROM Etudiant";
$stmt1 = $conn->query($query1);
$totalEtudiants = $stmt1->fetch()['totalEtudiants'];

$query2 = "SELECT COUNT(*) AS totalLivres FROM Livre";
$stmt2 = $conn->query($query2);
$totalLivres = $stmt2->fetch()['totalLivres'];

$query3 = "SELECT COUNT(*) AS totalEmprunts FROM Emprunter";
$stmt3 = $conn->query($query3);
$totalEmprunts = $stmt3->fetch()['totalEmprunts'];


$queryCodeAhmed = "SELECT codeEtudiant FROM Etudiant WHERE nom = 'Ahmed' LIMIT 1";
$stmtCodeAhmed = $conn->query($queryCodeAhmed);
$codeAhmed = $stmtCodeAhmed->fetchColumn();

$query5 = "SELECT Livre.titre 
           FROM Livre 
           JOIN Emprunter ON Emprunter.codeLivre = Livre.codeLivre
           JOIN Etudiant ON Emprunter.codeEtudiant = Etudiant.codeEtudiant
           WHERE Etudiant.nom = 'Ahmed'";  

$stmt5 = $conn->prepare($query5);
$stmt5->execute();
$livresAhmed = $stmt5->fetchAll();  




$query6 = "SELECT Etudiant.nom, Etudiant.prenom FROM Emprunter
           INNER JOIN Livre ON Emprunter.codeLivre = Livre.codeLivre
           INNER JOIN Etudiant ON Emprunter.codeEtudiant = Etudiant.codeEtudiant
           WHERE Livre.auteur = 'Alphonse Daudet'";
$stmt6 = $conn->query($query6);
$etudiantsAlphonse = $stmt6->fetchAll();

$query8 = "SELECT titre FROM Livre WHERE codeLivre NOT IN (SELECT codeLivre FROM Emprunter WHERE codeEtudiant = (SELECT codeEtudiant FROM Etudiant WHERE nom = 'Ahmed'))";
$stmt8 = $conn->query($query8);
$livresNonEmpruntesAhmed = $stmt8->fetchAll();

$query9 = "SELECT Etudiant.prenom, COUNT(*) AS nombreEmprunts FROM Emprunter
           INNER JOIN Etudiant ON Emprunter.codeEtudiant = Etudiant.codeEtudiant
           GROUP BY Etudiant.codeEtudiant ORDER BY nombreEmprunts DESC LIMIT 1";
$stmt9 = $conn->query($query9);
$etudiantPlusDeLivres = $stmt9->fetch();

$query10 = "SELECT COUNT(*) AS livresSamir FROM Emprunter
            INNER JOIN Etudiant ON Emprunter.codeEtudiant = Etudiant.codeEtudiant
            WHERE Etudiant.nom = 'Samir'";
$stmt10 = $conn->query($query10);
$livresSamir = $stmt10->fetch()['livresSamir'];

$query11 = "SELECT Etudiant.nom, Etudiant.prenom FROM Emprunter
            INNER JOIN Livre ON Emprunter.codeLivre = Livre.codeLivre
            INNER JOIN Etudiant ON Emprunter.codeEtudiant = Etudiant.codeEtudiant
            WHERE Livre.titre = 'Une Vie' AND YEAR(Emprunter.dateEmprunt) = 2021";
$stmt11 = $conn->query($query11);
$etudiantsUneVie2021 = $stmt11->fetchAll();

$query12 = "SELECT Etudiant.nom, Etudiant.prenom, COUNT(*) AS nombreLivres FROM Emprunter
            INNER JOIN Etudiant ON Emprunter.codeEtudiant = Etudiant.codeEtudiant
            GROUP BY Etudiant.codeEtudiant";
$stmt12 = $conn->query($query12);
$nombreLivresParEtudiant = $stmt12->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Statistiques</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #ffe6f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            /* height: 100vh; */
        }

        .container {
            width: 100%;
            max-width: 990px;
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
        <h2>📚 Statistiques de la Bibliothèque</h2>
        <h3>1. Nombre d'étudiants: <?php echo $totalEtudiants; ?></h3>
        <h3>2. Nombre de livres: <?php echo $totalLivres; ?></h3>
        <h3>3. Nombre d'emprunts: <?php echo $totalEmprunts; ?></h3>

        <h3>5. Livres empruntés par Ahmed:</h3>
<ul>
    <?php
    if (empty($livresAhmed)) {
        echo "<p>Aucun livre n'a été emprunté par Ahmed.</p>";
    } else {
        foreach ($livresAhmed as $livre) {
            echo "<li>" . htmlspecialchars($livre['titre']) . "</li>";
        }
    }
    ?>
</ul>

        <h3>6. Étudiants ayant emprunté des livres d'Alphonse DAUDET:</h3>
        <ul>
            <?php foreach ($etudiantsAlphonse as $etudiant) : ?>
                <li><?php echo htmlspecialchars($etudiant['nom'] . ' ' . $etudiant['prenom']); ?></li>
            <?php endforeach; ?>
        </ul>

        <h3>8. Livres non empruntés par Ahmed:</h3>
        <ul>
            <?php foreach ($livresNonEmpruntesAhmed as $livre) : ?>
                <li><?php echo htmlspecialchars($livre['titre']); ?></li>
            <?php endforeach; ?>
        </ul>

        <h3>9. Étudiant ayant emprunté le plus de livres:</h3>
        <p><?php echo htmlspecialchars($etudiantPlusDeLivres['prenom']); ?></p>

        <h3>10. Nombre de livres empruntés par Samir: <?php echo $livresSamir; ?></h3>

        <h3>11. Étudiants ayant emprunté le livre "Une Vie" en 2021:</h3>
        <ul>
            <?php foreach ($etudiantsUneVie2021 as $etudiant) : ?>
                <li><?php echo htmlspecialchars($etudiant['nom'] . ' ' . $etudiant['prenom']); ?></li>
            <?php endforeach; ?>
        </ul>

        <h3>12. Nombre de livres empruntés par chaque étudiant:</h3>
        <table>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Nombre de livres empruntés</th>
            </tr>
            <?php foreach ($nombreLivresParEtudiant as $etudiant) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($etudiant['nom']); ?></td>
                    <td><?php echo htmlspecialchars($etudiant['prenom']); ?></td>
                    <td><?php echo htmlspecialchars($etudiant['nombreLivres']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>
