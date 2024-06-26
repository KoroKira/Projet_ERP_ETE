<?php
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur'])) {
    header("Location: ../login.php");
    exit();
}

?>


<!DOCTYPE html>
<html>
    <style>
        html {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            background-image: url('../image/fondbleu.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            height: 100%;
            margin: 0;
            padding: 0;
            background-attachment: fixed; /* Fixe l'image de fond */
        }

        h1, h2 {
            color: #c1272d;
            font-size: 24px;
            text-align: center;
            text-shadow: 2px 2px 4px #ffffff;
            margin: 20px 0;
        }

        form {
            background-color: #ffffff;
            border-radius: 5px;
            margin: 20px auto;
            padding: 20px;
            max-width: 800px;
        }

        table {
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 5px auto;
            padding: 5px;
            width: 100%;
            table-layout: fixed;
            font-size: 10px; /* Set the table font size to 10px */
        }

        table th {
            background-color: #c1272d;
            color: #ffffff;
            font-size: 7px;
            font-weight: bold;
            padding: 8px 10px; /* Adjust the padding for the table header cells */
            text-align: left; /* Add text alignment for the table header cells */
            word-wrap: break-word;
        }

        table td {
            border-bottom: 1px solid #dddddd;
            padding: 10px;
            word-wrap: break-word;
            max-width: 150px;
            font-size: 10px; /* Set the table cell font size to 10px */
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
            font-size: 12px; /* Reduce the button font size to 12px */
            padding: 8px 16px; /* Adjust the button padding */
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
            font-size: 14px; /* Set the small text font size to 10px */
        }

        p.small-text a {
            color: green;
            text-align: center;
            text-decoration: underline;
            text-shadow: -2px -2px 4px white, 2px -2px 4px white, -2px 2px 4px white, 2px 2px 4px white;
        }

        /* Ajout de styles pour les cellules éditables */
        table td.editable {
            cursor: pointer;
        }

        /* Styles pour la fenêtre modale */
        .modal {
            display: none;
            position: fixed;
            z-index: 99999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #FDF4E9;
            margin: 15% auto;
            font-size: 25px;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            text-align: center;
            line-height: 1.5; /* Espacement entre les lignes pour une meilleure lisibilité */
            color: #333; /* Couleur du texte */
            font-family: Arial, sans-serif; /* Police de caractères */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2); /* Ajout d'une ombre pour une apparence plus visuelle */
            border-radius: 10px; /* Ajout des bords arrondis */
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            margin-top: -10px; /* Ajustement de la position du bouton de fermeture */
        }

        .close:hover,
        .close:focus {
            color: #333;
            text-decoration: none;
            cursor: pointer;
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


<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <meta charset="UTF-8">
    <title>Modifier les données</title>


    <div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <p>Afin de modifier les données, cliquez sur la case correspondante et modifiez l'information. Ensuite, une fois l'ensemble des modifications faites, cliquez sur le bouton de validation.</p>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById("myModal").style.display = "block";
    }

    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }

    // Appeler openModal() dès que la page se charge
    window.onload = openModal;
</script>

