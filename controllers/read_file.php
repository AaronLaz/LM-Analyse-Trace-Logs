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
         // Une requete commence avec select ou delete, on remplace les delete d'abord pour faciliter le tri
         $filetext = str_replace("\nDELETE","\nSELECT",$filetext);
         $arr = explode("\nSELECT", $filetext);
                  array_shift($arr);
                  $result = array();
                  $keys = array("contenu","date", "utilisateur", "temps");
                  // Rajout début de la requête enlevé pendant explode()
                  for($i = 0; $i<count($arr); $i++){
                      $prefix ="";
                      if(explode(' ',trim($arr[$i]))[0]=="FROM"){
                        $prefix = "DELETE";
                      }
                      else{
                        $prefix = "SELECT";
                      }
                      array_push($result, $prefix.$arr[$i]);
                      $result[$i] = explode("#",$result[$i]);
                      // redefinition clés
                      for($l = 0; $l<4; $l++){
                      // format date
                         if($l==1){
                            $d = date_create(substr($result[$i][$l],7));
                            $result[$i][$keys[$l]] = date_format($d, 'Y-m-d H:i:s');
                         }
                         else{
                            $result[$i][$keys[$l]] = $result[$i][$l];
                         }
                         unset($result[$i][$l]);
                      }
                  }

          echo "NB REQUETES: ".count($result);
//           echo '<pre>'; print_r($result); echo '</pre>';
      ?>
      <table class="table">
        <thead>
          <tr>
            <th>N° Requête</th>
            <th>Contenu</th>
            <th>Date</th>
            <th>Utilisateur</th>
            <th>Temps</th>
          </tr>
        </thead>
        <tbody>
      <?php
      $i=1;
        foreach ($result as $requetes) {
            echo '<tr>';
            echo '<td>' . $i . '</td>';
            foreach ($requetes as $key1 => $value1) {
                echo '<td>' . $value1 . '</td>';
            }
            $i++;
            echo '</tr>';
        }
       ?>
      </tbody>
      </table>

   </body>
</html>