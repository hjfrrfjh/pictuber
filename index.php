<!DOCTYPE html>
<html id="html" style="opacity: 1">

<head>
    <?php include "head.php" ?>
    <title>Picktuber</title>
    
    <link rel="stylesheet" type="text/css" media="screen" href="lib/slick/slick.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="index.css" />
    <script src="lib/slick/slick.min.js"></script>
</head>

<body>
    <?php include "header.php" ?>

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
                <?php 
                 include 'db_conn.php';
                 $sql = "select * from view_latest_review LIMIT 4";
                 $result = mysqli_query($conn,$sql);
                 
                 function cmp($a, $b)
                {
                    return $a['point'] < $b['point'];
                }

                 if($result){
                    while($row = mysqli_fetch_assoc($result)){
                        
                        $youtuber_name = $row["youtuber_name"];
                        $youtuber_id = $row["youtuber_id"];
                        $user_name = $row["user_name"];
                        
                        $list = array(
                            array('name'=>'정보', 'point'=>$row['point1']),
                            array('name'=>'유머', 'point'=>$row['point2']),
                            array('name'=>'비주얼', 'point'=>$row['point3']),
                            array('name'=>'재능', 'point'=>$row['point4']),
                            array('name'=>'소통', 'point'=>$row['point5'])
                        );
                        usort($list,"cmp");
                ?>
                <article class="pick-card card-base-deco">
                    <div class="pick-card__body">
                        <div class="pick-card__title-area">
                            <h3 class="pick-card__title">
                                <?php echo $youtuber_name ?>
                            </h3>
                            <div class="pick-card__picker">
                                <a href="#" style="text-decoration: underline;"><?php echo $user_name ?></a>
                            </div>
                        </div>
                        <div class="pick-card__circle-area">
                            <div class="pick-card__circle circle-component">
                                <div class="circle-component__circle" data-value=<?php echo $list[0]['point']?> >
                                    <div class="circle-component__value"></div>
                                </div>
                                <div class="circle-component__title">
                                    <?php echo $list[0]['name'] ?>
                                </div>
                            </div>
                            <div class="pick-card__circle circle-component">
                                <div class="circle-component__circle" data-value=<?php echo $list[1]['point']?>>
                                    <div class="circle-component__value"></div>
                                </div>
                                <div class="circle-component__title">
                                <?php echo $list[1]['name'] ?>
                                </div>
                            </div>
                            <div class="pick-card__circle circle-component">
                                <div class="circle-component__circle" data-value=<?php echo $list[2]['point']?>>
                                    <div class="circle-component__value"></div>
                                </div>
                                <div class="circle-component__title">
                                <?php echo $list[2]['name'] ?>
                                </div>
                            </div>
                        </div>
                        <div class="pick-card__text">역사를 용감하고 찾아다녀도, 것은 이상의 착목도, 것은 이상의 착목도, 것은 이상의 착목....
                        </div>
                        <div class="pick-card__button-area">
                            <a href="pages/youtuber/youtuber.php?id=<?php echo $youtuber_id ?>" class="button button--light">프로필</a>
                            <a href="#" class="button button--light">채널</a>
                        </div>
                    </div>
                    </article>
                <?php
                    }
                }
                 mysqli_close($conn);
                ?>
            </section>

        </div>
        <div class="column2">
        <h2 class="pick-talk__title"><i class="icon-font icon-font--chat"></i>픽톡</h2>
            <section class="pick-talk">
                <ul class="board">
                    <li class="board__title">자유로운 이야기 공간입니다</li>
                    <li class="board__item">
                        <a href="#">
                            <span class="cell col1">국회는 선전포고, 국군의 외국에의 파견 또는 외국군...</span>
                            <span class="cell col2">19/01/31</span>
                        </a>
                    </li>
                    <li class="board__item">
                        <a href="#">
                            <span class="cell col1">법률안에 이의가 있을 때에는 대통령은 제1항의 기간...</span>
                            <span class="cell col2">19/01/31</span>
                        </a>
                    </li>
                    <li class="board__item">
                        <a href="#">
                            <span class="cell col1">의무교육은 무상으로 한다. 군인 또는 군무원이 아닌 ...</span>
                            <span class="cell col2">19/01/31</span>
                        </a>
                    </li>
                    <li class="board__item">
                        <a href="#">
                            <span class="cell col1">국회의원은 그 지위를 남용하여 국가·공공단체 또는 ...</span>
                            <span class="cell col2">19/01/31</span>
                        </a>
                    </li>
                    <li class="board__item">
                        <a href="#">
                            <span class="cell col1">국회가 재적의원 과반수의 찬성으로 계엄의 해제를 요...</span>
                            <span class="cell col2">19/01/31</span>
                        </a>
                    </li>
                    <li class="board__item">
                        <a href="#">
                            <span class="cell col1">모든 국민은 법률이 정하는 바에 의하여 국가기관에 ...</span>
                            <span class="cell col2">19/01/31</span>
                        </a>
                    </li>
                    <li class="board__item">
                        <a href="#">
                            <span class="cell col1">모든 국민은 근로의 의무를 진다. 국가는 근로의 의무...</span>
                            <span class="cell col2">19/01/31</span>
                        </a>
                    </li>
                    <li class="board__item">
                        <a href="#">
                            <span class="cell col1">평화통일정책의 수립에 관한 대통령의 자문에 응하기 ...</span>
                            <span class="cell col2">19/01/31</span>
                        </a>
                    </li>
                    <li class="board__item">
                        <a href="#">
                            <span class="cell col1">국회의원은 국가이익을 우선하여 양심에 따라 직무를 ...</span>
                            <span class="cell col2">19/01/31</span>
                        </a>
                    </li>
                </ul>
            </section>
            <section class="youtuber-board">
                <h2 class="youtuber-board__title"><i class="icon-font icon-font--face1"></i>유투버 공간</h2>
                <div style="text-align:center">
                    <a href="#" class="button button--point" style="letter-spacing: -1px;">게시판 신청하러 가기</a>
                </div>
                <div style="line-height:200%;padding:0 20px;">
                <br>특정 유투버를 주제로한 게시판을 만들어드리고 있습니다. 신청하시면 바로 만들어 드리겠습니다.^^
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

            $('#html').css("opacity", "1");
        });
    </script>
</body>

</html>