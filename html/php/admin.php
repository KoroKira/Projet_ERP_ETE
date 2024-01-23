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
<head>
  <meta charset="UTF-8">
  <title>Administration</title>
  <link rel="stylesheet" type="text/css" href="../css/full.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

<h1>Administration</h1>

<h2>Ajouter des informations</h2>

<form id="addInfoForm">
  <label for="year">Année :</label>
  <input type="text" id="year" name="year" inputmode="numeric" pattern="[0-9]{4}" maxlength="4" oninput="this.value=this.value.replace(/[^0-9]/g,'');" required>
  <br>
  <label for="country">Pays :</label>
  <input type="text" id="country" name="country" required>
  <br>
  <label for="status">Statut :</label>
  <select id="status" name="status" required>
    <option value="prospect">Prospect</option>
    <option value="en cours">En cours</option>
    <option value="facturé">Facturé</option>
    <option value="commande">Commande</option>
    <option value="devis">Devis</option>
  </select>
  <br>
  <label for="statusDate">Date du statut :</label>
  <input type="text" id="statusDate" name="statusDate" required>
  <br>
  <label for="number">Numéro :</label>
  <input type="text" id="number" name="number" required>
  <br>
  <label for="client">Client :</label>
  <input type="text" id="client" name="client" required>
  <br>
  <label for="contact">Contact :</label>
  <input type="text" id="contact" name="contact" required>
  <br>
  <label for="projectName">Nom du projet :</label>
  <input type="text" id="projectName" name="projectName" required>
  <br>
  <label for="referrer">Apporteur d'affaire :</label>
  <input type="text" id="referrer" name="referrer" required>
  <br>
  <label for="partner1">Partenaire 1 :</label>
  <input type="text" id="partner1" name="partner1">
  <br>
  <label for="partner2">Partenaire 2 :</label>
  <input type="text" id="partner2" name="partner2">
  <br>
  <label for="partner3">Partenaire 3 :</label>
  <input type="text" id="partner3" name="partner3">
  <br>
  <label for="partner4">Partenaire 4 :</label>
  <input type="text" id="partner4" name="partner4">
  <br>
  <label for="duration">Durée :</label>
  <input type="text" id="duration" name="duration" required>
  <br>
  <label for="amount">Montant HT :</label>
  <input type="text" id="amount" name="amount" required>
  <br>
  <label for="probability">Probabilité :</label>
  <input type="text" id="probability" name="probability" required>
  <br>
  <label for="orderDate">Date de commande :</label>
  <input type="text" id="orderDate" name="orderDate" required>
  <br>
  <label for="potentialRevenue">CA potentiel :</label>
  <input type="text" id="potentialRevenue" name="potentialRevenue" required>
  <br>
  <label for="additionalInfo">Informations complémentaires :</label>
  <input type="text" id="additionalInfo" name="additionalInfo" required>
  <br>
</form>

<button id="transferButton" style="display: block; margin: 0 auto;">Transférer vers la base de données "BDD CRM ETE"</button>


<form id="AjoutForm">
  <label for="pays">Pays :</label>
  <input type="text" id="pays" name="pays" required>
  <br>
  <label for="CLIENT">Client :</label>
  <input type="text" id="CLIENT" name="CLIENT" required>
  <br>
  <label for="label">Libellé :</label>
  <input type="text" id="label" name="label" required>
  <br>
  <label for="detail">Détail :</label>
  <input type="text" id="detail" name="detail" required>
  <br>
  <label for="intermediary">Intermédiaire :</label>
  <input type="text" id="intermediary" name="intermediary" required>
  <br>
  <label for="DateOffre">Date Offre :</label>
  <input type="text" id="DateOffre" name="DateOffre" required>
  <br>
  <label for="montantHT">Montant HT :</label>
  <input type="text" id="montantHT" name="montantHT" required>
  <br>
</form>

<button id="boutontransfert" style="display: block; margin: 0 auto;">Transférer vers la base de données "Projet en Attente Département Eau"</button>


<form id="Ajout_Datas">
  <label for="NomPrenom">Nom Prénom :</label>
  <input type="text" id="NomPrenom" name="NomPrenom" required>
  <br>
  <label for="Societe">Société :</label>
  <input type="text" id="Societe" name="Societe" required>
  <br>
  <label for="Pays">Pays (si plusieurs, séparer par une virgule) :</label>
  <input type="text" id="Pays" name="Pays" required>
  <br>
  <label for="Contrat">Contrat :</label>
  <input type="text" id="Contrat" name="Contrat" required>
  <br>
  <label for="DomaineActivite">Domaine d'activité :</label>
  <input type="text" id="DomaineActivite" name="DomaineActivite" required>
