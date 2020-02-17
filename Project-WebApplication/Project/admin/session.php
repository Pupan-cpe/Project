<?php
        session_start();
        if (!isset($_SESSION['userID'])) {
            header("Location: login.php");
        }
        include '../db/database.php';
        
        $session_userID= $_SESSION['userID'];
        
        $qry_user = "SELECT * FROM user WHERE userID='$session_userID'";
        $result_user = mysqli_query($link,$qry_user);
        if ($result_user) {
            $row_user = mysqli_fetch_array($result_user,MYSQLI_ASSOC);
            
            $s_userFullname = $row_user['userFullname'];
            $s_userPicture = $row_user['userPicture'];
            
            $s_admin = $row_user['userName'];
            
           
            mysqli_free_result($result_user);
        }