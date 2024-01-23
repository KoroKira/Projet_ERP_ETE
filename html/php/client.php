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
    <title>Tableaux CRM</title>
    <link rel="stylesheet" type="text/css" href="../css/full.css">
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

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const headers = document.querySelectorAll("#tableaubis th");

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
      const table = document.getElementById("tableaubis");
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

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const headers = document.querySelectorAll("#tableaubisbis th");

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
      const table = document.getElementById("tableaubisbis");
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


<script>
  document.addEventListener("DOMContentLoaded", function() {
    const headers = document.querySelectorAll("#tableaubisbisbis th");

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
      const table = document.getElementById("tableaubisbisbis");
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



</head>
<body>
    <h1>Tableaux CRM</h1>

    <!-- Formulaire de déconnexion -->
    <form id="logoutForm" action="logout.php" method="post" style="text-align: center; margin-top: 20px;">
      <button type="submit" style="background-color: #c1272d; border: none; border-radius: 5px; color: #ffffff; cursor: pointer; font-size: 16px; padding: 10px 20px;">Se déconnecter</button>
    </form>

    <h2>Tableau 1</h2>
  <div class="table-container">

    <table id="infoTable">
      <thead>
        <tr>
          <th data-column="1">Année</th>
          <th data-column="2">Pays</th>
          <th data-column="3">Statut</th>
          <th data-column="4">Date du statut</th>
          <th data-column="5">Numéro</th>
          <th data-column="6">Client</th>
          <th data-column="7">Contact</th>
          <th data-column="8">Nom du projet</th>
          <th data-column="9">Apporteur d'affaire</th>
          <th data-column="10">Partenaire 1</th>
          <th data-column="11">Partenaire 2</th>
          <th data-column="12">Partenaire 3</th>
          <th data-column="13">Partenaire 4</th>
          <th data-column="14">Durée</th>
          <th data-column="15">Montant HT</th>
          <th data-column="16">Probabilité</th>
          <th data-column="17">Date de commande</th>
          <th data-column="18">CA potentiel</th>
          <th data-column="19">Informations complémentaires</th>
        </tr>
      </thead>
      <tbody>
        <?php
  			$dsn = "pgsql:host=localhost;dbname=bddcrmete;options='--client_encoding=UTF8'";
			$user = "postgres";
			$password = "root";
          try {
            $pdo = new PDO($dsn, $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT * FROM matable";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
              echo "<tr>";
              echo "<td>" . $row['year'] . "</td>";
              echo "<td>" . $row['country'] . "</td>";
              echo "<td>" . $row['status'] . "</td>";
              echo "<td>" . $row['statusDate'] . "</td>";
              echo "<td>" . $row['number'] . "</td>";
              echo "<td>" . $row['client'] . "</td>";
              echo "<td>" . $row['contact'] . "</td>";
              echo "<td>" . $row['projectName'] . "</td>";
              echo "<td>" . $row['referrer'] . "</td>";
              echo "<td>" . $row['partner1'] . "</td>";
              echo "<td>" . $row['partner2'] . "</td>";
              echo "<td>" . $row['partner3'] . "</td>";
              echo "<td>" . $row['partner4'] . "</td>";
              echo "<td>" . $row['duration'] . "</td>";
              echo "<td>" . $row['amount'] . "</td>";
              echo "<td>" . $row['probability'] . "</td>";
              echo "<td>" . $row['orderDate'] . "</td>";
              echo "<td>" . $row['potentialRevenue'] . "</td>";
              echo "<td>" . $row['additionalInfo'] . "</td>";
              echo "</tr>";
            }
          } catch (PDOException $e) {
            echo "Erreur de requête : " . $e->getMessage();
          }
        ?>
      </tbody>
    </table>
    </div>

    <h2>Tableau 2</h2>
    <div class="table-container">

    <table id="tableaubis">
      <thead>
        <tr>
          <th data-column="1">Pays</th>
          <th data-column="2">Client</th>
          <th data-column="3">Ville</th>
          <th data-column="4">Détail</th>
          <th data-column="5">Intermédiaire</th>
          <th data-column="6">Date Offre</th>
          <th data-column="7">Montant HT</th>
        </tr>
      </thead>
      <tbody>
        <?php
			$dsn = "pgsql:host=localhost;dbname=bddcrmete;options='--client_encoding=UTF8'";
			$user = "postgres";
			$password = "root";
          try {
            $pdo = new PDO($dsn, $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT * FROM tatable";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
              echo "<tr>";
              echo "<td>" . $row['pays'] . "</td>";
              echo "<td>" . $row['CLIENT'] . "</td>";
              echo "<td>" . $row['label'] . "</td>";
              echo "<td>" . $row['detail'] . "</td>";
              echo "<td>" . $row['intermediary'] . "</td>";
              echo "<td>" . $row['DateOffre'] . "</td>";
              echo "<td>" . $row['montantHT'] . "</td>";
              echo "</tr>";
            }
          } catch (PDOException $e) {
            echo "Erreur de requête : " . $e->getMessage();
          }
        ?>
      </tbody>
    </table>
    </div>

    <h2>Tableau 3</h2>
    <div class="table-container">

    <table id="tableaubisbis">
      <thead>
        <tr>
          <th data-column="1">Nom Prénom</th>
          <th data-column="2">Société</th>
          <th data-column="3">Pays</th>
          <th data-column="4">Contrat</th>
          <th data-column="5">Domaine d'activité</th>
        </tr>
      </thead>
      <tbody>
        <?php
			$dsn = "pgsql:host=localhost;dbname=bddcrmete;options='--client_encoding=UTF8'";
			$user = "postgres";
			$password = "root";

          try {
            $pdo = new PDO($dsn, $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT * FROM satable";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
              echo "<tr>";
              echo "<td>" . $row['NomPrenom'] . "</td>";
              echo "<td>" . $row['Societe'] . "</td>";
              echo "<td>" . $row['Pays'] . "</td>";
              echo "<td>" . $row['Contrat'] . "</td>";
              echo "<td>" . $row['DomaineActivite'] . "</td>";
              echo "</tr>";
            }
          } catch (PDOException $e) {
            echo "Erreur de requête : " . $e->getMessage();
          }
        ?>
      </tbody>
    </table>
    </div>

    <h2>Tableau 4</h2>
    <div class="table-container">


    <table id="tableaubisbisbis">
      <thead>
        <tr>
          <th data-column="1">Société</th>
          <th data-column="2">Pays</th>
          <th data-column="3">Contrat</th>
          <th data-column="4">Domaine d'activité</th>
        </tr>
      </thead>
      <tbody>
        <?php
			$dsn = "pgsql:host=localhost;dbname=bddcrmete;options='--client_encoding=UTF8'";
			$user = "postgres";
			$password = "root";

          try {
            $pdo = new PDO($dsn, $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT * FROM notretablee";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
              echo "<tr>";
              echo "<td>" . $row['SOCIETE'] . "</td>";
              echo "<td>" . $row['PAYS'] . "</td>";
              echo "<td>" . $row['CONTRAT'] . "</td>";
              echo "<td>" . $row['DOMAINEACTIVITE'] . "</td>";
              echo "</tr>";
            }
          } catch (PDOException $e) {
            echo "Erreur de requête : " . $e->getMessage();
          }
        ?>
      </tbody>
    </table>
    </div>
    
    <p class="small-text">
      <a href="accueil.php">Retour à la page d'accueil</a>
    </p>

</body>
</html>
