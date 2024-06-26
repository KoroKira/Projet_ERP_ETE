<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); // Démarrer la session

$user_id = isset($_SESSION['utilisateur']) ? $_SESSION['utilisateur'] : null;

$dsn = "pgsql:host=localhost;dbname=bddcrmete;options='--client_encoding=UTF8'";
$user = "postgres";
$password = "root";

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve the data from the AJAX request
    $dateheure = $_POST['dateheure'];
    $texte = $_POST['texte'];

    // Validate the 'DateHeure' field
    if (empty($dateheure)) {
        throw new Exception("Le champ DateHeure ne peut pas être vide");
    }

    // Prepare the INSERT statement
    $query = "INSERT INTO user_data (user_id, file_name, date_time, text_content) VALUES (:user_id, '', :dateheure, :texte)";
    $stmt = $pdo->prepare($query);

    // Bind the values to the placeholders
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':dateheure', $dateheure);
    $stmt->bindParam(':texte', $texte);

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
    <script>
        // Close the window after a short delay
        setTimeout(function() {
            window.close();
        }, 2000);
    </script>
</body>
</html>
