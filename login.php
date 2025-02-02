ceci est un code pour une machine de type ctf 

<?php

$db = sqlite_open('votre_base_de_donnees.db', 0666, $error);

if (!$db) {
    die($error);
}

$nom_utilisateur = 'hacker123';
$mot_de_passe = 'HERMESMESSAGER';

// Hachage du mot de passe
$mot_de_passe_hashé = password_hash($mot_de_passe, PASSWORD_DEFAULT);

// Requête préparée
$stmt = sqlite_prepare($db, "INSERT INTO utilisateurs (nom_utilisateur, mot_de_passe) VALUES (:nom_utilisateur, :mot_de_passe)");
sqlite_bind_param($stmt, ':nom_utilisateur', $nom_utilisateur);
sqlite_bind_param($stmt, ':mot_de_passe', $mot_de_passe_hashé);

// Exécution de la requête
$result = sqlite_query($stmt);

if ($result) {
    echo "Utilisateur ajouté avec succès.";
} else {
    echo "Erreur lors de l'ajout de l'utilisateur.";
}

sqlite_close($db);

?>
