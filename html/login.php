<!DOCTYPE html>
<html lang="fr">
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <meta charset="UTF-8">
  <title>Connexion</title>
</head>
<body>
  <h1 class="text-center mt-5">Connexion</h1>
  <form id="Connexion" class="container mt-4">
    <label for="utilisateur" class="form-label">Utilisateur :</label>
    <input type="text" id="utilisateur" name="utilisateur" class="form-control" required>
    <br>
    <label for="motdepasse" class="form-label">Mot de passe :</label>
    <input type="password" id="motdepasse" name="motdepasse" class="form-control" required>
  </form>

  <button id="valider" class="btn btn-primary d-block mx-auto">Se connecter</button>

  <p class="text-center mt-3">
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
            form.reset();
            window.location.href = 'php/espace-admin.php';
          }

          if (result === "SuccessL") {
            form.reset();
            window.location.href = 'php/accueil.php';
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-eaU7l2zErsg8J0NQgtz1jd/mF7R8SScfOFojBq9UBPimCIa53b8IlU2xsH6bkeXB" crossorigin="anonymous"></script>
</body>
</html>
