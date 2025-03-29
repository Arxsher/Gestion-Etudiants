<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Liste des Etudiants</title>
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
            width: 100%;
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
        <h1>Liste des étudiants</h1>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>CNE</th>
                <th>Adresse</th>
                <th>Classe</th>
            </tr>
            <?php
            require '../config/config.php';

            $sql = "SELECT id, nom, prenom, email, cne, adresse, classe FROM Etudiant";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["id"] . "</td>
                            <td>" . $row["nom"] . "</td>
                            <td>" . $row["prenom"] . "</td>
                            <td>" . $row["email"] . "</td>
                            <td>" . $row["cne"] . "</td>
                            <td>" . $row["adresse"] . "</td>
                            <td>" . $row["classe"] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Aucun étudiant trouvé</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
</body>

</html>