<?php
$dsn = "pgsql:host=localhost;dbname=bddcrmete;options='--client_encoding=UTF8'";
$user = "postgres";
$password = "root";


try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Receive the modified data from the request body
    $modifiedData = json_decode(file_get_contents('php://input'), true);

    // Update the database with the modified data
    foreach ($modifiedData as $data) {
        $id = $data['id'];
        $column = $data['column'];
        $value = $data['value'];

        // If the value is empty, delete the row instead of updating it
        if ($value === '') {
            $query = "DELETE FROM connexion WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } else {
            $query = "UPDATE connexion SET $column = :value WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':value', $value);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }
    }

    // Send a success response
    echo "Modifications successfully saved!";
} catch (PDOException $e) {
    // Handle any errors that occur during the database update
    echo "Error: " . $e->getMessage();
}
?>
