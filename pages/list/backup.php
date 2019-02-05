<?php


                    
            ?>
            
            <li class="card-base-deco card">
                <div class="card__wraper">
                    <div class="card__title">
                        <?php echo $tags[0] ?>
                        <?php echo $row['name']; ?>
                    </div>
                    <div class="card__body">
                        <div class="card__tag-area"><span class="card__tag">정보</span><span
                                class="card__tag">먹방</span><span class="card__tag">게임</span>
                        </div><img class="card__img" src="https://via.placeholder.com/80"><!--
                        --><div class="card__circle">
                            <div class="circle-component clearfix">
                                <div class="circle-component__circle" data-value="<?php echo $list[0]['point']?>">
                                    <div class="circle-component__value"></div>
                                </div>
                                <div class="circle-component__title">
                                    <?php echo $list[0]['name']?>
                                </div>
                            </div>
                        </div>
                        <div class="card__point-area clearfix">
                            <?php 
                            for($i=1;$i<5;$i++){
                                
                            ?>
                            <div class="card-point">
                                <div class="card-point__value"><?php echo $list[$i]['point']?></div>
                                <div class="card-point__name"><?php echo $list[$i]['name']?></div>
                            </div>

                            <?php } ?>
    
                        </div>
                        <div class="card__button-area">
                            <a href="../youtuber/youtuber.php" class="card__button button button--light">프로필</a>
                            <a href="#" class="card__button button button--light">채널이동</a>
                        </div>
                    </div>
                </div>
            </li>

            <?php 
        } ?>