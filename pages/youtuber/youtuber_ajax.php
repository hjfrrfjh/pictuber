<?php
include "../../db_conn.php";
$testCount=0;
ob_start();

$offset = isset($_GET['offset'])?$_GET['offset']:"";

// $sql = "." limit 6";

$sql = "select * from youtuber_review join user on youtuber_review.user_id=user.id where youtuber_id=".$_GET['id']." limit 6";


if("" != trim($offset)){//조건 있을때
    $sql = $sql." offset ".$offset;    
}

echo $sql;
$result = mysqli_query($conn, $sql);

// 한개의상의 레코드 있을 경우
if($result&&mysqli_num_rows($result)!=0){ 
    while($row = mysqli_fetch_assoc($result)){
?>

<li class="pick__item card-base-deco">
    <div class="pick__item-body clearfix">
        <div class="pick__item-author"><?php echo $row['username'] ?></div>
        <p class="pick__item-text">
            <?php echo $row['detail'] ?>
            <p>
    </div>
    <div class="pick__item-point">
        <div class="point-row">
            <div class="point-col">영상미 </div>
            <div class="point-col point-data" data-value=<?php echo $row['point1'] ?>>
                <div class="point__item-graph"></div>
                <div class="point__item-value"></div>
            </div>
        </div>
        <div class="point-row">
            <div class="point-col">비주얼</div>
            <div class="point-col point-data" data-value=<?php echo $row['point2'] ?>>
                <div class="point__item-graph"></div>
                <div class="point__item-value"></div>
            </div>
        </div>
        <div class="point-row">
            <div class="point-col">재능</div>
            <div class="point-col point-data" data-value=<?php echo $row['point3'] ?>>
                <div class="point__item-graph"></div>
                <div class="point__item-value"></div>
            </div>
        </div>
        <div class="point-row">
            <div class="point-col">유머</div>
            <div class="point-col point-data" data-value=<?php echo $row['point4'] ?>>
                <div class="point__item-graph"></div>
                <div class="point__item-value"></div>
            </div>
        </div>
        <div class="point-row">
            <div class="point-col">소통</div>
            <div class="point-col point-data" data-value=<?php echo $row['point5'] ?>>
                <div class="point__item-graph"></div>
                <div class="point__item-value"></div>
            </div>
        </div>
    </div>
</li>
<?php
    }
}else{
    echo "<div style='text-align:center'>작성된 리뷰가 없습니다. ㅠ</div>";
}

$html = ob_get_contents();
if (ob_get_contents()) ob_end_clean();
echo $html;

mysqli_close($conn);

?>