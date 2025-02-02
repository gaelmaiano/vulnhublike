ceci est un code pour une machine de type ctf . c'est normal que tout soit en clzir. c 'est justement l une des failles

<?php
// Activer l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Démarrer la session
session_start();

// Ouvrir la base de données SQLite
$db = new SQLite3('votre_base_de_donnees.db');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Rechercher l'utilisateur dans la base de données
    $stmt = $db->prepare("SELECT mot_de_passe FROM utilisateurs WHERE nom_utilisateur = :nom_utilisateur");
    $stmt->bindValue(':nom_utilisateur', $username, SQLITE3_TEXT);
    $result = $stmt->execute();
    $row = $result->fetchArray(SQLITE3_ASSOC);

    if ($row && password_verify($password, $row['mot_de_passe'])) {
        // Connexion réussie
        $_SESSION['username'] = $username; // Enregistre le nom d'utilisateur dans la session
        header("Location: secret.html"); // Redirige vers secret.html
        exit();
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
}

// Fermer la connexion à la base de données
$db->close();
?>
