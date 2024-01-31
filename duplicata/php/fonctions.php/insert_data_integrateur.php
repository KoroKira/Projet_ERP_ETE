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
  $societe = $_POST['societe'];
  $pays = $_POST['pays'];
  $contrat = $_POST['contrat'];
  $domaineactivite = $_POST['domaineactivite'];

  // Validate the 'Societe' field
  if (empty($societe)) {
    throw new Exception("Societe field cannot be empty");
  }

  // Prepare the INSERT statement
  $query = "INSERT INTO notretable (societe, pays, contrat, domaineactivite) VALUES (:societe, :pays, :contrat, :domaineactivite)";
  $stmt = $pdo->prepare($query);

  // Bind the values to the placeholders
  $stmt->bindParam(':societe', $societe);
  $stmt->bindParam(':pays', $pays);
  $stmt->bindParam(':contrat', $contrat);
  $stmt->bindParam(':domaineactivite', $domaineactivite);

  // Execute the INSERT statement
  $stmt->execute();

  // Send a success response
  $message = "Data inserted successfully!";
} catch (PDOException $e) {
  // Handle any errors that occur during the database insertion
  $message = "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Insert Data</title>
</head>
<body>
  <h1>Data Insertion</h1>
  <p><?php echo $message; ?></p>
</body>
</html>
