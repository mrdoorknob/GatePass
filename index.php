<?php
session_start();
include "connection.php";

if (isset($_POST['login'])) {

  $uname = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  if ($uname != "" && $password != "") {

    $sql_query = "SELECT * FROM user WHERE username='$uname' AND password='$password'";
    $result = mysqli_query($conn, $sql_query);
    $row = mysqli_fetch_array($result);

    if (mysqli_num_rows($result) > 0) {
      $userType = $row['userType'];
      if ($userType == "Employee") {
        $_SESSION['uname'] = $row['username'];
        $_SESSION['employeeName'] = $row['userFullname'];
        $_SESSION['employeeLogged'] = 'yes';
        header('Location: employeeDashboard.php');
        exit();
      } else if ($userType == "Security") {
        $_SESSION['uname'] = $row['username'];
        $_SESSION['securityName'] = $row['userFullName'];
        $_SESSION['securityLogged'] = 'yes';
        header('Location: securityDashboard.php');
        exit();
      }
      else if ($userType == "Supervisor") {
        $_SESSION['uname'] = $row['username'];
        $_SESSION['dept'] = $row['dept'];
        $_SESSION['supervisorName'] = $row['userFullname'];
        $_SESSION['supervisorLogged'] = 'yes';
        header('Location: supervisorDashboard.php');
        exit();
      }
    } else {
      echo '<script>alert("Incorrect Username and/or Password.");</script>';
    }
  } else {
    echo '<script>alert("Username and/or Password is Empty");</script>';
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.88.1">
  <title>North Park GatePass System</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">
  <!-- Bootstrap core CSS -->
  <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>

  <!-- Custom styles for this template -->
  <link href="Css/signin.css" rel="stylesheet">
</head>

<body class="text-center" style="background: linear-gradient(135deg, #2d318f 90%, #FFD700 10%); min-height: 100vh;">

  <main class="form-signin d-flex flex-column align-items-center justify-content-center" style="min-height: 100vh;">
    <form method="POST" action="" class="p-4 rounded shadow-lg" style="background: #fff; max-width: 400px; width: 100%; border-radius: 16px;">
      <img class="mb-4" src="Pictures/Logos.png" alt="" width="180" height="90" style="border-radius: 8px; box-shadow: 0 2px 8px rgba(45,49,143,0.15);">
      <h1 class="h2 mb-2 fw-bold" style="color: #2d318f;">Gate Pass System</h1>
      <h2 class="h5 mb-3 fw-normal" style="color: #2d318f;">Ni Hao! Welcome</h2>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" name="username" autocomplete="off" placeholder="J4-01-01" style="border: 1.5px solid #2d318f; border-radius: 8px;">
        <label for="floatingInput" style="color: #2d318f;">Username</label>
      </div>
      <div class="form-floating mb-3">
        <input type="password" class="form-control" id="floatingPassword" name="password" autocomplete="off" placeholder="Password" style="border: 1.5px solid #2d318f; border-radius: 8px;">
        <label for="floatingPassword" style="color: #2d318f;">Password</label>
      </div>
      <button class="w-100 btn btn-lg btn-primary" type="submit" name="login" style="background-color: #2d318f; color: #FFD700; border: none; font-weight: 600; border-radius: 8px;">Sign in</button>
      <p class="mt-4 mb-2 text-muted" style="color: #2d318f;">&copy; 2022–2025</p>
    </form>
  </main>

</body>

</html>