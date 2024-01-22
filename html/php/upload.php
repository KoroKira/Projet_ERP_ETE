<?php
$dossier = 'upload/';
$fichier = basename($_FILES['avatar']['name']);
$taille_maxi = 100000000;
$tailleOctets = filesize($_FILES['avatar']['tmp_name']);
$extensions = array('.png', '.gif', '.jpg', '.jpeg', '.pdf', '.txt', '.doc', '.docx', '.odt', '.xls', '.xlsx', '.ods', '.ppt', '.pptx', '.odp', '.bmp', '.tiff', '.tif', '.mp3', '.mp4', '.avi', '.wav', '.ogg', '.flac', '.rar', '.mkv', '.zip', '.7z', '.csv', '.json');
$extension = strrchr($_FILES['avatar']['name'], '.'); 
//Début des vérifications de sécurité...
if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
{
     $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt, doc, docx, odt, xls, xlsx, ods, ppt, pptx, odp, bmp, tiff, tif, mp3, mp4, avi, wav, ogg, flac, mkv, zip, rar, mkv, 7z, csv ou json ...';
}
if($tailleOctets > $taille_maxi)
{
     $erreur = 'Le fichier est trop gros...';
}
if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
{
     //On formate le nom du fichier ici...
     $fichier = strtr($fichier, 
          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
     $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
     if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
          echo 'Upload effectué avec succès !';
          sleep(3); // Attendre 3 secondes avant la redirection
          header("Location: espace-lambda.php"); // Redirection vers la page "espace-lambda.php"
          exit();
     }
     else //Sinon (la fonction renvoie FALSE).
     {
          echo 'Echec de l\'upload !';
          sleep(3); // Attendre 3 secondes avant la redirection
          header("Location: espace-lambda.php"); // Redirection vers la page "espace-lambda.php"
          exit();
     }
}
else
{
     echo $erreur;
}

// Fonction de conversion de taille en octets vers Ko ou Mo
function convertirTaille($tailleEnOctets)
{
    $tailleEnKo = $tailleEnOctets / 1024; // Conversion en Ko
    if ($tailleEnKo < 1024) {
        return number_format($tailleEnKo, 2) . ' Ko'; // Affichage avec deux décimales
    } else {
        $tailleEnMo = $tailleEnKo / 1024; // Conversion en Mo
        return number_format($tailleEnMo, 2) . ' Mo'; // Affichage avec deux décimales
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Page d'upload</title>
    <!-- Mettre ici les balises <link> vers les feuilles de style CSS, les scripts JS, etc. -->
</head>
<body>
    <!-- Mettre ici le contenu HTML de la page -->

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <!-- Mettre ici les champs du formulaire d'upload -->
        <input type="file" name="avatar" />
        <input type="submit" value="Envoyer le fichier" />
    </form>

</body>
</html>
