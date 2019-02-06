<?php include "../../common.php" ?>
<!DOCTYPE html>
<html>

<head>
    <?php echo includeHelper("../../head.php"); ?>

    <title>Picktuber</title>
    <link rel="stylesheet" type="text/css" media="screen" href="youtuber.css" />

</head>

<body>
    <?php echo includeHelper("../../header.php");?>
    <!-- /////////////////////////////////////////////////-->
    <?php $subTitle="Youtuber"; include "../../sub-title.php" ?>
    
    <?php 
        $id = $_GET['id'];
    ?>
    <div class="content">
    <?php
        include "../../db_conn.php";

    $sql1 = "select * from youtuber where id=$id";
    $sql2 = "select * from youtuber_info where youtuber_id=$id";
    $sql3 = "select * from youtuber_sum where youtuber_id=$id";


    $result_base = mysqli_query($conn,$sql1);
    $result_info = mysqli_query($conn, $sql2);
    $result_sum = mysqli_query($conn, $sql3);
    

    // 한개의상의 레코드 있을 경우
    if($result_base&&mysqli_num_rows($result_base)!=0){ 
        $item = mysqli_fetch_assoc($result_base);
        $name = $item['name'];
        $detail = $item['detail'];

        $item = mysqli_fetch_assoc($result_sum);
        $tags = explode(",",$item['tags']);
        $point1 = $item['point1'];
        $point2 = $item['point2'];
        $point3 = $item['point3'];
        $point4 = $item['point4'];
        $point5 = $item['point5'];

    ?>
    <div class="profile clearfix">
        <h3 class="profile__name">
            <?php echo $name?>
        </h3><!--
    --><img class="profile__photo" src="https://via.placeholder.com/300"><!--
    --><div class="profile__right">
            <ul class="tag">
                <?php 
                    foreach($tags as $tag){
                        if("" != trim($tag)){
                            echo "<li class='tag__item'>$tag</li>";
                        }else{
                            echo "<li>등록된 태그가 없습니다</li>";
                        }
                    }
                ?>
            
            </ul>
            <div class="circle-component clearfix">
                <div class="circle-component__circle" data-value=<?php echo $point1?>>
                    <div class="circle-component__value"></div>
                </div>
                <div class="circle-component__title">
                    유머
                </div>
            </div>
            <div class="circle-component clearfix">
                <div class="circle-component__circle" data-value=<?php echo $point2?>>
                    <div class="circle-component__value"></div>
                </div>
                <div class="circle-component__title">
                    소통
                </div>
            </div>
            <div class="circle-component clearfix">
                <div class="circle-component__circle" data-value=<?php echo $point3?>>
                    <div class="circle-component__value"></div>
                </div>
                <div class="circle-component__title">
                    비주얼
                </div>
            </div>
            <div class="circle-component clearfix">
                <div class="circle-component__circle" data-value=<?php echo $point4?>>
                    <div class="circle-component__value"></div>
                </div>
                <div class="circle-component__title">
                    재능
                </div>
            </div>
            <div class="circle-component clearfix">
                <div class="circle-component__circle" data-value=<?php echo $point5?>>
                    <div class="circle-component__value"></div>
                </div>
                <div class="circle-component__title">
                    정보
                </div>
            </div>
        </div>

        <div class="profile__bottom">
            <div class="profile__info-area clearfix">
                <ul class="profile__info">
                    <?php 
                        while($row = mysqli_fetch_assoc($result_info)){
                            echo "<li class='profile__info-item'><a href='".$row['url']."' target='blank'>".$row['info']."</a></li>";
                        }
                    ?>
                </ul>
                <p class="profile__detail"><?php echo $detail ?></p>
            </div>
            <div class="profile__button-area">
                <a href="review.php" class="profile__button button button--point">평점 주기</a>
                <a href="#" class="profile__button button">정보 수정 요청</a>
            </div>
        </div>
    </div>
            
    <?php
    }else{
        echo "<div style='text-align:center'>잘못된 ID입니다.</div>";
    }
    mysqli_close($conn);
    ?>
    <section class="pick">
        <ul id="pick">

        </ul>
    </section>
    <a id="more_button" href="#" class="button more">더보기</a>
    </div>

    <!-- ///////////////////////////////////////////// -->
    <?php echo includeHelper("../../footer.php");?>
    
    <?php echo "<script>var id=$id;</script>"?>
    

    <script>
    $(function() {
        var offset = 0;
        var reviewCount = 0;

        showCircle(3000);
    
        $pickContainer = $("#pick");

        $("#more_button").on("click",function(e){
            e.preventDefault();
            getList();
        });
        
        function getList(){
            var ajaxData = {
                url:'youtuber_ajax.php',
                type:"get",
                data:"id="+id
            }

            if(offset>0){
                ajaxData.data = ajaxData.data + "&offset="+offset;
            }
            
            $.ajax(ajaxData).done(function(data){
                $("#pick").append(data);
                offset=offset+6;
                drawGraph();


                if($(".pick__item").length==reviewCount){
                    $("#more_button").css("display","none");
                }else{
                    reviewCount = $(".pick__item").length;
                }
            })
        }

        function drawGraph(){
            $('.point-data').each(function(index,elm){
                var $elm = $(elm);
                var value = $elm.attr("data-value");
                $elm.find(".point__item-value").text(value);
                $elm.find(".point__item-graph").css("width",value+"%");
            });
        }

        getList()
    });

    </script>
</body>

</html>