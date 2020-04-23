<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
</head>
<body>
<a href="index.php"> Take me home, country roads ... </a> <br>
<?php
include "db-connection.php";
$conn = openCon();

$data = array($_POST["email"], $_POST["password"]); 
$sql = $conn->prepare("SELECT * from person where email = ? and password = ?");
$sql->execute($data);

$firstRow = $sql->fetch(PDO::FETCH_ASSOC);

if (!$firstRow) {
    die ("Not valid credentials.");
}

echo("Hello " . $firstRow['firstname'] . " you are now logged in.");

session_start();
$_SESSION["email"] = $firstRow['email'];

?>
</body>
</html>
