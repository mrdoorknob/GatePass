<?php
session_start();
if (!isset($_SESSION['securityLogged'])) {
  header("Location: index.php");
}
include('dbcon.php');
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Supervisor Dashboard</title>

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
      background: rgba(255, 255, 255, 0.18);
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
      backdrop-filter: blur(8px);
      border-radius: 18px;
      border: 1px solid rgba(255, 255, 255, 0.25);
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .glass-card:hover {
      transform: translateY(-4px) scale(1.03);
      box-shadow: 0 16px 32px 0 rgba(45, 49, 143, 0.18);
    }

    .table-section {
      background: rgba(255, 255, 255, 0.85);
      border-radius: 18px;
      box-shadow: 0 2px 12px rgba(45, 49, 143, 0.10);
      padding: 32px 24px;
      margin-bottom: 32px;
    }

    .btn-primary,
    .btn-outline-info {
      transition: box-shadow 0.2s, transform 0.2s;
    }

    .btn-primary:hover,
    .btn-outline-info:hover {
      box-shadow: 0 4px 16px #FFD70055;
      transform: scale(1.05);
    }

    @media (max-width: 768px) {
      .table-section {
        padding: 16px 8px;
      }
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
      <a class="navbar-brand d-flex align-items-center gap-2" href="#">
        <span style="display:flex;align-items:center;">
          <img src="Pictures/Logos.png" alt="Logo" width="44" height="44" class="rounded-circle shadow-sm"
            style="box-shadow:0 2px 8px #2d318f44;">
          <span style="height:40px;width:2px;background:linear-gradient(180deg,#FFD700,#2d318f);margin:0 16px;border-radius:2px;"></span>
        </span>
        <span class="fw-bold"
          style="font-size:1.5rem;background:linear-gradient(90deg,#FFD700 30%,#2d318f 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">
          North Park GatePass</span>
      </a>
      <div class="dropdown ms-auto">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="userDropdown"
          data-bs-toggle="dropdown" aria-expanded="false">
          <img src="Pictures/user.png" alt="Avatar" width="36" height="36" class="rounded-circle me-2">
          <span class="fw-semibold"><?php echo $_SESSION['securityName']; ?></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
          <li><a class="dropdown-item text-danger" href="userLogout.php">Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Banner -->
  <section class="py-5 text-center bg-white shadow-sm mb-4"
    style="border-radius:18px;margin:32px 0 0 0;">
    <div class="container">
      <h1 class="display-5 fw-bold" style="color:#2d318f;">Security Dashboard</h1>
      <p class="lead" style="color:#222;">Monitor gate pass requests and manage security actions.</p>
    </div>
  </section>

  <!-- Summary Cards -->
  <div class="container mb-4">
    <div class="row g-4 justify-content-center">
      <div class="col-6 col-md-4">
        <div class="glass-card text-center">
          <div class="card-body py-4">
            <div class="mb-2"><i class="bi bi-collection-fill" style="font-size:2rem;color:#2d318f;"></i></div>
            <h6 class="fw-bold" style="color:#2d318f;">Total Received</h6>
            <h2 class="fw-bold" style="color:#FFD700;">--</h2>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-4">
        <div class="glass-card text-center">
          <div class="card-body py-4">
            <div class="mb-2"><i class="bi bi-check-circle-fill" style="font-size:2rem;color:#2d318f;"></i></div>
            <h6 class="fw-bold" style="color:#2d318f;">Approved</h6>
            <h2 class="fw-bold" style="color:#FFD700;">--</h2>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-4">
        <div class="glass-card text-center">
          <div class="card-body py-4">
            <div class="mb-2"><i class="bi bi-x-circle-fill" style="font-size:2rem;color:#2d318f;"></i></div>
            <h6 class="fw-bold" style="color:#2d318f;">Rejected</h6>
            <h2 class="fw-bold" style="color:#FFD700;">--</h2>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Table Section -->
  <div class="container">
    <div class="table-section">
      <h4 style="color:#2d318f;font-weight:600;">Gate Pass Request</h4>
      <div class="d-flex bd-highlight">
        <div class="p-1 bd-highlight">
          <h5 class="float-start" style="margin-top:15px;">GatePass Code:</h5>
        </div>
        <div class="p-3 bd-highlight"><input type="text" class="form-control" style="width:110%;"
            id="searchTransaction" name="searchTransaction" placeholder="Search gatepass.."
            onkeyup="searchTransaction()" onclick="clearValue()"></div>
        <div class="p-4 bd-highlight"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
          </svg></div>
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
        <thead style="background-color:#494dc0;" class="text-white">
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
          $query = "SELECT * FROM gatepass WHERE gatepassStatus='Received' GROUP BY gatepassCode ORDER BY gatepassCode DESC";
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
              <a href="securityGatePassEdit.php?gatepassCode=<?= $row->gatepassCode ?>" class="btn btn-outline-info">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                  class="bi bi-pencil-fill" viewBox="0 0 16 16">
                  <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                </svg>
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
  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
    integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
    integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha"
    crossorigin="anonymous"></script>
  <script src="javascript/dashboard.js"></script>
</body>

</html>