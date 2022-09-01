<?php

function function_alert($msg) {
	echo "<script type='text/javascript'>alert('$msg');window.location.href='../templates/uploads_list.php';</script>";
}

// Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
if (isset($_FILES['tracelog']) && $_FILES['tracelog']['error'] == 0)
{
        // Testons si le fichier n'est pas trop gros
        if ($_FILES['tracelog']['size'] <= 50000000) // 50 Mo
        {
                // Testons si l'extension est autorisée
                $fileInfo = pathinfo($_FILES['tracelog']['name']);
                $extension = $fileInfo['extension'];
                $allowedExtensions = ['trc']; // types fichier autorisés
                if (in_array($extension, $allowedExtensions))
                {
                        // On peut valider le fichier et le stocker définitivement
                        move_uploaded_file($_FILES['tracelog']['tmp_name'], '../uploads/' . basename($_FILES['tracelog']['name']));
                        function_alert("L\'envoi a bien été effectué !");				
				}
				else function_alert("Extension non supporté !");
        }
		else function_alert("Fichier trop volumineux !");
}
else function_alert("Pas de fichier sélectionné!");
?>