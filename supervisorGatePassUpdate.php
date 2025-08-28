<?php

include_once 'connection.php';

if (isset($_POST['submit'])) {
  $gatepassCode = $_POST['gatepassCode'];
  $approveByName = $_POST['approveByName'];

  $approveBySignature = $_FILES['approveBySignature']['name'];
  $approveByFormatted = rand(1, 100) . 'A-' . $gatepassCode . '-' . $approveBySignature;
  $tmpPSign = $_FILES['approveBySignature']['tmp_name'];

  if ($approveByName != "" && $approveBySignature != "" && $gatepassCode != "") {
    move_uploaded_file($tmpPSign, 'Images/' . $approveByFormatted);
    $query = "UPDATE gatepass SET approveBy='$approveByName', approveBySignature='$approveByFormatted', gatepassStatus='Received' WHERE gatepassCode='$gatepassCode'";
    mysqli_query($conn, $query);
    header('Location: supervisorDashboard.php');
  } elseif ($approveByName != "" && $approveBySignature == "" && $gatepassCode != "") {
    $query = "UPDATE gatepass SET approveBy='$approveByName', gatepassStatus='Received' WHERE gatepassCode='$gatepassCode'";
    mysqli_query($conn, $query);
    header('Location: supervisorDashboard.php');
  } else {
    echo "<script> alert('Supervisor's Name or Signature is Empty.'); history.go(-1); </script>";
  }
}
