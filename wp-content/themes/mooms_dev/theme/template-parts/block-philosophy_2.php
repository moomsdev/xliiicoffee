<?php
$title = $args['title_philosophy_block_2'];
$img = $args['img_philosophy_block_2'];
$desc = $args['desc_philosophy_block_2'];

$typeLink = $args['type_read_more_link_philosophy_block_2'];
$readLink = $args['link_custom_philosophy_block_2'];
$pageObject = $args['page_object_philosophy_block_2'];

if ( $typeLink == 'manual-link' ) :
    $link = $readLink;
else:

    foreach ( $pageObject as $page ):
        $link = get_permalink($page['id']);
    endforeach;

endif;

?>
<section class="philosophy-block-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 title-link">
                <h2 class="title-blocks"><?php echo $title; ?></h2>
                <a href="<?php echo $link; ?>" class="read-more-blocks text-shadow"><?php echo __('Xem tất cả', 'gaumap'); ?></a>
            </div>
        </div>

        <?php if ( $desc ) : ?>
            <div class="row">
                <div class="col-12 col-lg-6 description-blocks">
                    <?php echo apply_filters('the_content', $desc); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if ( $img ) : ?>
            <figure class="media">
                <img src="<?php echo getImageUrlById($img); ?>" alt="<?php echo get_the_title($img); ?>">
            </figure>
        <?php endif; ?>
    </div>
</section>
<?php
