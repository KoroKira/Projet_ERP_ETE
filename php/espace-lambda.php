<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
  <title>Espace Utilisateur</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Add Font Awesome CSS -->
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

    h2 {
      color: #c1272d;
      font-size: 24px;
      text-align: center;
      text-shadow: 2px 2px 4px #ffffff;
      margin-top: 20px;
    }

    form {
      background-color: #ffffff;
      border-radius: 5px;
      margin: 20px auto;
      padding: 20px;
      width: 800px;
      box-sizing: border-box;
    }

    form h2 {
      color: #c1272d;
      font-size: 24px;
      text-align: center;
      margin-top: 0;
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

    button {
      background-color: #c1272d;
      border: none;
      border-radius: 5px;
      color: #ffffff;
      cursor: pointer;
      font-size: 16px;
      padding: 10px 20px;
    }

    button:hover {
      background-color: #a12026;
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

    .delete-button {
            background: none;
            border: none;
            color: #c1272d;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s, color 0.3s; /* Add transition effect */
        }

    .delete-button:hover {
            background-color: #c1272d; /* Change background color on hover */
            color: #ffffff; /* Change text color on hover */
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

    .center-button {
        display: block;
        margin: 0 auto;
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


  </style>
  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

<h1>Espace utilisateur</h1>

<h2>Ajouter du texte</h2>

<form id="AjoutTexte" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="DateHeure">Date et Heure (JJ/MM/AAAA HH:MM) :</label>
    <input type="text" id="DateHeure" name="DateHeure" required>
    <label for="text">Texte :</label>
    <textarea id="text" name="text" required></textarea> 
    <input type="submit" value="Créer une nouvelle entrée texte" class="center-button">
</form>

<h2>Uploader un fichier (taille limite: 100 MO). Merci de faire attention au nom du fichier, qu'il soit clair et compréhensif du premier coup d'oeil</h2>

<form method="POST" action="upload.php" enctype="multipart/form-data">
     <!-- On limite le fichier à 100MO -->
     <input type="hidden" name="MAX_FILE_SIZE" value="100000000">
     Fichier : <input type="file" name="avatar">
     <br>
     <br>
     <input type="submit" name="envoyer" value="Envoyer le fichier">
</form>


<script>
// Function to insert data into the database
function Datainserer() {
  // Retrieve the form data
  const form = document.getElementById('AjoutTexte');
  const formData = new FormData(form);

  // Send an AJAX request to the PHP script
  fetch('fonctions.php/insert_data_lambda.php', {
    method: 'POST',
    body: formData
  })
    .then(response => response.text())
    .then(result => {
      console.log(result);
      alert('Données insérées avec succès ! Rechargez la page pour voir les données dans le tableau en dessous');
      form.reset(); // Reset the form after successful insertion
    })
    .catch(error => {
      console.log(error);
      alert('Erreurs durant le transfert, contactez votre administrateur/technicien/informaticien');
    });
}

// Add an event listener to the form submit button
document.getElementById('AjoutTexte').addEventListener('submit', function(e) {
  e.preventDefault(); // Prevent form submission
  Datainserer();
});
</script>

<?php

$user_id = isset($_SESSION['utilisateur']) ? $_SESSION['utilisateur'] : null;

$host = 'localhost'; // L'hôte de la base de données
$user = 'Boss'; // Le nom d'utilisateur de la base de données
$password = 'D34thR0ck'; // Le mot de passe de la base de données
$database = 'bddcrmete'; // Le nom de la base de données

// Établir la connexion à la base de données
$conn = mysqli_connect($host, $user, $password, $database);

// Vérifier la connexion
if (!$conn) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}

$query = "SELECT * FROM user_data WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<div class=\"table-container\">";
    echo "<table>";
    echo "<tr><th>Date et heure</th><th>Texte</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        $dateHeure = $row['date_time'];
        $texte = $row['text_content'];

        echo "<tr><td>$dateHeure</td><td>$texte</td></tr>";
    }

    echo "</table>";
    echo "</div>";
} else {
    echo "Aucune donnée disponible.";
}

mysqli_close($conn);
?>

<p class="small-text">
  <a href="accueil.php">Retour à la page d'accueil</a>
</p>

</body>
</html>
