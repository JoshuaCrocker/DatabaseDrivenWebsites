<?php
/**
 * newuser.php (Database-Driven-Websites--PHP)
 * 03/12/2018
 *
 * @author joshuacrocker
 */

// Needed for both actions
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
        $id = $_POST['id'];
        $firstname = $_POST['fname'];
        $lastname = $_POST['sname'];
        $email = $_POST['email'];
        $password = $_POST['pass'];

        $stmt = $mysqli->prepare("UPDATE users SET firstname=?, lastname=?, email=?, password=? WHERE id=?");

        if (!$stmt) {
            echo "Error: " . $mysqli->error;
        }

        $stmt->bind_param("ssssi", $firstname, $lastname, $email, $password, $id);

        if (!$stmt->execute()) {
            echo "Error: " . $mysqli->error;
        } else {
            header("Location: users.php");
            exit();
        }

        $stmt->close();
        $mysqli->close();
    }
} else {
    if (!isset($_GET['id'])) {
        header("Location: users.php");
        exit();
    }

    $id = $_GET['id'];
    $stmt = $mysqli->prepare("SELECT firstname, lastname, email, password FROM users WHERE id=?");
    $stmt->bind_param('i', $id);

    if (!$stmt->execute()) {
        echo "Error: " . $mysqli->error;
    }

    $result = $stmt->get_result();

    if (!$result->num_rows) {
        echo "Error: undefined user";
        exit();
    }

    $result = $result->fetch_assoc();

    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Edit user</title>
    </head>
    <body>
    <h1>Edit record</h1>
    <form action="edit.php" method="post">
        <input type="hidden" name="id" value="<?php print $_GET['id']; ?>">
        Firstname: <input type="text" id="fname" name="fname" value="<?php echo $result['firstname']; ?>">
        Surname: <input type="text" id="sname" name="sname" value="<?php echo $result['lastname']; ?>">
        Email: <input type="text" id="email" name="email" value="<?php echo $result['email']; ?>">
        Password: <input type="text" id="pass" name="pass" value="<?php echo $result['password']; ?>">
        <input type="submit" id="submit" name="submit" value="Submit"/>
    </form>
    </body>
    </html>
    <?php
}
?>