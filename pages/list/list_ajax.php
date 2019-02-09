<?php
include 'list_model.php';
ob_start();


$results = $model->getYoutuberList();
// echo $results;
foreach($results->data as $data){
?><li class="card-base-deco card">
    <div class="card__wraper">
        <div class="card__title">
            <?php echo $data->name ?>
        </div>
        <div class="card__body">
            <div class="card__tag-area"><?php 
                foreach($data->tags as $tag){
                    if(empty($tag)) continue;
                    echo "<a href='list.php?search=$tag' class='card__tag'>$tag</a>";
                }
            ?></div><img class="card__img" src="https://via.placeholder.com/80"><div class="card__circle">
                <div class="circle-component clearfix">
                    <div class="circle-component__circle" data-value="<?php echo $data->points[0]['point']?>">
                        <div class="circle-component__value"></div>
                    </div>
                    <div class="circle-component__title">
                        <?php echo $data->points[0]['name']?>
                    </div>
                </div>
            </div>
            <div class="card__point-area clearfix">
                <!--  -->
                <?php 
                $index = 0;
                foreach($data->points as $point){ 
                    $index++;
                    if($index==1) continue;
                    ?>
                <div class="card-point">
                    <div class="card-point__value"><?php echo $point['point']?></div>
                    <div class="card-point__name"><?php echo $point['name']?></div>
                </div>
                <?php } ?>
                <!--  -->
            </div>
            <div class="card__button-area">
                <a href="../youtuber/youtuber.php?id=<?php echo $data->id?>"
                    class="card__button button button--light">프로필</a>
                <a href="<?php echo $data->url?>" target="blank" class="card__button button button--light">채널이동</a>
            </div>
        </div>
    </div>
</li><?php }
$obj = new stdClass();
$obj->html = ob_get_clean();
$obj->more = $results->more;
echo json_encode($obj);
?>