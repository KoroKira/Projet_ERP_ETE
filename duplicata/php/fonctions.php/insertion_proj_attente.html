<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$dsn = "pgsql:host=localhost;dbname=bddcrmete;options='--client_encoding=UTF8'";
$user = "postgres";
$password = "root";


$message = ""; // Initialize the message variable

try {
  $pdo = new PDO($dsn, $user, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Retrieve the data from the AJAX request
  $pays = $_POST['pays'];
  $client = $_POST['client'];
  $label = $_POST['label'];
  $detail = $_POST['detail'];
  $intermediary = $_POST['intermediary'];
  $dateoffre = $_POST['dateoffre'];
  $montantht = $_POST['montantht'];

  // Validate the 'pays' field
  if (empty($pays)) {
    throw new Exception("Le champ 'pays' ne peut pas être vide");
  }

  // Prepare the INSERT statement for TaTable
  $query = "INSERT INTO tatable (pays, client, label, detail, intermediary, dateoffre, montantht) VALUES (:pays, :client, :label, :detail, :intermediary, :dateoffre, :montantht)";
  $stmt = $pdo->prepare($query);

  // Bind the values to the placeholders
  $stmt->bindParam(':pays', $pays);
  $stmt->bindParam(':client', $client);
  $stmt->bindParam(':label', $label);
  $stmt->bindParam(':detail', $detail);
  $stmt->bindParam(':intermediary', $intermediary);
  $stmt->bindParam(':dateoffre', $dateoffre);
  $stmt->bindParam(':montantht', $montantht);

  // Execute the INSERT statement for TaTable
  $stmt->execute();

  // Prepare the INSERT statement for LesIntermediaires
  $queryIntermediaries = "INSERT INTO lesintermediaires (intermediary, text) VALUES (:intermediary, 0)";
  $stmtIntermediaries = $pdo->prepare($queryIntermediaries);

  // Bind the value to the placeholder
  $stmtIntermediaries->bindParam(':intermediary', $intermediary);

  // Execute the INSERT statement for LesIntermediaires
  $stmtIntermediaries->execute();

  // Clear the parameters of the second statement
  $stmtIntermediaries->closeCursor();

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
