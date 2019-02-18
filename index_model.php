<?php 
    require 'db_conn.php';
    class Model extends baseModel{

        function getLastestPick(){
        
            $statement = $this->conn->query("select * from view_latest_review ORDER by review_time desc LIMIT 4");
        
            $data = array();
        
            function cmp($a, $b)
            {
                return $a['point'] < $b['point'];
            }
        
            while($result = $statement->fetch(PDO::FETCH_OBJ)){
                $obj = new stdClass();
                $obj->youtuber_id=$result->youtuber_id;
                $obj->user_id=$result->user_id;
                $obj->youtuber_name=$result->youtuber_name;
                $obj->user_name=$result->user_name;
                // 높은 점수 순으로 정렬
                $list = array(
                    array('name'=>'정보', 'point'=>$result->point1),
                    array('name'=>'유머', 'point'=>$result->point2),
                    array('name'=>'비주얼', 'point'=>$result->point3),
                    array('name'=>'재능', 'point'=>$result->point4),
                    array('name'=>'소통', 'point'=>$result->point5)
                );
                usort($list,"cmp");
            
                $obj->points=$list;
                $obj->detail=$result->detail;
                $obj->url=$result->url;
                array_push($data,$obj);   
            }
            
            return $data;
        }
        
        
        function getLatestTalk(){
        
            $statement = $this->conn->query("select * from board_talk order by id desc LIMIT 9");
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
        
            foreach($result as $row){
                $row->write_time = date("y/m/d", strtotime($row->write_time));
            }
            
        
            return $result;
        }
    }

    $model = new Model();
?>