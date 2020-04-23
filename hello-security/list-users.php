<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
</head>
<body>
<a href="index.php"> Take me home, country roads ... </a> <br>
<?php
session_start();

if (!isset($_SESSION["email"])) {
    die("Only authenticated users are allowed");
}

include "db-connection.php";
$conn = openCon();

function isAdminRole()
{
    $conn = openCon();
    $data = array($_SESSION["email"]); 
    $sql = $conn->prepare("SELECT role from person where email=?");
    $sql->execute($data);

    $firstRow = $sql->fetch(PDO::FETCH_ASSOC);

    return $firstRow['role'] == "admin";
}

$data = array($_SESSION["email"]); 
$sql = $conn->prepare("SELECT * from person where email = ?");

if (!$sql->execute($data)) {
    die("Failed to query from DB!");
}
else if (!$sql->fetch(PDO::FETCH_ASSOC)) {
    die ("Users not found.");
}

if (!isAdminRole()){
    die("You don't have permission to access this information.");
}

$sql = "SELECT * from person;";

$resultSet = $conn->prepare($sql);
$resultSet->execute();

echo("The users in the system are: <br>");
while ($row = $resultSet->fetch(PDO::FETCH_ASSOC)) {
    echo $row['email'] . " " . $row['firstname'] . " " . $row['role'];
    echo "<br>";
}
?>
</body>
</html>