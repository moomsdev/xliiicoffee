<?php
$sliders = $args['slider_block'];
?>
<section class="slider-block">
    <div class="inner">
        <div class="swiper sliders">
            <div class="swiper-wrapper">
                <?php foreach ($sliders as $slider) : ?>
                        <div class="swiper-slide">
                            <img src="<?php echo getImageUrlById($slider['img_slider_block']); ?>" alt="<?php echo get_the_title($slider['img_slider_block']);  ?>">
                        </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
<?php
