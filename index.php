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
      } else if ($userType == "Security") {
        $_SESSION['uname'] = $row['username'];
        $_SESSION['securityName'] = $row['userFullName'];
        $_SESSION['securityLogged'] = 'yes';
        header('Location: securityDashboard.php');
      }
      else if ($userType == "Supervisor") {
        $_SESSION['uname'] = $row['username'];
        $_SESSION['dept'] = $row['dept'];
        $_SESSION['supervisorName'] = $row['userFullname'];
        $_SESSION['supervisorLogged'] = 'yes';
        header('Location: supervisorDashboard.php');
      }
    }
  } else if ($uname == "" || $password == "") { ?>
    <script>
      alert("Username and/or Password is Empty");
    </script>;
  <?php
  } else if ($uname == $row['username'] && $password != $row['password']) { ?>
    <script>
      alert("Incorrect Username and/or Password.");
    </script>;
<?php
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

<body class="text-center" style="background-color:#2d318f;">

  <main class="form-signin">
    <form method="POST" action="">
      <img class="mb-4" src="Pictures/Logos.png" alt="" width="300" height="150">
      <h1 class="h2 mb-2 fw-normal" style="color: white;"> Gate Pass System</h1>
      <h2 class="h4 mb-3 fw-normal" style="color: white;"> Ni Hao! Welcome</h2>

      <div class="form-floating">
        <input type="text" class="form-control" id="floatingInput" name="username" autocomplete="off" placeholder="J4-01-01">
        <label for="floatingInput">Username</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" name="password" autocomplete="off" placeholder="Password">
        <label for="floatingPassword">Password</label>
      </div>

      <div class="checkbox mb-4"></div>
      <button class="w-100 btn btn-lg btn-primary" type="submit" name="login">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2022–2022</p>
    </form>
  </main>

</body>

</html>