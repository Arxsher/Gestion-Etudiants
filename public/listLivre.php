<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des Livres</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 5% auto;
            overflow: hidden;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 85%;
            margin: auto;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 2px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <?php include 'index.php'; ?>
    <div class="container">
        <h1>Liste des livres</h1>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>ISBN</th>
                <th>Éditeur</th>
                <th>Année</th>
            </tr>
            <?php
            require '../config/config.php';
            $sql = "SELECT * FROM livres"; // Adjust table name as needed
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["id"] . "</td>
                            <td>" . $row["titre"] . "</td>
                            <td>" . $row["auteur"] . "</td>
                            <td>" . $row["isbn"] . "</td>
                            <td>" . $row["editeur"] . "</td>
                            <td>" . $row["annee"] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Aucun livre trouvé</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>