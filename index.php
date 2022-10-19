<?php
include 'database.php';
$obj=new Database();
$obj->insertData("student",["name"=>"torik","age"=>"26","city"=>"dhaka"]);
?>