<?php
// Error handling configuration
ini_set('log_errors', 1);
ini_set('error_log', 'php_errors.log');

function error_handler($errno, $errstr, $errfile, $errline) {
    error_log("[$errno] $errstr in $errfile on line $errline");
    echo "Oops, an error occurred. Please try again later.";
    return true;
}
set_error_handler('error_handler');

// Start the session
session_start();

// Open the SQLite database
$db = new SQLite3('utilisateurs.db');

// Create the 'utilisateurs' table if it doesn't exist
$db->exec("CREATE TABLE IF NOT EXISTS utilisateurs (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom_utilisateur TEXT NOT NULL UNIQUE,
    mot_de_passe TEXT NOT NULL
)");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Check if fields are empty
    if (empty($username) || empty($password)) {
        echo "Please fill in all fields.";
    } else {
        // Search for the user in the database
        $stmt = $db->prepare("SELECT * FROM utilisateurs WHERE nom_utilisateur = :nom_utilisateur");
        $stmt->bindValue(':nom_utilisateur', $username, SQLITE3_TEXT);
        $result = $stmt->execute();
        $row = $result->fetchArray(SQLITE3_ASSOC);

        // Verify password and redirect if successful
        if ($row && password_verify($password, $row['mot_de_passe'])) {
            $_SESSION['username'] = $username;
            header("Location: secret.html");
            exit();
        } else {
            echo "Incorrect username or password.";
        }
    }
}

// Close the database connection
$db->close();
?>