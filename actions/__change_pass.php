<?php
require_once '../bootstrap.php';
LogInCheck();

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $dept_id = $_SESSION['dept_id'];

    require_once '../db.php';
    $sql = "SELECT * FROM `department` WHERE `dept_id` = '" . $dept_id ."'";
    $query = $conn->query($sql);
    
    if($query == true) {
        $row = $query->fetch_assoc();
        
        if($_POST['pass'] == $row['password'])
        {
            if($_POST['new_pass'] == $_POST['con_pass'])
            {
                $new_pass = $_POST['new_pass'];
            
                $sql = " UPDATE `department` SET `password` = '" . $new_pass . "' WHERE `department`.`dept_id` = '" . $_SESSION['dept_id'] . "'";
                $query = $conn->query($sql);
                

                if ($query == true) {
                    $_SESSION['success'] = 'password changed successfully';
                    
                    header('location: ../admin_home.php');
                }
                else
                {
                    $_SESSION['error'] = 'Something went wrong while changing password';
                    header('location: ../change_pass.php');
                }
            }
            else
            {
                $_SESSION['error'] = 'password didnot matched !!!';
                header('location: ../change_pass.php');

            }

        }

        else
        {
            $_SESSION['error'] = 'provide correct password';
            header('location: ../change_pass.php');
        }


    }
}
else
{
    $_SESSION['error'] = 'Something went wrong while changing password !!! try again later';
    header('location: ../change_pass.php');
}