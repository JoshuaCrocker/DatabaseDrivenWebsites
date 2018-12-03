<?php
/**
 * users.php (Database-Driven-Websites--PHP)
 * 03/12/2018
 *
 * @author joshuacrocker
 */

include 'connect.php';
include 'functions.php';

$sql = "SELECT ID, firstname, lastname, email FROM users";

$result = $mysqli->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Users</title>
</head>

<body>
<p>
    <?php if (is_logged_in()) { ?>
        Welcome <?php print $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname']; ?>!
        <a href="logout.php">Logout</a>
    <?php } else { ?>
        <a href="login.php">Login</a>
    <?php } ?>
</p>

<?php if (is_logged_in()) { ?>
    <a href="newuser.php">New User</a>
<?php } ?>

<?php
if ($result) {
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Firstname</th>";
        echo "<th>Surname</th>";
        echo "<th>Email</th>";

        if (is_logged_in()) {
            echo "<th>Actions</th>";
        }

        echo "</tr>";
        while ($row = $result->fetch_assoc()) {
            // output data of each row
            echo "<tr>";
            echo "<td>" . $row['ID'] . "</td>";
            echo "<td>" . $row['firstname'] . "</td>";
            echo "<td>" . $row['lastname'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";

            if (is_logged_in()) {
                echo "<td><a href=\"edit.php?id=" . $row['ID'] . "\">Edit</a></td>";
            }

            echo "</tr>";
        }
        echo "</table>";

    } else {
        echo "0 results";
    }

    $result->close();
    $mysqli->close();
}
?>
</body>
</html>
