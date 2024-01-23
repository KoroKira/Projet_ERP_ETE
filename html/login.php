<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Connexion</title>
</head>
<body>
  <h1>Connexion</h1>
  <form id="Connexion">
    <label for="utilisateur">Utilisateur :</label>
    <input type="text" id="utilisateur" name="utilisateur" required>
    <br>
    <label for="motdepasse">Mot de passe :</label>
    <input type="password" id="motdepasse" name="motdepasse" required>
  </form>


  <button id="valider" style="display: block; margin: 0 auto;">Se connecter</button>

  <p class="small-text" style="text-align: center;">
    <a href="index.html">Retour à la page d'accueil</a>
  </p>


  <script>
    function Connexion() {
      const form = document.getElementById('Connexion');
      const formData = new FormData(form);

      fetch('verification.php', {
        method: 'POST',
        body: formData
      })
        .then(response => response.text())
        .then(result => {
          if (result === "Connexion Administrateur") {
            // alert('Connecté !');
            form.reset();
            window.location.href = 'php/espace-admin.php'; // Rediriger vers la page d'accueil de l'espace admin
          }

          if (result === "SuccessL") {
            // alert('Connecté !');
            form.reset();
            window.location.href = 'php/accueil.php'; // Rediriger vers la page d'accueil de l'espace Lambda

          } else {
            alert(result);
          }
        })
        .catch(error => {
          console.log(error);
          alert('Une erreur s\'est produite lors de la connexion.');
        });
    }

    document.getElementById('valider').addEventListener('click', function() {
      Connexion();
    });
  </script>
</body>
</html>
