<?php include 'index.php'; ?>
<link rel="stylesheet" href="../public/css/style.css">
<div class="container">
    <h1>Supprimer un étudiant</h1>
    <form action="../actions/deleteEtud-action.php" method="post">
        <label for="id">ID de l'étudiant:</label>
        <input type="number" id="id" name="id" required><br><br>
        <input type="submit" value="Supprimer">
    </form>
</div>