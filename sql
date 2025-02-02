<?php

$db = sqlite_open('votre_base_de_donnees.db', 0666, $error);

if (!$db) {
    die($error);
}

$result = sqlite_query("SELECT * FROM ma_table", $db);

while ($row = sqlite_fetch_array($result)) {
    echo $row['nom'] . "<br>";
}

sqlite_close($db);

?>
