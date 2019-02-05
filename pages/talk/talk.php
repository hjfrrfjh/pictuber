<?php include "../../common.php" ?>
<!DOCTYPE html>
<html>

<head>
    <?php echo includeHelper("../../head.php"); ?>

    <title>Picktuber</title>
    <link rel="stylesheet" type="text/css" media="screen" href="talk.css" />

</head>

<body>
    <?php echo includeHelper("../../header.php");?>
    <?php $subTitle="PickTalk"; include "../../sub-title.php" ?>
    <!-- /////////////////////////////////////////////////-->
    
    <div class="content clearfix">
    
    <section class="now">
            <div class="now__title">월간 인기글</div>
            <ul class="board">
                <li class="board__item board__header">
                    <div class="cell col1">추천</div>
                    <div class="cell col2">제목</div>
                    <div class="cell col3">코멘트</div>
                    <div class="cell col4">조회</div>
                    <div class="cell col5">작성자</div>
                    <div class="cell col6">날짜</div>
                </li>
                <li class="board__item">
                    <div class="cell col1">455</div>
                    <div class="cell col2">제안된 헌법개정안은 대통령이 20일 이상의 기간 이를 공고하여야 한다. 정기회의 회기는 100일을, 임시회의 회기는 30일을 초과할 수 없다. 대법원에 대법관을 둔다. 다만, 법률이 정하는 바에 의하여 대법관이 아닌 법관을 둘 수 있다.</div>
                    <div class="cell col3">767</div>
                    <div class="cell col4">1000</div>
                    <div class="cell col5">hjfrrfjh</div>
                    <div class="cell col6">2018/05/09</div>
                </li>
    
            </ul>
        <div class="board__bottom">
            <div class="board__buttons">
                <a href="write.php" class="button button--point">글쓰기</a>
            </div>
            <div class="board__control-page">
                <span class="board__page-num"><</span>
                <span class="board__page-num">1</span>
                <span class="board__page-num">2</span>
                <span class="board__page-num">3</span>
                <span class="board__page-num">4</span>
                <span class="board__page-num">5</span>
                <span class="board__page-num">></span>
            </div>
            <form class="board__search-control">
                <input class="board__search-text" type="text" placeholder="검색어 입력">
                <button class="board__search-submit button" type="submit" value="검색하기">검색</button>
            </form>
        </div>
        
        
            
        </section>

    </div>


    <section class="pick-talk">
                
            </section>

    <!-- ///////////////////////////////////////////// -->
    <?php echo includeHelper("../../footer.php");?>
    <script>

    </script>
</body>

</html>