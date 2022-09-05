<html>

   <head>
      <title>Afficher</title>
   </head>

   <body>

      <?php
         $name = $_GET['read'];

         $filename = "../uploads/" . $name;
         $file = fopen( $filename, "r" );

         if( $file == false ) {
            echo ( "Error ouverture fichier" );
            exit();
         }

         $filesize = filesize( $filename );
         $filetext = fread( $file, $filesize );
         fclose( $file );

         echo ( "Taille : $filesize bytes" );
         echo ( "<pre>$filetext</pre>" );
      ?>

   </body>
</html>