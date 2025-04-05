<?php
require '../config/config.php';
include '../public/index.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $sql = "SELECT * FROM Etudiant WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <link rel="stylesheet" href="../public/css/style.css">
        <div class="container">
            <h1>Modifier les informations de l'étudiant</h1>
            <form action="modifyEtud-action.php" method="post">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <label for="nom">Nom:</label>
                <input type="text" id="nom" name="nom" value="<?php echo $row['nom']; ?>" required><br><br>
                <label for="prenom">Prénom:</label>
                <input type="text" id="prenom" name="prenom" value="<?php echo $row['prenom']; ?>" required><br><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required><br><br>
                <label for="cne">CNE:</label>
                <input type="text" id="cne" name="cne" value="<?php echo $row['cne']; ?>" required><br><br>
                <label for="adresse">Adresse:</label>
                <input type="text" id="adresse" name="adresse" value="<?php echo $row['adresse']; ?>" required><br><br>
                <label for="classe">Classe:</label>
                <input type="text" id="classe" name="classe" value="<?php echo $row['classe']; ?>" required><br><br>
                <input type="submit" value="Modifier">
            </form>
        </div>
        <?php
    } else {
        echo "<div class='container'><p>Etudiant introuvable !</p></div>";
    }
    $stmt->close();
}
$conn->close();
?>