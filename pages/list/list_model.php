<?php 
    require '../../db_conn.php';
    class Model extends baseModel{
        public function getTopTags(){
                $sql = "SELECT * FROM view_top_tag LIMIT 7";
                $statement = $this->conn->prepare($sql);
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return $result;
        }

        public function getYoutuberList(){
            $sql = "SELECT * FROM view_youtuber_list";

            // 한번에 보여줄 유투버 수
            $scale = 12;
            
            // where tag
            $conditions = [];
            $parameters = [];            
            if (!empty($_GET['tags'])){
                foreach($_GET['tags'] as $tag){
                    $conditions[] = ' tags like ?';
                    $parameters[] = "%$tag%";
                }
            }
            // where search
            if (!empty($_GET['search'])){
                $conditions[] = " (tags like ? or name like ?)";
                $parameters[] = "%".$_GET['search']."%";
                $parameters[] = "%".$_GET['search']."%";
            }
            if($conditions){
                $sql .= " where ".implode(" AND ", $conditions);
            }

            //order by 
            if (!empty($_GET['order'])){
                $targetPoint = $_GET['order'];
                if($targetPoint=="정보"){
                    $targetPoint = "point1";
                }else if($targetPoint=="유머"){
                    $targetPoint = "point2";
                }else if($targetPoint=="비주얼"){
                    $targetPoint = "point3";
                }else if($targetPoint=="재능"){
                    $targetPoint = "point4";
                }else if($targetPoint=="소통"){
                    $targetPoint = "point5";
                }else{
                    $targetPoint = "point1";
                }

                $sql .=" order by $targetPoint desc";
            }

            // limit
            $sql = $sql." limit $scale";

            // offset
            if (!empty($_GET['offset']))
            {
                $sql = $sql." offset ".$_GET['offset']*$scale;
            }

            $statement = $this->conn->prepare($sql);
            $statement->execute($parameters);

            $data = array();

            // 점수 정렬 비교함수
            function cmp($a, $b)
            {
                return $a['point'] < $b['point'];
            }

            while($result = $statement->fetch(PDO::FETCH_OBJ)){
                $obj = new stdClass();
                $obj->name = $result->name;
                $obj->id = $result->id;
                $list = array(
                    array('name'=>'정보', 'point'=>$result->point1),
                    array('name'=>'유머', 'point'=>$result->point2),
                    array('name'=>'비주얼', 'point'=>$result->point3),
                    array('name'=>'재능', 'point'=>$result->point4),
                    array('name'=>'소통', 'point'=>$result->point5)
                );
                usort($list,"cmp");
                
                $obj->tags = explode(",",$result->tags);   
                $obj->points=$list;
                $obj->url=$result->url;
                $obj->img_url=$result->img_url;
                array_push($data,$obj);
            }

            $returnData = new stdClass();
            $returnData->data = $data;
            $returnData->more = count($data)==$scale;

            return $returnData;
        }

        function insertYoutuber(){
            // AUTO INCREASE 다음 번호 받아오기
            $sql = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'picktuber' AND TABLE_NAME = 'youtuber'";
            //중복 체크
            $sql2 = "SELECT id from youtuber where youtube_id= ?";
            // youtuber 테이블
            $sql3 = "INSERT into youtuber (name, detail, url, img_url, youtube_id) values(?, ?, ?, ?, ?)";
            //youtuber_tag 테이블
            $sql4 = "INSERT into youtuber_tag (youtuber_id, tag) values(?, ?)";
            
            //youtuber_sum 테이블
            $sql5 = "INSERT into youtuber_sum (youtuber_id, point1, point2, point3, point4, point5,tags) values(?, 0, 0, 0, 0, 0, ?);";

            

            $url = $_POST['url'];
            $name=$_POST['name'];
            $imgUrl = $_POST['img_url'];
            $desc = $_POST['desc'];

            $youtube_id = $_POST['id'];

            $tags = $_POST['tag'];
            $returnValue = new stdClass();
            $returnValue->succeed=false;

            // 공백 체크
            if(empty($url)||empty($name)||empty($imgUrl)||empty($tags)){
                $returnValue->msg="공백 데이터가 입력되었습니다.";
                return $returnValue;
            }

            //트랜잭션 시작
            $this->conn->beginTransaction();

            // 다음 id 얻기
            $statement = $this->conn->prepare($sql);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_OBJ);
            $id = $result->AUTO_INCREMENT;

            if(!$result){
                $returnValue->msg="ID 얻기 쿼리 실패";
                $this->conn->rollBack();
                return $returnValue;
            }

            $statement = $this->conn->prepare($sql2);
            $statement->execute([$youtube_id]);

            if($statement->rowCount()!=0){
                $returnValue->msg="이미 존재하는 유투버입니다.";
                $this->conn->rollBack();
                return $returnValue;
            }


            //유투버 테이블 insert
            $statement = $this->conn->prepare($sql3);
            $result = $statement->execute([$name,$desc,$url,$imgUrl,$youtube_id]);
            // return [$name,$desc,$url,$imgUrl,$youtube_id];
            if(!$result){
                $returnValue->msg="유튜브 추가 쿼리 실패";
                $this->conn->rollBack();
                return $returnValue;
            }

            //태그들 insert
            
            $statement = $this->conn->prepare($sql4);
            foreach($tags as $tag){
                $result = $statement->execute([$id,$tag]);
                if(!$result){
                    $returnValue->msg="태그 추가 쿼리 실패";
                    $this->conn->rollBack();
                    return $returnValue;
                }
            }
            
            
            $tags_string = implode( ',', $tags );
            $statement = $this->conn->prepare($sql5);
            $result = $statement->execute([$id,$tags_string]);

            if(!$result){
                $returnValue->msg="유튜브_SUM  쿼리 실패";
                $this->conn->rollBack();
                return $returnValue;
            }

            $returnValue->succeed=true;
            $returnValue->id=$id;

            //커밋
            $this->conn->commit();

            return $returnValue;
        }
    }

    $model = new Model();

    // print_r($model->getYoutuberList());
    // print_r($model->getTopTags());
?>