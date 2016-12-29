<?php
session_start();

$path = '/home/saddy/public_html/wp-load.php';

require_once($path);

$wpdb->update( 'account', array( 'online' => 'N' ), array( 'ID' => $_SESSION['secretID'] ) ); 

session_destroy();

wp_redirect('/');

?>