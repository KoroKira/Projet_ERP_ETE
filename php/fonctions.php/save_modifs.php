<?php
$dsn = "mysql:host=localhost;dbname=bddcrmete;charset=utf8mb4";
$user = "Boss";
$password = "D34thR0ck";


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
            $query = "DELETE FROM TaTable WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } else {
            $query = "UPDATE TaTable SET $column = :value WHERE id = :id";
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
