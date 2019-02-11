<?php 
    require '../../db_conn.php';
    class Model extends baseModel{
        function insertMember($type, $token, $username, $email){
            $sql = "insert into user (type, token, username, email) values (?, ?, ?, ?)";
            $result = $this->conn->prepare($sql)->execute([$type, $token, $username, $email]);
            return $result;
        }

        function getMemberInfo($type,$token){
            $sql = "select * from user where type=? and token=?";
            $statement = $this->conn->prepare($sql);
            $statement->execute([$type,$token]);
            $result = $statement->fetch(PDO::FETCH_OBJ);

            return $result;
        }

        
    }
    $model = new Model();
?>