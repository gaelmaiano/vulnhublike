<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet Déméter - Recherche</title>
</head>
<body>
    <h1>Recherche dans les archives</h1>
    <form action="search.php" method="GET">
        <label for="query">Entrez votre recherche :</label>
        <input type="text" id="query" name="query" required>
        <button type="submit">Rechercher</button>
    </form>

    <?php
    if (isset($_GET['query'])) {
        $query = $_GET['query'];
        echo "<p>Résultats pour : $query</p>";
        // Vulnérable à XSS
        echo "<p>Aucun résultat trouvé pour : " . $query . "</p>";
    }
    ?>
</body>
</html>