<?php
/**
 * newuser.php (Database-Driven-Websites--PHP)
 * 03/12/2018
 *
 * @author joshuacrocker
 */

include 'connect.php';
include 'functions.php';

if (!is_logged_in()) {
    header("Location: users.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['submit'])) {
        echo "<p>ERROR form was not submitted</p>";
    } else {
        $sql = "insert into users (firstname, lastname, email, password) values ('" . $_POST['fname'] . "','" . $_POST['sname'] . "','" . $_POST['email'] . "','" . $_POST['pass'] . "')";
        if (!$mysqli->query($sql)) {
            echo "Error: " . $mysqli->error;
        } else {
            //here we could redirect he user back to another page or simple
            // output a success message

            header("Location: users.php");
            exit();
        }
        $mysqli->close();
    }
} else {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Add user</title>
    </head>
    <body>
    <h1>Add record</h1>
    <form action="newuser.php" method="post">
        Firstname: <input type="text" id="fname" name="fname"/>
        Surname: <input type="text" id="sname" name="sname"/>
        Email: <input type="text" id="email" name="email"/>
        Password: <input type="text" id="pass" name="pass"/>
        <input type="submit" id="submit" name="submit" value="submit"/>
    </form>
    </body>
    </html>
    <?php
}
?>