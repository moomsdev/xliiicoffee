<?php
use SocialLinks\Page;

$page = new Page([
    'url'   => get_the_permalink(),
    'title' => get_the_title(),
    'text'  => get_the_excerpt(),
    'image' => get_the_post_thumbnail_url('full'),
]);
?>
<div class="share-post">
    <div class="row">
        <div class="col-4">
            <h2 class="title-section gray"><?php echo __('Share to','gaumap'); ?></h2>
        </div>
        <div class="col-8">
            <ul>
                <li>
                    <a href="javascript:"
                       onclick="window.open('<?php echo $page->facebook->shareUrl ?>','Share post','width=600,height=600,top=150,left=250'); return false;"><i class="fab fa-facebook-f"></i> Facebook</a>
                </li>
                <li>
                    <a href="javascript:"
                       onclick="window.open('<?php echo $page->twitter->shareUrl ?>','Share post','width=600,height=600,top=150,left=250'); return false;"><i class="fab fa-twitter"></i> Twitter</a>
                </li>
                <li>
                    <a href="javascript:"
                       onclick="window.open('<?php echo $page->linkedin->shareUrl ?>','Share post','width=600,height=600,top=150,left=250'); return false;"><i class="fab fa-linkedin-in"></i> Linkedin</a>
                </li>
            </ul>
        </div>
    </div>

</div>

