<?php
include('connexion.php');

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Rechercher'])) {
    $critere = $_POST['critere'];
    $valeur = htmlspecialchars(trim($_POST['valeur']));

    if (!empty($valeur)) {
        switch ($critere) {
            case 'Code':
                $colonne = 'codeEtudiant';
                break;
            case 'Nom':
                $colonne = 'nom';
                break;
            case 'Prenom':
                $colonne = 'prenom';
                break;
            case 'Adresse':
                $colonne = 'adresse';
                break;
            case 'Classe':
                $colonne = 'classe';
                break;
            default:
                $colonne = 'prenom';
        }

        $sql = $conn->prepare("SELECT COUNT(*) FROM Etudiant WHERE $colonne LIKE :valeur");
        $sql->bindValue(':valeur', "%$valeur%");
        $sql->execute();
        $count = $sql->fetchColumn();

        if ($count > 0) {
            $message = "✅ L'étudiant cherché existe dans la base.";
        } else {
            $message = "❌ L'étudiant cherché n'existe pas dans la base.";
        }
    } else {
        $message = "⚠️ Veuillez entrer une valeur pour la recherche.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche Étudiant</title>
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

        select,
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
        <h2>🔍 Recherche d'Étudiant</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="form-group">
                <label for="critere">Critère de recherche :</label>
                <select id="critere" name="critere">
                    <option value="Code">Code</option>
                    <option value="Nom">Nom</option>
                    <option value="Prenom" selected>Prénom</option>
                    <option value="Adresse">Adresse</option>
                    <option value="Classe">Classe</option>
                </select>
            </div>
            <div class="form-group">
                <label for="valeur">Valeur :</label>
                <input type="text" id="valeur" name="valeur" placeholder="Saisir la valeur à rechercher">
            </div>
            <button type="submit" class="btn" name="Rechercher">🔎 Rechercher</button>
        </form>
        <?php
        if (!empty($message)) { ?>
            <div class="result">
                <?php
                echo "C'est votre tableau de bord.<br>";
                echo $message;
                ?>
            </div>
        <?php } ?>
    </div>
</body>

</html>