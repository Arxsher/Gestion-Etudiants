<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Menu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        .menu {
            background: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        .menu a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            display: inline-block;
        }

        .menu a:hover {
            background: #555;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="menu">
            <a href="newEtud.php">Ajouter un étudiant</a>
            <a href="listEtud.php">Liste des étudiants</a>
            <a href="modifyEtud.php">Modifier un étudiant</a>
            <a href="deleteEtud.php">Supprimer un étudiant</a>
            <a href="rechercheEtud.php">Rechercher un étudiant</a>
        </div>
    </div>
</body>

</html>