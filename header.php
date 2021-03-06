<header class="header">
    <div class="header__top-area">
        <div class="logo-container">
            <h1><a href="#"><img class="logo-container__logo logo" src="img/logo_edit3.png" alt="픽튜버"></a></h1>
            <!-- <div class="logo-container__text">
                <strong>당신의</strong><strong>유투버</strong>를 알려주세요
            </div> -->
        </div>
        <form class="search" action="pages/list/list.php" method="GET">
            <input class="search__text" type="text" name="search" placeholder="유투버 검색"><button class="search__submit icon-font icon-font--search"
                type="submit" value=""></button>
        </form>
        <div class="login-area">
            <?php
                if(empty($_SESSION['id'])){
                    echo "<a class='login' href='pages/member/login.php'><strong>Google ID</strong> 로 로그인하기</a>";
                }else{
                    echo "
                    <div class='' href='#'><strong>".$_SESSION['name']."</strong>님 환영합니다</div>
                    <a href='pages/member/logout.php' class='logout'>로그아웃</a>
                    ";
                }
            ?>
        </div>
    </div>
    <nav class="gnb">
        <ul class="gnb__container">
            <li class="gnb__item gnb__item--point"><a href="pages/list/list.php">PICK!<span class="gnb__item-desc">유투버들에게 평점을 매겨보아요</span></a></span><div class="gnb__item-underline"></div></li>
            <li class="gnb__item gnb__item--point"><a href="pages/talk/talk.php">픽톡</a><div class="gnb__item-underline"></div></li>
            <li class="gnb__item"><a href="#">평점순위</a><div class="gnb__item-underline"></div></li>
            <li class="gnb__item"><a href="#">최근PICK 살펴보기</a><div class="gnb__item-underline"></div></li>
            <li class="gnb__item"><a href="#">유투버 공간</a><div class="gnb__item-underline"></div></li>
        </ul>
    </nav>

</header>