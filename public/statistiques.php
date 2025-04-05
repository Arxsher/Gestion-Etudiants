<?php
include("index.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Statistiques</title>
    <style>
    .container {
            width: 85%;
            margin-left: 250px;
        }

        h1 {
            margin-right: 250px;
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 85%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 2px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        td {
            background-color: #fff;
        }

        td:hover {
            background-color:rgba(210, 210, 210, 0.6);
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Statistiques</h1>
        
        <table>
            <tr>
                <th>#</th>
                <th>Description</th>
                <th>Valeur</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Nombre d'étudiants</td>
                <td>
                    <?php
                    require '../config/config.php';
                    $result = $conn->query("SELECT COUNT(*) AS count FROM Etudiant");
                    $row = $result->fetch_assoc();
                    echo $row['count'];
                    ?>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Nombre de livres</td>
                <td>
                    <?php
                    $result = $conn->query("SELECT COUNT(*) AS count FROM livres");
                    $row = $result->fetch_assoc();
                    echo $row['count'];
                    ?>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>Nombre d'emprunts</td>
                <td>
                    <?php
                    $result = $conn->query("SELECT COUNT(*) AS count FROM Emprunter");
                    $row = $result->fetch_assoc();
                    echo $row['count'];
                    ?>
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td>Nombre de livres empruntés par Ahmed</td>
                <td>
                    <?php
                    $result = $conn->query("SELECT COUNT(*) AS count FROM Emprunter WHERE etudiant_id = (SELECT id FROM Etudiant WHERE nom = 'Ahmed')");
                    $row = $result->fetch_assoc();
                    echo $row['count'];
                    ?>
                </td>
            </tr>
            <tr>
                <td>5</td>
                <td>Liste des étudiants ayant déjà emprunté un livre de Dostoevsky</td>
                <td>
                    <?php
                    $result = $conn->query("SELECT nom, prenom FROM Etudiant WHERE id IN (SELECT etudiant_id FROM Emprunter WHERE livre_id IN (SELECT id FROM livres WHERE auteur = 'Dostoevsky'))");
                    $students = [];
                    while ($row = $result->fetch_assoc()) {
                        $students[] = $row['nom'] . " " . $row['prenom'];
                    }
                    echo implode(", ", $students);
                    ?>
                </td>
            </tr>
            <tr>
                <td>6</td>
                <td>Prénom de l'étudiant ayant emprunté le plus de livres</td>
                <td>
                    <?php
                    $result = $conn->query("SELECT nom FROM Etudiant WHERE id = (SELECT etudiant_id FROM Emprunter GROUP BY etudiant_id ORDER BY COUNT(*) DESC LIMIT 1)");
                    $row = $result->fetch_assoc();
                    echo $row['nom'];
                    ?>
                </td>
            </tr>
            <tr>
                <td>7</td>
                <td>Nombre de livres empruntés par Samir</td>
                <td>
                    <?php
                    $result = $conn->query("SELECT COUNT(*) AS count FROM Emprunter WHERE etudiant_id = (SELECT id FROM Etudiant WHERE nom = 'Samir')");
                    $row = $result->fetch_assoc();
                    echo $row['count'];
                    ?>
                </td>
            </tr>
            <tr>
                <td>8</td>
                <td>Les étudiants ayant emprunté le livre « Power of Now » sur l'année 2025</td>
                <td>
                    <?php
                    $result = $conn->query("SELECT nom, prenom FROM Etudiant WHERE id IN (SELECT etudiant_id FROM Emprunter WHERE livre_id = (SELECT id FROM livres WHERE titre = 'Power of Now') AND YEAR(date_emprunt) = 2025)");
                    $students = [];
                    while ($row = $result->fetch_assoc()) {
                        $students[] = $row['nom'] . " " . $row['prenom'];
                    }
                    echo implode(", ", $students);
                    ?>
                </td>
            </tr>
            <tr>
                <td>9</td>
                <td>Nombre de livres empruntés par chaque étudiant</td>
                <td>
                    <?php
                    $result = $conn->query("SELECT nom, prenom, COUNT(*) AS count FROM Etudiant LEFT JOIN Emprunter ON Etudiant.id = Emprunter.etudiant_id GROUP BY Etudiant.id");
                    $output = [];
                    while ($row = $result->fetch_assoc()) {
                        $output[] = $row['nom'] . " " . $row['prenom'] . ": " . $row['count'];
                    }
                    echo implode("<br>", $output);
                    ?>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>