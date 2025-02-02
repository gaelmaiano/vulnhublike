<?php
// Connexion à la base de données (simulée)
$host = 'localhost';
$db   = 'projet_demeter';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

// Récupération des données du formulaire
$username = $_POST['username'];
$password = $_POST['password'];

// Requête SQL vulnérable à l'injection SQL
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Connexion réussie
    header("Location: secret.php");
} else {
    // Connexion échouée
    echo "Nom d'utilisateur ou mot de passe incorrect.";
}

$conn->close();
?>