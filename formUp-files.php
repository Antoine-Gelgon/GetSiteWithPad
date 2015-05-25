
<?php

$projet = $_GET['title'];

//Partie enregister les fichiers.
//créer le dossier si il n'existe pas.
 $fileDir = 'files/'.$projet;

if(file_exists($fileDir)){
  echo '<h4>'.$fileDir.'</h4>';
}
else{
  mkdir($fileDir);
}

if (isset($_FILES['upFiles']) AND $_FILES['upFiles']['error'] == 0)
{
        // Testons si le fichier n'est pas trop gros
        if ($_FILES['upFiles']['size'] <= 100000000000)
        {

                // Testons si l'extension est autorisée
                $infosfichier = pathinfo($_FILES['upFiles']['name']);
                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = array('txt', 'ttf', 'otf', 'zip', 'rar', 'js', 'pdf');
                if (in_array($extension_upload, $extensions_autorisees))
                {
                        // On peut valider le fichier et le stocker définitivement
                        move_uploaded_file($_FILES['upFiles']['tmp_name'],  $fileDir.'/'. basename($_FILES['upFiles']['name']));
                        echo "Les fichiers ont bien été envoyé!";
                }
        }
}

?>

<form class="form-files" action="#" method="post"  enctype="multipart/form-data" >
	<div>upload:(txt|ttf|otf|zip|rar|js|pdf)<input type="file" name="upFiles" /></div>
	<div style="display:none"><input type="text" name="motdepass" value="<?php echo $motdepass; ?>" /></div>
	<input type="submit" value="enregistrer"/>
</form>
<?php
$dir = $fileDir;

// Ouvre un dossier connu, et liste tous les fichiers
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {

        while (($file = readdir($dh)) !== false) {

          if( $file != '.' && $file != '..' && preg_match('#\.(txt|ttf|otf|zip|rar|js|pdf)$#i', $file)) {

            ?>
            <div class="list">
               <a target="_blank" href="<?php echo $dir.'/'.$file; ?>" ><?php echo $file; ?></a>
             </div>

        <?php
      }

        }
        closedir($dh);
    }
}

?>
