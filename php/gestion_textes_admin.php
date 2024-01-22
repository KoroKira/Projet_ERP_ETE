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



// Établir la connexion à la base de données
$conn = mysqli_connect($host, $user, $password, $database);

// Vérifier la connexion
if (!$conn) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
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

<!DOCTYPE html>
<html>

<style>
body {
  background-image: url('../image/fondbleu.jpg');
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center center;
  height: 100vh;
  background-attachment: fixed;
}

h1, h2, form-h2 {
  color: #c1272d;
  font-size: 24px;
  text-align: center;
  text-shadow: 2px 2px 4px #ffffff;
  margin-top: 50px;
}

form-h2 {
  margin-top: 0px;
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
  cursor: pointer;
}

table td {
  border-bottom: 1px solid #dddddd;
  padding: 10px;
  max-width: 150px;
  white-space: nowrap; /* Prevent text from wrapping */
  overflow: hidden; /* Hide any overflowing content */
  text-overflow: ellipsis; /* Display an ellipsis (...) for truncated content */
}

table td:first-child {
  font-weight: bold;
  white-space: nowrap;
}

button, input[type="submit"] {
  background-color: #c1272d;
  color: #ffffff;
  padding: 10px 20px;
  border-radius: 5px;
  border: none;
  cursor: pointer;
  font-size: 16px;
}

button:hover, input[type="submit"]:hover {
  background-color: #a12026;
}

label {
  color: #c1272d;
  display: block;
  font-size: 14px;
  margin-top: 10px;
}

input[type="text"], input[type="number"], textarea {
  background-color: rgba(255, 255, 255, 0.8);
  border: none;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  padding: 10px;
  margin-bottom: 10px;
  width: 100%;
  color: #c1272d;
}

textarea {
  border: 1px solid #dddddd;
  border-radius: 5px;
  box-sizing: border-box;
  font-size: 14px;
  padding: 8px;
  width: 100%;
  height: 200px;
}

.delete-button {
            background: none;
            border: none;
            color: #c1272d;
            cursor: pointer;
			z-index: 9999;
            font-size: 16px;
            transition: background-color 0.3s, color 0.3s; /* Add transition effect */
}

.delete-button:hover {
            background-color: #c1272d; /* Change background color on hover */
            color: #ffffff; /* Change text color on hover */
}

p.small-text {
  color: green;
  text-align: center;
  text-decoration: underline;
  text-shadow: -2px -2px 4px white, 2px -2px 4px white, -2px 2px 4px white, 2px 2px 4px white;
}

.form-wrapper, form {
  background-color: #f9f6f5;
  border-radius: 5px;
  margin: 20px 0;
  padding: 30px;
  max-width: 400px;
  box-sizing: border-box;
  position: fixed;
  top: 50%;
  left: -400px;
  transform: translate(0, -50%);
  transition: left 0.3s;
  z-index: 90000;
  border: 1px solid #000000;
}

form.show {
  left: 20px;
  z-index: 90000;
}

.form-wrapper.show {
  left: -400px;
  z-index: 90000;
}

.toggle-button {
  position: absolute;
  top: 50%;
  right: -40px;
  transform: translateY(-50%);
  width: 40px;
  height: 40px;
  background-color: rgba(0, 0, 0, 0.1);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  z-index: 999;
  transition: right 0.3s;
}

.toggle-button .arrow {
  width: 20px;
  height: 20px;
  border: solid #c1272d;
  border-width: 2px 2px 0 0;
  transform: rotate(-135deg);
  transition: transform 0.3s;
  z-index: 90000;
}

.form-wrapper.show .toggle-button .arrow {
  transform: rotate(45deg);
  z-index: 90000;
}

/* Style pour le formulaire d'ajout */
#AjoutTexte label {
  color: #000000;
}

#AjoutTexte input[type="text"],
#AjoutTexte textarea {
  background-color: rgba(255, 255, 255, 0.8);
  border: none;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  padding: 10px;
  margin-bottom: 10px;
  width: 100%;
  color: #000000;
}

#AjoutTexte input[type="submit"] {
  background-color: #c1272d;
  color: #ffffff;
  padding: 10px 20px;
  border-radius: 5px;
  border: none;
  cursor: pointer;
  font-size: 16px;
}

#AjoutTexte input[type="submit"]:hover {
  background-color: #a12026;
}

th {
  background-color: #c1272d;
  color: #ffffff;
  font-size: 12px;
  cursor: pointer;
  position: relative;
}

th::after {
  content: "";
  display: inline-block;
  width: 0;
  height: 0;
  border-style: solid;
  border-width: 5px;
  margin-left: 5px;
  vertical-align: middle;
  transition: all 0.3s;
}

th.asc::after {
  border-color: transparent transparent #ffffff;
  margin-left: 10px;
}

th.desc::after {
  border-color: #ffffff transparent transparent;
  margin-left: 10px;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

/* Styles for the table containers */
.table-container {
  max-height: 300px;
  overflow-y: auto;
}

table thead th {
  position: sticky;
  top: 0;
  z-index: 1;
}

#filesTable td:last-child {
    white-space: nowrap;
}

.delete-button {
  top: 50%; /* Ajuster la position verticale du bouton dans le conteneur */
  left: 50%; /* Ajuster la position horizontale du bouton dans le conteneur */
  transform: translate(-50%, -50%); /* Centrer le bouton dans son conteneur */
  z-index: 9999; /* Ajuster le z-index pour s'assurer que le bouton est au-dessus du contenu du tableau */
  background: none;
  border: none;
  padding: 75px;
  color: #c1272d;
  cursor: pointer;
  font-size: 16px;
  transition: background-color 0.3s, color 0.3s;
}

.delete-button i {
    margin-right: 5px; /* Ajouter un espacement entre l'icône et le texte */
}

.delete-button:hover {
    color: #ffffff;
    background-color: #c1272d;
}




/* Add the word-wrap property to table cells within the specific table */
#filesTable td {
  word-wrap: break-word;
  max-width: 200px;
}

  #filesTable td:nth-child(1),
  #filesTable td:nth-child(4) {
    max-width: 300px; /* You can adjust this value as needed */
}

</style>


<head>
  <meta charset="UTF-8">
  <title>Espace Administrateur</title>
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
$query = "SELECT * FROM user_data WHERE 1=1";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<div class=\"table-container\">";
    echo "<table id=\"infoTable\">";
    echo "<thead><tr><th data-column=\"1\" data-order=\"\">Date et heure</th><th data-column=\"2\" data-order=\"\">Texte</th><th data-column=\"3\" data-order=\"\">Utilisateur</th></tr></thead>";
    echo "<tbody>";

    while ($row = mysqli_fetch_assoc($result)) {
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
        $insertQuery = "INSERT INTO user_data (date_time, text_content, user_id, file_name) VALUES (?, ?, ?, '0')";
        $stmt = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($stmt, "ssi", $dateHeure, $texte, $_SESSION['utilisateur']);

        // Exécuter la requête d'insertion
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Les informations ont été insérées avec succès.');</script>";
            echo "<script>window.location.reload();</script>";
        } else {
            echo "Erreur lors de l'insertion des informations : " . mysqli_error($conn);
        }
    } else {
        echo "Veuillez remplir tous les champs du formulaire.";
    }
}

mysqli_close($conn);
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