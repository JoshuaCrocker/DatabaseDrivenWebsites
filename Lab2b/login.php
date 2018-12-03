<?php
/**
 * login.php (Database-Driven-Websites--PHP)
 * 03/12/2018
 *
 * @author joshuacrocker
 */

include 'connect.php';
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['submit'])) {
        echo "<p>ERROR form was not submitted</p>";
    } else {
        $stmt = $mysqli->prepare("select id, firstname, lastname, email from users where email=? and password=?");
        $stmt->bind_param('ss', $email, $password);

        $email = $_POST['email'];
        $password = $_POST['pass'];
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $_SESSION['user'] = $result->fetch_assoc();
            header("Location: users.php");
            exit();
        }

        echo "Invalid Username and Password";
        exit();
    }
}

if (is_logged_in()) {
    header("Location: users.php");
    exit();
}

?>
<!doctype html>
<html>
<head>
    <title>Log In</title>
</head>
<body>
<h1>Login</h1>
<form action="login.php" method="post">
    Email: <input type="text" id="email" name="email"/>
    Password: <input type="text" id="pass" name="pass"/>
    <input type="submit" id="submit" name="submit" value="submit"/>
</form>
</body>
</html>