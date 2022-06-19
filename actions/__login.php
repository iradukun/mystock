<?php
require_once '../bootstrap.php';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    
    if(!(Token::verify($_POST['token'])))
    {
        $_SESSION['error'] = 'Session Has Expired!!!';
        header('location: ../index.php');
    }

    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    $_id = $_POST['id'];
    $_password = $_POST['password'];

    require_once '../db.php';
    $sql = "SELECT * FROM  `department` WHERE `dept_id`='" . $_id . "' AND `password`='" . $_password . "'";

    $result = $conn->query($sql);
    
    if($result == true)
    {
        if(!($result->num_rows == 1)) {
            $_SESSION['error'] = 'Wrong Credentials !!!';
            header('location: ../index.php');
        }
        else
        {
            
            $row = $result->fetch_assoc();
            if($row['role'] == 1)
            {

                $_SESSION['dept_name'] = 'ADMIN';
                $_SESSION['dept_id'] = $row['dept_id'];
                $_SESSION['role'] = 'admin';
                $_SESSION['success'] = 'welcome ' . $row['dept_name'] . ' to admin home page';
                header('location: ../admin_home.php');
            }
            else
            {
                $_SESSION['dept_name'] = $row['dept_name'];
                $_SESSION['dept_id'] = $row['dept_id'];
                $_SESSION['role'] = 'dept';
                $_SESSION['success'] = 'welcome ' . $row['dept_name'] . ' to depeartmental home page';

                header('location: ../admin_home.php');
            }
        }
    }
    $conn->close();
}
else
{
    $_SESSION['error'] = 'Something went wrong';
    header('location: ../index.php');
}
