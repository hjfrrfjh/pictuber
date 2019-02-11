<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <base href="../../" target="_blank">
    <?php include "../../head.php" ?>
    <title>Picktuber</title>
    <link rel="stylesheet" type="text/css" media="screen" href="pages/youtuber/youtuber.css" />
</head>

<body>
    <?php include "../../header.php"?>
    <!-- /////////////////////////////////////////////////-->
    <?php $subTitle="Youtuber"; include "../../sub-title.php" ?>
    <?php include 'youtuber_model.php' ?>
    <?php 
        $id="";
        $id = !empty($_GET['id'])?$_GET['id']:"";

        

        $data = $model->getYoutuberInfo();

        if(empty($data)) finish_and_die("잘못된 ID입니다");

    ?>
    <div class="content">

        <div class="profile clearfix">
            <h3 class="profile__name">
                <?php echo $data->name?>
            </h3><img class="profile__photo" src="https://via.placeholder.com/300"><div class="profile__right">
                <ul class="tag">
                    <?php 
                    foreach($data->tags as $tag){
                        if("" != trim($tag)){
                            echo "<li class='tag__item'>$tag</li>";
                        }else{
                            echo "<li>등록된 태그가 없습니다</li>";
                        }
                    }
                ?>
                </ul>
                <div class="circle-component clearfix">
                    <div class="circle-component__circle" data-value=<?php echo $data->point1?>>
                        <div class="circle-component__value"></div>
                    </div>
                    <div class="circle-component__title">
                        유머
                    </div>
                </div>
                <div class="circle-component clearfix">
                    <div class="circle-component__circle" data-value=<?php echo $data->point2?>>
                        <div class="circle-component__value"></div>
                    </div>
                    <div class="circle-component__title">
                        소통
                    </div>
                </div>
                <div class="circle-component clearfix">
                    <div class="circle-component__circle" data-value=<?php echo $data->point3?>>
                        <div class="circle-component__value"></div>
                    </div>
                    <div class="circle-component__title">
                        비주얼
                    </div>
                </div>
                <div class="circle-component clearfix">
                    <div class="circle-component__circle" data-value=<?php echo $data->point4?>>
                        <div class="circle-component__value"></div>
                    </div>
                    <div class="circle-component__title">
                        재능
                    </div>
                </div>
                <div class="circle-component clearfix">
                    <div class="circle-component__circle" data-value=<?php echo $data->point5?>>
                        <div class="circle-component__value"></div>
                    </div>
                    <div class="circle-component__title">
                        정보
                    </div>
                </div>
            </div><div class="profile__bottom">
                <div class="profile__info-area clearfix">
                    <ul class="profile__info">
                        <?php 
                        echo "<li class='profile__info-item'><a href='$data->url' target='blank'>채널 주소 : $data->url</a></li>";    
                        foreach($data->info as $info){
                            echo "<li class='profile__info-item'><a ",
                            !empty($info->url)?"href='$info->url' target='blank'":"",
                            ">$info->info</a></li>";    
                        }
                    ?>
                    </ul>
                    <p class="profile__detail"><?php echo $data->detail ?></p>
                </div>
                <div class="profile__button-area">
                    <a href="/pages/youtuber/review.php" class="profile__button button button--point">평점 주기</a>
                    <a href="#" class="profile__button button">정보 수정 요청</a>
                </div>
            </div>
        </div>

        <section class="pick">
            <ul id="pick">
                <!-- ajax 데이터 -->
            </ul>
        </section>
        <a id="more_button" href="#" class="button more button--light">더보기</a>
    </div>
    <!-- ///////////////////////////////////////////// -->
    <?php include "../../footer.php"?>
    <?php 
    
    function finish_and_die($message) {
        echo "<div style='text-align:center'>$message</div>";
        include "../../footer.php";
        exit;
    }

    ?>

    <?php echo "<script>var id=$id;</script>"?>
    <script>
    $(function() {
        let offset = 0;
        showCircle(3000);

        $("#more_button").on("click", function(e) {
            offset = offset + 6;
            e.preventDefault();
            getReview();
        });

        function getReview() {

            $.ajax({
                url: 'pages/youtuber/youtuber_ajax.php',
                type: "get",
                data: {
                    id: id,
                    offset: offset
                }
            }).done(function(data) {
                data = JSON.parse(data);
                console.log(data.html);
                $("#pick").append(data.html);
                drawGraph();

                if (data.more) {
                    $("#more_button").css("display", "block");
                } else {
                    $("#more_button").css("display", "none");

                }
            })
        }

        function drawGraph() {
            $('.point-data').each(function(index, elm) {
                var $elm = $(elm);
                var value = $elm.attr("data-value");
                $elm.find(".point__item-value").text(value);
                $elm.find(".point__item-graph").css("width", value + "%");
            });
        }

        getReview();
    });
    </script>

</body>

</html>