<?php
include('connexion.php');
if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['send'])) {
    $code = htmlspecialchars(stripslashes(trim($_POST['code'])));
    $nom = htmlspecialchars(stripslashes(trim($_POST['nom'])));
    $prenom = htmlspecialchars(stripslashes(trim($_POST['prenom'])));
    $adresse = htmlspecialchars(stripslashes(trim($_POST['adresse'])));
    $classe = htmlspecialchars(stripslashes(trim($_POST['classe'])));

    $sql = $conn->prepare("INSERT INTO  Etudiant(codeEtudiant,nom ,prenom ,adresse,classe) VALUES (:code,:nom,:prenom,:adresse,:classe)");


    $sql->bindvalue(':code', $code);
    $sql->bindvalue(':nom', $nom);
    $sql->bindvalue(':prenom', $prenom);
    $sql->bindvalue(':adresse', $adresse);
    $sql->bindvalue(':classe', $classe);
    $resultat = $sql->execute();
    header("Location:listeEtudiant.php");
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'Insertion</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #ffe6f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
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

        .container h2 {
            text-align: center;
            color: #ff66b2;
        }

        .form-group {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        label {
            font-weight: bold;
            margin-right: 10px;
            width: 120px;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        textarea {
            height: 100px;
        }

        .btn {
            display: block;
            width: 100%;
            background: #28a745;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn:hover {
            background: #218838;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>📄 Formulaire d'Insertion</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="form-group">
                <label for="code">Code :</label>
                <input type="text" id="code" name="code" placeholder="Code">
            </div>
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" placeholder="nom">
            </div>
            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" placeholder="prénom">
            </div>

            <div class="form-group">
                <label for="adresse">Adresse :</label>
                <textarea id="adresse" name="adresse" placeholder=" adresse"></textarea>
            </div>
            <div class="form-group">
                <label for="classe">Classe :</label>
                <input type="text" id="classe" name="classe" placeholder="Classe">
            </div>
            <button type="submit" class="btn" name="send">Créer</button>
        </form>
    </div>
</body>

</html>