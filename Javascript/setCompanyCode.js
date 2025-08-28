// Auto insert values to Supplier Code and Payment Terms when Supplier Name is chosen
function SetCompanyCode() {
  var companyName = document.getElementById("companyName").value;

  if (companyName == 'BCC - BACCHUS CATERING CORP'){
    document.getElementById("companyCode").value = 'ODI-BCC';
  }
  else if (companyName == 'CGC - CHEZ GABRIEL CORP'){
    document.getElementById("companyCode").value = 'ODI-CGC';
  }
  else if (companyName == 'LCAV - LE COQ AU VIN INC'){
    document.getElementById("companyCode").value = 'ODI-LCAV';
  }
  else if (companyName == 'NDI - NEXT DOOR INC'){
    document.getElementById("companyCode").value = 'ODI-NDI';
  }
  else if (companyName == 'NPNH - NORTH PARK NOODLE HOUSE INC'){
    document.getElementById("companyCode").value = 'ODI-NPNH';
  }
  else if (companyName == 'SPNH - SOUTH PARK NOODLE HOUSE INC'){
    document.getElementById("companyCode").value = 'ODI-SPNH';
  }
  else if (companyName == 'G&R - G&R HOLDING'){
    document.getElementById("companyCode").value = 'ODI-G&R';
  }
}
  //Clear the values of Supplier Code and Payment Terms when Supplier Name is clicked
  function clearValues() {
    document.getElementById("companyName").value = "";
    document.getElementById("companyCode").value = "";
  }