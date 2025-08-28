<?php

include_once 'connection.php';

if (isset($_POST['submit'])) {
  $gatepassCode = $_POST['gatepassCode'];
  $securityName = $_SESSION['securityName'];
  $departureTime = $_POST['departureTime'];
  $arrivalTime = $_POST['arrivalTime'];

  $departureSignature = $_FILES['departureSignature']['name'];
  $departureTimeFormatted = rand(1, 100) . 'DS-' . $gatepassCode . '-' . $departureSignature;
  $tmpDSSign = $_FILES['departureSignature']['tmp_name'];
  
  $arrivalSignature = $_FILES['arrivalSignature']['name'];
  $arrivalTimeFormatted = rand(1, 100) . 'AT-' . $gatepassCode . '-' . $arrivalSignature;
  $tmpATSign = $_FILES['arrivalSignature']['tmp_name'];

  if ($securityName != "" && $departureTime != "" && $departureSignature != "" && $arrivalTime != "" && $arrivalSignature != "" && $gatepassCode != "") {
    move_uploaded_file($tmpDSSign, 'Images/' . $departureTimeFormatted);
    move_uploaded_file($tmpATSign, 'Images/' . $arrivalTimeFormatted);
    $query = "UPDATE gatepass SET securityName='$securityName', departureTime='$departureTime', departureSignature='$departureTimeFormatted',
    arrivalTime='$arrivalTime', arrivalSignature='$arrivalTimeFormatted' WHERE gatepassCode='$gatepassCode'";
    mysqli_query($conn, $query);
    header('Location: supervisorDashboard.php');
  } elseif ($securityName != "" && $approveBySignature == "" && $gatepassCode != "") {
    $query = "UPDATE gatepass SET approveBy='$approveByName', gatepassStatus='Received' WHERE gatepassCode='$gatepassCode'";
    mysqli_query($conn, $query);
    header('Location: supervisorDashboard.php');
  } else {
    echo "<script> alert('Supervisor's Name or Signature is Empty.'); history.go(-1); </script>";
  }
}
