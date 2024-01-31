<?php
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur'])) {
    header("Location: ../login.html");
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
    $query = "SELECT acces FROM connexion WHERE utilisateur = :utilisateur";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':utilisateur', $_SESSION['utilisateur']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier l'accréditation de l'utilisateur
    $isAdmin = ($result['acces'] === "Admin");
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <meta charset="UTF-8">
  <title>Accueil</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body class="bg-secondary">

  <div class="container mt-5">
    <h1 class="text-danger text-center">Accueil</h1>

    <button class="btn btn-danger d-block mx-auto mb-4" onclick="location.href='client.php'">Voir les données des CRM</button>

    <button class="btn btn-danger d-block mx-auto mb-4" onclick="location.href='admin.php'">Ajouter les données des CRM</button>

    <?php if ($isAdmin) { ?>
      <button class="btn btn-danger d-block mx-auto mb-4" onclick="location.href='modif_admin.php'">Modifier les données du CRM - Administrateur</button>
    <?php } ?>

    <?php if (!$isAdmin) { ?>
      <button class="btn btn-danger d-block mx-auto mb-4" onclick="location.href='modif.php'">Modifier les données du CRM</button>
    <?php } ?>

    <button class="btn btn-danger d-block mx-auto mb-4" onclick="location.href='intermediary.php'">Gérer les intermédiaires</button>

    <button class="btn btn-danger d-block mx-auto mb-4" onclick="location.href='espace-lambda.php'">Ajouter des comptes-rendus, des informations, des fichiers etc...</button>

    <?php if ($isAdmin) { ?>
      <button class="btn btn-danger d-block mx-auto mb-4" onclick="location.href='espace-admin.php'">Accéder à l'espace de gestion - Administrateur</button>
    <?php } ?>

    <?php if ($isAdmin) { ?>
      <button class="btn btn-danger d-block mx-auto mb-4" onclick="location.href='gestion_textes_admin.php'">Accéder aux textes des utilisateurs - Administrateur </button>
    <?php } ?>

    <button class="btn btn-danger d-block mx-auto mb-4" onclick="location.href='news.php'">Voir les DevLog du stagiaire, les nouveautés et ajouts qui vont arriver</button>

    <button class="btn btn-danger d-block mx-auto mb-4" onclick="location.href='ticket.php'">Envoyer un ticket</button>

    <p class="small-text text-center">
      <a href="../index.html" class="text-light">Se déconnecter</a>
    </p>
  </div>

</body>
</html>
