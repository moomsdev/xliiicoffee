<?php
$content = $args['content_block'];

$current_page = get_queried_object();

// Lấy ngày đăng của trang
$post_date = $current_page->post_date;

// Lấy ngày cập nhật của trang
$post_modified = $current_page->post_modified;

// Kiểm tra ngôn ngữ hiện tại của trang
$current_language = get_locale();
?>
<section class="content-slider-block">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 title-link">
                <h2 class="title-blocks"><?php theTitle(); ?></h2>
                <?php

                if ($current_language === 'en_US') {
                    // Định dạng ngày khi trang ở tiếng Anh (M d, Y)
                    $formatted_post_date = date('M d, Y', strtotime($post_date));
                    $formatted_post_modified = date('M d, Y', strtotime($post_modified));
                } else {
                    // Định dạng ngày khi trang ở tiếng Việt (d-m-Y)
                    $formatted_post_date = date('d-m-Y', strtotime($post_date));
                    $formatted_post_modified = date('d-m-Y', strtotime($post_modified));
                }

                if ( $post_date === $post_modified ) :
                    echo '<span class="read-more-blocks"> ' . __("Đăng ngày", "gaumap") . ' ' . $formatted_post_date . '</span>';
                else :
                    echo '<span class="read-more-blocks"> ' . __("Cập nhật ngày", "gaumap") . ' ' . $formatted_post_modified . '</span>';
                endif;
                ?>
            </div>
        </div>
        <div class="main-content">
            <?php
            if ( $content ) :
                echo apply_filters('the_content', $content);
            endif;
            ?>
        </div>

    </div>
</section>
<?php
