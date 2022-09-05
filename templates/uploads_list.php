<?php
if(array_key_exists('delete_all', $_POST)) { 
        delete_all(); 
    } 
	
function delete_all() {
$files = glob('../uploads/*');
foreach($files as $file){ 
  if(is_file($file)) {
    unlink($file);
  }
}
}
$contents = scandir("../uploads");

if (count($contents) <= 2)
	echo "Pas de fichiers disponibles ! ";
else ?>
<table class="table">
  <thead>
    <tr>
      <th>Log</th>
      <th>Afficher</th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($contents as $c): ?>
 <?php if ($c!="." && $c!=".."): ?>
	<tr>
            <td><?=$c;?></td>
            <td><form method="get" action="../controllers/read_file.php">
                <button type="submit" name="read"
                        class="button" value=<?=$c?>>Afficher</button>
            </form> </td>
			<td><form method="get" action="../controllers/delete.php">
    <button type="submit" name="delete"
            class="button" value=<?=$c?>>X</button>
</form> </td>
    </tr>
	<?php endif;?>
<?php endforeach;?>
</tbody>
</table>
<form method="post"> 
    <input type="submit" name="delete_all"
            class="button" value="Delete all" />
</form>