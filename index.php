<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type:application/json;charset=utf8");
require_once 'config/database.php';
require_once 'Helper/mHelper.php';
$db=new Database();
$returnArray=[];

$mode=$_GET['mode'];
$process=$_GET['process'];


$path='Api/'.$mode.'/'.$process.'.php';

    if(file_exists($path)){
        require_once('Api/'.$mode.'/'.$process.'.php');
        echo json_encode($returnArray);
    }
    else{
        die("Page is Not Found");
    }

?>