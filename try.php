<!DOCTYPE html>
<html>

<head>
  <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
  <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
  <meta charset="utf-8" />
  <title>JS Bin</title>
</head>

<body>
  <form action="supervisorGatePassUpdate.php" method="POST" enctype="multipart/form-data">
  <input type="file" name="approveBySignature" onchange="employeeSignature1(this);" />
  <img id="approveBy" src="#" /> <br><br><br><br><br><br><br><br>
  <input type="text" name="approveByName"> <br> <br>
  <input type="hidden" name="gatepassCode" value="PM-HRD-2022-000007">
  <input type="submit" name="submit" value="Submit">
</body>









<script>
  function employeeSignature1(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#approveBy').attr('src', e.target.result).width(150).height(30);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
</html>