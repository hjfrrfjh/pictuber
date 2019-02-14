<?php 
    require '../../db_conn.php';
    class Model extends baseModel{
        function getBoardContent(){
            $sql = "SELECT * from view_board_talk_content where id=?";
            $id =!empty($_GET['id'])?$_GET['id']:"";
            
            if(empty($id)){ 
                return "";
            }

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetch(PDO::FETCH_OBJ);

            return $result;
        }

        function getComments(){
            $sql="select * from view_board_talk_comment where board_id=?";

            $id =!empty($_GET['id'])?$_GET['id']:"";
            
            if(empty($id)){ 
                return "";
            }
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);

            return $result;
        }

        function hit(){
            $sql = "update board_talk set hit= hit+1 where id=?";
            $result = $this->conn->prepare($sql)->execute([$_GET['id']]);
            return $result;
        }

        function insertBoard(){
            $sql = "insert into board_talk(user_id, subject, content) values(?, ?, ?)";
            $body = $_POST['body'];
            $subject = $_POST['subject'];
            $id = $_SESSION['id'];

            $returnValue = new stdClass();
            $returnValue->succeed=false;

            // 공백 체크
            if(empty($body)||empty($subject)||empty($id)){
                $returnValue->msg="공백 데이터가 입력되었습니다.";
                return $returnValue;
            }

            $result = $this->conn->prepare($sql)->execute([$id, $subject, $body]);

            // 쿼리 결과
            if(!$result){
                $returnValue->msg="쿼리 실패";
                return $returnValue;
            }

            $returnValue->succeed=true;  
                
            return $returnValue;
        }

        function getBoardList(){
            $sql = "SELECT * from view_board_talk_list";
            $sql2 = "SELECT count(*) AS count FROM board_talk";

            $scale= 20;

            $offset =!empty($_GET['offset'])?$_GET['offset']:"";
            $search = !empty($_GET['search'])?$_GET['search']:"";
            $id = !empty($_GET['id'])?$_GET['id']:"";

            // where 
            $conditions = [];
            $parameters = [];  
            if(!empty($search)){ 
                $conditions[] = "subject like ?";
                $parameters[] = "%$search%";
            }
            if($conditions){
                $sql .= " where ".implode(" AND ", $conditions);
            }

            // limit
            $sql .=" limit $scale";

            // offset
            if(!empty($offset)){ 
                $sql .= " offset ".($offset*$scale);
            }

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($parameters);
            $results = $stmt->fetchAll(PDO::FETCH_OBJ);

            
            foreach($results as $data){
                // URL 생성
                $url = "pages/talk/talk.php";
                $params=[];

                $params[]="id=$data->id";

                if(!empty($offset)){
                    $params[]="offset=$offset";
                }

                if(!empty($search)){
                    $params[]="search=$search";
                }

                if($params){
                    $url .= "?".implode("&", $params);
                }

                $data->link = $url;

                // 코멘트 null -> 0
                $data->comment_count = !empty($data->comment_count)?$data->comment_count:0;
                
                // 날짜 형식 변경
                $data->write_time = date("y/m/d", strtotime($data->write_time));
                
            }

            
            //sql2 where 
            if($conditions){
                $sql2 .= " where ".implode(" AND ", $conditions);
            }
            $stmt = $this->conn->prepare($sql2);
            $stmt->execute($parameters);
            $result = $stmt->fetch(PDO::FETCH_OBJ);

            
            $count = $result->count;

            $pageCount = ceil($count/$scale);
            $pages = [];

            for($i=0;$i<$pageCount;$i++){
                $page = new StdClass();
                $page->number = $i+1;

                $url = "pages/talk/talk.php?offset=".$i;

                if(!empty($search)){
                    $url .= "&search=$search";
                }
                $page->url = $url;
                $pages[] = $page;
            }

            $returnData = new stdClass();
            $returnData->data=$results;
            $returnData->nav=$pages;

            return $returnData;

        }

    }

    $model = new Model();

    // print_r($model->getBoardList());
    // print_r($model->getBoardList());
    // print_r($model->getBoardContent());
    // print_r($model->getComments());
?>