<?php 
    require '../../db_conn.php';
    class Model extends baseModel{

        function getReviews(){
            $scale = 6;
            $sql = "SELECT * FROM youtuber_review JOIN user ON youtuber_review.user_id=user.id WHERE youtuber_id=? ORDER BY review_time LIMIT $scale";
            
            $id = !empty($_GET['id'])?$_GET['id']:"";

            // 아이디 없을경우 리턴
            if(empty($id)){
                return "";
            }

            if(!empty($_GET['offset'])){
                $sql .= " offset ".$_GET['offset'];    
            }

            $statement = $this->conn->prepare($sql);
            $statement->execute([$id]);
            $data = $statement->fetchAll(PDO::FETCH_OBJ);


            $returnData = new stdClass();
            $returnData->data = $data;
            $returnData->more = count($data)==$scale;

            return $returnData;
        }

        function insertReview(){
            // 리뷰 추가, 있을경우 업데이트
            $sql =" insert into youtuber_review (youtuber_id, user_id, point1, point2, point3, point4, point5, detail) 
            values (:youtuber_id, :user_id, :point1,:point2,:point3,:point4,:point5,:detail) 
            ON DUPLICATE KEY UPDATE point1=:point1, point2=:point2,point3=:point3,point4=:point4,point5=:point5, detail=:detail;";

            // 유투버 평균값 계산 -> youtuber_sum 테이블업데이트
            $sql2 = "UPDATE youtuber_sum, (
                select floor(avg(point1)) as point1,
                floor(avg(point2)) as point2,
                floor(avg(point3)) as point3,
                floor(avg(point4)) as point4,
                floor(avg(point5)) as point5
                  from youtuber_review where youtuber_id=:youtuber_id group by youtuber_id
                ) as data 
                SET 
                youtuber_sum.point1=data.point1, 
                youtuber_sum.point2=data.point2, 
                youtuber_sum.point3=data.point3, 
                youtuber_sum.point4=data.point4, 
                youtuber_sum.point5=data.point5
                where youtuber_sum.youtuber_id=:youtuber_id";

            $user_id = $_SESSION['id'];
            $youtuber_id = $_POST['youtuber_id'];
            $point1 = $_POST['point1'];
            $point2 = $_POST['point2'];
            $point3 = $_POST['point3'];
            $point4 = $_POST['point4'];
            $point5 = $_POST['point5'];
            $detail = $_POST['detail'];

            
            $returnValue = new StdClass();

            
            // 400점 넘었을때
            $sum = $point1+$point2+$point3+$point4+$point5;
            if($sum>400){
                $this->conn->rollBack();
                $returnValue->msg="리뷰 점수가 400점이 넘었습니다.($sum)";
                $returnValue->sucessed=false;
                return $returnValue;
            }


            //트랜잭션 시작
            $this->conn->beginTransaction();

            $statement = $this->conn->prepare($sql);
            $result = $statement->execute([
                ':youtuber_id'=>$youtuber_id,
                ':user_id'=>$user_id,
                ':point1'=>$point1,
                ':point2'=>$point2,
                ':point3'=>$point3,
                ':point4'=>$point4,
                ':point5'=>$point5,
                ':detail'=>$detail
                ]);
                
            //쿼리 실패시 롤백
            if(!$result){
                $this->conn->rollBack();
                $returnValue->msg="youtubr_review 테이블 업데이트 실패";
                $returnValue->sucessed=false;
                return $returnValue;
            }

            
            $statement = $this->conn->prepare($sql2);
            $result = $statement->execute([
                ':youtuber_id'=>$youtuber_id
            ]);
            
            //쿼리 실패시 롤백
            if(!$result){
                $this->conn->rollBack();
                $returnValue->msg="youtubr_sum 테이블 업데이트 실패";
                $returnValue->sucessed=false;
                return $returnValue;
            }

            //커밋
            $this->conn->commit();

            $returnValue = new stdClass();
            $returnValue->sucessed = true;
            
            return $returnValue;
        }


        function getYoutuberInfo(){
            $sql1 = "SELECT * FROM youtuber WHERE id=?";
            $sql2 = "SELECT * FROM youtuber_info WHERE youtuber_id=?";
            $sql3 = "SELECT * FROM youtuber_sum WHERE youtuber_id=?";

            $id = isset($_GET['id'])?$_GET['id']:"";
            
            if(empty($id)) return ""; //ID가 없을경우 공백리턴
            
            // sql1
            $data = new stdClass();
            $statement = $this->conn->prepare($sql1);
            $statement->execute([$id]);
            if($statement->rowCount()==0){
                return "";
            }
            $result = $statement->fetch(PDO::FETCH_OBJ);
            
            
            $data->name=$result->name;
            $data->detail=$result->detail;
            $data->url=$result->url;
            $data->img_url=$result->img_url;
            // sql2
            $statement = $this->conn->prepare($sql2);
            $statement->execute([$id]);
            $result = $statement->fetchAll(PDO::FETCH_OBJ);

            $data->info=$result;

            // sql3
            $statement = $this->conn->prepare($sql3);
            $statement->execute([$id]);
            $result=$statement->fetch(PDO::FETCH_OBJ);

            $data->tags = explode(",",$result->tags);
            $data->point1 = $result->point1;
            $data->point2 = $result->point2;
            $data->point3 = $result->point3;
            $data->point4 = $result->point4;
            $data->point5 = $result->point5;

            return $data;
        }

    }
    $model = new Model();

    // print_r($model->getReviews());
    // print_r($model->getYoutuberInfo());
?>
