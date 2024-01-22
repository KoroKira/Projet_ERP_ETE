<?php
session_start();

$dsn = "mysql:host=localhost;dbname=bddcrmete;charset=utf8mb4";
$user = "root";
$password = "@dminETE";


$utilisateur = $_POST['Utilisateur'];
$motDePasse = $_POST['MotDePasse'];

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT * FROM Connexion WHERE Utilisateur = :utilisateur AND MotDePasse = :motDePasse";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':utilisateur', $utilisateur);
    $stmt->bindParam(':motDePasse', $motDePasse);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $acces = $row['Acces'];

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
