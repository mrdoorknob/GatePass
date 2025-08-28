function validateForm() {
    var supplierName = document.forms["transactionForm"]["supplierName"].value;
    var branchName = document.forms["transactionForm"]["branchName"].value;


    if (supplierName == "" && branchName == "") {
        window.alert("Supplier Name and Branch Name is empty.");
        return false;
    }
    else if (branchName == ""){
        window.alert("Branch Name is empty.");
        return false;
    }
    else if (supplierName == ""){
        window.alert("Supplier Name is empty.");
        return false;
    }
}