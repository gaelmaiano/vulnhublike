<?php

try {
    // Ouvrir la base de données SQLite
    $db = new SQLite3('votre_base_de_donnees.db');

    // Exécuter une requête SQL
    $result = $db->query("SELECT * FROM ma_table");

    // Parcourir les résultats et afficher les noms
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        echo $row['nom'] . "<br>";
    }

    // Fermer la connexion à la base de données
    $db->close();
} catch (Exception $e) {
    // Gérer les erreurs
    die("Erreur : " . $e->getMessage());
}

?>
