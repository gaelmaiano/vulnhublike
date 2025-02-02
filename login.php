<?php

$db = sqlite_open('votre_base_de_donnees.db', 0666, $error);

if (!$db) {
    die($error);
}

$username = $_POST['username'];
$password = $_POST['password'];

// Use a prepared statement to prevent SQL injection
$stmt = sqlite_prepare($db, "SELECT * FROM users WHERE username = :username AND password = :password");
sqlite_bind_param($stmt, ':username', $username);
sqlite_bind_param($stmt, ':password', $password);

$result = sqlite_query($stmt);

if (sqlite_num_rows($result) > 0) {
    header("Location: secret.php");
} else {
    echo "Nom d'utilisateur ou mot de passe incorrect.";
}

sqlite_close($db);

?>
