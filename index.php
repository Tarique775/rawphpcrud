<?php
include 'database.php';
$obj=new Database();
$obj->insertData("student",["id"=>1,"name"=>"torik","department"=>"cse","university"=>"aiub"]);
print_r($obj->getError());
?>