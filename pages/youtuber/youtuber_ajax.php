<?php
include 'youtuber_model.php';

$result = $model->getReviews();

if(empty($result)){
    echo "";
    exit;
}

ob_start();

foreach($result->data as $data){
?>
<li class="pick__item card-base-deco">
    <div class="pick__item-body clearfix">
        <div class="pick__item-author"><?php echo $data->username ?></div>
        <p class="pick__item-text clamp">
            <?php echo $data->detail ?>
            </p>
    </div>
    <div class="pick__item-point">
        <div class="point-row">
            <div class="point-col">정보 </div>
            <div class="point-col point-data" data-value=<?php echo $data->point1 ?>>
                <div class="point__item-graph"></div>
                <div class="point__item-value"></div>
            </div>
        </div>
        <div class="point-row">
            <div class="point-col">유머</div>
            <div class="point-col point-data" data-value=<?php echo $data->point2 ?>>
                <div class="point__item-graph"></div>
                <div class="point__item-value"></div>
            </div>
        </div>
        <div class="point-row">
            <div class="point-col">비주얼</div>
            <div class="point-col point-data" data-value=<?php echo $data->point3 ?>>
                <div class="point__item-graph"></div>
                <div class="point__item-value"></div>
            </div>
        </div>
        <div class="point-row">
            <div class="point-col">재능</div>
            <div class="point-col point-data" data-value=<?php echo $data->point4 ?>>
                <div class="point__item-graph"></div>
                <div class="point__item-value"></div>
            </div>
        </div>
        <div class="point-row">
            <div class="point-col">소통</div>
            <div class="point-col point-data" data-value=<?php echo $data->point5 ?>>
                <div class="point__item-graph"></div>
                <div class="point__item-value"></div>
            </div>
        </div>
    </div>
</li>
<?php
}
$response = new stdClass();
$response->html = ob_get_clean();
$response->more = $result->more;
echo json_encode($response);

?>