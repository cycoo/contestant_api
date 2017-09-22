
<div class="container">
    <h2>Photo Gallery</h2> 
    <div id="main_area">
        <!-- Slider -->
        <div class="row">
            <div class="col-sm-6" id="slider-thumbs">
                <!-- Bottom switcher of slider -->
                <ul class="hide-bullets">
                <?php
                    if(!empty($photos)){
                        foreach($photos as $key=>$detail){
                            ?>
                            <li class="col-sm-3">
                                <a class="thumbnail" id="carousel-selector-<?= $key?>">
                                    <img src="<?= base_url()?>/uploads/contestant/<?= $detail['photo_url']?>">
                                </a>
                            </li>
                            <?php
                        }
                    }
                ?>       

                </ul>
            </div>
            <div class="col-sm-6">
                <div class="col-xs-12" id="slider">
                    <!-- Top part of the slider -->
                    <div class="row">
                        <div class="col-sm-12" id="carousel-bounding-box">
                            <div class="carousel slide" id="myCarousel">
                                <!-- Carousel items -->
                                <div class="carousel-inner">

                                <?php
                                    if(!empty($photos)){
                                        foreach($photos as $key=>$detail){
                                            ?>
                                            <div class="<?= ($key==0)?'active':''?> item" data-slide-number="<?= $key?>">
                                                <img src="<?= base_url()?>/uploads/contestant/<?= $detail['photo_url']?>">
                                            </div>
                                            <?php
                                        }
                                    }
                                ?>                                   
                                </div>
                                <!-- Carousel nav -->
                                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                </a>
                                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/Slider-->
        </div>

    </div>
</div>