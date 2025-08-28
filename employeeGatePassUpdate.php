<?php

include_once 'connection.php';

if (isset($_POST['submit'])) {
  $x = 1;
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
  $prepByFormatted = rand(1, 100) . 'P-' . $gatepassCode . '-' . $prepBySignature;
  $tmpPSign = $_FILES['prepBySignature']['tmp_name'];
  move_uploaded_file($tmpPSign, 'Images/' . $prepByFormatted);
  do {
    $employeeID = $_POST['employeeID' . strval($x)];
    $employeeName = $_POST['employeeName' . strval($x)];
    $employeeDept = $_POST['employeeDept' . strval($x)];
    $employeeSignature = $_FILES['employeeSign' . strval($x)]['name'];
    $employeeRemarks = $_POST['employeeRemarks' . strval($x)];
    $tmpESign = $_FILES['employeeSign' . strval($x)]['tmp_name'];
    $uploadDir = $gatepassCode . '-' . $employeeSignature;
    if ($employeeName != "" && $employeeDept != "" && $employeeSignature != "" || $prepBySignature != "") {
      move_uploaded_file($tmpESign, 'Images/' . $uploadDir);
      $query = "UPDATE gatepass SET fieldworkDate='$fieldworkDate', destination='$destination', employeeName='$employeeName', dept='$employeeDept', employeeSignature='$uploadDir', remarks='$employeeRemarks', purpose1='$purpose1', purpose2='$purpose2', purpose3='$purpose3', prop1='$prop1', prop2='$prop2', prop3='$prop3', preparedBy='$prepByName', prepSignature='$prepByFormatted' WHERE id='$employeeID'";
      $query_run = mysqli_query($conn, $query);
    }
    elseif ($employeeName != "" && $employeeDept != "" && $employeeSignature == "" || $prepBySignature == "") {
      move_uploaded_file($tmpESign, 'Images/' . $uploadDir);
      $query = "UPDATE gatepass SET fieldworkDate='$fieldworkDate', destination='$destination', employeeName='$employeeName', dept='$employeeDept', remarks='$employeeRemarks', purpose1='$purpose1', purpose2='$purpose2', purpose3='$purpose3', prop1='$prop1', prop2='$prop2', prop3='$prop3', preparedBy='$prepByName' WHERE id='$employeeID'";
      $query_run = mysqli_query($conn, $query);
    }
    $x++;
  } while ($x <= 5);
  header ('Location: employeeDashboard.php');
}
