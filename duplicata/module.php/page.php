<?php

// Nombre d'heures passées sur ce code (et ce projet): environ 200h juste sur la progra
// Nombre de lignes de code: trop
// Langages utilisés: HTML, CSS, PHP, SQL, JS
// Database: PostGreSQL
// Frameworks: Bootstrap
// Serveur: Apache (localhost)



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


// Tout le code au dessus doit et devra être conservé, il concerne la connexion à la base de données et la vérification de l'utilisateur, c'est de la sécurité
// Il est important de checker que dsn, user, et password soient bons, sinon ça ne marchera pas
// J'ai setup déjà tout ce qu'il faut, normalement il suffit juste de copier coller ce bout sans y toucher et ça marche
// Si un problème survient, il faut modifier "accréditation" dans PostGreSQL et adapter les valeurs de dsn, user, et password en conséquence


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

// Ce script PHP utilise PDO pour se connecter à une base de données, traiter un formulaire (s'il est soumis en méthode POST), 
// insérer des données dans une table "lesintermediaires", et récupérer les données existantes de cette table. 
// Les commentaires expliquent chaque étape du processus, y compris la configuration de la connexion à la base de données, 
// la gestion des erreurs, la récupération des données du formulaire, la préparation et l'exécution des requêtes SQL.

// Afin de réutiliser ce script, la seule chose à changer globalement c'est le nom de la table (attention, c'est case sensitive),
// Et les données (ici intermediary, text) ainsi que les values associées (:intermediary, :text)
// Faut en rajouter pour chaque nouvelle donnée qu'on veut mettre dans le sql, honnêtement c'est pas bien dur c'est le même pattern systématiquement


// ADENDA:
// Pour avoir la table et tout, faut en créer une nouvelle. Mais comment on créé une table ?
// Sur le gestionnaire webmin, il faut qu'on aille dans "PostGreSQL" (onglet "Serveur")
// Une fois dans cet onglet, il faut aller dans la BDD "bddcrmete" (elle est déjà créée c'est nickel on gagne du temps)
// Une fois dans la BDD, on peut créer une nouvelle table mais attention ! Lorsque l'on créé une table, il faut SYSTEMATIQUEMENT
// Une colonne "en plus", qui sera la PRIMARY KEY (ID) de la table. C'est un identifiant unique pour chaque ligne de la table
// Sans ça, la table marchera pas, on pourra ni entrer des données, ni en supprimer ou en modifier
// Le mieux à faire ensuite est de créer tous les autres champs de la table comme des VarChar(255) (c'est le type de données, il offre le plus de flexibilité)
// Petit conseil: tout en minuscule pour les noms de champs dans la table (et pour les noms de table). Ca évite les emmerdes
// Penser à mettre les perms dans la nouvelle table d'ailleurs !! faut que l'utilisateur puisse éditer, supprimer, etc donc faut donner les perms à postgres


?>





<!DOCTYPE html>
<html lang="fr">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <meta charset="UTF-8">
    <title>Intermédiaires</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">


<!-- 

Ici j'ai utilisé le framework BOOTSTRAP pour faire du beau CSS sans avoir 500 milles lignes. Pour s'en servir, faut regarder la docu
La documentation est très bien faite, alors autant en profiter. C'est un framework CSS, donc ça s'utilise comme du CSS
Il n'y a aucune difficulté à se servir de ce framework, c'est limite du plug and play

-->    
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
<!-- 

C'est un form basique, que dire de plus ? Il faut penser à mettre la méthode POST, et à mettre les names des inputs et tout
Attention aux accents, caractères spéciaux et majuscules, c'est là qu'on a tendance à se tromper ensuite dans la DB et que c'est la galère
Faut aussi penser au nom/id des inputs, c'est important pour le JS et la transmission des données à notre DB

-->
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

<!-- 

Ici on a une simple requête SQL qui va poster nos données dans la DB
Elle permet aussi de mettre à jour du coup les données si on en a besoin
C'est un peu plus compliqué, mais c'est pas bien dur non plus, vraiment, c'est du full copié collé et il faut juste changer les noms de champs et les values, et le nom des tables

-->
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

<!-- 

Ici on utilise des cases "éditables" pour faciliter le travail de changement des données, et on valide avec le bouton en dessous en full JS

-->

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

<!-- 

Vraiment tout le code est à copier coller, et ensuite on adapte les intitulés çà et là
Faut penser à faire attention aux chemin des données pour pas que ça soit cassé, mais sinon c'est du full copié collé

-->
</html>
