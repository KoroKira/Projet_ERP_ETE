<?php
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur'])) {
    header("Location: ../login.php");
    exit();
}

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Intermédiaires</title>
  <link rel="stylesheet" type="text/css" href="../css/full.css">

  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
  <h1> Ici vous verrez les devlogs du stagiaire, je rajouterai progressivement des infos de ce qui est ajouté, ce qui va etre ajouté etc...</h1>
</body>
  
    <div class="info-box">
    <h2>21/07/2023</h2>
    <p>
      Les DevLogs seront rajoutés progressivement à la chaine ici, et j'expliquerai les ajouts que j'ai fait dans mon code et dans l'interface. Cela vous permettra d'en savoir plus
  sur l'outil que vous utilisez sans avoir à chercher ce qui a changé. Pour l'instant, la fonctionnalité des textes est ajoutée. Les utilisateurs "Lambda" pourront insérer du texte de compte-rendu, prise de note etc...
Et les utilisateurs "Admin" ont accès à un historique pour l'ensemble des utilisateurs, daté ce qui permettra de mieux s'y retrouver dans les affaires. La fonctionnalité d'ajout de fichiers n'est toujours pas mise en place mais je me focus dessus.
    </p>
  </div>
  
      <div class="info-box">
    <h2>21/07/2023 10:00</h2>
    <p>
      Le dépôt de fichier est disponible et fonctionnel.
    </p>
  </div>

  <p class="small-text" style="text-align: center;">
    <a href="accueil.php">Retourner à l'accueil</a>
  </p>
</body>
</html>
