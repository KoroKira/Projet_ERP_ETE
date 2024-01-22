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
  <style>
    body {
      background-image: url('../image/fondbleu.jpg');
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center center;
      height: 100vh; /* Ajout de la propriété height */
      background-attachment: fixed; /* Fixe l'image de fond */
    }

    h1 {
      color: #c1272d;
      font-size: 36px;
      text-align: center;
      text-shadow: 2px 2px 4px #ffffff;
      margin-top: 50px;
    }

    form {
      background-color: #ffffff;
      border-radius: 5px;
      margin: 20px auto;
      padding: 20px;
      width: 400px;
      box-sizing: border-box;
    }

    label {
      color: #c1272d;
      display: block;
      font-size: 14px;
      margin-top: 10px;
    }

    input[type="text"],
    input[type="number"] {
      border: 1px solid #dddddd;
      border-radius: 5px;
      box-sizing: border-box;
      font-size: 14px;
      padding: 8px;
      width: 100%;
    }

    input[type="submit"] {
      background-color: #c1272d;
      border: none;
      border-radius: 5px;
      color: #ffffff;
      cursor: pointer;
      font-size: 16px;
      padding: 10px 20px;
    }

    input[type="submit"]:hover {
      background-color: #a12026;
    }

    p.small-text {
      color: green;
      text-align: center;
      text-decoration: underline;
      text-shadow: -2px -2px 4px white, 2px -2px 4px white, -2px 2px 4px white, 2px 2px 4px white;
    }

    p.small-text a {
      color: green;
      text-align: center;
      text-decoration: underline;
      text-shadow: -2px -2px 4px white, 2px -2px 4px white, -2px 2px 4px white, 2px 2px 4px white;
    }

    textarea {
      border: 1px solid #dddddd;
      border-radius: 5px;
      box-sizing: border-box;
      font-size: 14px;
      padding: 8px;
      width: 100%;
      height: 200px; /* Modifier la taille de la zone de texte */
    }

    table {
      background-color: #ffffff;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      margin: 20px auto;
      padding: 20px;
      width: 100%;
      table-layout: fixed;
    }

    table th {
      background-color: #c1272d;
      color: #ffffff;
      font-size: 14px;
      font-weight: bold;
      padding: 10px;
      text-align: left;
    }

    table td {
      border-bottom: 1px solid #dddddd;
      padding: 10px;
      word-wrap: break-word;
      max-width: 150px;
    }

    table td:first-child {
      font-weight: bold;
      white-space: nowrap;
    }

        /* Styles pour les conteneurs des tableaux */
    .table-container {
      max-height: 300px; /* Limite de 10 lignes visuellement */
      overflow-y: auto; /* Barre de défilement verticale */
    }

    table thead th {
        position: sticky; /* Rend l'en-tête fixe */
        top: 0; /* Positionne l'en-tête en haut du conteneur */
        z-index: 1; /* Assure que l'en-tête reste au-dessus du contenu du tableau */
      }

    .info-box {
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      margin: 20px auto;
      padding: 20px;
      width: 80%;
      max-width: 600px;
    }

    .info-box h2 {
      color: #c1272d;
      font-size: 24px;
      text-align: center;
    }

    .info-box p {
      font-size: 16px;
      line-height: 1.6;
      text-align: justify;
    }

  </style>
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
