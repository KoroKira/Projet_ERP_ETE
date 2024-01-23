<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

$user_id = isset($_SESSION['utilisateur']) ? $_SESSION['utilisateur'] : null;

$dsn = "pgsql:host=localhost;dbname=bddcrmete;options='--client_encoding=UTF8'";
$user = "postgres";
$password = "root";

try {
  $pdo = new PDO($dsn, $user, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Define the upload directory path
$upload_directory = __DIR__ . "/upload/";

// Récupérer la liste des fichiers dans le dossier
$files = scandir($upload_directory);

// Retirer les fichiers '.' et '..'
$files = array_diff($files, array('.', '..'));

$fileList = array();

foreach ($files as $file) {
    $filePath = $upload_directory . $file;
    $fileInfo = array(
        'name' => $file,
        'size' => filesize($filePath) . ' octets',
        'date' => date('d/m/Y H:i:s', filemtime($filePath)),
        'type' => pathinfo($file, PATHINFO_EXTENSION)
    );

    $fileList[] = $fileInfo;
}

// Fonction pour convertir la taille du fichier en Ko ou Mo
function convertirTaille($taille)
{
    $unites = array(' octets', ' Ko', ' Mo', ' Go', ' To');

    for ($i = 0; $taille >= 1024 && $i < count($unites) - 1; $i++) {
        $taille /= 1024;
    }

    return round($taille, 2) . $unites[$i];
}

?>

<?php
// Remplacez les valeurs suivantes par les informations de votre base de données
$host = "localhost";
$port = "5432";
$dbname = "bddcrmete";
$user = "postgres";
$password = "root";

// Établir la connexion à la base de données PostgreSQL
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Échec de la connexion à la base de données: " . pg_last_error());
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Espace Administrateur</title>
  <link rel="stylesheet" type="text/css" href="../css/full.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Add Font Awesome CSS -->

    <script>
    function deleteFile(file) {
        if (confirm("Êtes-vous sûr de vouloir supprimer ce fichier ?")) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "supprimer_fichier.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    // Reload the page after the deletion
                    window.location.reload();
                }
            };
            xhr.send("fichier=" + encodeURIComponent(file));
        }
    }

    const deleteButtons = document.querySelectorAll(".delete-button");
    deleteButtons.forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            const file = this.dataset.file;
            deleteFile(file);
        });
    });
</script>



</head>
<body>
  
  <script>
  document.addEventListener("DOMContentLoaded", function() {
    const headers = document.querySelectorAll("#infoTable th");

    headers.forEach(header => {
      header.addEventListener("click", function() {
        const column = this.dataset.column;
        const order = this.dataset.order === "asc" ? "desc" : "asc";

        // Réinitialise tous les en-têtes
        headers.forEach(header => {
          header.classList.remove("asc", "desc");
        });

        // Met à jour l'en-tête cliqué avec le nouvel ordre
        this.dataset.order = order;
        this.classList.add(order);

        // Effectue la requête de tri
        sortTable(column, order);
      });
    });

    function sortTable(column, order) {
      const table = document.getElementById("infoTable");
      const tbody = table.querySelector("tbody");
      const rows = Array.from(tbody.querySelectorAll("tr"));

      // Trier les lignes en fonction de la colonne spécifiée
      rows.sort((a, b) => {
        const aValue = a.querySelector(`td:nth-child(${column})`).textContent.trim();
        const bValue = b.querySelector(`td:nth-child(${column})`).textContent.trim();

        if (order === "asc") {
          return aValue.localeCompare(bValue);
        } else {
          return bValue.localeCompare(aValue);
        }
      });

      // Met à jour l'ordre des lignes dans le tableau
      rows.forEach(row => tbody.appendChild(row));
    }
  });
</script>


<h1>Espace administrateur</h1>

<h2>Documents et compte-rendus utilisateurs</h2>

