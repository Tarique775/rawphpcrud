<?php
include 'database.php';
$obj=new Database();
// $obj->insertData("student",["id"=>1,"student_name"=>"torik","age"=>25,"department"=>"cse","university"=>"aiub","city"=>"dhaka"]);
//$obj->updateData("student",["city"=>"dhaka","department"=>"cis"],"id=4");
// $obj->deleteData("student","id=1");
echo "result=>><br/>";
var_dump($obj->getResult());
?>