<?php
/**
 * logout.php (Database-Driven-Websites--PHP)
 * 03/12/2018
 *
 * @author joshuacrocker
 */

include 'connect.php';
include 'functions.php';

$_SESSION['user'] = null;

header("Location: users.php");
exit();
