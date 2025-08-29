<?php
session_start();
if (!isset($_SESSION['employeeLogged'])) {
  header("Location: index.php");
}
require 'dbcon.php';

$gatepassCode = $_GET['gatepassCode'];
$fieldworkDate;
$destination;
$idArray = array();
$employeeNameArray = array();
$deptArray = array();
$employeeSignatureArray = array();
$employeeRemarksArray = array();
$purpose1;
$purpose2;
$purpose3;
$prop1;
$prop2;
$prop3;
$preparedBy;
$prepSignature;

$query = "SELECT * FROM gatepass WHERE gatepassCode = '$gatepassCode'";
$statement = $conn->prepare($query);
$statement->execute();

$statement->setFetchMode(PDO::FETCH_OBJ); //PDO::FETCH_ASSOC
$result = $statement->fetchAll();
if ($result) {
  foreach ($result as $row) {
    $fieldworkDate = $row->fieldworkDate;
    $destination = $row->destination;
    $purpose1 = $row->purpose1;
    $purpose2 = $row->purpose2;
    $purpose3 = $row->purpose3;
    $prop1 = $row->prop1;
    $prop2 = $row->prop2;
    $prop3 = $row->prop3;
    $preparedBy = $row->preparedBy;
    $prepSignature = $row->prepSignature;

    $id = $row->id;
    $employeeName = $row->employeeName;
    $dept = $row->dept;
    $employeeSignature = $row->employeeSignature;
    $employeeRemarks = $row->remarks;

    array_push($idArray, $id);
    array_push($employeeNameArray, $employeeName);
    array_push($deptArray, $dept);
    array_push($employeeSignatureArray, $employeeSignature);
    array_push($employeeRemarksArray, $employeeRemarks);
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gate Pass Print</title>

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
    .table-responsive-lg {
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
    .table-bordered {
      border: 2px solid #2d318f !important;
    }
    .table-bordered th, .table-bordered td {
      border: 1px solid #2d318f !important;
    }
    .colTable {
      background-color: #2d318f !important;
      color: #FFD700 !important;
    }
    .form-control {
      border-radius: 8px;
      border: 1px solid #2d318f;
    }
    .btn-primary {
      background-color: #FFD700 !important;
      color: #2d318f !important;
      border: none;
    }
    .btn-primary:hover {
      background-color: #2d318f !important;
      color: #FFD700 !important;
      border: 1px solid #FFD700 !important;
    }
    .btn-success {
      background-color: #2d318f !important;
      color: #FFD700 !important;
      border: none;
    }
    .btn-success:hover {
      background-color: #FFD700 !important;
      color: #2d318f !important;
      border: 1px solid #2d318f !important;
    }
    hr {
      border-top: 2px solid #2d318f;
    }
  </style>
  <!-- Custom styles for this template -->
  <link href="css/dashboard.css" rel="stylesheet">
  <link href="Css/headers.css" rel="stylesheet">
  <link href="style.css" rel="stylesheet">

  <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
</head>

<body>
    <div class="container py-4">
      <div class="row justify-content-center mb-4">
        <div class="col-lg-8">
          <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-4">
              <div class="d-flex align-items-center mb-3">
                <span style="display:flex;align-items:center;">
                  <img src="Pictures/Logos.png" class="rounded-circle shadow-sm" width="60" height="60" alt="Logo" style="box-shadow:0 2px 8px #2d318f44;">
                  <span style="height:44px;width:2px;background:linear-gradient(180deg,#FFD700,#2d318f);margin:0 18px;border-radius:2px;"></span>
                </span>
                <span>
                  <h2 class="fw-bold mb-0" style="font-size:2rem;background:linear-gradient(90deg,#FFD700 30%,#2d318f 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">North Park GatePass</h2>
                  <span class="fs-5 fw-semibold" style="color:#FFD700;">Gate Pass for Special/Field Assignments (In Group)</span>
                </span>
              </div>
              <hr>
              <form action="employeeGatePassUpdate.php" method="POST" enctype="multipart/form-data">
                <div class="row g-3 mb-3">
                  <div class="col-md-6">
                    <label class="form-label fw-bold" style="color:#2d318f;">Fieldwork Date</label>
                    <input type="text" name="fieldworkDate" class="form-control form-control-lg" value="<?= $fieldworkDate; ?>">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-bold" style="color:#2d318f;">Destination</label>
                    <input type="text" name="destination" class="form-control form-control-lg" value="<?= $destination; ?>">
                  </div>
                </div>
                <div class="table-responsive mb-4">
                  <table class="table table-bordered align-middle text-center">
                    <thead class="table-dark" style="background-color:#2d318f;color:#FFD700;">
                      <tr>
                        <th>Name of Employees</th>
                        <th>Dept. / Branch</th>
                        <th>Employee Signature</th>
                        <th>Remarks</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php for($i=0;$i<5;$i++): ?>
                      <tr style="background-color:<?= $i%2==0?'#f8f9fa':'#fff'; ?>;">
                        <input type="hidden" name="employeeID<?= $i+1 ?>" value="<?= isset($idArray[$i])?$idArray[$i]:''; ?>">
                        <td><input type="text" class="form-control form-control-sm" name="employeeName<?= $i+1 ?>" value="<?= isset($employeeNameArray[$i])?$employeeNameArray[$i]:''; ?>"></td>
                        <td><input type="text" class="form-control form-control-sm" name="employeeDept<?= $i+1 ?>" value="<?= isset($deptArray[$i])?$deptArray[$i]:''; ?>"></td>
                        <td>
                          <img id="empSign<?= $i+1 ?>" src="<?= isset($employeeSignatureArray[$i])?'Images/'.$employeeSignatureArray[$i]:''; ?>" height="30" width="150" alt="Employee Signature">
                          <input type="file" class="form-control form-control-sm mt-2" id="upload<?= $i+1 ?>" name="employeeSign<?= $i+1 ?>" onchange="employeeSignature<?= $i+1 ?>(this);" hidden />
                          <label class="btn btn-primary btn-sm w-100 mt-2" for="upload<?= $i+1 ?>" style="font-size:10px;">Upload</label>
                        </td>
                        <td><input type="text" class="form-control form-control-sm" name="employeeRemarks<?= $i+1 ?>" value="<?= isset($employeeRemarksArray[$i])?$employeeRemarksArray[$i]:''; ?>"></td>
                      </tr>
                      <?php endfor; ?>
                    </tbody>
                  </table>
                </div>
                <div class="row g-3 mb-3">
                  <div class="col-md-4">
                    <label class="form-label fw-bold" style="color:#2d318f;">Purpose</label>
                    <input type="text" class="form-control" name="purpose1" value="<?= $purpose1; ?>">
                  </div>
                  <div class="col-md-4">
                    <label class="form-label fw-bold" style="color:#2d318f;">Purpose</label>
                    <input type="text" class="form-control" name="purpose2" value="<?= $purpose2; ?>">
                  </div>
                  <div class="col-md-4">
                    <label class="form-label fw-bold" style="color:#2d318f;">Purpose</label>
                    <input type="text" class="form-control" name="purpose3" value="<?= $purpose3; ?>">
                  </div>
                </div>
                <div class="row g-3 mb-3">
                  <div class="col-md-4">
                    <label class="form-label fw-bold" style="color:#2d318f;">Property</label>
                    <input type="text" class="form-control" name="prop1" value="<?= $prop1; ?>">
                  </div>
                  <div class="col-md-4">
                    <label class="form-label fw-bold" style="color:#2d318f;">Property</label>
                    <input type="text" class="form-control" name="prop2" value="<?= $prop2; ?>">
                  </div>
                  <div class="col-md-4">
                    <label class="form-label fw-bold" style="color:#2d318f;">Property</label>
                    <input type="text" class="form-control" name="prop3" value="<?= $prop3; ?>">
                  </div>
                </div>
                <div class="row g-3 mb-3">
                  <div class="col-md-6">
                    <label class="form-label fw-bold" style="color:#2d318f;">Prepared By</label>
                    <input type="text" class="form-control" name="preparedBy" value="<?= $preparedBy; ?>">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-bold" style="color:#2d318f;">Signature</label>
                    <img id="prepSign" src="<?= 'Images/'.$prepSignature; ?>" height="30" width="150" alt="Prepared By Signature">
                    <input type="file" class="form-control form-control-sm mt-2" id="prepUpload" name="prepSignature" onchange="prepBy(this);" hidden />
                    <label class="btn btn-primary btn-sm w-100 mt-2" for="prepUpload" style="font-size:10px;">Upload</label>
                  </div>
                </div>
                <div class="d-flex justify-content-end gap-2 mt-4">
                  <button type="submit" name="submit" class="btn btn-success btn-lg px-4 shadow">Save</button>
                  <button type="button" class="btn btn-primary btn-lg px-4 shadow" onclick="window.print()">PDF</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
<script>
  function employeeSignature1(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#empSign1').attr('src', e.target.result).width(150).height(30);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
<script>
  function employeeSignature2(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#empSign2').attr('src', e.target.result).width(150).height(30);
      };
      reader.readAsDataURL(input.files[0]);
      var fileName = document.getElementById('upload2');
      document.getElementById('test').value = fileName.files.item(0).name;
    }
  }
</script>
<script>
  function employeeSignature3(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      var fileValue
      reader.onload = function(e) {
        $('#empSign3').attr('src', e.target.result).width(150).height(30);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
<script>
  function employeeSignature4(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#empSign4').attr('src', e.target.result).width(150).height(30);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
<script>
  function employeeSignature5(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#empSign5').attr('src', e.target.result).width(150).height(30);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
<script>
  function prepBy(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#prepSign').attr('src', e.target.result).width(150).height(30);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
<script src="assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
<script src="javascript/dashboard.js"></script>

</html>