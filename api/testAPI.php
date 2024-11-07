<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    error_log("You messed up!\r\n", 3, "../logs/error_logs.log");
    exit;
}
?>