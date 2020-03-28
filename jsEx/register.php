<?php

define("SUCCESS_MESSAGE", "Success!");
define("FAIL_MESSAGE", "Fail!");

$jsonData = file_get_contents('php://input');
$dataClassObject = json_decode($jsonData);
$associativeArray = json_decode(json_encode($dataClassObject), TRUE);

$username = $associativeArray['Username'];
$password = $associativeArray['Password'];
$confirmPassword = $associativeArray['ConfirmPassword'];

if($username != null && $password != null && $confirmPassword != null)
    echo json_encode(SUCCESS_MESSAGE);
else
    echo json_encode(FAIL_MESSAGE);
?>