<?php
include('connexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send'])) {
    $codeEtudiant = $_POST['codeEtudiant'];
    $codeLivre = $_POST['codeLivre'];
    $dateEmprunt = date('Y-m-d');

    try {
        $query = "INSERT INTO Emprunter (codeEtudiant, codeLivre, dateEmprunt) VALUES (:codeEtudiant, :codeLivre, :dateEmprunt)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':codeEtudiant', $codeEtudiant, PDO::PARAM_INT);
        $stmt->bindParam(':codeLivre', $codeLivre, PDO::PARAM_INT);
        $stmt->bindParam(':dateEmprunt', $dateEmprunt, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            header("Location: listeEmprunts.php");
            echo "L'emprunt a été effectué avec succès.";
        } else {
            echo "Erreur lors de l'emprunt.";
        }
    } catch (PDOException $e) {
        echo "Erreur de base de données : " . $e->getMessage();
    }
}

$etudiants_query = "SELECT * FROM Etudiant";
$etudiants_result = $conn->query($etudiants_query);

$livres_query = "SELECT * FROM Livre";
$livres_result = $conn->query($livres_query);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'Emprunt</title>
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

        select,
        input {
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
        <h2>📄 Formulaire d'Emprunt</h2>
        <form action="emprunterLivre.php" method="post">
            <div class="form-group">
                <label for="codeEtudiant">Etudiant :</label>
                <select name="codeEtudiant" id="codeEtudiant">
                    <option value="">Nom Et Prenom</option>
                    <?php while($etudiant = $etudiants_result->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $etudiant['codeEtudiant']; ?>"><?php echo $etudiant['nom'] . ' ' . $etudiant['prenom']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="codeLivre">Livre :</label>
                <select name="codeLivre" id="codeLivre">
                    <option value="">Titre Livre</option>
                    <?php while($livre = $livres_result->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $livre['codeLivre']; ?>"><?php echo $livre['titre']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" class="btn" name="send">Emprunter</button>
        </form>
    </div>
</body>

</html>
