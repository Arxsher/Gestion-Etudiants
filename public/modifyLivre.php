<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modifier un Livre</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'index.php'; ?>
    <div class="container">
        <h1>Modifier un livre</h1>
        <form action="../actions/modifyLivre-Form.php" method="post">
            <label for="id">ID du livre:</label>
            <input type="number" id="id" name="id" required>
            <input type="submit" value="Modifier">
        </form>
    </div>
</body>
</html>