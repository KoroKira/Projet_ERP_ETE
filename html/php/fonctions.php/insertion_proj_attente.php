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
  $CLIENT = $_POST['CLIENT'];
  $label = $_POST['label'];
  $detail = $_POST['detail'];
  $intermediary = $_POST['intermediary'];
  $DateOffre = $_POST['DateOffre'];
  $montantHT = $_POST['montantHT'];

  // Validate the 'pays' field
  if (empty($pays)) {
    throw new Exception("Le champ 'pays' ne peut pas être vide");
  }

  // Prepare the INSERT statement for TaTable
  $query = "INSERT INTO TaTable (pays, CLIENT, label, detail, intermediary, DateOffre, montantHT) VALUES (:pays, :CLIENT, :label, :detail, :intermediary, :DateOffre, :montantHT)";
  $stmt = $pdo->prepare($query);

  // Bind the values to the placeholders
  $stmt->bindParam(':pays', $pays);
  $stmt->bindParam(':CLIENT', $CLIENT);
  $stmt->bindParam(':label', $label);
  $stmt->bindParam(':detail', $detail);
  $stmt->bindParam(':intermediary', $intermediary);
  $stmt->bindParam(':DateOffre', $DateOffre);
  $stmt->bindParam(':montantHT', $montantHT);

  // Execute the INSERT statement for TaTable
  $stmt->execute();

  // Prepare the INSERT statement for LesIntermediaires
  $queryIntermediaries = "INSERT INTO LesIntermediaires (intermediary, text) VALUES (:intermediary, 0)";
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
