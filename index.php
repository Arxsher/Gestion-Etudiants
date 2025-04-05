<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Cute</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #ffe6f2;
            display: flex;
            align-items: flex-start;
            height: 100vh;
        }

        .menu {
            width: 250px;
            background: white;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            margin: 20px;
        }

        .menu h3 {
            background: #ff66b2;
            color: white;
            margin: 0;
            padding: 10px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }

        .menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu ul li {
            padding: 10px;
            border-bottom: 1px solid #f2f2f2;
            display: flex;
            align-items: center;
            font-size: 16px;
        }

        .menu ul li:hover {
            background: #ffccdd;
            cursor: pointer;
        }

        .menu ul li i {
            margin-right: 8px;
        }

        a {
            text-decoration: none;
            color: black;
        }
    </style>
</head>

<body>
    <div class="menu">
        <h3>📚 Gestion Etudiant</h3>
        <ul>
            <li><a href="nouveauEtudiant.php">➕ Nouveau Etudiant</a></li>
            <li><a href="supprimerEtudiant.php">🗑️ Suppression Etudiant</a></li>
            <li><a href="modifierEtudiant.php">✏️ Modification Etudiant</a></li>
            <li><a href="rechercheEtudiant.php">🔍 Recherche Etudiant</a></li>
            <li><a href="listeEtudiant.php">📋 Liste Etudiant</a></li>
        </ul>
        <h3>📖 Gestion Livre</h3>
        <ul>
            <li><a href="nouveauLivre.php">➕ Nouveau Livre</a></li>
            <li><a href="supprimerLivre.php">🗑️ Suppression Livre</a></li>
            <li><a href="modifierLivre.php">✏️ Modification Livre</a></li>
            <li><a href="rechercherLivre.php">🔍 Recherche Livre</a></li>
            <li><a href="listeLivre.php">📋 Liste Livre</a></li>
        </ul>
        <h3>📦 Gestion des Emprunts</h3>
        <ul>
            <li><a href="emprunterLivre.php">➕ Emprunter un livre</a></li>
            <li><a href="statistique.php">🔄 Statistiques</a></li>
            <li><a href="listeEmprunts.php">📚 Liste des emprunts</a></li>
        </ul>
    </div>
</body>

</html>