<!DOCTYPE html>
<html id="html" style="opacity: 1">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Picktuber</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../../index.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../../fonts/font.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../../lib/slick/slick.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../../common.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="list.css" />
    <script src="../../lib/jquery-3.3.1.min.js"></script>
    <script src="../../lib/circle-progress.min.js"></script>
    <script src="../../common.js"></script>

</head>

<body>
    <header class="header">
        <div class="header__top-area">
            <div class="logo-container">
                <h1><a href="#"><img class="logo-container__logo logo" src="../../img/logo_edit3.png" alt="픽튜버"></a></h1>
                <div class="logo-container__text">
                    <strong>당신의</strong><strong>유투버</strong>를 알려주세요
                </div>
            </div>
            <form class="search">
                <input class="search__text" type="text" placeholder="유투버 검색"><button class="search__submit icon-font icon-font--search"
                    type="submit" value="">
            </form>
        </div>
        <nav class="gnb">
            <ul class="gnb__container">
                <li class="gnb__item gnb__item--point"><a href="#">PICK!<span class="gnb__item-desc">유투버들에게 평점을 매겨보아요</span></a></span></li>
                <li class="gnb__item gnb__item--point"><a href="#">픽톡</a></li>
                <li class="gnb__item"><a href="#">평점순위</a></li>
                <li class="gnb__item"><a href="#">최근PICK 살펴보기</a></li>
                <li class="gnb__item"><a href="#">유투버 공간</a></li>
            </ul>
        </nav>
    </header>
<!-- /////////////////////////////////////////////////-->
    <div class="title-area">
        <div class="wrap">
            <div class="title__text">
                PICK
            </div>
        </div>
    </div>
    <div class="wrap">

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

        <ul class="list">
            <?php for($i=1;$i<30;$i++) {?>

            <li class="card-base-deco card">
                <div class="card__wraper">
                    <div class="card__title">
                        재밌는 방송!
                    </div>
                    <div class="card__body">
                        <div class="card__tag-area"><span class="card__tag">정보</span><span class="card__tag">먹방</span><span class="card__tag">게임</span>
                        </div><img class="card__img" src="https://via.placeholder.com/80"><div class="card__circle">
                            <div class="circle-component clearfix">
                                <div class="circle-component__circle" data-value="0.8">
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

            <?php }?>
        </ul>
    </div>
    <script>

    </script>
<!-- ///////////////////////////////////////////// -->
    <footer class="footer">
        <div class="footer__link-area">
            <div class="wrap">
                <a href="#" class="footer__link" onClick="alert('준비중입니다')">개인정보 취급 방침</a>
                <a href="#" class="footer__link">운영 방침</a>
            </div>
        </div>
        <div class="footer__body">
            <div class="wrap">
                Copyright kimhyojin. All rights reserved.<br>
                kimhyojin87@gmail.com
            </div>
        </div>
    </footer>
    <script>
        $(function () {

            showCircle(0);
        });
    </script>
</body>

</html>