<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Page de ticket</title>
    <link rel="stylesheet" type="text/css" href="../css/full.css">

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
