<?php
    require_once '../bootstrap.php';
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
        $dept_id = $_POST['dept_id'];
        $dept_name = trim($_POST['dept_name']);
        $dept_details = trim($_POST['dept_details']);

    
        require_once '../db.php';
        $sql = " UPDATE `department` SET `dept_name` = '" .$dept_name. "', `dept_details` = '" .$dept_details. "' WHERE `department`.`dept_id` = '" .$dept_id. "'";
        $query = $conn->query($sql);
        

        if($query == true)
        {
            $_SESSION['success'] = 'department updated successfully';
    
            header('location: ../departments.php');
        }
        else
        {
            $_SESSION['error'] = 'Something went wrong while updating department';
        
            header('location: ../departments.php');
        }

    }
    else
    {
        $_SESSION['error'] = 'Something went wrong while updating item';
        header('location: ../departments.php');
    }
