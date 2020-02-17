<?php
        
        include '../db/database.php';
        
        $prodID = $_GET['prodID'];
        
        foreach ($prodID as $id) {
            $sql = "DELETE FROM product WHERE prodID='$id' ";
            $result = mysqli_query($link, $sql);
        }
        
        if ($result) {
            header('Content-Type: application/json');
            echo json_encode(array('status' => 'success','message' => 'ลบข้อมูลเรียบร้อยแล้ว'));
        } else {
            header('Content-Type: application/json');
            $errors = "เกิดข้อผิดพลาดในการบันทึก กรุณาลองใหม่ " . mysqli_error($link);
            echo json_encode(array('status' => 'danger','message' => $errors));
        }
        

