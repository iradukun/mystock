<?php
require_once '../bootstrap.php';
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
    $dept_id = $_POST['dept_id'];
    $email = $_POST['email'];
    

    require_once '../db.php';
    $sql = "SELECT * FROM `department` WHERE `dept_id` = '" . $dept_id ."'";
    $query = $conn->query($sql);
    

    if($query == true)
    {
        if($query->num_rows)
        {
            $row = $query->fetch_assoc();
            
            $otp = OTP::generate();
            $sql = " UPDATE `department` SET `password`='". $otp ."' WHERE `dept_id` = '" .$dept_id. "'";
            $query = $conn->query($sql);
            if($sql == true){
                $_SESSION['success'] = 'password updated <br> please note down the password : <span class=""><strong>'. $otp .'</strong><span>';
            
                header('location: ../forgot_pass.php');
            }

        }
        else
        {
            $_SESSION['error'] = ' Department Does not Exists!!';
            header('location: ../forgot_pass.php');
        }
    }
    else
    {
        $_SESSION['error'] = 'Something Went Wrong!!';
        header('location: ../forgot_pass.php');
    }

}
else
{
    $_SESSION['error'] = 'Something went wrong !!! try again later';
    header('location: ../forgot_pass.php');
}