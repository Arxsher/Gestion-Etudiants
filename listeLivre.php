<?php
include('connexion.php');
$requete = "SELECT * FROM Livre";
$res = $conn->query(($requete));

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Livres</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #ffe6f2;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
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

        h1 {
            text-align: center;
            color: #ff66b2;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #ff66b2;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ffccdd;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>📚 Liste des Livres</h1>
        <table>
            <thead>
                <tr>
                    <th>Code Livre</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Date Edition</th>
                </tr>
            </thead>
            <tbody>
                <!-- <tr>
                    <td>1</td>
                    <td>Power Of Now</td>
                    <td>I don't Know</td>
                    <td>2003-12-02</td>
                </tr> -->
                <?php
                while ($ligne = $res->fetch(PDO::FETCH_NUM)) {
                    echo "<tr>";
                    foreach ($ligne as $valeur) {
                        echo "<td>$valeur</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <?php
        $res->closeCursor();
        ?>
    </div>
</body>

</html>