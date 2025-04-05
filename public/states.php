<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modifier les États des Emprunts</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        table {
            width: 85%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 2px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
        }

        .container {
            width: 90%;
            margin: 0 auto;
        }

        .action-form {
            display: none;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php include 'index.php'; ?>
    <div class="container">
        <h1>Modifier les États des Emprunts</h1>
        <table>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Date d'Emprunt</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
            <?php
            require '../config/config.php';
            $sql = "SELECT e.nom, e.prenom, l.titre, l.auteur, em.date_emprunt, em.status, em.livre_id, em.etudiant_id 
                    FROM Emprunter em 
                    JOIN Etudiant e ON em.etudiant_id = e.id 
                    JOIN livres l ON em.livre_id = l.id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["nom"] . "</td>
                            <td>" . $row["prenom"] . "</td>
                            <td>" . $row["titre"] . "</td>
                            <td>" . $row["auteur"] . "</td>
                            <td>" . $row["date_emprunt"] . "</td>
                            <td>" . $row["status"] . "</td>
                            <td>
                                <button onclick=\"showForm(" . $row['livre_id'] . ", " . $row['etudiant_id'] . ")\">Marquer comme Retourné</button>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Aucun emprunt trouvé.</td></tr>";
            }
            $conn->close();
            ?>
        </table>

        <div class="action-form" id="actionForm">
            <h2>Marquer un Emprunt comme Retourné</h2>
            <form action="../actions/modifyState_Action.php" method="post">
                <input type="hidden" name="livre_id" id="livre_id">
                <input type="hidden" name="etudiant_id" id="etudiant_id">
                <input type="submit" value="Confirmer">
                <button type="button" onclick="hideForm()">Annuler</button>
            </form>
        </div>
    </div>

    <script>
        function showForm(livreId, etudiantId) {
            document.getElementById('livre_id').value = livreId;
            document.getElementById('etudiant_id').value = etudiantId;
            document.getElementById('actionForm').style.display = 'block';
        }

        function hideForm() {
            document.getElementById('actionForm').style.display = 'none';
        }
    </script>
</body>
</html>