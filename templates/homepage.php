<?php $title = "Analyse Trace Logs"; ?>

<?php ob_start(); ?>
<html>
    <head>
    </head>
    <body>
	<form action="./controllers/submit_tracelog.php" method="POST" enctype="multipart/form-data">
    <!-- Ajout champ d'upload ! -->
    <div class="mb-3">
        <label for="tracelog" class="form-label">Votre trace log</label>
        <input type="file" class="form-control" id="tracelog" name="tracelog" />
    </div>
    <!-- Fin ajout du champ -->
    <button type="submit" class="btn btn-primary">Envoyer</button>
	</form>
    </body>
</html>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>