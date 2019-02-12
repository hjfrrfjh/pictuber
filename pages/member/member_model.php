<?php 
    require '../../db_conn.php';
    class Model extends baseModel{
        function insertMember($type, $token, $username, $email){
            $returnValue = new stdClass();
            $returnValue->succeed=false;

            // 공백 체크
            if(empty($type)||empty($token)||empty($username)||empty($email)){
                $returnValue->msg="공백 데이터가 입력되었습니다.";
                return $returnValue;
            }
            
            //닉네임 체크
            //영문 또는 한글로 시작, 3글자 이상 10글자 이하
            if(!preg_match('/^([가-힣]|[a-zA-Z]){1}([가-힣]|[a-zA-Z]){2,9}$/u', $username)){
                $returnValue->msg="잘못된 닉네임 형식입니다.";
                return $returnValue;
            }

            // 메일 체크
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $returnValue->msg="잘못된 Email 형식입니다.";
                return $returnValue;
            }


            $sql = "insert into user (type, token, username, email) values (?, ?, ?, ?)";
            $result = $this->conn->prepare($sql)->execute([$type, $token, $username, $email]);
            
            // 쿼리 결과
            if(!$result){
                $returnValue->msg="잘못된 Email 형식입니다.";
                return $returnValue;
            }

            $returnValue->succeed=true;  
                
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