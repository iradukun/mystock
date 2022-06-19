<?php

function LogInCheck()
{
   
    if(!isset($_SESSION['dept_id'])){
        $_SESSION['error'] = 'please log in first';
        header('location: http://localhost/sms/');
    }
}
