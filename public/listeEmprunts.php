<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des Emprunts</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'index.php'; ?>
    <div class="container">
        <h1>Liste des Emprunts</h1>
        <table style="width: 85%; margin-left: 125px; border-collapse: collapse; margin-top: 20px;">
            <tr style="background-color: #f2f2f2;">
                <th style="padding: 15px; text-align: left; border-bottom: 2px solid #ddd;">Nom</th>
                <th style="padding: 15px; text-align: left; border-bottom: 2px solid #ddd;">Prénom</th>
                <th style="padding: 15px; text-align: left; border-bottom: 2px solid #ddd;">Titre</th>
                <th style="padding: 15px; text-align: left; border-bottom: 2px solid #ddd;">Auteur</th>
                <th style="padding: 15px; text-align: left; border-bottom: 2px solid #ddd;">Date d'Emprunt</th>
                <th style="padding: 15px; text-align: left; border-bottom: 2px solid #ddd;">Statut</th>
            </tr>
            <?php
            require '../config/config.php';
            $sql = "SELECT e.nom, e.prenom, l.titre, l.auteur, em.date_emprunt, em.status 
                    FROM Emprunter em 
                    JOIN Etudiant e ON em.etudiant_id = e.id 
                    JOIN livres l ON em.livre_id = l.id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td style=\"padding: 15px; text-align: left; border-bottom: 2px solid #ddd;\">" . $row["nom"] . "</td>
                            <td style=\"padding: 15px; text-align: left; border-bottom: 2px solid #ddd;\">" . $row["prenom"] . "</td>
                            <td style=\"padding: 15px; text-align: left; border-bottom: 2px solid #ddd;\">" . $row["titre"] . "</td>
                            <td style=\"padding: 15px; text-align: left; border-bottom: 2px solid #ddd;\">" . $row["auteur"] . "</td>
                            <td style=\"padding: 15px; text-align: left; border-bottom: 2px solid #ddd;\">" . $row["date_emprunt"] . "</td>
                            <td style=\"padding: 15px; text-align: left; border-bottom: 2px solid #ddd;\">" . $row["status"] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6' style='padding: 15px; text-align: left; border-bottom: 2px solid #ddd;'>Aucun emprunt trouvé.</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
</body>
</html> 