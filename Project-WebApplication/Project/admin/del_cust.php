<?php
        
        include '../db/database.php';
        
        $id = $_GET['id'];
        
        $sql = "DELETE FROM customer WHERE custID='$id' ";
        
        $result = mysqli_query($link, $sql);
        
        if ($result) {
            header("Location: customer.php");
        }
        
