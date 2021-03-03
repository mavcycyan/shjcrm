<?php require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');

foreach($_POST['ids'] as $id) {
    echo $id;
    wp_trash_post( $id );
}
?>
