<?php
session_start();
if (!isset($_SESSION['employeeLogged'])) {
  header("Location: index.php");
}
include('dbcon.php');
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Employee Gate Pass List</title>

  <!-- Bootstrap core CSS -->
  <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #2d318f;
      font-family: 'Segoe UI', Arial, sans-serif;
    }
    .navbar {
      background-color: #2d318f !important;
      box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    }
    .navbar .nav-link.active, .navbar .nav-link {
      color: #fff !important;
      font-weight: 500;
    }
    .navbar .nav-link.active {
      border-bottom: 2px solid #FFD700;
    }
    .navbar .dropdown-menu {
      background-color: #FFD700 !important;
      border: none;
    }
    .navbar .dropdown-item {
      color: #2d318f !important;
      font-weight: 500;
    }
    .dashboard-header {
      background: linear-gradient(90deg, #2d318f 80%, #FFD700 100%);
      color: #FFD700;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      padding: 32px 0 24px 0;
      margin-bottom: 24px;
    }
    .dashboard-header h1 {
      font-size: 2.2rem;
      font-weight: 700;
      margin: 0;
      color: #FFD700;
      text-shadow: 1px 1px 4px #222;
    }
    .table-responsive {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.06);
      padding: 24px;
      margin-bottom: 32px;
    }
    .table thead {
      background-color: #2d318f !important;
      color: #FFD700 !important;
      font-weight: 600;
    }
    .table-striped tbody tr:nth-of-type(odd) {
      background-color: #f4f4f4;
    }
    .btn-outline-info {
      border-color: #FFD700;
      color: #2d318f;
      background-color: #FFD700;
    }
    .btn-outline-info:hover {
      background-color: #2d318f;
      color: #FFD700;
      border-color: #2d318f;
    }
    .form-control {
      border-radius: 8px;
      border: 1px solid #2d318f;
    }
    hr {
      border-top: 2px solid #2d318f;
    }
  </style>
  <!-- Custom styles for this template -->
  <link href="css/dashboard.css" rel="stylesheet">
  <link href="Css/headers.css" rel="stylesheet">
</head>

<body>
  <div class="container py-4">
    <div class="row justify-content-center mb-4">
      <div class="col-lg-10">
        <div class="card shadow-lg border-0 rounded-4">
          <div class="card-body p-4">
            <div class="d-flex align-items-center mb-3">
              <img src="Pictures/Logos.png" class="rounded-circle me-3" width="60" height="60" alt="Logo">
              <div>
                <h2 class="fw-bold mb-0" style="color:#2d318f;">Gate Pass List</h2>
                <span class="fs-5 fw-semibold" style="color:#FFD700;">Welcome, <?php echo $_SESSION['employeeName']; ?>!</span>
              </div>
            </div>
            <hr>
            <div class="dashboard-header text-center mb-4">
              <h1>North Park Gate Pass System</h1>
            </div>
            <div class="table-responsive mb-4">
              <div class="d-flex bd-highlight">
                <div class="p-1 bd-highlight">
                  <h5 class="float-start" style="margin-top:15px;">GatePass Code:</h5>
                </div>
                <div class="p-3 bd-highlight"><input type="text" class="form-control" style="width:110%;" id="searchTransaction" name="searchTransaction" placeholder="Search gatepass.." onkeyup="searchTransaction()" onclick="clearValue()"></div>
                <div class="p-4 bd-highlight"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
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
          <thead>
                  <tr>
                    <th scope="col">GatePass Code</th>
                    <th scope="col">Fieldwork Date</th>
                    <th scope="col">Destination</th>
                    <th scope="col">Department/Branch</th>
                    <th scope="col">Prepared By</th>
                    <th scope="col">
                      <div class="dropdown">
                        <a href="#" class="d-block link-light text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                          GatePass Status
                        </a>
                        <ul class="dropdown-menu text-sm" aria-labelledby="dropdownUser1" style="font-size:14px;background-color:gold;">
                          <li><a class="dropdown-item" href="employeeGatePassList.php?gatepassStatus='*'">All</a></li>
                          <li><a class="dropdown-item" href="employeeGatePassList.php?gatepassStatus=Pending">Pending</a></li>
                          <li><a class="dropdown-item" href="employeeGatePassList.php?gatepassStatus=Approved">Approved</a></li>
                        </ul>
                      </div>
                    </th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (isset($_GET['gatepassStatus'])) {
                    $uname = $_SESSION['uname'];
                    $gatepassStatus = $_GET['gatepassStatus'];
                    $query = "SELECT * FROM gatepass WHERE gatepassStatus='$gatepassStatus' AND username='$uname' GROUP BY gatepassCode ORDER BY gatepassCode DESC";
                    $statement = $conn->prepare($query);
                    $statement->execute();

                    $statement->setFetchMode(PDO::FETCH_OBJ); //PDO::FETCH_ASSOC
                    $result = $statement->fetchAll();
                    if ($result) {
                      foreach ($result as $row) {
                  ?>
                        <tr>
                          <td><?= $row->gatepassCode; ?></td>
                          <td><?= $row->fieldworkDate; ?></td>
                          <td><?= $row->destination; ?></td>
                          <td><?= $row->dept; ?></td>
                          <td><?= $row->preparedBy; ?></td>
                          <td><?= $row->gatepassStatus; ?></td>
                          <td>
                            <a href="employeeGatePassEdit.php?gatepassCode=<?= $row->gatepassCode ?>" class="btn btn-outline-info">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                              </svg>
                            </a>
                          </td>
                        </tr>
                      <?php }
                    } else {
                      ?>
                      <tr>
                        <td colspan="7">No Record Found</td>
                      </tr>
                  <?php
                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <div class="d-flex justify-content-end gap-2 mt-4">
              <a href="employeeGatePass.php" class="btn btn-primary btn-lg px-4 shadow" style="background-color:#2d318f;color:#FFD700;">New Gatepass</a>
              <a href="employeeDashboard.php" class="btn btn-success btn-lg px-4 shadow" style="background-color:#FFD700;color:#2d318f;">Dashboard</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
  <script src="javascript/dashboard.js"></script>
</body>

</html>