<?php
include "db-connection.php";

if ($_POST['role'] != "teacher" || $_POST['role'] != "student") {
  echo '<a href="index.php"> Take me home, country roads ... </a> <br>';
  die("Your role is wrong.");
}

$conn = openCon();

$data = array($_POST["email"], $_POST["firstname"], $_POST["password"], $_POST["role"]); 
$sql = $conn->prepare("INSERT INTO person (email, firstname, password, role) values (?, ?, ?, ?)");

// echo ("sql: " . $sql);  
if (!$sql->execute($data)) {
  echo("Error description: " . $conn -> error);
} else {
	echo("You are registered as: " . $_POST["email"] . " with role: " .  $_POST["role"]);
}

echo "<br> Let's login <br>";
echo '<a href="login.html"> Login </a>';
?>