<?php
include('connexion.php');
if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['update'])) {
    $codeEtudiant = htmlspecialchars(stripslashes(trim($_POST['code'])));
    $nom = htmlspecialchars(stripslashes(trim($_POST['nom'])));
    $prenom = htmlspecialchars(stripslashes(trim($_POST['prenom'])));
    $adresse = htmlspecialchars(stripslashes(trim($_POST['adresse'])));
    $classe = htmlspecialchars(stripslashes(trim($_POST['classe'])));

    $sql = $conn->prepare("UPDATE Etudiant SET nom = :nom, prenom = :prenom, adresse = :adresse, classe = :classe WHERE codeEtudiant = :code");

    $sql->bindValue(':code', $codeEtudiant);
    $sql->bindValue(':nom', $nom);
    $sql->bindValue(':prenom', $prenom);
    $sql->bindValue(':adresse', $adresse);
    $sql->bindValue(':classe', $classe);
    if ($sql->execute()) {
        echo "L'étudiant a été modifié avec succès!";
        header("Location: listeEtudiant.php");
        exit;
    } else {
        echo "Une erreur s'est produite, veuillez réessayer.";
    }
}
if (isset($_GET['code'])) {
    $codeEtudiant = htmlspecialchars($_GET['code']);

    $requete = $conn->prepare("SELECT * FROM Etudiant WHERE codeEtudiant = :code");
    $requete->bindValue(':code', $codeEtudiant);
    $requete->execute();

    if ($requete->rowCount() > 0) {
        $etudiant = $requete->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "Étudiant non trouvé!";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Étudiant</title>
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
        <h2>✏️ Modifier Étudiant</h2>
        <form action="<?php echo htmlspecialchars($_SERVER_['PHP_SELF']); ?>" method="post">
            <div class="form-group">
                <label for="code">Code :</label>
                <input type="text" id="code" name="code" value="<?php echo $etudiant['codeEtudiant']; ?>">
            </div>
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" value="<?php echo $etudiant['nom']; ?>">
            </div>
            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" value="<?php echo $etudiant['prenom']; ?>">
            </div>
            <div class="form-group">
                <label for="adresse">Adresse :</label>
                <input type="text" id="adresse" name="adresse" value="<?php echo $etudiant['adresse']; ?>">
            </div>
            <div class="form-group">
                <label for="classe">Classe :</label>
                <input type="text" id="classe" name="classe" value="<?php echo $etudiant['classes']; ?>">
            </div>
            <button type="submit" class="btn" name="update">Modifier</button>
        </form>
    </div>
</body>

</html>