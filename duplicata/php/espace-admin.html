<?php
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur'])) {
    header("Location: ../login.php");
    exit();
}

// Vérifier les droits d'accès
$acces = $_SESSION['acces'];
if ($acces !== 'Admin') {
    echo "Accès refusé. Retournez à la page précédente";
    exit();
}

$dsn = "pgsql:host=localhost;dbname=bddcrmete;options='--client_encoding=UTF8'";
$user = "postgres";
$password = "root";

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $column = $_POST['column'];
            $value = $_POST['value'];

            $query = "UPDATE connexion SET $column = :value WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':value', $value);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            echo "Données mises à jour avec succès!";
        } elseif (isset($_POST['delete'])) {
            $id = $_POST['id'];

            $query = "DELETE FROM connexion WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            echo "Données supprimées avec succès!";
        } elseif (isset($_POST['ajouterCompte'])) {
            $utilisateur = $_POST['utilisateur'];
            $motdepasse = $_POST['motdepasse'];
            $acces = $_POST['acces'];

            $query = "INSERT INTO connexion (utilisateur, motdepasse, acces) VALUES (:utilisateur, :motdepasse, :acces)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':utilisateur', $utilisateur);
            $stmt->bindParam(':motdepasse', $motdepasse);
            $stmt->bindParam(':acces', $acces);
            $stmt->execute();

            echo "Compte ajouté avec succès!";
        }
    }

    $query = "SELECT * FROM connexion";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur de requête : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <meta charset="UTF-8">
    <title>Administration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

<h1 class="text-center mt-5">Espace administrateur</h1>

<div class="d-flex justify-content-center mt-3">
    <button onclick="location.href='modif_admin.php'" class="btn btn-primary me-2">Modifier les données dans le CRM</button>
    <button onclick="location.href='gestion_textes_admin.php'" class="btn btn-primary">Accéder aux textes des utilisateurs et aux fichiers déposés - admin</button>
</div>

<h2 class="text-center mt-3">Ajouter un compte</h2>

<div class="container mt-3">
    <form id="AjoutCompte">
        <div class="mb-3">
            <label for="utilisateur" class="form-label">Utilisateur :</label>
            <input type="text" id="utilisateur" name="utilisateur" required class="form-control">
        </div>
        <div class="mb-3">
            <label for="motdepasse" class="form-label">Mot de passe :</label>
            <input type="text" id="motdepasse" name="motdepasse" required class="form-control">
        </div>
        <div class="mb-3">
            <label for="acces" class="form-label">Droit d'accès (mettre Admin ou Lambda) :</label>
            <input type="text" id="acces" name="acces" required class="form-control">
        </div>
    </form>

    <button id="valider" style="display: block; margin: 0 auto;" class="btn btn-primary" onclick="Datainserer()">Créer un nouveau compte utilisateur</button>
</div>

<div class="table-container mt-3">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Utilisateur</th>
                <th>Mot de passe</th>
                <th>Accès</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $row) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="utilisateur"><?php echo $row['utilisateur']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="motdepasse"><?php echo $row['motdepasse']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="acces"><?php echo $row['acces']; ?></td>
                    <td>
                        <button class="delete-button" onclick="deleteRow(<?php echo $row['id']; ?>)" name="delete">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<button id="BoutonDeValidation" onclick="ValidationModifications()" class="btn btn-primary mt-3">Valider les modifications</button>

<script>
  function Datainserer() {
    const utilisateur = document.getElementById('utilisateur').value;
    const motdepasse = document.getElementById('motdepasse').value;
    const acces = document.getElementById('acces').value;

    const formData = new FormData();
    formData.append('utilisateur', utilisateur);
    formData.append('motdepasse', motdepasse);
    formData.append('acces', acces);
    formData.append('ajouterCompte', 'true'); // Ajoutez le drapeau ajouterCompte

    fetch('espace-admin.php', { // Pointez vers le fichier espace-admin.php
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        console.log(result);
        alert('Compte ajouté avec succès !');
        location.reload(); // Rafraîchir la page pour refléter les modifications
    })
    .catch(error => console.log(error));
  }

    // Ajoutez un gestionnaire d'événements pour les cellules éditables
    const CelluleEditableBis = document.querySelectorAll('.editable');
    CelluleEditableBis.forEach(cell => {
        cell.addEventListener('click', () => {
            const id = cell.getAttribute('data-id');
            const column = cell.getAttribute('data-column');
            const value = prompt('Modifier la valeur :', cell.textContent.trim());

            if (value !== null) {
                const formData = new FormData();
                formData.append('id', id);
                formData.append('column', column);
                formData.append('value', value);
                formData.append('submit', 'true'); // Ajoutez le drapeau submit

                fetch('espace-admin.php', {
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

    // Fonction pour valider et enregistrer les modifications
    function ValidationModifications() {
        // Collecter toutes les données modifiées de la table
        const modifiedData = [];
        CelluleEditableBis.forEach(cell => {
            const id = cell.getAttribute('data-id');
            const column = cell.getAttribute('data-column');
            const value = cell.textContent.trim();

            modifiedData.push({ id, column, value });
        });

        // Envoyer les données modifiées au serveur
        fetch('fonctions.php/save_modif_connexion.php', {
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

    function deleteRow(id) {
        const confirmation = confirm("Êtes-vous sûr de supprimer cette ligne ? Toute donnée supprimée est définitivement perdue.");

        if (confirmation) {
            const formData = new FormData();
            formData.append('id', id);
            formData.append('delete', 'true'); // Ajoutez le drapeau delete

            fetch('espace-admin.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(result => {
                console.log(result);
                alert('Ligne retirée avec succès !');
                location.reload(); // Rafraîchir la page pour refléter les modifications
            })
            .catch(error => console.log(error));
        }
    }
</script>

<p class="small-text mt-3">
  <a href="accueil.php">Retour à la page d'accueil</a>
</p>

</body>
</html>
