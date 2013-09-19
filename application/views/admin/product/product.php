<!-- Main content -->
<div class="span9">
    <section id="products">
        <div class="row">
            <!-- Main Area of Carrosel -->
            <div id="main_area">
                <!-- Slider -->
                <div class="row">
                    <div class="span9" id="slider">
                        <!-- Top part of the slider -->
                        <div class="row">
                            <div class="span6" id="carousel-bounding-box">
                                <div id="myCarousel" class="carousel slide">
                                    <!-- Carousel indicators -->
                                    <?php echo get_carousel_indicator($products, 'myCarousel'); ?>                                                                                                                    
                                    <!-- Carousel items -->
                                    <?php echo get_carousel_slide($products); ?>                                        
                                    <!-- Carousel nav -->
                                    <a class="carousel-control left" href="#myCarousel" data-slide="prev">‹</a>
                                    <a class="carousel-control right" href="#myCarousel" data-slide="next">›</a>
                                </div>
                            </div>
                            <div class="span3" id="carousel-text"></div>
                            <?php echo get_carousel_text($products); ?>                                                                    
                        </div>                        
                    </div>
                </div> <!--/Slider-->                
            </div>
        </div>
    </section><!-- products-->
</div>


<!-- Sidebar -->
<div class="span3 sidebar">
    <article>
        <h2><?php echo e($page->title); ?></h2>
        <?php echo $page->body; ?>
    </article>
</div>


<!-- Modal Definition -->
<div class="modal hide" id="dialog-carousel">
    <!--    
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" id="btn-close">x</button>
            <h3>ABOUT OF</h3>
        </div>
    -->

    <div class="modal-body">
    </div>

    <div class="modal-footer">
        <a href="#" data-dismiss="modal" class="btn btn-primary" id="btn-close"><?php echo $this->lang->line('close'); ?></a>        
    </div>
</div>
<!-- Enf of Modal Definition -->