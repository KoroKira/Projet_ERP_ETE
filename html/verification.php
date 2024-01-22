<?php
session_start();

$dsn = "pgsql:host=localhost;dbname=bddcrmete;options='--client_encoding=UTF8'";
$user = "postgres";
$password = "root";

$utilisateur = $_POST['utilisateur'];
$motdepasse = $_POST['motdepasse'];

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT * FROM connexion WHERE utilisateur = :utilisateur AND motdepasse = :motdepasse";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':utilisateur', $utilisateur);
    $stmt->bindParam(':motdepasse', $motdepasse);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $acces = $row['acces'];

        $_SESSION['utilisateur'] = $utilisateur;
        $_SESSION['acces'] = $acces;

        if ($acces === 'Admin') {
            echo "Connexion Administrateur";
        } elseif ($acces === 'Lambda') {
            echo "SuccessL";
        } else {
            echo "Droits d'accès non valides.";
        }
    } else {
        echo "Identifiant ou mot de passe incorrect.";
    }
} catch (PDOException $e) {
    echo "Erreur de requête : " . $e->getMessage();
}
?>
