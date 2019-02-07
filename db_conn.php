<?php
class baseModel {
    protected $conn;

    public function __construct() {
        $this->conn=new PDO('mysql:host=localhost;dbname=picktuber;charset=utf8', 'root', '1234');
    }
}
?>
