<?php
/**
 * functions.php (Database-Driven-Websites--PHP)
 * 03/12/2018
 *
 * @author joshuacrocker
 */

function is_logged_in() {
    return isset($_SESSION['user']) && !is_null($_SESSION['user']);
}