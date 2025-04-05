<?php
include('connexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['code'])) {
    $code = htmlspecialchars(stripslashes(trim($_POST['code'])));
    $sqlCheck = "SELECT * FROM Etudiant WHERE codeEtudiant = :code";
    $stmtCheck = $conn->prepare($sqlCheck);
    $stmtCheck->bindValue(':code', $code);
    $stmtCheck->execute();
    if ($stmtCheck->rowCount() > 0) {
        $sqlDelete = "DELETE FROM Etudiant WHERE codeEtudiant = :code";
        $stmtDelete = $conn->prepare($sqlDelete);
        $stmtDelete->bindValue(':code', $code);
        if ($stmtDelete->execute()) {
            $message = "L'étudiant a été supprimé avec succès.";
        } else {
            $message = "Une erreur est survenue lors de la suppression.";
        }
    } else {
        $message = "Aucun étudiant trouvé avec ce code.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer Étudiant</title>
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

        .result {
            margin-top: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 5px;
            border-left: 4px solid #28a745;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>🗑️ Supprimer Étudiant</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="form-group">
                <label for="code">Code :</label>
                <input type="text" id="code" name="code" placeholder="Code">
            </div>
            <button type="submit" class="btn">Supprimer</button>
        </form>
        <?php
        if (isset($message)) { ?>
            <div class="result">
                <div class="message"><?php echo $message; ?></div>
            </div>
        <?php }
        ?>
    </div>
</body>

</html>