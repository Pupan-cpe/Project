<?php
    
        include '../db/database.php';
        

        $customer_id= $_GET['customer_id'];
        
        
        $qry_id = "SELECT * FROM customer WHERE custID ='$customer_id'";
        $result_id = mysqli_query($link,$qry_id);
        if ($result_id) {
            $row_id = mysqli_fetch_array($result_id,MYSQLI_ASSOC);
           
         
            $customer_id = $row_id['custID'];
            
            mysqli_free_result($result_id);
        }
?>