<?php require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');

wp_delete_term( $_POST['id'], $_POST['taxonomy'] )
?>
