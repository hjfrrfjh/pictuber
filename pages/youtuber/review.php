<!DOCTYPE html>
<html>

<head>
    <?php include "../../head.php" ?>

    <title>Picktuber</title>
    <link rel="stylesheet" type="text/css" media="screen" href="review.css" />

</head>

<body>
    <?php include "../../header.php";?>
    <!-- /////////////////////////////////////////////////-->
    <?php $subTitle="Youtuber"; include "../../sub-title.php" ?>
    <div class="content">
        <div class="title">
            이상한 방송 PICK 점수
        </div>
        <form class="form" action="">
            <div class="form__row1">
                <div class="form__input-container">
                    <label>정보</label>
                    <input class="form__point1" type="number" placeholder="안녕하세요" value="50">
                </div>

                <div class="form__input-container">
                    <label>유머</label>
                    <input class="form__point2" type="number" placeholder="안녕하세요" value="50">
                </div>

                <div class="form__input-container">
                    <label>비주얼</label>
                    <input class="form__point3" type="number" placeholder="안녕하세요" value="50">
                </div>

                <div class="form__input-container">                                        
                    <label>재능</label>
                    <input class="form__point4" type="number" placeholder="안녕하세요" value="50">
                </div>

                <div class="form__input-container">
                    <label>소통</label>
                    <input class="form__point5" type="number" placeholder="안녕하세요" value="50">
                </div>
                
            </div>
            <div class="form__row2">
                    <label for="">기타 평가</label>
                    <textarea class="form__text" name="" id="" ></textarea>
                </div>

            <div class="form__row3">
                <div class="form__buttons">
                    <a class="button" type="submit">등록</a>
                    <a class="button" href="#" onclick="history.go(-1)">취소</a>
                </div>
            </div>
        </form>
    </div>
    <!-- ///////////////////////////////////////////// -->
    <?php include "../../footer.php" ?>
    <script>

    </script>
</body>

</html>