<div class="form-wrapper" id="formWrapper">
  <form id="AjoutTexte" class="show" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div style="display: flex; flex-direction: column; align-items: flex-start;">
      <label for="DateHeure" style="margin-bottom: 10px;">Date et Heure (JJ/MM/AAAA HH:MM) :</label>
      <input type="text" id="DateHeure" name="DateHeure" required style="width: 100%;">
    </div>

    <div style="display: flex; flex-direction: column; align-items: flex-start; margin-top: 20px;">
      <label for="text" style="margin-bottom: 10px;">Texte :</label>
      <textarea id="text" name="text" required style="width: 100%; height: 200px;"></textarea>
    </div>

    <input type="submit" value="Créer une nouvelle entrée texte" class="center-button" style="margin-top: 20px;">
  </form>
</div>
      
<div class="toggle-button" id="toggleButton">
  <div class="arrow"></div>
</div>

<script>
  const formWrapper = document.getElementById("formWrapper");
  const toggleButton = document.getElementById("toggleButton");

  toggleButton.addEventListener("click", function() {
    formWrapper.classList.toggle("show");
  });
</script>


<?php

$query = "SELECT * FROM user_data WHERE true";

$result = pg_query($conn, $query);

if (pg_num_rows($result) > 0) {
    echo "<div class=\"table-container\">";
    echo "<table id=\"infoTable\">";
    echo "<thead><tr><th data-column=\"1\" data-order=\"\">Date et heure</th><th data-column=\"2\" data-order=\"\">Texte</th><th data-column=\"3\" data-order=\"\">Utilisateur</th></tr></thead>";
    echo "<tbody>";

    while ($row = pg_fetch_assoc($result)) {
        $dateHeure = $row['date_time'];
        $texte = $row['text_content'];
        $userID = $row['user_id'];

        echo "<tr><td>$dateHeure</td><td>$texte</td><td>$userID</td></tr>";
    }

    echo "</tbody>";
    echo "</table>";
    echo "</div>";
} else {
    echo "Aucune donnée disponible.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si les données du formulaire sont présentes
    if (isset($_POST['DateHeure']) && isset($_POST['text'])) {
        // Récupérer les valeurs du formulaire
        $dateHeure = $_POST['DateHeure'];
        $texte = $_POST['text'];

        // Utiliser une requête préparée pour sécuriser les données
        $insertQuery = "INSERT INTO user_data (date_time, text_content, user_id, file_name) VALUES ($1, $2, $3, '0')";
        $stmt = pg_prepare($conn, "insert_query", $insertQuery);
        $result = pg_execute($conn, "insert_query", array($dateHeure, $texte, $_SESSION['utilisateur']));

        // Exécuter la requête d'insertion
        if ($result) {
            echo "<script>alert('Les informations ont été insérées avec succès.');</script>";
            echo "<script>window.location.reload();</script>";
        } else {
            echo "Erreur lors de l'insertion des informations : " . pg_last_error($conn);
        }
    } else {
        echo "Veuillez remplir tous les champs du formulaire.";
    }
}

pg_close($conn);

?>


    <h1>Liste des fichiers</h1>

<table id="filesTable">
    <thead id="filesTableHead">
        <tr>
            <th>Nom</th>
            <th>Taille</th>
            <th>Date</th>
            <th>Type</th>
            <th>Télécharger</th>
			<th>Supprimer</th>
        </tr>
    </thead>
    <tbody id="filesTableBody">
<?php foreach ($files as $file) { ?>
    <tr>
        <td class="word-wrap"><?php echo $file; ?></td>
        <td class="word-wrap"><?php echo convertirTaille(filesize($upload_directory . $file)); ?></td>
        <td class="word-wrap"><?php echo date('d/m/Y H:i:s', filemtime($upload_directory . $file)); ?></td>
        <td class="word-wrap"><?php echo pathinfo($file, PATHINFO_EXTENSION); ?></td>
        <td><a href="telecharger.php?fichier=<?php echo urlencode($file); ?>">Télécharger</a></td>
        <td>
            <a href="#" class="delete-button" data-file="<?php echo urlencode($file); ?>">
                <i class="fas fa-trash-alt"></i> 
            </a>
        </td>
    </tr>
<?php } ?>

        </tbody>
    </table>

<p class="small-text">
  <a href="accueil.php">Retour à la page d'accueil</a>
</p>

</body>
</html>