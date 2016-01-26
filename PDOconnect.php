<?php
require_once("PdoDB.php");
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "testblog";
$tblname = users;

$isrt = new PdoDB($servername, $dbname, $username, $password);
$arg = array( 'username' => 'DDDXXXXmonkey',
              'password' => '123456',
              'email' => 'deamonkey@gmail.com');
$setArg = ['username' => 'DDDmonkey'];
$whereArg = ['user_id'=>1];
// $isrt->insertDB($tblname, $arg);
$isrt->deleteDB($tblname, ['user_id'=>'9']);
 ?>
