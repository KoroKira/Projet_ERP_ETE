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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <meta charset="UTF-8">
  <title>Administration</title>
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
  <label for="statusdate">Date du statut :</label>
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
  <label for="projectname">Nom du projet :</label>
  <input type="text" id="projectname" name="projectname" required>
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
  <label for="orderdate">Date de commande :</label>
  <input type="text" id="orderdate" name="orderdate" required>
  <br>
  <label for="potentialrevenue">CA potentiel :</label>
  <input type="text" id="potentialrevenue" name="potentialrevenue" required>
  <br>
  <label for="additionalinfo">Informations complémentaires :</label>
  <input type="text" id="additionalinfo" name="additionalinfo" required>
  <br>
</form>

<button id="transferButton" style="display: block; margin: 0 auto;">Transférer vers la base de données "BDD CRM ETE"</button>


<form id="AjoutForm">
  <label for="pays">Pays :</label>
  <input type="text" id="pays" name="pays" required>
  <br>
  <label for="client">Client :</label>
  <input type="text" id="client" name="client" required>
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
  <label for="dateoffre">Date Offre :</label>
  <input type="text" id="dateoffre" name="dateoffre" required>
  <br>
  <label for="montantht">Montant HT :</label>
  <input type="text" id="montantht" name="montantht" required>
  <br>
</form>

<button id="boutontransfert" style="display: block; margin: 0 auto;">Transférer vers la base de données "Projet en Attente Département Eau"</button>


<form id="Ajout_Datas">
  <label for="nomprenom">Nom Prénom :</label>
  <input type="text" id="nomprenom" name="nomprenom" required>
  <br>
  <label for="societe">Société :</label>
  <input type="text" id="societe" name="societe" required>
  <br>
  <label for="pays">Pays (si plusieurs, séparer par une virgule) :</label>
  <input type="text" id="pays" name="pays" required>
  <br>
  <label for="contrat">Contrat :</label>
  <input type="text" id="contrat" name="contrat" required>
  <br>
  <label for="domaineactivite">Domaine d'activité :</label>
  <input type="text" id="domaineactivite" name="domaineactivite" required>
</form>

<button id="transferationbouton" style="display: block; margin: 0 auto;">Transférer vers la base de données "Stratégie d'export Afrique ETE département Eau" - Apporteur d'affaire</button>



<form id="Ajouter_Des_Datas">
  <label for="societe">Société :</label>
  <input type="text" id="societe" name="societe" required>
  <br>
  <label for="pays">Pays :</label>
  <input type="text" id="pays" name="pays" required>
  <br>
  <label for="contrat">Contrat :</label>
  <input type="text" id="contrat" name="contrat" required>
  <br>
  <label for="domaineactivite">Domaine d'activité :</label>
  <input type="text" id="domaineactivite" name="domaineactivite" required>
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