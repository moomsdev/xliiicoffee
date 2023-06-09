<?php
$title = $args['title_philosophy_block'];
$imgLarge = $args['img_lg_philosophy_block'];
$imgSmall = $args['img_sm_philosophy_block'];
$desc = $args['desc_philosophy_block'];

$typeLink = $args['type_read_more_link_philosophy_block'];
$readLink = $args['link_custom_philosophy_block'];
$pageObject = $args['page_object_philosophy_block'];

if ( $typeLink == 'manual' ) :
    $link = $readLink;
else:

    foreach ( $pageObject as $page ):
        $link = get_permalink($page['id']);
    endforeach;

endif;

?>
<section class="philosophy-block">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-xl-6 col-xxl-6 left-column">

                <div class="content">
                    <h2 class="title-blocks">
                        <?php echo $title; ?>
                    </h2>

                    <div class="description-blocks">
                        <?php echo apply_filters('the_content', $desc);?>
                    </div>

                    <a href="<?php echo $link; ?>" class="read-more-blocks text-shadow"><?php echo __('Đọc thêm', 'gaumap'); ?></a>
                </div>

                <figure class="media sm-img">
                    <a href="<?php echo $link; ?>">
                        <img src="<?php echo getImageUrlById($imgSmall) ?>" alt="<?php echo get_the_title($imgSmall);  ?>">
                    </a>
                </figure>

            </div>

            <div class="col-12 col-xl-6 col-xxl-6 right-column">
                <figure class="media lg-img">
                    <a href="<?php echo $link; ?>">
                        <img src="<?php echo getImageUrlById($imgLarge) ?>" alt="<?php echo get_the_title($imgLarge);  ?>">
                    </a>
                </figure>
            </div>
        </div>
    </div>
</section>
<?php
