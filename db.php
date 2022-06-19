<?php

error_reporting(0);
require_once 'bootstrap.php';

$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);


//check
if($conn->connect_error)
{
    
    die('Connection ERROR [' . $conn->connect_errno . ']:' . $conn->connect_error );
}

