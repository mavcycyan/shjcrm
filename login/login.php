<?php

require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');

$creds = array();
$creds['user_login'] = $_POST['login'];
$creds['user_password'] = $_POST['password'];
$creds['remember'] = ($_POST['remember']) ? true : false ;

$user = wp_signon( $creds, false );

if ( is_wp_error($user) ) {
//    echo $user->get_error_message();
    header('Location: /user-login/?auth=failed');
} else {
    header('Location: /');
}

?>