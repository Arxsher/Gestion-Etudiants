<?php
include('connexion.php');
if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['update'])) {
    $code = htmlspecialchars(stripslashes(trim($_POST['code'])));
    $titre = htmlspecialchars(stripslashes(trim($_POST['titre'])));
    $auteur = htmlspecialchars(stripslashes(trim($_POST['auteur'])));
    $dateE = htmlspecialchars(stripslashes(trim($_POST['dateE'])));

    $sql = $conn->prepare("UPDATE Livre SET titre = :titre, auteur = :auteur, dateEdition = :dateE WHERE codeLivre = :code");

    $sql->bindValue(':code', $code);
    $sql->bindValue(':titre', $titre);
    $sql->bindValue(':auteur', $auteur);
    $sql->bindValue(':dateE', $dateEdition);
    if ($sql->execute()) {
        echo "Livre a été modifié avec succès!";
        header("Location: listeLivre.php");
        exit;
    } else {
        echo "Une erreur s'est produite, veuillez réessayer.";
    }
}
if (isset($_GET['code'])) {
    $code = htmlspecialchars($_GET['code']);

    $requete = $conn->prepare("SELECT * FROM Livre WHERE codeLivre = :code");
    $requete->bindValue(':code', $code);
    $requete->execute();

    if ($requete->rowCount() > 0) {
        $livre = $requete->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "Livre non trouvé!";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Livre</title>
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
            max-width: 500px;
            background: white;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
            padding: 30px;
            border-left: 8px solid #ff66b2;
        }

        h2 {
            text-align: center;
            color: #ff66b2;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn {
            display: block;
            width: 100%;
            background: #ff66b2;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn:hover {
            background: #ff3399;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>✏️ Modifier Livre</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="form-group">
                <label for="code">Code :</label>
                <input type="text" id="code" name="code" value="<?php if(isset($livre["codeLivre"])) echo $livre['codeLivre']; ?>">
            </div>
            <div class="form-group">
                <label for="nom">Titre :</label>
                <input type="text" id="nom" name="titre" value="<?php if(isset($livre["titre"])) echo $livre['titre']; ?>">
            </div>
            <div class="form-group">
                <label for="prenom">Auteur :</label>
                <input type="text" id="prenom" name="auteur" value="<?php if(isset($livre["auteur"])) echo $livre['auteur']; ?>">
            </div>
            <div class="form-group">
                <label for="adresse">Date Edition :</label>
                <input type="text" id="adresse" name="dateE" value="<?php if(isset($livre["dateE"])) echo $livre['dateE']; ?>">
            </div>
            <button type="submit" class="btn" name="update">Modifier</button>
        </form>
    </div>
</body>
</html>