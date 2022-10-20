<?php
     class Database{
        private $db_host="localhost";
        private $db_user="root";
        private $db_password="";
        private $db_name="crudoop";

        private $mysqli="";
        private $result=array();
        private $conn=false;

        public function __construct(){
            if(!$this->conn){
                $this->mysqli=new mysqli($this->db_host,$this->db_user,$this->db_password,$this->db_name);
                $this->conn=true;
                //connection error
                if($this->mysqli->connect_error){
                    array_push($this->result,$this->mysqli->connect_error);
                    return false;
                }
                echo"database connected<br/>";
            }else{
                return true;

            }
            
        }

        //INSERT DATA INTO DATABASE
        public function insertData($table,$params=array()){
            //table exists or not checking
            if($this->tableExists($table)){
                //print_r($params);
                //echo $table;
                //CONVERT AN ARRAY TO STRING
                $table_Keys=implode(', ',array_keys($params));
                $table_Values=implode("', '",$params);

                $sql="INSERT INTO $table ($table_Keys) VALUES ('$table_Values')";

                if($this->mysqli->query($sql)){
                    array_push($this->result,$this->mysqli->insert_id);
                    //echo "congratulation you done it";
                    return true;
                }else{
                    array_push($this->result,$this->mysqli->error);
                    //echo"not insert";
                    return true;
                }
               
            }else{
                //echo"table not exists";
                return false;
            }
        }

        //UPDATE DATA INTO DATABASE
        public function updateData($table,$params=array(),$where){
            //table exists or not checking
            if($this->tableExists($table)){
                $key_values=array();
                foreach($params as $key => $value){
                    array_push($key_values,"$key='$value'");
                }
                print_r($key_values);
                echo "<br/>";
                // //CONVERT AN ARRAY TO STRING
                $implodeData=implode(", ",$key_values);
                
                // $table_Keys=implode(", ",array_keys($params));
                // $table_Values=implode(", ",$params);

                echo $sql="UPDATE $table SET $implodeData where $where";
                echo"<br/>";

                if($this->mysqli->query($sql)){
                    array_push($this->result,$this->mysqli->affected_rows);
                    return true;
                }else{
                    array_push($this->result,$this->mysqli->error);
                    return false;
                }
            }else{
                return false;
            }
        }

        //DELETE DATA INTO DATABASE
        public function deleteData($table,$where){
            //table exists or not checking
            if($this->tableExists($table)){
                echo $sql="DELETE FROM $table where $where";

                if($this->mysqli->query($sql)){
                    array_push($this->result,$this->mysqli->affected_rows);
                    return true;
                }else{
                    array_push($this->result,$this->mysqli->error);
                    return false;
                }
            }else{
                return false;
            }
        }

        //does table exists or not
        private function tableExists($table){
            echo $sql="SHOW TABLES FROM $this->db_name LIKE '$table'";
            echo"<br/>";
            $tableInsideDB=$this->mysqli->query($sql);
            if($tableInsideDB){
                if($tableInsideDB->num_rows > 0){
                    return true;
                    // echo("get the row");
                }else{
                    array_push($this->result,$table." table name does not exites!");
                    return false;
                    //echo("table name does not exites");
                }
            }    
        }
        //ALL THE RESULT SHOWCASE
        public function getResult(){
            $val=$this->result;
            $this->result=array();
            return $val;
        }
        //close connection
        public function __distruct(){
            if($this->conn){
                if($this->mysqli->close()){
                    $this->conn=false;
                    return true;
                };
            }else{
                return false;
            }
        }
    }
?>