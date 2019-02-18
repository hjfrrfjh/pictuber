<?php session_start(); ?>
<!DOCTYPE html>
<html id="html" style="opacity: 1">

<head>
    <?php include "head.php" ?>
    <title>Picktuber</title>
    <link rel="stylesheet" type="text/css" media="screen" href="lib/slick/slick.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="index.css" />
    <script src="lib/slick/slick.min.js"></script>
    <script src="lib/ellipsis.min.js"></script>
</head>

<body>
    <?php include "header.php"?>

    <?php 
    include "index_model.php";
    ?>

    <div class="top-banner">
        <ul class="slide">
            <li class="slide__item slide1">
                <div class="slide__content-wrapper">
                    <div class="slide1__content">
                        재밌는건 <strong>같이봐야</strong> 더 재밌다!
                    </div>
                </div>
            </li>
            <li class="slide__item slide2">
                <div class="slide__content-wrapper">
                    <div class="slide2__content">
                        재능있지만 <strong>알려지지 않은 유투버</strong>를 알려주세요
                    </div>
                </div>
            </li>
        </ul>
    </div>

    <div class="wrap clearfix">
        <div class="column1">
            <section class="recent-pick clearfix">
                <h2 class="recent-pick__title"><i class="icon-font icon-font--face2"></i>따끈따끈한 PICK!</h2>
                <!-- PHP출력  -->
                <?php 
                $results = $model->getLastestPick();
                foreach($results as $result){
                ?>
                <article class="pick-card card-base-deco">
                    <div class="pick-card__body">
                        <div class="pick-card__title-area">
                            <h3 class="pick-card__title">
                                <?php echo $result->youtuber_name ?>
                            </h3>
                            <div class="pick-card__picker">
                                <a href="#" style="text-decoration: underline;"><?php echo $result->user_name ?></a>
                            </div>
                        </div>
                        <div class="pick-card__circle-area">
                            <div class="pick-card__circle circle-component">
                                <div class="circle-component__circle" data-value=<?php echo $result->points[0]['point']?> >
                                    <div class="circle-component__value"></div>
                                </div>
                                <div class="circle-component__title">
                                    <?php echo $result->points[0]['name'] ?>
                                </div>
                            </div>
                            <div class="pick-card__circle circle-component">
                                <div class="circle-component__circle" data-value=<?php echo $result->points[1]['point']?>>
                                    <div class="circle-component__value"></div>
                                </div>
                                <div class="circle-component__title">
                                <?php echo $result->points[1]['name'] ?>
                                </div>
                            </div>
                            <div class="pick-card__circle circle-component">
                                <div class="circle-component__circle" data-value=<?php echo $result->points[2]['point']?>>
                                    <div class="circle-component__value"></div>
                                </div>
                                <div class="circle-component__title">
                                <?php echo $result->points[2]['name'] ?>
                                </div>
                            </div>
                        </div>
                        <p class="pick-card__text"><?php echo  $result->detail ?></p>
                        
                        <div class="pick-card__button-area">
                            <a href="pages/youtuber/youtuber.php?id=<?php echo $result->youtuber_id ?>" class="button button--light">프로필</a>
                            <a href="<?php echo $result->url ?>" target="blank" class="button button--light">채널</a>
                        </div>
                    </div>
                    </article>
                    <?php } ?>
                    <!--  -->
            </section>

        </div>
        <div class="column2">
        <h2 class="pick-talk__title"><i class="icon-font icon-font--chat"></i>픽톡</h2>
            <section class="pick-talk">
                <ul class="board">
                    <li class="board__title">자유로운 이야기 공간입니다</li>
                    <!-- PHP출력 -->
                    <?php 
                    $results = $model->getLatestTalk();
                    foreach($results as $result){
                    ?>
                    <li class="board__item">
                        <a href="pages/talk/talk.php?id=<?php echo $result->id?>">
                            <span class="cell col1"><?php echo $result->subject ?></span>
                            <span class="cell col2"><?php echo $result->write_time ?></span>
                        </a>
                    </li>
                    <?php
                    }
                     ?>
                     <!--  -->

                </ul>
            </section>
            <section class="youtuber-board">
                <h2 class="youtuber-board__title"><i class="icon-font icon-font--face1"></i>유투버 공간</h2>
                <div style="text-align:center">
                    <a href="#" class="button button--point" style="letter-spacing: -1px;">게시판 신청하기</a>
                </div>
                <div style="line-height:200%;padding:0 20px;">
                <br>특정 유투버를 주제로한 게시판을 만들어드리고 있습니다
                </div>
            </section>
        </div>
    </div>

    <?php include "footer.php" ?>
    <script>
        $(function () {
            $('.slide').slick({
                dots: true, // 네비게이션(아래의 점들) 보여주기
                infinite: true, //루프되게
                slidesToShow: 1, //한번에 보여주는 아이템의 개수
                // slidesToScroll: 1, // 몇개단위로 페이지가 넘어가는지 설정
                autoplay: true, //자동으로 넘어가게
                autoplaySpeed: 3000, //넘어가는 속도 설정
                // centerMode:false, //센터모드 - 좌우의 안보이는 아이템을 일부 보이게 해줌
                // centerPadding: '40px' //센터모드시 좌우의 아이템을 얼마나 보이게 해줄지 설정
            });

            showCircle(2000);

            $('.pick-card__text').ellipsis({
                lines: 2,             // force ellipsis after a certain number of lines. Default is 'auto'
            });

            $('#html').css("opacity", "1");
        });
    </script>
</body>

</html>