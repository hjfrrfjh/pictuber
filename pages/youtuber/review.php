<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <base href="../../">
    <?php include "../../head.php" ?>
    <title>Picktuber</title>
    <link rel="stylesheet" type="text/css" media="screen" href="pages/youtuber/review.css" />

</head>

<body>
    <?php include "../../header.php";?>
    <!-- /////////////////////////////////////////////////-->
    <?php $subTitle="Youtuber"; include "../../sub-title.php" ?>
    <?php include 'youtuber_model.php' ?>
    <?php 
        $id="";
        $id = !empty($_GET['id'])?$_GET['id']:"";

        

        $data = $model->getYoutuberInfo();

        if(empty($data)){
            echo "<div style='text-align:center'>잘못된 ID입니다</div>";
            include "../../footer.php";
            exit;
        };

    ?>

    <div class="content">
        <h3 class="title">
            <strong><?php echo $data->name ?></strong> <span>PICK 점수</span>
        </h3>
        <div class="form__row1 card-base-deco">
            <img class="form__img" src="<?php echo $data->img_url;?>">
            <p class="form__desc">
                <?php echo $data->detail ?>
            </p>
        </div>
        <form class="form" action="pages/youtuber/review_write.php" method="POST">
            <div class="form__row2">
                <div class="form__desc-box">
                    <div id="sum" class="point-sum">400</div>
                    <div class="point-desc">
                        - 최대 400점까지 분배 가능합니다
                    </div>
                </div>
                <div class="input-bar">
                    <div class="input-bar__label">
                        정보
                    </div>
                    <div class="input-bar__container">
                        <div class="input-bar__selected">
                            <div class="input-bar__handle">
                                <input class="input-bar__value" size=1 name=point1 value=0>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="input-bar">
                    <div class="input-bar__label">
                        유머
                    </div>
                    <div class="input-bar__container">
                        <div class="input-bar__selected">
                            <div class="input-bar__handle">
                                <input class="input-bar__value" size=1 name=point2 value=0>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="input-bar">
                    <div class="input-bar__label">
                        비주얼
                    </div>
                    <div class="input-bar__container">
                        <div class="input-bar__selected">
                            <div class="input-bar__handle">
                                <input class="input-bar__value" size=1 name=point3 value=0>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="input-bar">
                    <div class="input-bar__label">
                        재능
                    </div>
                    <div class="input-bar__container">
                        <div class="input-bar__selected">
                            <div class="input-bar__handle">
                                <input class="input-bar__value" size=1 name=point4 value=0>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="input-bar">
                    <div class="input-bar__label">
                        소통
                    </div>
                    <div class="input-bar__container">
                        <div class="input-bar__selected">
                            <div class="input-bar__handle">
                                <input class="input-bar__value" size=1 name=point5 value=0>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form__row3">
                <div class="form__detail">
                    <label for="">추가 내용</label>
                    <textarea class="form__text" name="detail"></textarea>
                </div>

                <div class="form__buttons">
                    <input class="button" type="submit" value="등록" onclick="return check()"></a>
                    <button class="button" href="#" onclick="history.go(-1)">취소</button>
                </div>
            </div>
            <input type="hidden" name="youtuber_id" value="<?php echo $id?>">
        </form>
    </div>
    <!-- ///////////////////////////////////////////// -->
    <?php include "../../footer.php" ?>

    <script>
    $(function() {

    });

    function check() {
        return true;
    }
    </script>

    <!-- 슬라이더 부분 -->
    <script>
    let $sumPointContainer = $('#sum');
    $(".input-bar").each(function(index) {
        let maxPoint = 400;
        let $this = $(this);
        let $handle = $this.find('.input-bar__handle');
        let $container = $this.find('.input-bar__container');
        let $selected = $this.find(".input-bar__selected");
        let $value = $this.find(".input-bar__value");

        let containerLeft;
        let containerRight;

        let moveEvent = function(event) {
            let x = event.type == "mousemove" ? event.clientX : event.touches[0].clientX;
            let prevWidth = $selected.width();
            let newWidth = x - containerLeft >= 0 ? x - containerLeft : 0;
            let addWidth = newWidth - prevWidth;

            if (x >= containerRight) {
                newWidth = $container.width();
            }

            let prevPoint = Number($value.val());
            let newPoint = Math.floor((newWidth / $container.width()) * 100);
            let addPoint = newPoint - prevPoint;


            let pointSum = $(".input-bar__value").toArray().reduce(function(sum, elm) {
                return sum + Number($(elm).val());
            }, 0);


            let newSumPoint = pointSum + addPoint;

            if (newSumPoint > maxPoint) { //점수가 최대값을 초과 했을 경우 
                newPoint = prevPoint + maxPoint - pointSum;
                newWidth = $container.width() * (newPoint * 0.01);
                $('.input-bar__container').addClass("input-bar__container-lock");
            } else {
                $('.input-bar__container').removeClass("input-bar__container-lock");
            }

            $value.val(newPoint);
            $selected.width(newWidth);
            $sumPointContainer.text(maxPoint - pointSum);
        }

        $handle.on("mousedown touchstart", function(e) {
            containerLeft = $container.position().left;
            containerRight = $container.position().left + $container.width();

            e.preventDefault();
            $(document.body).on("mousemove touchmove", moveEvent);
            $handle.addClass("input-bar__handle--active");
            $(document.body).one("mouseup touchend", function() {
                $(document.body).off("mousemove touchmove", moveEvent);
                $(document.body).off("mouseup touchend", this);
                $handle.removeClass("input-bar__handle--active");
            })
        });
    });
    </script>
</body>

</html>