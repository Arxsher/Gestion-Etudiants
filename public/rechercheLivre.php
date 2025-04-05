<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rechercher un Livre</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'index.php'; ?>
    <div class="container">
        <h1>Rechercher un livre</h1>
        <form method="get" action="">
            <label for="id">ID du livre:</label>
            <input type="number" id="id" name="id" required>
            <input type="submit" value="Rechercher">
        </form>

        <?php
        if (isset($_GET['id'])) {
            require '../config/config.php';
            
            $id = $_GET['id'];
            $sql = "SELECT * FROM livres WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo '<h2 style="margin-left: 100px">Détails du livre</h2>';
                echo '<table style="width: 85%; margin-left: 125px; border-collapse: collapse; margin-top: 20px;">
                        <tr style="background-color: #f2f2f2;">
                            <th style="padding: 15px; text-align: left; border-bottom: 2px solid #ddd;">ID</th>
                            <th style="padding: 15px; text-align: left; border-bottom: 2px solid #ddd;">Titre</th>
                            <th style="padding: 15px; text-align: left; border-bottom: 2px solid #ddd;">Auteur</th>
                            <th style="padding: 15px; text-align: left; border-bottom: 2px solid #ddd;">ISBN</th>
                            <th style="padding: 15px; text-align: left; border-bottom: 2px solid #ddd;">Éditeur</th>
                            <th style="padding: 15px; text-align: left; border-bottom: 2px solid #ddd;">Année</th>
                        </tr>';
                
                $row = $result->fetch_assoc();
                echo "<tr>
                        <td style=\"padding: 15px; text-align: left; border-bottom: 2px solid #ddd;\">" . $row["id"] . "</td>
                        <td style=\"padding: 15px; text-align: left; border-bottom: 2px solid #ddd;\">" . $row["titre"] . "</td>
                        <td style=\"padding: 15px; text-align: left; border-bottom: 2px solid #ddd;\">" . $row["auteur"] . "</td>
                        <td style=\"padding: 15px; text-align: left; border-bottom: 2px solid #ddd;\">" . $row["isbn"] . "</td>
                        <td style=\"padding: 15px; text-align: left; border-bottom: 2px solid #ddd;\">" . $row["editeur"] . "</td>
                        <td style=\"padding: 15px; text-align: left; border-bottom: 2px solid #ddd;\">" . $row["annee"] . "</td>
                      </tr>";
                echo '</table>';
            } else {
                echo '<p class="error">Aucun livre trouvé avec cet ID.</p>';
            }
            $stmt->close();
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
