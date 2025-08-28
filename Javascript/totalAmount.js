function totalDocumentAmount() {
  var documentAmount1 = document.getElementById("documentAmount1").value;
  var documentAmount2 = document.getElementById("documentAmount2").value;
  var documentAmount3 = document.getElementById("documentAmount3").value;
  var documentAmount4 = document.getElementById("documentAmount4").value;
  var documentAmount5 = document.getElementById("documentAmount5").value;
  var documentAmount6 = document.getElementById("documentAmount6").value;
  var documentAmount7 = document.getElementById("documentAmount7").value;
  var documentAmount8 = document.getElementById("documentAmount8").value;

  var totalAmount = document.getElementById("totalAmount").value = Number(documentAmount1) + Number(documentAmount2) + Number(documentAmount3)
    + Number(documentAmount4) + Number(documentAmount5) + Number(documentAmount6) + Number(documentAmount7) + Number(documentAmount8);

  if (totalAmount > Number("499999.99")) {
    document.getElementById("documentAmount1").readOnly = true;
    document.getElementById("documentAmount2").readOnly = true;
    document.getElementById("documentAmount3").readOnly = true;
    document.getElementById("documentAmount4").readOnly = true;
    document.getElementById("documentAmount5").readOnly = true;
    document.getElementById("documentAmount6").readOnly = true;
    document.getElementById("documentAmount7").readOnly = true;
    document.getElementById("documentAmount8").readOnly = true;
    alert("You have exceeded ₱500,000.00. Fill-out another transaction.")
  }
}
