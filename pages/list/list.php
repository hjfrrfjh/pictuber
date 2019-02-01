<?php include "../../common.php" ?>
<!DOCTYPE html>
<html>

<head>
    <?php echo includeHelper("../../head.php"); ?>

    <title>Picktuber</title>
    <link rel="stylesheet" type="text/css" media="screen" href="list.css" />

</head>

<body>
    <?php echo includeHelper("../../header.php");?>
    <?php $subTitle="PICK"; include '../../sub-title.php'; ?>
    <!-- /////////////////////////////////////////////////-->
    <div class="wrap">
        <div class="top clearfix">
            <ul class="filter">
                <div class="filter__title">조건 검색</div>
                <a href="#" class="filter__item">먹방</a>
                <a href="#" class="filter__item">게임</a>
                <a href="#" class="filter__item">일상</a>
                <a href="#" class="filter__item">리뷰</a>
                <a href="#" class="filter__item">병맛</a>
                <a href="#" class="filter__item">토크</a>
                <a href="#" class="filter__item">구독자1000</a>
                <a href="#" class="filter__item">버킷첼린지</a>
            </ul>
            <a href="#" class="button button--point top__add-youtuber">유투버 등록하기</a>
        </div>

        <ul class="list">
            <?php for ($i = 1; $i < 30; $i++) { ?>

            <li class="card-base-deco card">
                <div class="card__wraper">
                    <div class="card__title">
                        재밌는 방송!
                    </div>
                    <div class="card__body">
                        <div class="card__tag-area"><span class="card__tag">정보</span><span
                                class="card__tag">먹방</span><span class="card__tag">게임</span>
                        </div><img class="card__img" src="https://via.placeholder.com/80"><!--
                        --><div class="card__circle">
                            <div class="circle-component clearfix">
                                <div class="circle-component__circle" data-value="80">
                                    <div class="circle-component__value"></div>
                                </div>
                                <div class="circle-component__title">
                                    편집능력
                                </div>
                            </div>
                        </div>
                        <div class="card__point-area clearfix">
                            <div class="card-point">
                                <div class="card-point__value">50</div>
                                <div class="card-point__name">유머</div>
                            </div>
                            <div class="card-point">
                                <div class="card-point__value">50</div>
                                <div class="card-point__name">소통</div>
                            </div>
                            <div class="card-point">
                                <div class="card-point__value">50</div>
                                <div class="card-point__name">비주얼</div>
                            </div>
                            <div class="card-point">
                                <div class="card-point__value">50</div>
                                <div class="card-point__name">재능</div>
                            </div>
                        </div>
                        <div class="card__button-area">
                            <a href="#" class="card__button button button--light">프로필</a>
                            <a href="#" class="card__button button button--light">채널이동</a>
                        </div>
                    </div>
                </div>
            </li>

            <?php 
        } ?>
        </ul>
    </div>
    <script>

    </script>
    <!-- ///////////////////////////////////////////// -->
    <?php echo includeHelper("../../footer.php");?>
    <script>
    $(function() {
        showCircle(0);
    });
    </script>
</body>

</html>