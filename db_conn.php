<?php
class baseModel {
    protected $conn;

    public function __construct() {
        $this->conn=new PDO('mysql:host=localhost;dbname=picktuber;charset=utf8', 'root', '1234');
    }

   protected function query($str){
        return $this->conn->query($str);
   }

   protected function quote($str){
       return $this->conn->quote($str);
   }
}
?>
