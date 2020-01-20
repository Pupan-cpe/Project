<?php
        
        include '../db/database.php';
        
        $custUsername = $_GET['custUsername'];
        
        $sql = "SELECT custID FROM customer WHERE custUsername='$custUsername'";
        $result = mysqli_query($link, $sql);
        $row = mysqli_num_rows($result);
        
        if ($row == 1) {
            header('Content-Type: application/json');
            echo json_encode(array('status' => 'active','message' => 'Username นี้มีคนใช้แล้ว!'));
        }
        

