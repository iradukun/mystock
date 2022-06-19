<?php
require_once '../bootstrap.php';
    
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    $supplier_id = $_POST['supplier_id'];
    $supplier_name = trim($_POST['supplier_name']);
    $supplier_details = trim($_POST['supplier_details']);

    require_once '../db.php';
    $sql = " UPDATE `supplier` SET `supplier_name` = '" . $supplier_name. "', `supplier_details` = '" .$supplier_details. "' WHERE `supplier`.`supplier_id` = '" .$supplier_id. "'";
    $query = $conn->query($sql);


    if($query == true)
    {
        $_SESSION['success'] = 'supplier updated successfully';
    }
    else
    {
        $_SESSION['error'] = 'Something went wrong while updating supplier';
    }

    
    header('location: ../suppliers.php');
}
else
{
    $_SESSION['error'] = 'Something went wrong while updating item';
    header('location: ../suppliers.php');
}
