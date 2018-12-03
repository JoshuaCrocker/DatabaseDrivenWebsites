<?php
$name = 'Guest';

if (isset($_GET['name'])) {
    $name = $_GET['name'];
}

echo '<p>Hello ' . $name . ', pleased to meet you!</p>';