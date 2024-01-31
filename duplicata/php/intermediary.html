<?php
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur'])) {
    header("Location: ../CRM_ETE/login.php");
    exit();
}

// Se connecter à la base de données
$dsn = "pgsql:host=localhost;dbname=bddcrmete;options='--client_encoding=UTF8'";
$user = "postgres";
$password = "root";

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Traiter le formulaire lors de la soumission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données saisies dans les zones de texte
        $intermediary = $_POST['intermediary'];
        $text = $_POST['text'];

        // Vérifier si les données sont vides
        if (!empty($intermediary) && !empty($text)) {
            // Insérer les données dans la table LesIntermediaires
            $insertQuery = "INSERT INTO lesintermediaires (intermediary, text) VALUES (:intermediary, :text)";
            $insertStmt = $pdo->prepare($insertQuery);
            $insertStmt->bindParam(':intermediary', $intermediary);
            $insertStmt->bindParam(':text', $text);

            // Exécuter la requête d'insertion
            $insertStmt->execute();
        }
    }

    // Récupérer les données des intermédiaires déjà présents
    $query = "SELECT * FROM lesintermediaires";
    $stmt = $pdo->query($query);
    $intermediaires = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <meta charset="UTF-8">
    <title>Intermédiaires</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body class="bg-secondary">

<h1 class="text-danger text-center">Intermédiaires</h1>

<form id="Intermediaires_datas" method="POST" class="container">
    <div class="mb-3">
        <label for="intermediary" class="form-label text-light">Intermédiaire :</label>
        <input type="text" id="intermediary" name="intermediary" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="text" class="form-label text-light">Texte :</label>
        <textarea id="text" name="text" class="form-control" required></textarea>
    </div>
    <button type="submit" class="btn btn-danger">Enregistrer</button>
</form>

<?php
    try {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['submit'])) {
                $id = $_POST['id'];
                $column = $_POST['column'];
                $value = $_POST['value'];

                $query = "UPDATE lesintermediaires SET $column = :value WHERE id = :id";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':value', $value);
                $stmt->bindParam(':id', $id);
                $stmt->execute();

                echo "Données mises à jour avec succès!";
            }
        }

        $query = "SELECT * FROM lesintermediaires";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

<div class="table-container">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Intermédiaire</th>
                <th>Texte</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $row) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="intermediary"><?php echo $row['intermediary']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="text"><?php echo $row['text']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

    <button id="BoutonValidation" onclick="ValidationModif()" class="btn btn-danger">Valider les modifications</button>

    <script>
        // Ajoutez un gestionnaire d'événement pour les cellules éditables
        const CelluleEditable = document.querySelectorAll('.editable');
        CelluleEditable.forEach(cell => {
            cell.addEventListener('click', () => {
                const id = cell.getAttribute('data-id');
                const column = cell.getAttribute('data-column');
                const value = prompt('Modifier la valeur :', cell.textContent.trim());

                if (value !== null) {
                    const formData = new FormData();
                    formData.append('id', id);
                    formData.append('column', column);
                    formData.append('value', value);
                    formData.append('submit', 'true'); // Add the submit flag

                    fetch('intermediary.php', {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => response.text())
                        .then(result => {
                            console.log(result);
                            cell.textContent = value;
                        })
                        .catch(error => console.log(error));
                }
            });
        });

        // Function to validate and save the modifications
        function ValidationModif() {
            // Collect all the modified data from the table
            const modifiedData = [];
            CelluleEditable.forEach(cell => {
                const id = cell.getAttribute('data-id');
                const column = cell.getAttribute('data-column');
                const value = cell.textContent.trim();

                modifiedData.push({ id, column, value });
            });

            // Send the modified data to the server
            fetch('fonctions.php/save_modifications_intermediary.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(modifiedData)
            })
                .then(response => response.text())
                .then(result => {
                    console.log(result);
                    alert('Modifications enregistrées ! Rechargez la page en cas de problèmes, ou contactez votre administrateur/développeur');
                })
                .catch(error => console.log(error));
        }

    </script>

    <?php } catch (PDOException $e) {
        echo "Erreur de requête : " . $e->getMessage();
    } ?>

  <p class="small-text text-center">
    <a href="accueil.php" class="text-light">Retourner à l'accueil</a>
  </p>
</body>
</html>
