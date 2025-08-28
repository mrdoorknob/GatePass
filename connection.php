<?php
    // Database Connection      
    $host = "localhost";  
    $user = "root";  
    $password = '';  
    $db_name = "gatepassdb";
    
    /*
    $host = "sql112.epizy.com";  
    $user = "epiz_31399905";  
    $password = 'ULDh5iagarubHc';  
    $db_name = "epiz_31399905_counteringdb"; */
      
    $conn = mysqli_connect($host, $user, $password, $db_name);  
    if(mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    }  
?>  