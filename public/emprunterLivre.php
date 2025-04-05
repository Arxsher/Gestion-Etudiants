<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Emprunter un Livre</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'index.php'; ?>
    <div class="container">
        <h1>Emprunter un Livre</h1>
        <form action="../actions/emprunterLivre_Action.php" method="post">
            <label for="etudiant">Sélectionner un Étudiant:</label>
            <select id="etudiant" name="etudiant_id" required>
                <option value="">Choisir un étudiant</option>
                <?php
                require '../config/config.php';
                $sql = "SELECT id, nom, prenom FROM Etudiant";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['nom'] . " " . $row['prenom'] . "</option>";
                }
                ?>
            </select>

            <label for="livre">Sélectionner un Livre:</label>
            <select id="livre" name="livre_id" required>
                <option value="">Choisir un livre</option>
                <?php
                $sql = "SELECT id, titre FROM livres";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['titre'] . "</option>";
                }
                ?>
            </select>

            <input type="hidden" name="date_emprunt" value="<?php echo date('Y-m-d'); ?>">
            <input type="submit" value="Emprunter">
        </form>
    </div>
</body>
</html> 