<?php # Script 16.7 - activate.php
// This page activates the user's account.
require_once 'core/init.php';
$user = new User();

$x = $y = FALSE;

if(!isset($_GET['x'])){
    Redirect::to('404');
}
if ($user->activate($_GET['x'], $_GET['y'])) {
    Session::flash('home', '<div class="message">Your account is now active. You may now log in.</div>');
    Redirect::to('index.php');
} else {
    Session::flash('home', '<div class="message">Your account could not be activated. Please recheck the link or contact the system administrator.</div>');
    Redirect::to('index.php');
}

?>