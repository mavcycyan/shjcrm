<?php require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php'); ?>
<?php

$param = $_POST;

global $wpdb;

$isCode = $wpdb->query("SELECT `meta_id` FROM `wp_postmeta` WHERE `meta_key`='item-num_loc' AND `meta_value`='".$param['code']."'");

if ($param['code'] != '') {
    if ($isCode > 0) {
        echo 'exists';
    } else {
        echo 'done';
    }
}

?>