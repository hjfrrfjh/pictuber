<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <base href="../../">
    <?php include "../../head.php"; ?>
    <title>Picktuber</title>
    <link rel="stylesheet" type="text/css" media="screen" href="pages/talk/talk.css" />

</head>

<body>
    <?php include "../../header.php";?>
    <?php $subTitle="PickTalk"; include "../../sub-title.php" ?>
    <!-- /////////////////////////////////////////////////-->
    <?php include "talk_model.php" ?>

    <?php
        $search = !empty($_GET['search'])?$_GET['search']:"";
        $offset = !empty($_GET['offset'])?$_GET['offset']:"";
        $id = !empty($_GET['id'])?$_GET['id']:"";


    ?>
    <div class="content clearfix">
        <?php
            $data = $model->getBoardContent();
            if(!empty($data)){
        ?>
        <section class="inside card-base-deco">
            <div class="inside__title-area clearfix">
                <div class="inside__title">
                    <?php echo $data->subject; ?>
                </div>
            </div>

            <div class="inside__info-area clearfix">
                <div class="inside__recommend">
                    <?php echo $data->recommend; ?>
                </div>

                <div class="inside__hit">
                    <?php echo $data->hit; ?>
                </div>
                <div class="inside__author">
                    <?php echo $data->author; ?>
                </div>

            </div>

            <div class="inside__content-area">
                <div class="inside__content">
                    <?php echo $data->content; ?>
                </div>
                <div class="inside__date">
                    <?php echo $data->write_time; ?>
                </div>
            </div>

            <div class="inside__comment-area">
                <ul class="comment">
                    <?php
                    $coment_data = $model->getComments();

                    foreach($coment_data as $comment){
                    ?>
                    <li class="comment__item card-base-deco">
                        <div class="comment__item-author">
                            <?php echo $comment->author ?>
                        </div>
                        <div class="comment__item-body">
                            <div class="comment__item-comment"><?php echo $comment->comment ?></div>
                        </div>
                        <div class="comment__item-date">
                            <?php echo $comment->write_time ?>
                        </div>
                    </li>
                    <?php 
                    }
                    ?>
                </ul>
            </div>
        </section>
        <?php } ?>


        <section class="now">
            <ul class="board">
                <li class="board__item board__header">
                    <div class="cell col1">추천</div>
                    <div class="cell col2">제목</div>
                    <div class="cell col3">코멘트</div>
                    <div class="cell col4">조회</div>
                    <div class="cell col5">작성자</div>
                    <div class="cell col6">날짜</div>
                </li>
                <?php 
                $result = $model->getBoardList();
                foreach($result->data as $data){
                ?>
                <li class="board__item">
                    <a href=<?php echo $data->link ?>>
                        <div class="cell col1"><?php echo $data->recommend ?></div>
                        <div class="cell col2"><?php echo $data->subject ?></div>
                        <div class="cell col3"><?php echo $data->comment_count ?></div>
                        <div class="cell col4"><?php echo $data->hit ?></div>
                        <div class="cell col5"><?php echo $data->username ?></div>
                        <div class="cell col6"><?php echo $data->write_time ?></div>
                    </a>
                </li>
                <?php }?>
            </ul>
            <div class="board__bottom">
                <div class="board__control-page">
                    <div class="board__buttons">
                        <a href="pages/talk/write.php" class="button button--point">글쓰기</a>
                    </div>
                    <?php 
                        $acitve = !empty($offset)?$offset+1:1;
                        foreach($result->nav as $data){
                            $class = $acitve==$data->number?"board__page-num board__page-num--active":"board__page-num";
                            echo "<a href='$data->url' class='$class'>$data->number</a>";
                        }
                    ?>
                </div>
                <form class="board__search-control" method="GET" action="pages/talk/talk.php">
                    <input class="board__search-text" type="text" placeholder="검색어 입력" name="search">
                    <button class="board__search-submit button" type="submit" value="검색하기">검색</button>
                    <?php 
                        if(!empty($search)){
                            echo "<a href='pages/talk/talk.php' class='button'>전체보기</a>";
                        }
                    ?>

                </form>
            </div>
    </div>


    </section>
    </div>



    <!-- ///////////////////////////////////////////// -->
    <?php include "../../footer.php"?>
    <script>

    </script>
</body>

</html>