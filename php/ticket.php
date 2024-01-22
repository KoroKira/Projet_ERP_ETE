<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Page de ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #c1272d;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        input[type="submit"] {
            background-color: #c1272d;
            border: none;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .success {
            color: green;
            font-weight: bold;
        }

        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Formulaire de ticket</h1>
    <h2>Envoyez moi les requetes par mail, le systeme de ticket n'est pas fini. Mail: guilhem.desarcy-lemiere@2027.icam.fr</h2>
        <?php
        if (isset($_GET['status'])) {
            if ($_GET['status'] === 'success') {
                echo '<p class="success">Le ticket a été soumis avec succès !</p>';
            } elseif ($_GET['status'] === 'error') {
                echo '<p class="error">Une erreur s\'est produite. Veuillez réessayer.</p>';
            }
        }
        ?>
        <form action="traitement_ticket.php" method="post">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>
            
            <label for="email">Email :</label>
            <input type="text" id="email" name="email" required>
            
            <label for="sujet">Sujet :</label>
            <input type="text" id="sujet" name="sujet" required>
            
            <label for="message">Message :</label>
            <textarea id="message" name="message" required></textarea>
            
            <input type="submit" value="Soumettre le ticket">
        </form>
    </div>
</body>
</html>
