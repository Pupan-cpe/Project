<?php
    include '../db/database.php';
    
    $userName = mysqli_real_escape_string($link,$_POST['userName']);
    $userPassword = mysqli_real_escape_string($link,$_POST['userPassword']);
    
    //$salt = 'tikde78uj4ujuhlaoikiksakeidke';
	$salt = 'tyidi3idkdislsoskdisli333lidk';
    $hash_login_password = hash_hmac('sha256', $userPassword, $salt);
    
    $sql = "SELECT * FROM user WHERE (userName=? AND userPassword=?)";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $userName,$hash_login_password);
    mysqli_stmt_execute($stmt);
    $result_user = mysqli_stmt_get_result($stmt);
    if($result_user->num_rows == 1){
        session_start();
        $row_user = mysqli_fetch_array($result_user, MYSQLI_ASSOC);
        $_SESSION['userID'] = $row_user['userID'];
        $_SESSION['userName'] = $row_user['userName'];
        header('Content-Type: application/json');
        echo json_encode(array('status' => 'success'));
    } else {
        header('Content-Type: application/json');
        $errors = "Username หรือ Password ไม่ถูกต้อง" . mysqli_error($link);
        echo json_encode(array('status' => 'danger','message' => $errors));
    }
    
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($link);