<?php
include "../../db_conn.php";

ob_start();

$lastItem = $_POST['last_item'];
$where = $_POST['where'];

$sql = "select * from view_youtuber_list";


if("" != trim($where)){//조건 있을때
    $sql = $sql." ".$where;
}

$sql = $sql." limit 12 offset $lastItem";

$result = mysqli_query($conn, $sql);

function cmp($a, $b)
{
    return $a['point'] < $b['point'];
}

if($result){
    
    while($row = mysqli_fetch_assoc($result)){
        $list = array(   
            array('name'=>'정보', 'point'=>$row['point1']),
            array('name'=>'유머', 'point'=>$row['point2']),
            array('name'=>'비주얼', 'point'=>$row['point3']),
            array('name'=>'재능', 'point'=>$row['point4']),
            array('name'=>'소통', 'point'=>$row['point5'])
        );

        
        usort($list,"cmp");

        $tags = explode(",",$row['tags']);
        
?>
<li class="card-base-deco card">
    <div class="card__wraper">
        <div class="card__title">
            <?php echo $row['name']; ?>
        </div>
        <div class="card__body">
            <div class="card__tag-area"><?php for($i=0;$i<count(array_filter($tags));$i++){ ?><span class="card__tag"><?php echo $tags[$i]?></span><?php } ?>
            </div><img class="card__img" src="https://via.placeholder.com/80"><!--
            --><div class="card__circle">
                <div class="circle-component clearfix">
                    <div class="circle-component__circle" data-value="<?php echo $list[0]['point']?>">
                        <div class="circle-component__value"></div>
                    </div>
                    <div class="circle-component__title">
                        <?php echo $list[0]['name']?>
                    </div>
                </div>
            </div>
            <div class="card__point-area clearfix">
                <?php 
                    for($i=1;$i<5;$i++){
                        
                    ?>
                <div class="card-point">
                    <div class="card-point__value"><?php echo $list[$i]['point']?></div>
                    <div class="card-point__name"><?php echo $list[$i]['name']?></div>
                </div>

                <?php } ?>

            </div>
            <div class="card__button-area">
                <a href="../youtuber/youtuber.php?id=<?php echo $row['youtuber_id']?>" class="card__button button button--light">프로필</a>
                <a href="#" class="card__button button button--light">채널이동</a>
            </div>
        </div>
    </div>
</li>

<?php 
        $html = ob_get_contents();
        if (ob_get_contents()) ob_end_clean();
        echo $html;
    }

    // if(mysqli_num_rows($result)<12){
    //     echo "
    //     <script> $('.more').addClass('more--hidden');</script>
    //     ";
    // }else {
    //     echo "
    //     <script> $('.more').removeClass('more--hidden');</script>
    //     ";
    // }
}
mysqli_close($conn);
?>