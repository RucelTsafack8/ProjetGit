<?php
session_start();
// Include the database connection file.
//include('database.php');

// Check if the user is logged in.
if (!isset($_SESSION['NOM_UTILISATEUR'])) {
    header('Location: connexion.php');
    exit;
}
// Display the admin page.
echo '<h1>Admin Page</h1>';
echo '<p>Welcome, ' . $_SESSION['NOM_UTILISATEUR'] . '!</p>';
echo '<p><a href="deconnexion.php">Deconnexion</a></p>';

?>