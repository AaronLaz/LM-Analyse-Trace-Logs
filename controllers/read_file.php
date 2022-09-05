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

//          echo ( "Taille : $filesize bytes" );
//          echo ( "<pre>$filetext</pre>" );
         $arr = explode("\nSELECT", $filetext);
                  array_shift($arr);
                  $result = array();
                  $keys = array("contenu","date", "utilisateur", "temps");
                  for($i = 0; $i<count($arr); $i++){
                      array_push($result, "SELECT".$arr[$i]);
                      $result[$i] = explode("#",$result[$i]);
                      // redefinition clés
                      for($l = 0; $l<4; $l++){
                         $result[$i][$keys[$l]] = $result[$i][$l];
                         unset($result[$i][$l]);
                      }
                  }

          echo count($result);
          echo '<pre>'; print_r($result); echo '</pre>';
//             echo $result2[1][0];
      ?>

   </body>
</html>