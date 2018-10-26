<?php
    class SQLHelper{
        private $con;
        private $result;
        private $table;
        public function __construct($host, $user, $password, $database, $table){
            $this->con=mysqli_connect($host, $user, $password, $database);
            $this->table = $table;
        }
        public function executeQuery($query){
            mysqli_query($this->con, $query);
            $r = mysqli_affected_rows($this->con);
            return $r;
        }
        public function getData($query){
            $this->result = mysqli_query($this->con, $query);
            return $this->result;
        }
        public function getError(){
            return $this->con->errno;
        }
        public function authenticateUser($u,$p){
            $auth=mysqli_query($this->con, "SELECT * FROM ".$this->table." WHERE email='$u' and password='$p'");
            $cnt=mysqli_num_rows($auth);
            if($cnt>0){
                //$row=mysql_fetch_array($auth);
                $st=1;
            }
            else
                $st=0;
            return $st;
        }
        public function getUserName($id){
            $mres=mysqli_query($this->con, "SELECT name FROM ".$this->table." WHERE email='$id'");
            $row=mysqli_fetch_array($mres);
            $nm=$row[0];
            return $nm;
        }
        public function getColumn($col,$cond,$val){
            $nres=mysqli_query($this->con, "SELECT ".$col." FROM ".$this->table." WHERE ".$cond."=\"".$val."\";");
            $row=mysqli_fetch_array($nres);
            $res=$row[0];
            return $res;
        }
        public function __destruct(){
            mysqli_close($this->con);
        }
    }
?>