</form>

<button id="transferationbouton" style="display: block; margin: 0 auto;">Transférer vers la base de données "Stratégie d'export Afrique ETE département Eau" - Apporteur d'affaire</button>



<form id="Ajouter_Des_Datas">
  <label for="SOCIETE">Société :</label>
  <input type="text" id="SOCIETE" name="SOCIETE" required>
  <br>
  <label for="PAYS">Pays :</label>
  <input type="text" id="PAYS" name="PAYS" required>
  <br>
  <label for="CONTRAT">Contrat :</label>
  <input type="text" id="CONTRAT" name="CONTRAT" required>
  <br>
  <label for="DOMAINEACTIVITE">Domaine d'activité :</label>
  <input type="text" id="DOMAINEACTIVITE" name="DOMAINEACTIVITE" required>
</form>

<button id="transferationboutonINTEGRATEUR" style="display: block; margin: 0 auto;">Transférer vers la base de données "Stratégie d'export Afrique ETE département Eau" - Intégrateur</button>


<?php

// SCRIPT 1

?>


<script>
// Function to insert data into the database
function insertData() {
  // Retrieve the form data
  const form = document.getElementById('addInfoForm');
  const formData = new FormData(form);

  // Send an AJAX request to the PHP script
  fetch('fonctions.php/insert_data_crm.php', {
    method: 'POST',
    body: formData
  })
    .then(response => response.text())
    .then(result => {
      console.log(result);
      alert('Données insérées avec succès!');
      form.reset(); // Reset the form after successful insertion
    })
    .catch(error => {
      console.log(error);
      alert('Erreurs durant le transfert, contactez votre administrateur/technicien/informaticien');
    });
}

// Add an event listener to the transfer button
document.getElementById('transferButton').addEventListener('click', function() {
  insertData();
});

</script>

<?php

// SCRIPT 2

?>

<script>
// Function to insert data into the database
function InsertionData() {
  // Retrieve the form data
  const form = document.getElementById('AjoutForm');
  const formData = new FormData(form);

  // Send an AJAX request to the PHP script
  fetch('fonctions.php/insertion_proj_attente.php', {
    method: 'POST',
    body: formData
  })
    .then(response => response.text())
    .then(result => {
      console.log(result);
      alert('Données insérées avec succès!');
      form.reset(); // Reset the form after successful insertion
    })
    .catch(error => {
      console.log(error);
      alert('Erreurs durant le transfert, contactez votre administrateur/technicien/informaticien');
    });
}

// Add an event listener to the transfer button
document.getElementById('boutontransfert').addEventListener('click', function() {
  InsertionData();
});

</script>

<?php

// SCRIPT 3

?>

<script>
// Function to insert data into the database
function inserationData() {
  // Retrieve the form data
  const form = document.getElementById('Ajout_Datas');
  const formData = new FormData(form);

  // Send an AJAX request to the PHP script
  fetch('fonctions.php/insert_data_apporteur_affaire.php', {
    method: 'POST',
    body: formData
  })
    .then(response => response.text())
    .then(result => {
      console.log(result);
      alert('Données insérées avec succès!');
      form.reset(); // Reset the form after successful insertion
    })
    .catch(error => {
      console.log(error);
      alert('Erreurs durant le transfert, contactez votre administrateur/technicien/informaticien');
    });
}

// Add an event listener to the transfer button
document.getElementById('transferationbouton').addEventListener('click', function() {
  inserationData();
});

</script>

<?php

// SCRIPT 4

?>

<script>
// Function to insert data into the database
function Datainserer() {
  // Retrieve the form data
  const form = document.getElementById('Ajouter_Des_Datas');
  const formData = new FormData(form);

  // Send an AJAX request to the PHP script
  fetch('fonctions.php/insert_data_integrateur.php', {
    method: 'POST',
    body: formData
  })
    .then(response => response.text())
    .then(result => {
      console.log(result);
      alert('Données insérées avec succès!');
      form.reset(); // Reset the form after successful insertion
    })
    .catch(error => {
      console.log(error);
      alert('Erreurs durant le transfert, contactez votre administrateur/technicien/informaticien');
    });
}

// Add an event listener to the transfer button
document.getElementById('transferationboutonINTEGRATEUR').addEventListener('click', function() {
  Datainserer();
});

</script>


<p class="small-text">
  <a href="accueil.php">Retour à la page d'accueil</a>
</p>

</body>
</html>