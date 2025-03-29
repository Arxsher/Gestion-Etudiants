<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rechercher un Étudiant</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'index.php'; ?>
    <div class="container">
        <h1>Rechercher un étudiant</h1>
        <form method="get" action="">
            <label for="id">ID de l'étudiant:</label>
            <input type="number" id="id" name="id" required>
            <input type="submit" value="Rechercher">
        </form>

        <?php
        if (isset($_GET['id'])) {
            require '../config/config.php';
            
            $id = $_GET['id'];
            $sql = "SELECT * FROM Etudiant WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                echo '<h2>Résultat de la recherche</h2>';
                echo '<table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                        <tr style="background-color: #f2f2f2;">
                            <th style="padding: 15px; text-align: left; border-bottom: 2px solid #ddd;">ID</th>
                            <th style="padding: 15px; text-align: left; border-bottom: 2px solid #ddd;">Nom</th>
                            <th style="padding: 15px; text-align: left; border-bottom: 2px solid #ddd;">Prénom</th>
                            <th style="padding: 15px; text-align: left; border-bottom: 2px solid #ddd;">Email</th>
                            <th style="padding: 15px; text-align: left; border-bottom: 2px solid #ddd;">CNE</th>
                            <th style="padding: 15px; text-align: left; border-bottom: 2px solid #ddd;">Adresse</th>
                            <th style="padding: 15px; text-align: left; border-bottom: 2px solid #ddd;">Classe</th>
                        </tr>';
                
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td style=\"padding: 15px; text-align: left; border-bottom: 2px solid #ddd;\">" . $row["id"] . "</td>
                            <td style=\"padding: 15px; text-align: left; border-bottom: 2px solid #ddd;\">" . $row["nom"] . "</td>
                            <td style=\"padding: 15px; text-align: left; border-bottom: 2px solid #ddd;\">" . $row["prenom"] . "</td>
                            <td style=\"padding: 15px; text-align: left; border-bottom: 2px solid #ddd;\">" . $row["email"] . "</td>
                            <td style=\"padding: 15px; text-align: left; border-bottom: 2px solid #ddd;\">" . $row["cne"] . "</td>
                            <td style=\"padding: 15px; text-align: left; border-bottom: 2px solid #ddd;\">" . $row["adresse"] . "</td>
                            <td style=\"padding: 15px; text-align: left; border-bottom: 2px solid #ddd;\">" . $row["classe"] . "</td>
                          </tr>";
                }
                echo '</table>';
            } else {
                echo '<p class="error">Aucun étudiant trouvé avec cet ID.</p>';
            }
            $stmt->close();
            $conn->close();
        }
        ?>
    </div>
</body>
</html> 