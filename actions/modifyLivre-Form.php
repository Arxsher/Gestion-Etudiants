<?php
require '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $sql = "SELECT * FROM livres WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Modifier un Livre</title>
            <link rel="stylesheet" href="../public/css/style.css">
        </head>
        <body>
            <?php include '../public/index.php'; ?>
            <div class="container">
                <h1>Modifier les informations du livre</h1>
                <form action="modifyLivre-action.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <label for="titre">Titre:</label>
                    <input type="text" id="titre" name="titre" value="<?php echo $row['titre']; ?>" required>
                    <label for="auteur">Auteur:</label>
                    <input type="text" id="auteur" name="auteur" value="<?php echo $row['auteur']; ?>" required>
                    <label for="isbn">ISBN:</label>
                    <input type="text" id="isbn" name="isbn" value="<?php echo $row['isbn']; ?>" required>
                    <label for="editeur">Éditeur:</label>
                    <input type="text" id="editeur" name="editeur" value="<?php echo $row['editeur']; ?>" required>
                    <label for="annee">Année:</label>
                    <input type="number" id="annee" name="annee" value="<?php echo $row['annee']; ?>" required>
                    <input type="submit" value="Modifier">
                </form>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "<div class='container'><p>Livre introuvable !</p></div>";
    }
    $stmt->close();
}
$conn->close();
?>