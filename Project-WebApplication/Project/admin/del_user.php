<?php
        
        include '../db/database.php';
        
        $id = $_GET['id'];
        
        //delete image
        $sql_img = "SELECT userPicture FROM user WHERE userID='$id'";
        $result_img = mysqli_query($link, $sql_img);
        $img_name = mysqli_fetch_row($result_img);
        @unlink('./dist/img/'.$img_name[0]);
        
        $sql = "DELETE FROM user WHERE userID='$id' ";
        
        $result = mysqli_query($link, $sql);
        
        if ($result) {
            header("Location: user.php");
        }
        

