<?php
    class Database{
        private $db_host="localhost";
        private $db_user="root";
        private $db_password="";
        private $db_name="crudoop1";

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
                echo"database connected";
            }else{
                return true;

            }
            
        }

        //INSERT DATA INTO DATABASE
        public function insertData($table,$params=array()){
            if($this->tableExists($table)){
                //print_r($params);
                //echo $table;
                $table_Keys=implode(', ',array_keys($params));
                $table_Values=implode("', '",$params);

                $sql="INSERT INTO $table ($table_Keys) VALUES ('$table_Values')";

                if($this->mysqli->query($sql)){
                    array_push($this->result,$this->mysqli->insert_id);
                    echo "yeah";
                   // return true;
                }else{
                    array_push($this->result,$this->mysqli->error);
                    echo"not insert";
                    //return true;
                }
               
            }else{
                echo"table not exists";
                //return false;
            }
        }

        // //UPDATE DATA INTO DATABASE
        // public function updateData(){}

        //   //DELETE DATA INTO DATABASE
        // public function insertData(){}

        //does table exists or not
        private function tableExists($table){
            $sql="SHOW TABLES FROM $this->db_name LIKE '$table'";
            $tableInsideDB=$this->mysqli->query($sql);
            if($tableInsideDB){
                if($tableInsideDB->num_rows > 0){
                    return true;
                    // echo("get the row");
                }else{
                    array_push($this->result,$table." table name does not exites!");
                    //return false;
                    echo("table name does not exites");
                }
            }    
        }

        public function getError(){
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