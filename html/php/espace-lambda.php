<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); // Démarrer la session

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur'])) {
    header("Location: ../login.php");
    exit();
}

$dsn = "pgsql:host=localhost;dbname=bddcrmete;options='--client_encoding=UTF8'";
$user = "postgre";
$password = "root";


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Espace Utilisateur</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Add Font Awesome CSS -->
  <link rel="stylesheet" type="text/css" href="../css/full.css">
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


// Établir la connexion à la base de données
$conn = pg_connect("host=localhost dbname=bddcrmete user=postgres password=root");

// Vérifier la connexion
if (!$conn) {
    die("Erreur de connexion à la base de données : " . pg_last_error());
}

$query = "SELECT * FROM user_data WHERE user_id = '$user_id'";
$result = pg_query($conn, $query);

if (pg_num_rows($result) > 0) {
    echo "<div class=\"table-container\">";
    echo "<table>";
    echo "<tr><th>Date et heure</th><th>Texte</th></tr>";

    while ($row = pg_fetch_assoc($result)) {
        $dateHeure = $row['date_time'];
        $texte = $row['text_content'];

        echo "<tr><td>$dateHeure</td><td>$texte</td></tr>";
    }

    echo "</table>";
    echo "</div>";
} else {
    echo "Aucune donnée disponible.";
}

pg_close($conn);
?>

<p class="small-text">
  <a href="accueil.php">Retour à la page d'accueil</a>
</p>

</body>
</html>