</head>
<body>
    <?php
			$dsn = "pgsql:host=localhost;dbname=bddcrmete;options='--client_encoding=UTF8'";
			$user = "postgres";
			$password = "root";

        try {
            $pdo = new PDO($dsn, $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if (isset($_POST['submit'])) {
                $id = $_POST['id'];
                $column = $_POST['column'];
                $value = $_POST['value'];

                $query = "UPDATE matable SET $column = :value WHERE id = :id";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':value', $value);
                $stmt->bindParam(':id', $id);
                $stmt->execute();

                echo "Données mises à jour avec succès!";
            } 

            $query = "SELECT * FROM matable";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <h1>BDD CRM ETE</h1>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Année</th>
                <th>Pays</th>
                <th>Statut</th>
                <th>Date du statut</th>
                <th>Numéro</th>
                <th>Client</th>
                <th>Contact</th>
                <th>Nom du projet</th>
                <th>Apporteur d'affaire</th>
                <th>Partenaire 1</th>
                <th>Partenaire 2</th>
                <th>Partenaire 3</th>
                <th>Partenaire 4</th>
                <th>Durée</th>
                <th>Montant HT</th>
                <th>Probabilité</th>
                <th>Date de commande</th>
                <th>CA potentiel</th>
                <th>Informations complémentaires</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $row) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="year"><?php echo $row['year']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="country"><?php echo $row['country']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="status"><?php echo $row['status']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="statusDate"><?php echo $row['statusDate']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="number"><?php echo $row['number']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="client"><?php echo $row['client']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="contact"><?php echo $row['contact']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="projectname"><?php echo $row['projectname']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="referrer"><?php echo $row['referrer']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="partner1"><?php echo $row['partner1']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="partner2"><?php echo $row['partner2']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="partner3"><?php echo $row['partner3']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="partner4"><?php echo $row['partner4']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="duration"><?php echo $row['duration']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="amount"><?php echo $row['amount']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="probability"><?php echo $row['probability']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="orderdate"><?php echo $row['orderdate']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="potentialrevenue"><?php echo $row['potentialrevenue']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="additionalinfo"><?php echo $row['additionalinfo']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>

    <button id="validateButton" onclick="validateModifications()">Valider les modifications</button>

    <script>
        // Ajoutez un gestionnaire d'événement pour les cellules éditables
        const editableCells = document.querySelectorAll('.editable');
        editableCells.forEach(cell => {
            cell.addEventListener('click', () => {
                const id = cell.getAttribute('data-id');
                const column = cell.getAttribute('data-column');
                const value = prompt('Modifier la valeur :', cell.textContent.trim());

                if (value !== null) {
                    const formData = new FormData();
                    formData.append('id', id);
                    formData.append('column', column);
                    formData.append('value', value);
                    formData.append('submit', 'true'); // Ajouter le flag de soumission

                    fetch('modif.php', {
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
        function validateModifications() {
            // Collect all the modified data from the table
            const modifiedData = [];
            editableCells.forEach(cell => {
                const id = cell.getAttribute('data-id');
                const column = cell.getAttribute('data-column');
                const value = cell.textContent.trim();

                modifiedData.push({ id, column, value });
            });

            // Send the modified data to the server
            fetch('fonctions.php/save_modifications.php', {
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


        function showModal(message) {
            const modal = document.getElementById("myModal");
            const modalContent = document.querySelector(".modal-content");
            const modalMessage = document.createElement("p");
            const closeBtn = document.createElement("span");

            modalMessage.textContent = message;
            closeBtn.innerHTML = "&times;";
            closeBtn.classList.add("close");
            closeBtn.onclick = closeModal;

            modalContent.innerHTML = "";
            modalContent.appendChild(closeBtn);
            modalContent.appendChild(modalMessage);
            modal.style.display = "block";
        }
    </script>

    <?php } catch (PDOException $e) {
        echo "Erreur de requête : " . $e->getMessage();
    } ?>


    <?php
    // TABLE 2 en dessous
    ?>


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

                $query = "UPDATE tatable SET $column = :value WHERE id = :id";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':value', $value);
                $stmt->bindParam(':id', $id);
                $stmt->execute();

                echo "Données mises à jour avec succès!";
            }
        }

        $query = "SELECT * FROM tatable";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <h1>Projet en Attente</h1>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Pays</th>
                <th>Client</th>
                <th>Libellé</th>
                <th>Détail</th>
                <th>Intermédiaire</th>
                <th>Date Offre</th>
                <th>Montant HT</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $row) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="pays"><?php echo $row['pays']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="client"><?php echo $row['client']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="label"><?php echo $row['label']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="detail"><?php echo $row['detail']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="intermediary"><?php echo $row['intermediary']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="dateoffre"><?php echo $row['dateoffre']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="montantht"><?php echo $row['montantht']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>

    <button id="BoutonValidation" onclick="ValidationModif()">Valider les modifications</button>

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

                    fetch('modif.php', {
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
            fetch('fonctions.php/save_modifications.php', {
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

    <?php

    // TABLE 3 EN DESSOUS

    ?>

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

                $query = "UPDATE satable SET $column = :value WHERE id = :id";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':value', $value);
                $stmt->bindParam(':id', $id);
                $stmt->execute();

                echo "Données mises à jour avec succès!";
            }
        }

        $query = "SELECT * FROM satable";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <h1>Liste Apporteur d'Affaire</h1>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom Prénom</th>
                <th>Société</th>
                <th>Pays</th>
                <th>Contrat</th>
                <th>Domaine d'activité</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $row) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="nomprenom"><?php echo $row['nomprenom']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="societe"><?php echo $row['societe']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="pays"><?php echo $row['pays']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="Concontrattrat"><?php echo $row['contrat']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="domaineactivite"><?php echo $row['domaineactivite']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

    <button id="BoutonValidation2" onclick="ValidationModif2()">Valider les modifications</button>

    <script>
        // Ajoutez un gestionnaire d'événement pour les cellules éditables
        const CelluleEditable2 = document.querySelectorAll('.editable');
        CelluleEditable2.forEach(cell => {
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

                    fetch('modif.php', {
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
        function ValidationModif2() {
            // Collect all the modified data from the table
            const modifiedData = [];
            CelluleEditable2.forEach(cell => {
                const id = cell.getAttribute('data-id');
                const column = cell.getAttribute('data-column');
                const value = cell.textContent.trim();

                modifiedData.push({ id, column, value });
            });

            // Send the modified data to the server
            fetch('fonctions.php/save_modifications.php', {
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


<p class="small-text">
    <a href="accueil.php">Retour à la page d'accueil</a>
</p>

</body>
</html>
