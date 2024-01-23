<?php
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur'])) {
    header("Location: ../login.php");
    exit();
}

// Se connecter à la base de données
$dsn = "pgsql:host=localhost;dbname=bddcrmete;options='--client_encoding=UTF8'";
$user = "postgres";
$password = "root";

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer l'accréditation de l'utilisateur depuis la table "connexion"
    $query = "SELECT Acces FROM Connexion WHERE utilisateur = :utilisateur";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':utilisateur', $_SESSION['utilisateur']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier l'accréditation de l'utilisateur
    if ($result['Acces'] !== "Admin") {
        $isAdmin = false;
    } else {
        $isAdmin = true;
    }
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Accueil</title>
  <link rel="stylesheet" type="text/css" href="../css/full.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
  <h1>Accueil</h1>

  <button onclick="location.href='client.php'">Voir les données des CRM</button>

  <button onclick="location.href='admin.php'">Ajouter les données des CRM</button>

  <?php if ($isAdmin) { ?>
    <button onclick="location.href='modif_admin.php'">Modifier les données du CRM - Administrateur</button>
    <?php } ?>

  <?php if ($isAdmin === false ) { ?>
    <button onclick="location.href='modif.php'">Modifier les données du CRM</button>
  <?php } ?>

  <button onclick="location.href='intermediary.php'">Gérer les intermédiaires</button>


  <button onclick="location.href='espace-lambda.php'">Ajouter des comptes-rendus, des informations, des fichiers etc...</button>  

  <?php if ($isAdmin) { ?>
    <button onclick="location.href='espace-admin.php'">Accéder à l'espace de gestion - Administrateur</button>
  <?php } ?>

  <?php if ($isAdmin) { ?>
    <button onclick="location.href='gestion_textes_admin.php'">Accéder aux textes des utilisateurs - Administrateur </button>
  <?php } ?>
                       
  
  
  
  <button onclick="location.href='news.php'">Voir les DevLog du stagiaire, les nouveautés et ajouts qui vont arriver</button>
  
    <button onclick="location.href='ticket.php'">Envoyer un ticket</button>

  <p class="small-text" style="text-align: center;">
    <a href="../index.html">Se déconnecter</a>
  </p>
</body>
</html>
