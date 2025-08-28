<?php
session_start();
if (!isset($_SESSION['employeeLogged'])) {
  header("Location: index.php");
}
include_once 'connection.php';

if (isset($_POST['submit'])) {
  $x = 1;
  $username = $_SESSION['uname'];
  $gatepassCode = $_POST['gatepassCode'];
  $fieldworkDate = $_POST['fieldworkDate'];
  $destination = $_POST['destination'];
  $purpose1 = $_POST['purpose1'];
  $purpose2 = $_POST['purpose2'];
  $purpose3 = $_POST['purpose3'];
  $prop1 = $_POST['prop1'];
  $prop2 = $_POST['prop2'];
  $prop3 = $_POST['prop3'];
  $prepByName = $_POST['prepByName'];
  $prepBySignature = $_FILES['prepBySignature']['name'];
  $prepByFormatted = 'P-' . $gatepassCode . '-' . $prepBySignature;
  $tmpPSign = $_FILES['prepBySignature']['tmp_name'];
  move_uploaded_file($tmpPSign, 'Images/' . $prepByFormatted);
  do {
    $employeeName = $_POST['employeeName' . strval($x)];
    $employeeDept = $_POST['employeeDept' . strval($x)];
    $employeeSignature = $_FILES['employeeSign' . strval($x)]['name'];
    $employeeRemarks = $_POST['employeeRemarks' . strval($x)];
    $tmpESign = $_FILES['employeeSign' . strval($x)]['tmp_name'];
    $uploadDir = $gatepassCode . '-' . $employeeSignature;
    if ($employeeName != "" && $employeeDept != "" && $employeeSignature != "") {
      move_uploaded_file($tmpESign, 'Images/' . $uploadDir);
      $query = "INSERT INTO gatepass (gatepassCode, fieldworkDate, destination, employeeName, dept, employeeSignature, remarks, 
      purpose1, purpose2, purpose3, prop1, prop2, prop3, preparedBy, prepSignature, gatepassStatus, username) VALUES ('$gatepassCode', '$fieldworkDate', '$destination',
      '$employeeName', '$employeeDept', '$uploadDir', '$employeeRemarks', '$purpose1', '$purpose2', '$purpose3' , '$prop1', '$prop2',
      '$prop3', '$prepByName', '$prepByFormatted', 'Pending', '$username')";
      mysqli_query($conn, $query);
    }
    $x++;
  } while ($x <= 5);
  echo "<script> alert('Insert Successful'); </script>";
  header('Location: employeeDashboard.php?insert=success');
}
