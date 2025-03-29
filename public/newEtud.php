<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nouveau Etudiant</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 60%;
            margin: 5% auto;
            overflow: hidden;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="email"], input[type="number"] {
            width: 97%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background: #333;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background: #555;
        }
    </style>
</head>
<body>
    <?php include 'index.php'; ?>
    <div class="container">
        <h1>Ajouter un nouvel étudiant</h1>
        <form action="../actions/newEtud-action.php" method="post">
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" required><br><br>
            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" required><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            <label for="cne">CNE:</label>
            <input type="text" id="cne" name="cne" required><br><br>
            <label for="adresse">Adresse:</label>
            <input type="text" id="adresse" name="adresse" required><br><br>
            <label for="classe">Classe:</label>
            <input type="text" id="classe" name="classe" required><br><br>
            <input type="submit" value="Ajouter">
        </form>
    </div>
</body>
</html>