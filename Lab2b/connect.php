<?php
/**
 * connect.php (Database-Driven-Websites--PHP)
 * 03/12/2018
 *
 * @author joshuacrocker
 */

$servername = 'localhost:8889';
$username = 'root';
$password = 'root';
$dbasename = 'ddw';

// Start session
session_start();

// Create Connection
$mysqli = new mysqli($servername, $username, $password, $dbasename);

// Check Connection
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
