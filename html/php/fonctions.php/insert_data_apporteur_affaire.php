<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$dsn = "pgsql:host=localhost;dbname=bddcrmete;options='--client_encoding=UTF8'";
$user = "postgres";
$password = "root";


try {
  $pdo = new PDO($dsn, $user, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Retrieve the data from the AJAX request
  $NomPrenom = $_POST['NomPrenom'];
  $Societe = $_POST['Societe'];
  $Pays = $_POST['Pays'];
  $Contrat = $_POST['Contrat'];
  $DomaineActivite = $_POST['DomaineActivite'];

  // Validate the 'NomPrenom' field
  if (empty($NomPrenom)) {
    throw new Exception("Le champ Nom Prénom ne peut pas être vide");
  }

  // Prepare the INSERT statement
  $query = "INSERT INTO SaTable (NomPrenom, Societe, Pays, Contrat, DomaineActivite) VALUES (:NomPrenom, :Societe, :Pays, :Contrat, :DomaineActivite)";
  $stmt = $pdo->prepare($query);

  // Bind the values to the placeholders
  $stmt->bindParam(':NomPrenom', $NomPrenom);
  $stmt->bindParam(':Societe', $Societe);
  $stmt->bindParam(':Pays', $Pays);
  $stmt->bindParam(':Contrat', $Contrat);
  $stmt->bindParam(':DomaineActivite', $DomaineActivite);

  // Execute the INSERT statement
  $stmt->execute();

  // Send a success response
  $message = "Données insérées avec succès !";
} catch (PDOException $e) {
  // Handle any errors that occur during the database insertion
  $message = "Erreur : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Insertion de données</title>
</head>
<body>
  <h1>Insertion de données</h1>
  <p><?php echo $message; ?></p>
</body>
</html>
