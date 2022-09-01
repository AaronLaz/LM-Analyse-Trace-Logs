<?php
$name = $_GET['delete'];
unlink("../uploads/" . $name);
header('Location: ../templates/uploads_list.php');
?>