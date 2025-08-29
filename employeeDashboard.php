<?php
session_start();
if (!isset($_SESSION['employeeLogged'])) {
  header("Location: index.php");
}
include('dbcon.php');
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Employee Dashboard</title>

  <!-- Bootstrap core CSS -->
  <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #2d318f 0%, #FFD700 100%);
      min-height: 100vh;
      background-attachment: fixed;
    }
    .glass-card {
      background: rgba(255,255,255,0.18);
      box-shadow: 0 8px 32px 0 rgba(31,38,135,0.15);
      backdrop-filter: blur(8px);
      border-radius: 18px;
      border: 1px solid rgba(255,255,255,0.25);
      transition: transform 0.2s, box-shadow 0.2s;
    }
    .glass-card:hover {
      transform: translateY(-4px) scale(1.03);
      box-shadow: 0 16px 32px 0 rgba(45,49,143,0.18);
    }
    .hero-banner {
      position: relative;
      background: linear-gradient(90deg, #2d318f 60%, #FFD700 100%);
      color: #fff;
      border-radius: 24px;
      box-shadow: 0 4px 24px rgba(45,49,143,0.10);
      overflow: hidden;
    }
    .hero-banner .overlay {
      position: absolute;
      top:0;left:0;width:100%;height:100%;
      background: rgba(45,49,143,0.18);
      z-index:1;
      border-radius:24px;
    }
    .hero-banner-content {
      position: relative;
      z-index:2;
      padding: 48px 0 32px 0;
    }
    .hero-icon {
      font-size: 3.5rem;
      color: #FFD700;
      margin-bottom: 12px;
      filter: drop-shadow(0 2px 8px #2d318f88);
    }
    .table-section {
      background: rgba(255,255,255,0.85);
      border-radius: 18px;
      box-shadow: 0 2px 12px rgba(45,49,143,0.10);
      padding: 32px 24px;
      margin-bottom: 32px;
    }
    .btn-primary, .btn-outline-warning {
      transition: box-shadow 0.2s, transform 0.2s;
    }
    .btn-primary:hover, .btn-outline-warning:hover {
      box-shadow: 0 4px 16px #FFD70055;
      transform: scale(1.05);
    }
    @media (max-width: 768px) {
      .hero-banner-content { padding: 32px 0 24px 0; }
      .table-section { padding: 16px 8px; }
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="css/dashboard.css" rel="stylesheet">
  <link href="Css/headers.css" rel="stylesheet">
  <link href="Css/navbar.css" rel="stylesheet">
</head>

<body>
  <!-- Top Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#2d318f;box-shadow:0 2px 8px rgba(45,49,143,0.10);">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="Pictures/Logos.png" alt="Logo" width="40" height="40" class="rounded-circle me-2">
        <span class="fw-bold" style="color:#FFD700;font-size:1.3rem;">North Park GatePass</span>
      </a>
      <div class="dropdown ms-auto">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="Pictures/user.png" alt="Avatar" width="36" height="36" class="rounded-circle me-2">
          <span class="fw-semibold"><?php echo $_SESSION['employeeName']; ?></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
          <li><a class="dropdown-item" href="employeeDashboard.php">Dashboard</a></li>
          <li><a class="dropdown-item" href="employeeGatePass.php">New Gatepass</a></li>
          <li><a class="dropdown-item" href="employeeGatePassList.php?gatepassStatus='*'">GatePass List</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item text-danger" href="userLogout.php">Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Notification Area -->
  <div class="container mt-3">
    <div class="alert alert-info shadow-sm text-center" style="border-radius:12px;display:none;" id="dashboardAlert">
      <!-- JS can show/hide this for notifications -->
      Welcome! You have 2 new gate pass updates.
    </div>
  </div>
  <!-- Hero Banner -->
  <section class="hero-banner mb-4">
    <div class="overlay"></div>
    <div class="container hero-banner-content text-center">
      <div class="hero-icon"><i class="bi bi-shield-check"></i></div>
      <h1 class="display-5 fw-bold">Welcome to Your Dashboard</h1>
      <p class="lead">Manage your gate passes, view status, and take action quickly.</p>
      <div class="d-flex justify-content-center gap-3 mt-3">
        <a href="employeeGatePass.php" class="btn btn-primary btn-lg px-4" style="background-color:#2d318f;color:#FFD700;">New Gatepass</a>
        <a href="employeeGatePassList.php?gatepassStatus='*'" class="btn btn-outline-warning btn-lg px-4" style="color:#2d318f;border-width:2px;">GatePass List</a>
      </div>
    </div>
  </section>
  <!-- Summary Cards -->
  <?php
  $uname = $_SESSION['uname'];
  // Get total gate passes
  $totalQuery = "SELECT COUNT(DISTINCT gatepassCode) AS total FROM gatepass WHERE username='$uname'";
  $totalStmt = $conn->prepare($totalQuery);
  $totalStmt->execute();
  $total = $totalStmt->fetch(PDO::FETCH_ASSOC)['total'];
  // Get pending gate passes
  $pendingQuery = "SELECT COUNT(DISTINCT gatepassCode) AS pending FROM gatepass WHERE gatepassStatus='Pending' AND username='$uname'";
  $pendingStmt = $conn->prepare($pendingQuery);
  $pendingStmt->execute();
  $pending = $pendingStmt->fetch(PDO::FETCH_ASSOC)['pending'];
  // Get approved gate passes
  $approvedQuery = "SELECT COUNT(DISTINCT gatepassCode) AS approved FROM gatepass WHERE gatepassStatus='Approved' AND username='$uname'";
  $approvedStmt = $conn->prepare($approvedQuery);
  $approvedStmt->execute();
  $approved = $approvedStmt->fetch(PDO::FETCH_ASSOC)['approved'];
  // Get rejected gate passes
  $rejectedQuery = "SELECT COUNT(DISTINCT gatepassCode) AS rejected FROM gatepass WHERE gatepassStatus='Rejected' AND username='$uname'";
  $rejectedStmt = $conn->prepare($rejectedQuery);
  $rejectedStmt->execute();
  $rejected = $rejectedStmt->fetch(PDO::FETCH_ASSOC)['rejected'];
  ?>
  <div class="container mb-4">
    <div class="row g-4 justify-content-center">
      <div class="col-6 col-md-3">
        <div class="glass-card text-center">
          <div class="card-body py-4">
            <div class="mb-2"><i class="bi bi-collection-fill" style="font-size:2rem;color:#2d318f;"></i></div>
            <h6 class="fw-bold" style="color:#2d318f;">Total Gate Passes</h6>
            <h2 class="fw-bold" style="color:#FFD700;"><?= $total ?></h2>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="glass-card text-center">
          <div class="card-body py-4">
            <div class="mb-2"><i class="bi bi-hourglass-split" style="font-size:2rem;color:#2d318f;"></i></div>
            <h6 class="fw-bold" style="color:#2d318f;">Pending</h6>
            <h2 class="fw-bold" style="color:#FFD700;"><?= $pending ?></h2>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="glass-card text-center">
          <div class="card-body py-4">
            <div class="mb-2"><i class="bi bi-check-circle-fill" style="font-size:2rem;color:#2d318f;"></i></div>
            <h6 class="fw-bold" style="color:#2d318f;">Approved</h6>
            <h2 class="fw-bold" style="color:#FFD700;"><?= $approved ?></h2>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="glass-card text-center">
          <div class="card-body py-4">
            <div class="mb-2"><i class="bi bi-x-circle-fill" style="font-size:2rem;color:#2d318f;"></i></div>
            <h6 class="fw-bold" style="color:#2d318f;">Rejected</h6>
            <h2 class="fw-bold" style="color:#FFD700;"><?= $rejected ?></h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Table Section -->
  <div class="container">
    <div class="table-section">
      <h4 style="color:#2d318f;font-weight:600;">Gate Pass Request</h4>
      <div class="d-flex bd-highlight align-items-center mb-3">
        <div class="p-1 bd-highlight">
          <h5 class="float-start" style="margin-top:15px;color:#2d318f;font-weight:600;">GatePass Code:</h5>
        </div>
        <div class="p-3 bd-highlight" style="flex:1;min-width:220px;">
          <input type="text" class="form-control" id="searchTransaction" name="searchTransaction" placeholder="Search gatepass.." onkeyup="searchTransaction()" onclick="clearValue()">
        </div>
        <div class="p-2 bd-highlight">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#FFD700" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
          </svg>
        </div>
      </div>
      <script>
        function searchTransaction() {
          // Declare variables
          var input, filter, table, tr, td, i, txtValue;
          input = document.getElementById("searchTransaction");
          filter = input.value.toUpperCase();
          table = document.getElementById("transactionTbl");
          tr = table.getElementsByTagName("tr");

          // Loop through all table rows, and hide those who don't match the search query
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
              txtValue = td.textContent || td.innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            }
          }
        }

        function clearValue() {
          document.getElementById("searchTransaction").value = "";
        }
      </script>
      <table class="table table-striped table-md table-hover text-center" id="transactionTbl">
        <thead>
          <tr>
            <th scope="col">Gate Pass Code</th>
            <th scope="col">Fieldwork Date</th>
            <th scope="col">Destination</th>
            <th scope="col">Department/Branch</th>
            <th scope="col">Prepared By</th>
            <th scope="col">GatePass Status</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $uname = $_SESSION['uname'];
          $query = "SELECT * FROM gatepass WHERE gatepassStatus='Pending' AND username='$uname' GROUP BY gatepassCode ORDER BY gatepassCode DESC";
          $statement = $conn->prepare($query);
          $statement->execute();
          $statement->setFetchMode(PDO::FETCH_OBJ); //PDO::FETCH_ASSOC
          $result = $statement->fetchAll();
          if ($result) {
            foreach ($result as $row) {
          ?>
            <tr>
              <td><?= $row->gatepassCode; ?></td>
              <td><?= date("m-d-Y", strtotime($row->fieldworkDate)); ?></td>
              <td><?= $row->destination; ?></td>
              <td><?= $row->dept; ?></td>
              <td><?= $row->preparedBy; ?></td>
              <td><?= $row->gatepassStatus; ?></td>
              <td>
                <a href="employeeGatePassEdit.php?gatepassCode=<?= $row->gatepassCode ?>" class="btn btn-outline-info">
                  <i class="bi bi-pencil-fill" style="font-size:1.2rem;"></i>
                </a>
              </td>
            </tr>
          <?php
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Sample JavaScript to show/hide notification
    document.addEventListener("DOMContentLoaded", function() {
      var alertBox = document.getElementById("dashboardAlert");
      alertBox.style.display = "block";
      setTimeout(function() {
        alertBox.style.display = "none";
      }, 5000);
    });
  </script>
</body>

</html>