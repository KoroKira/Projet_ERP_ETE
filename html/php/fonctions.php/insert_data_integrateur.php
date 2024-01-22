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
  $SOCIETE = $_POST['SOCIETE'];
  $PAYS = $_POST['PAYS'];
  $CONTRAT = $_POST['CONTRAT'];
  $DOMAINEACTIVITE = $_POST['DOMAINEACTIVITE'];

  // Validate the 'Societe' field
  if (empty($SOCIETE)) {
    throw new Exception("Societe field cannot be empty");
  }

  // Prepare the INSERT statement
  $query = "INSERT INTO NotreTable (SOCIETE, PAYS, CONTRAT, DOMAINEACTIVITE) VALUES (:SOCIETE, :PAYS, :CONTRAT, :DOMAINEACTIVITE)";
  $stmt = $pdo->prepare($query);

  // Bind the values to the placeholders
  $stmt->bindParam(':SOCIETE', $SOCIETE);
  $stmt->bindParam(':PAYS', $PAYS);
  $stmt->bindParam(':CONTRAT', $CONTRAT);
  $stmt->bindParam(':DOMAINEACTIVITE', $DOMAINEACTIVITE);

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
