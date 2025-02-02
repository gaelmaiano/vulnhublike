<?php
// Activer l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Ouvrir ou créer la base de données SQLite
$db = new SQLite3('votre_base_de_donnees.db');

// Créer la table 'utilisateurs' si elle n'existe pas
$db->exec("CREATE TABLE IF NOT EXISTS utilisateurs (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom_utilisateur TEXT NOT NULL UNIQUE,
    mot_de_passe TEXT NOT NULL
)");

// Données de l'utilisateur à insérer
$nom_utilisateur = 'hacker123';
$mot_de_passe = 'HERMESMESSAGER';

// Vérifier si l'utilisateur existe déjà
$stmt = $db->prepare("SELECT * FROM utilisateurs WHERE nom_utilisateur = :nom_utilisateur");
$stmt->bindValue(':nom_utilisateur', $nom_utilisateur, SQLITE3_TEXT);
$result = $stmt->execute();

if ($result->fetchArray()) {
    echo "Un utilisateur avec ce nom existe déjà.";
} else {
    // Hachage du mot de passe
    $mot_de_passe_hashé = password_hash($mot_de_passe, PASSWORD_DEFAULT);

    // Requête préparée pour insérer l'utilisateur
    $stmt = $db->prepare("INSERT INTO utilisateurs (nom_utilisateur, mot_de_passe) VALUES (:nom_utilisateur, :mot_de_passe)");
    $stmt->bindValue(':nom_utilisateur', $nom_utilisateur, SQLITE3_TEXT);
    $stmt->bindValue(':mot_de_passe', $mot_de_passe_hashé, SQLITE3_TEXT);

    // Exécution de la requête
    $result = $stmt->execute();

    if ($result) {
        echo "Utilisateur ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout de l'utilisateur : " . $db->lastErrorMsg();
    }
}

// Fermer la connexion à la base de données
$db->close();
?>
