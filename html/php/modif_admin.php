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
<link rel="stylesheet" type="text/css" href="../css/full.css">
<head>
    <meta charset="UTF-8">
    <title>Modifier les données</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Add Font Awesome CSS -->



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
            } elseif (isset($_POST['delete'])) {
                $id = $_POST['id'];
                $accesRequis = $_POST['acces']; // Récupérer l'accréditation requise depuis la requête

                // Effectuer la vérification de l'accréditation
                if ($_SESSION['Acces'] !== $accesRequis) {
                    echo "Erreur : Vous n'avez pas les autorisations requises pour supprimer les données.";
                    exit();
                }

                $query = "DELETE FROM matable WHERE id = :id";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':id', $id);
                $stmt->execute();

                echo "Données supprimées avec succès!";
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
                <th>Actions</th>
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
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="projectName"><?php echo $row['projectName']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="referrer"><?php echo $row['referrer']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="partner1"><?php echo $row['partner1']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="partner2"><?php echo $row['partner2']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="partner3"><?php echo $row['partner3']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="partner4"><?php echo $row['partner4']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="duration"><?php echo $row['duration']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="amount"><?php echo $row['amount']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="probability"><?php echo $row['probability']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="orderDate"><?php echo $row['orderDate']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="potentialRevenue"><?php echo $row['potentialRevenue']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="additionalInfo"><?php echo $row['additionalInfo']; ?></td>
                    <td>
                        <?php if ($_SESSION['Acces'] !== "Lambda") { ?>
                            <button class="delete-button" onclick="deleteRow('<?php echo $row['id']; ?>', '<?php echo $row['accreditation']; ?>')">
                                <i class="fas fa-trash-alt"></i> <!-- Add trash bin icon -->
                            </button>
                        <?php } ?>
                    </td>
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

                    fetch('modif_admin.php', {
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

        function deleteRow(id, accreditation) {
            const Acces = "<?php echo $_SESSION['Acces']; ?>";

            if (Acces === "Lambda") {
                showModal("Vous n'avez pas les droits suffisants pour supprimer une ligne. Veuillez contacter un administrateur.");
            } else if (Acces === accreditation) { // Vérifier si l'accréditation de l'utilisateur correspond
                const confirmation = confirm("Êtes-vous sûr de supprimer cette ligne ? Toute donnée supprimée est définitivement perdue.");

                if (confirmation) {
                    const formData = new FormData();
                    formData.append('id', id);
                    formData.append('delete', 'true'); // Add the delete flag

                    fetch('fonctions.php/save_modifications.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify([{ id, column: '', value: '' }]) // Use an empty value for the column to indicate deletion
                    })
                        .then(response => response.text())
                        .then(result => {
                            console.log(result);
                            alert('Ligne retirée avec succès !');
                            location.reload(); // Refresh the page to reflect the changes
                        })
                        .catch(error => console.log(error));
                }
            } else {
                showModal("Vous n'avez pas les autorisations requises pour supprimer cette ligne.");
            }
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
            } elseif (isset($_POST['delete'])) {
                $id = $_POST['id'];

                $query = "DELETE FROM tatable WHERE id = :id";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':id', $id);
                $stmt->execute();

                echo "Données supprimées avec succès!";
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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $row) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="pays"><?php echo $row['pays']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="CLIENT"><?php echo $row['CLIENT']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="label"><?php echo $row['label']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="detail"><?php echo $row['detail']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="intermediary"><?php echo $row['intermediary']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="DateOffre"><?php echo $row['DateOffre']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="montantHT"><?php echo $row['montantHT']; ?></td>
                    <td>
                        <?php if ($_SESSION['Acces'] !== "Lambda") { ?>
                            <button class="delete-button" onclick="deleteRow('<?php echo $row['id']; ?>')">
                                <i class="fas fa-trash-alt"></i> <!-- Add trash bin icon -->
                            </button>
                        <?php } ?>
                    </td>
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

                    fetch('modif_admin.php', {
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

        function deleteRow(id) {
            const confirmation = confirm("Êtes-vous sûr de supprimer cette ligne ? Toute donnée supprimée est définitivement perdue.");

            if (confirmation) {
                const formData = new FormData();
                formData.append('id', id);
                formData.append('delete', 'true'); // Add the delete flag

                fetch('fonctions.php/save_modifications.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify([{ id, column: '', value: '' }]) // Use an empty value for the column to indicate deletion
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
            } elseif (isset($_POST['delete'])) {
                $id = $_POST['id'];

                $query = "DELETE FROM satable WHERE id = :id";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':id', $id);
                $stmt->execute();

                echo "Données supprimées avec succès!";
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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $row) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="NomPrenom"><?php echo $row['NomPrenom']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="Societe"><?php echo $row['Societe']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="Pays"><?php echo $row['Pays']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="Contrat"><?php echo $row['Contrat']; ?></td>
                    <td class="editable" data-id="<?php echo $row['id']; ?>" data-column="DomaineActivite"><?php echo $row['DomaineActivite']; ?></td>
                    <td>
                        <?php if ($_SESSION['Acces'] !== "Lambda") { ?>
                            <button class="delete-button" onclick="deleteRow('<?php echo $row['id']; ?>')">
                                <i class="fas fa-trash-alt"></i> <!-- Add trash bin icon -->
                            </button>
                        <?php } ?>
                    </td>
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

                    fetch('modif_admin.php', {
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

        function deleteRow(id) {
            const confirmation = confirm("Êtes-vous sûr de supprimer cette ligne ? Toute donnée supprimée est définitivement perdue.");

            if (confirmation) {
                const formData = new FormData();
                formData.append('id', id);
                formData.append('delete', 'true'); // Add the delete flag

                fetch('fonctions.php/save_modifications.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify([{ id, column: '', value: '' }]) // Use an empty value for the column to indicate deletion
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
