<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


$dsn = "mysql:host=localhost;dbname=bddcrmete;charset=utf8mb4";
$user = "Boss";
$password = "D34thR0ck";


try {
  $pdo = new PDO($dsn, $user, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Retrieve the data from the AJAX request
  $year = $_POST['year'];
  $country = $_POST['country'];
  $status = $_POST['status'];
  $statusDate = $_POST['statusDate'];
  $number = $_POST['number'];
  $client = $_POST['client'];
  $contact = $_POST['contact'];
  $projectName = $_POST['projectName'];
  $referrer = $_POST['referrer'];
  $partner1 = $_POST['partner1'];
  $partner2 = $_POST['partner2'];
  $partner3 = $_POST['partner3'];
  $partner4 = $_POST['partner4'];
  $duration = $_POST['duration'];
  $amount = $_POST['amount'];
  $probability = $_POST['probability'];
  $orderDate = $_POST['orderDate'];
  $potentialRevenue = $_POST['potentialRevenue'];
  $additionalInfo = $_POST['additionalInfo'];

  // Validate the 'year' field
  if (empty($year)) {
    throw new Exception("Year field cannot be empty");
  }

  // Prepare the INSERT statement
  $query = "INSERT INTO MaTable (year, country, status, statusDate, number, client, contact, projectName, referrer, partner1, partner2, partner3, partner4, duration, amount, probability, orderDate, potentialRevenue, additionalInfo) VALUES (:year, :country, :status, :statusDate, :number, :client, :contact, :projectName, :referrer, :partner1, :partner2, :partner3, :partner4, :duration, :amount, :probability, :orderDate, :potentialRevenue, :additionalInfo)";
  $stmt = $pdo->prepare($query);

  // Bind the values to the placeholders
  $stmt->bindParam(':year', $year);
  $stmt->bindParam(':country', $country);
  $stmt->bindParam(':status', $status);
  $stmt->bindParam(':statusDate', $statusDate);
  $stmt->bindParam(':number', $number);
  $stmt->bindParam(':client', $client);
  $stmt->bindParam(':contact', $contact);
  $stmt->bindParam(':projectName', $projectName);
  $stmt->bindParam(':referrer', $referrer);
  $stmt->bindParam(':partner1', $partner1);
  $stmt->bindParam(':partner2', $partner2);
  $stmt->bindParam(':partner3', $partner3);
  $stmt->bindParam(':partner4', $partner4);
  $stmt->bindParam(':duration', $duration);
  $stmt->bindParam(':amount', $amount);
  $stmt->bindParam(':probability', $probability);
  $stmt->bindParam(':orderDate', $orderDate);
  $stmt->bindParam(':potentialRevenue', $potentialRevenue);
  $stmt->bindParam(':additionalInfo', $additionalInfo);

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