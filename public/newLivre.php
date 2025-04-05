<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Livre</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'index.php'; ?>
    <div class="container">
        <h1>Ajouter un nouveau livre</h1>
        <form action="../actions/newLivre-action.php" method="post">
            <label for="titre">Titre:</label>
            <input type="text" id="titre" name="titre" required>
            <label for="auteur">Auteur:</label>
            <input type="text" id="auteur" name="auteur" required>
            <label for="isbn">ISBN:</label>
            <input type="text" id="isbn" name="isbn" required>
            <label for="editeur">Éditeur:</label>
            <input type="text" id="editeur" name="editeur" required>
            <label for="annee">Année:</label>
            <input type="number" id="annee" name="annee" required>
            <input type="submit" value="Ajouter">
        </form>
    </div>
</body>
</html>