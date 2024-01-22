<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Connexion</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-image: url('image/fondbleu.jpg');
      background-repeat: no-repeat;
      background-position: center center;
      background-size: cover;
      height: 100vh; /* Correction pour remplir entièrement la fenêtre */
    }

    h1 {
      color: #c1272d;
      font-size: 36px;
      text-align: center;
      text-shadow: 2px 2px 4px #ffffff;
      margin-top: 50px;
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
    input[type="number"],
    input[type="password"] {
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
  </style>
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
