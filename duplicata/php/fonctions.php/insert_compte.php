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
    $utilisateur = $_POST['utilisateur'];
    $motdepasse = $_POST['motdepasse'];
    $acces = $_POST['acces'];

    // Validate the 'Utilisateur' field
    if (empty($utilisateur)) {
        throw new Exception("Le champ Utilisateur ne peut pas être vide");
    }

    // Prepare the INSERT statement
    $query = "INSERT INTO connexion (utilisateur, motdepasse, acces) VALUES (:utilisateur, :motdepasse, :acces)";
    $stmt = $pdo->prepare($query);

    // Bind the values to the placeholders
    $stmt->bindParam(':utilisateur', $utilisateur);
    $stmt->bindParam(':motdepasse', $motdepasse);
    $stmt->bindParam(':acces', $acces);

    // Execute the INSERT statement
    $stmt->execute();

    // Send a success response
    $message = "Données insérées avec succès !";
} catch (PDOException $e) {
    // Handle any errors that occur during the database insertion
    $message = "Erreur : " . $e->getMessage();
}

// Output the message as JSON for the AJAX response
echo json_encode(['message' => $message]);
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
