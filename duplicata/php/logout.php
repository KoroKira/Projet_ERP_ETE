<?php
session_start(); // Démarrer la session
session_destroy(); // Détruire la session en cours
header("Location: ../login.php"); // Rediriger vers la page de connexion
exit;
?>
