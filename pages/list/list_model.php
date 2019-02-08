<?php 
    require '../../db_conn.php';
    class Model extends baseModel{
        private $more=true;

        public function getTopTags(){
            $statement = $this->query("SELECT * FROM view_top_tag LIMIT 7");
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return $result;
        }

        public function getYoutuberList(){
            // 한번에 보여줄 유투버 수
            $scale = 12;
            
            // base SQL
            $sql = "SELECT * FROM view_youtuber_list";
            
            // where tag
            $conditions = [];
            
            if (!empty($_GET['tags'])){
                foreach($_GET['tags'] as $tag){
                    $conditions[] = 'tags like '.$this->quote("%".$tag."%");
                }
            }

            // where search
            if (!empty($_GET['search'])){
                $word = $this->quote("%".$_GET['search']."%");
                $conditions[] = "(tags like ".$word." or name like ".$word.")";
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
            // order by id desc

            // limit
            $sql = $sql." limit $scale";
            
            // offset
            if (!empty($_GET['offset']))
            {
                $sql = $sql." offset ".$_GET['offset']*$scale;
            }

            // query
            $statement = $this->conn->query($sql);

            // return data
            $data = array();

            // 점수 정렬
            function cmp($a, $b)
            {
                return $a['point'] < $b['point'];
            }

            while($result = $statement->fetch(PDO::FETCH_OBJ)){
                $obj = new stdClass();
                $obj->name = $result->name;
                $obj->id = $result->youtuber_id;
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
                array_push($data,$obj);
            }
            $this->more = count($data)==$scale; 
            return $data;
            
        }

        public function hasMore(){
            return $this->more;
        }
    }

    $model = new Model();

    // print_r($model->getYoutuberList());
    // print_r($model->getTopTags());
?>