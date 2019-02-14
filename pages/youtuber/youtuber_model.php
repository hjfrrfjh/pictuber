<?php 
    require '../../db_conn.php';
    class Model extends baseModel{

        function getReviews(){
            $scale = 6;
            $sql = "SELECT * FROM youtuber_review JOIN user ON youtuber_review.user_id=user.id WHERE youtuber_id=? LIMIT $scale";
            
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
