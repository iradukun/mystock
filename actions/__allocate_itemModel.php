<?php
require_once '../bootstrap.php';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{

    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    $item_id = $_POST['item_id'];
    $dept_id = $_POST['dept_id'];


    require_once '../db.php';
    $sql = " UPDATE `item` SET `item`.`dept_id` = '" . $dept_id . "' WHERE `item`.`item_id` = '" .$item_id. "'";
    $query = $conn->query($sql);


    if($query == true)
    {
        $_SESSION['success'] = 'item allocated successfully';

    }

    else
    {
        $_SESSION['error'] = 'Something went wrong while allocating item';
    }


    header('location: ../allocate.php');




}
else
{
    $_SESSION['error'] = 'Something went wrong while allocating item';
    header('location: ../allocate.php');
}



