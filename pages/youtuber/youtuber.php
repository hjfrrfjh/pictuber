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
    <div class="wrap">

        <div class="profile clearfix">
            <h3 class="profile__name">
                이상한 방송
            </h3><!--
        --><img class="profile__photo" src="https://via.placeholder.com/300"><!--
        --><div class="profile__right">
                <ul class="tag">
                    <li class="tag__item">
                        먹방
                    </li>
                    <li class="tag__item">
                        게임
                    </li>
                    <li class="tag__item">
                        일상
                    </li>
                    <li class="tag__item">
                        비주얼
                    </li>
                    <li class="tag__item">
                        병맛
                    </li>
                </ul>
                <div class="circle-component clearfix">
                    <div class="circle-component__circle" data-value="80">
                        <div class="circle-component__value"></div>
                    </div>
                    <div class="circle-component__title">
                        편집능력
                    </div>
                </div>
                <div class="circle-component clearfix">
                    <div class="circle-component__circle" data-value="10">
                        <div class="circle-component__value"></div>
                    </div>
                    <div class="circle-component__title">
                        편집능력
                    </div>
                </div>
                <div class="circle-component clearfix">
                    <div class="circle-component__circle" data-value="80">
                        <div class="circle-component__value"></div>
                    </div>
                    <div class="circle-component__title">
                        편집능력
                    </div>
                </div>
                <div class="circle-component clearfix">
                    <div class="circle-component__circle" data-value="80">
                        <div class="circle-component__value"></div>
                    </div>
                    <div class="circle-component__title">
                        편집능력
                    </div>
                </div>
                <div class="circle-component clearfix">
                    <div class="circle-component__circle" data-value="80">
                        <div class="circle-component__value"></div>
                    </div>
                    <div class="circle-component__title">
                        편집능력
                    </div>
                </div>
            </div>

            <div class="profile__bottom">
                <ul class="profile__info">
                    <li class="profile__info-item">채널 주소 - aaise.youtube.com/asidasem</li>
                    <li class="profile__info-item">팬까페 - aaa/care.naver.com</li>
                    <li class="profile__info-item">나이 - 20세 중반으로 추정</li> 
                </ul>
                <p class="profile__detail">그들의 일월과 천자만홍이 끝까지 길지 것이다. 못하다 우리 뭇 놀이 끓는 얼음에 이상 것이다. 능히 싸인 공자는 평화스러운 주는 듣는다. 황금시대의 동력은 것은 인생을 이성은 이상은 있음으로써 그리하였는가? 몸이 이상을 우리는 없으면 없으면, 곳이 피고, 철환하였는가? 그들의 얼마나 가진 피에 것이다.</p>
            </div>
        </div>
        <section class="pick">
                <?php for($i=0;$i<20;$i++){?>
                <li class="pick__item card-base-deco">
                    <div class="pick__item-body clearfix">
                        <div class="pick__item-author">hjfrrfjh</div>
                        <p class="pick__item-text">
                        대통령은 국가의 독립·영토의 보전·국가의 계속성과 헌법을 수호할 책무를 진다. 중앙선거관리위원회는 대통령이 임명하는 3인, 국회에서 선출하는 
                        <p>
                    </div>
                    <div class="pick__item-point">
                        <div class="point-row">
                            <div class="point-col">영상미 </div>
                            <div class="point-col point-data" data-value="50">
                                <div class="point__item-graph"></div>
                                <div class="point__item-value"></div>
                            </div>
                        </div>
                        <div class="point-row">
                            <div class="point-col">비주얼</div>
                            <div class="point-col point-data" data-value="30">
                                <div class="point__item-graph"></div>
                                <div class="point__item-value"></div>
                            </div>
                        </div>
                        <div class="point-row">
                            <div class="point-col">재능</div>
                            <div class="point-col point-data" data-value="80">
                                <div class="point__item-graph"></div>
                                <div class="point__item-value"></div>
                            </div>
                        </div>
                        <div class="point-row">
                            <div class="point-col">유머</div>
                            <div class="point-col point-data" data-value="90">
                                <div class="point__item-graph"></div>
                                <div class="point__item-value"></div>
                            </div>
                        </div>
                        <div class="point-row">
                            <div class="point-col">소통</div>
                            <div class="point-col point-data" data-value="85">
                                <div class="point__item-graph"></div>
                                <div class="point__item-value"></div>
                            </div>
                        </div>
                        
                    </div>
                </li>
                <?php } ?>
            </ul>
        </section>
    </div>

    <!-- ///////////////////////////////////////////// -->
    <?php echo includeHelper("../../footer.php");?>
    <script>
    $(function() {
        showCircle(3000);

        $('.point-data').each(function(index,elm){
            var $elm = $(elm);
            var value = $elm.attr("data-value");

            $elm.find(".point__item-value").text(value);
            $elm.find(".point__item-graph").css("width",value+"%");
        });

    });
    </script>
</body>

</html>