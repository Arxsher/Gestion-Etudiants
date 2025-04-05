<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('connexion.php');


include('connexion.php');
if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['send'])) {
    $code = htmlspecialchars(stripslashes(trim($_POST['code'])));
    $titre = htmlspecialchars(stripslashes(trim($_POST['titre'])));
    $auteur = htmlspecialchars(stripslashes(trim($_POST['auteur'])));
    $dateE = htmlspecialchars(stripslashes(trim($_POST['dateE'])));

    $sql = $conn->prepare("INSERT INTO  Livre(codeLivre,titre ,auteur ,dateEdition) VALUES (:code,:titre,:auteur,:dateE)");


    $sql->bindValue(':code', $code);
    $sql->bindValue(':titre', $titre);
    $sql->bindValue(':auteur', $auteur);
    $sql->bindValue(':dateE', $dateE);
    $resultat = $sql->execute();
    header("Location:listeLivre.php");

    // if ($resultat) {
    //     echo "Livre inséré avec succès !";
    //     header("Location:listeLivre.php");
    // } else {
    //     echo "Erreur lors de l'insertion.";
    // }
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
                <input type="text" id="code" name="code" placeholder="Code Livre">
            </div>
            <div class="form-group">
                <label for="nom">Titre :</label>
                <input type="text" id="nom" name="titre" placeholder="livre">
            </div>
            <div class="form-group">
                <label for="prenom">Auteur :</label>
                <input type="text" id="prenom" name="auteur" placeholder="auteur">
            </div>
            <div class="form-group">
                <label for="classe">Date Edition:</label>
                <input type="text" id="classe" name="dateE" placeholder="date edition">
            </div>
            <button type="submit" class="btn" name="send">Créer</button>
        </form>
    </div>
</body>

</html>