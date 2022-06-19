<?php
require_once '../bootstrap.php';
LogInCheck();

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
    $supplier_name = trim($_POST['supplier_name']);
    $supplier_details = trim($_POST['supplier_details']);


    require_once '../db.php';
    $sql = "INSERT INTO `supplier` (`supplier_name`, `supplier_details`, `added_at`) VALUES ('" . $supplier_name . "',' " . $supplier_details . "', CURDATE())";
    $query = $conn->query($sql);
    

    if($query == true)
    {
        $_SESSION['success'] = 'supplier added successfully';
        
        header('location: ../suppliers.php');
    }
    else
    {
        $_SESSION['error'] = 'Something went wrong while adding supplier department';
    
        header('location: ../suppliers.php');
    }

}
else
{
    $_SESSION['error'] = 'Something went wrong while adding supplier';
    header('location: ../suppliers.php');
}
