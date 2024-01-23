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

?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Administration</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Add Font Awesome CSS -->
  <style>
    body {
      background-image: url('../image/fondbleu.jpg');
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center center;
      height: 100vh; /* Ajout de la propriété height */
      background-attachment: fixed; /* Fixe l'image de fond */
    }

    h1 {
      color: #c1272d;
      font-size: 36px;
      text-align: center;
      text-shadow: 2px 2px 4px #ffffff;
      margin-top: 50px;
    }

    h2 {
      color: #c1272d;
      font-size: 24px;
      text-align: center;
      text-shadow: 2px 2px 4px #ffffff;
      margin-top: 20px;
    }

    form {
      background-color: #ffffff;
      border-radius: 5px;
      margin: 20px auto;
      padding: 20px;
      width: 800px;
      box-sizing: border-box;
    }

    form h2 {
      color: #c1272d;
      font-size: 24px;
      text-align: center;
      margin-top: 0;
    }

    table {
      background-color: #ffffff;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      margin: 20px auto;
      padding: 20px;
      width: 100%;
      table-layout: fixed;
    }

    table th {
      background-color: #c1272d;
      color: #ffffff;
      font-size: 14px;
      font-weight: bold;
      padding: 10px;
      text-align: left;
    }

    table td {
      border-bottom: 1px solid #dddddd;
      padding: 10px;
      word-wrap: break-word;
      max-width: 150px;
    }

    table td:first-child {
      font-weight: bold;
      white-space: nowrap;
    }

    button {
      background-color: #c1272d;
      border: none;
      border-radius: 5px;
      color: #ffffff;
      cursor: pointer;
      font-size: 16px;
      padding: 10px 20px;
    }

    button:hover {
      background-color: #a12026;
    }

    label {
      color: #c1272d;
      display: block;
      font-size: 14px;
      margin-top: 10px;
    }

    input[type="text"],
    input[type="number"] {
      border: 1px solid #dddddd;
      border-radius: 5px;
      box-sizing: border-box;
      font-size: 14px;
      padding: 8px;
      width: 100%;
    }

    input[type="submit"] {
      background-color: #c1272d;
      border: none;
      border-radius: 5px;
      color: #ffffff;
      cursor: pointer;
      font-size: 16px;
      padding: 10px 20px;
    }

    input[type="submit"]:hover {
      background-color: #a12026;
    }

    p.small-text {
      color: green;
      text-align: center;
      text-decoration: underline;
      text-shadow: -2px -2px 4px white, 2px -2px 4px white, -2px 2px 4px white, 2px 2px 4px white;
    }

    p.small-text a {
      color: green;
      text-align: center;
      text-decoration: underline;
      text-shadow: -2px -2px 4px white, 2px -2px 4px white, -2px 2px 4px white, 2px 2px 4px white;
    }

    .delete-button {
            background: none;
            border: none;
            color: #c1272d;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s, color 0.3s; /* Add transition effect */
        }

        .delete-button:hover {
            background-color: #c1272d; /* Change background color on hover */
            color: #ffffff; /* Change text color on hover */
    }

        /* Styles pour les conteneurs des tableaux */
    .table-container {
      max-height: 300px; /* Limite de 10 lignes visuellement */
      overflow-y: auto; /* Barre de défilement verticale */
    }

    table thead th {
        position: sticky; /* Rend l'en-tête fixe */
        top: 0; /* Positionne l'en-tête en haut du conteneur */
        z-index: 1; /* Assure que l'en-tête reste au-dessus du contenu du tableau */
      }

  </style>
  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

<h1>Espace administrateur</h1>


<button onclick="location.href='modif_admin.php'">Modifier les données dans le CRM</button>
<button onclick="location.href='gestion_textes_admin.php'">Accéder aux textes des utilisateurs et aux fichiers déposés - admin </button>



<h2>Ajouter un compte</h2>


<form id="AjoutCompte">
  <label for="Utilisateur">Utilisateur :</label>
  <input type="text" id="Utilisateur" name="Utilisateur" required>
  <br>
  <label for="MotDePasse">Mot de passe :</label>
  <input type="text" id="MotDePasse" name="MotDePasse" required>
  <label for="Acces">Droit d'accès (mettre Admin ou Lambda) :</label>
  <input type="text" id="Acces" name="Acces" required>
</form>

<button id="valider" style="display: block; margin: 0 auto;">Créer un nouveau compte utilisateur</button>



<script>
// Function to insert data into the database
function Datainserer() {
  // Retrieve the form data
  const form = document.getElementById('AjoutCompte');
  const formData = new FormData(form);

  // Send an AJAX request to the PHP script
  fetch('fonctions.php/insert_compte.php', {
    method: 'POST',
    body: formData
  })
    .then(response => response.text())
    .then(result => {
      console.log(result);
      alert('Données insérées avec succès ! Rechargez la page pour voir les données dans le tableau en dessous');
      form.reset(); // Reset the form after successful insertion
    })
    .catch(error => {
      console.log(error);
      alert('Erreurs durant le transfert, contactez votre administrateur/technicien/informaticien');
    });
}

// Add an event listener to the transfer button
document.getElementById('valider').addEventListener('click', function() {
  Datainserer();
});

</script>


<?php
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

            $query = "UPDATE Connexion SET $column = :value WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':value', $value);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            echo "Données mises à jour avec succès!";
        } elseif (isset($_POST['delete'])) {
            $id = $_POST['id'];

            $query = "DELETE FROM Connexion WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            echo "Données supprimées avec succès!";
        }
    }

    $query = "SELECT * FROM Connexion";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Liste comptes existants</h1>

<div class="table-container">
<table>
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
                <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="Utilisateur"><?php echo $row['Utilisateur']; ?></td>
                <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="MotDePasse"><?php echo $row['MotDePasse']; ?></td>
                <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="Acces"><?php echo $row['Acces']; ?></td>
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
<button id="BoutonDeValidation" onclick="ValidationModifications()">Valider les modifications</button>

<script>
    // Ajoutez un gestionnaire d'événement pour les cellules éditables
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
                formData.append('submit', 'true'); // Add the submit flag

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

    // Function to validate and save the modifications
    function ValidationModifications() {
        // Collect all the modified data from the table
        const modifiedData = [];
        CelluleEditableBis.forEach(cell => {
            const id = cell.getAttribute('data-id');
            const column = cell.getAttribute('data-column');
            const value = cell.textContent.trim();

            modifiedData.push({ id, column, value });
        });

        // Send the modified data to the server
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
            formData.append('delete', 'true'); // Add the delete flag

            fetch('espace-admin.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(result => {
                console.log(result);
                alert('Ligne retirée avec succès !');
                location.reload(); // Refresh the page to reflect the changes
            })
            .catch(error => console.log(error));
        }
    }

</script>



<?php } catch (PDOException $e) {
    echo "Erreur de requête : " . $e->getMessage();
} ?>







<p class="small-text">
  <a href="accueil.php">Retour à la page d'accueil</a>
</p>

</body>
</html>