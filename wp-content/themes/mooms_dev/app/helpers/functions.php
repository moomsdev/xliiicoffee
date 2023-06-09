<?php

use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;
use Jenssegers\Agent\Agent;

if (!function_exists('insertArrayAtPosition')) {
    function insertArrayAtPosition($array, $insert, $position)
    {
        return array_slice($array, 0, $position, true) + $insert + array_slice($array, $position, null, true);
    }
}

function get_icl_language_code()
{
    return !defined('ICL_LANGUAGE_CODE') ? '' : ICL_LANGUAGE_CODE;
}

function currentLanguage()
{
    return get_icl_language_code();
}

function adminAsset($path) { return get_stylesheet_directory_uri() . '/../resources/admin/' . $path; }

function getListAllCategories() {
    $args = [
        'hide_empty' => false,
        'taxonomy'   => 'category',
    ];

    $term_query = new WP_Term_Query();

    if (is_admin()) {
        add_filter('terms_clauses', 'filter_terms_by_polylang');
    }

    $terms = $term_query->query($args);

    if (is_admin()) {
        remove_filter('terms_clauses', 'filter_terms_by_polylang');
    }

    $list = [];
    foreach ($terms as $term) {
        $list[$term->term_id] = $term->name;
    }

    return $list;
}

function getListAllPages()
{
    $pages = get_posts([
        'post_type'      => 'page',
        'posts_per_page' => -1,
        'lang'           => get_icl_language_code(),
    ]);

    $list = [];
    foreach ($pages as $page) {
        $list[$page->ID] = $page->post_title;
    }

    return $list;
}

/**
 * function update_post_meta by gaumap
 *
 * @param        $post_id
 * @param        $field_name
 * @param string $value
 *
 * @return bool|false|int
 */
function updatePostMeta($post_id, $field_name, $value = '')
{
    if (empty($value)) {
        return delete_post_meta($post_id, $field_name);
    }

    if (!get_post_meta($post_id, $field_name)) {
        return add_post_meta($post_id, $field_name, $value);
    }

    return update_post_meta($post_id, $field_name, $value);
}

/**
 * Hàm updateUserMeta
 *
 * @param $idUser
 * @param $key
 * @param $value
 *
 * @return bool|false|int
 */
function updateUserMeta($idUser, $key, $value)
{
    if (empty($value)) {
        return delete_user_meta($idUser, $key);
    }

    if (!get_user_meta($idUser, $key)) {
        return add_user_meta($idUser, $key, $value);
    }

    return update_user_meta($idUser, $key, $value);
}

function updateAttachmentSize($attachment_id, $fileName, $width, $height, $type)
{
    $metadata = wp_get_attachment_metadata($attachment_id);
    if (is_array($metadata) && array_key_exists('sizes', $metadata)) {
        $size     = $metadata['sizes'];
        $sizeName = $width . 'x' . $height;
        if (!array_key_exists($sizeName, $size)) {
            $metadata['sizes'][$sizeName] = [
                'file'      => $fileName,
                'width'     => $width,
                'height'    => $height,
                'mime-type' => $type,
            ];
        }
        wp_update_attachment_metadata($attachment_id, $metadata);
    }
}

function resizeImage($srcPath, $destinationPath, $maxWidth, $maxHeight, $type = 'webp')
{
    try {
        if (carbon_get_theme_option('use_php_image_magick') === 'yes') {
            Image::configure(['driver' => 'imagick']);
        }
        $image = Image::make($srcPath);
        if ($maxWidth !== 0 || $maxHeight !== 0) {
            $image->fit($maxWidth, $maxHeight, static function ($constraint) {
                $constraint->upsize();
            });
        }
        $image->encode($type);
        $image->save($destinationPath, 85);
    } catch (\Exception $ex) {
        dump($ex);
    }
}

/**
 * Normalizes a path's slashes according to the current OS
 * This solves mixed slashes that are sometimes returned by core functions
 *
 * @param string $path
 *
 * @return string
 */
function crb_normalize_path($path)
{
    return preg_replace('~[/' . preg_quote('\\', '~') . ']~', DIRECTORY_SEPARATOR, $path);
}

/**
 * Truncates a string to a certain word count.
 *
 * @param string  $input       Text to be shortalized. Any HTML will be stripped.
 * @param integer $words_limit number of words to return
 * @param string  $end         the suffix of the shortalized text
 *
 * @return string
 */
function crb_shortalize($input, $words_limit = 15, $end = '...')
{
    return wp_trim_words($input, $words_limit, $end);
}

function subString($str, $limit)
{
    $content = explode(' ', $str, $limit);
    if (count($content) >= $limit) {
        array_pop($content);
        $content = implode(' ', $content) . '...';
    } else {
        $content = implode(' ', $content);
    }

    return preg_replace('`[[^]]*]`', '', $content);
}

/**
 * Load css files for theme
 *
 * @param array $files
 */
function loadStyles($files = [])
{
    add_action('wp_enqueue_scripts', static function () use ($files) {
        $count = 1;
        foreach ($files as $file) {
            wp_enqueue_style('gaumap-css-' . $count, $file, [], '0.1.0');
            $count++;
        }
        wp_enqueue_style('gaumap-css-style', get_stylesheet_directory_uri() . '/style.css', [], '0.1.0');
    }, 1);
}

/**
 * load javascript files for theme
 *
 * @param array $files
 */
function loadScripts($files = [])
{
    add_action('wp_enqueue_scripts', static function () use ($files) {
        $count = 1;
        foreach ($files as $file) {
            $scriptHandle = 'gaumap-js-' . $count;
            wp_enqueue_script($scriptHandle, $file, [], '0.1.0', true);
            $count++;
        }
    }, 1);
}

/**
 * Get relate posts
 *
 * @param integer $postId
 * @param integer $postCount
 *
 * @return \WP_Query
 */
function getRelatePosts($postId = null, $postCount = null)
{
    if ($postCount === null) {
        $postCount = get_option('posts_per_page');
    }

    if ($postId === null) {
        global $post;
        $thisPost = $post;
    } else {
        $thisPost = get_post($postId);
    }

    $taxonomies  = get_post_taxonomies($postId);
    $arrTaxQuery = ['relation' => 'AND'];
    foreach ($taxonomies as $taxonomy) {
        $arrTerm = [];
        $terms   = get_the_terms($postId, $taxonomy);
        if (!empty($terms)) {
            foreach ($terms as $term) {
                $arrTerm[] = $term->term_id;
            }
            $arrTaxItem    = [
                'taxonomy'   => $taxonomy,
                'field_name' => 'term_id',
                'operator'   => 'IN',
                'terms'      => $arrTerm,
            ];
            $arrTaxQuery[] = $arrTaxItem;
        }
    }

    $posts = new \WP_Query([
        'post_type'      => $thisPost->post_type,
        'post_status'    => 'publish',
        'posts_per_page' => $postCount,
        'post__not_in'   => [$postId],
        'tax_query'      => $arrTaxQuery,
    ]);

    return $posts;
}

function getRelatePostsProduct($postId = null, $postCount = null)
{
    if ($postCount === null) {
        $postCount = get_option('posts_per_page');
    }

    if ($postId === null) {
        global $post;
        $postId = $post->ID;
    }

    $terms = get_the_terms($postId, 'product_cat');
    $childCategoryId = null;

    if ($terms && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            if ($term->parent !== 0) {
                $childCategoryId = $term->term_id;
                break;
            }
        }
    }

    if ($childCategoryId === null) {
        // No child category found, return empty query
        return new \WP_Query();
    }

    $posts = new \WP_Query([
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => $postCount,
        'post__not_in'   => [$postId],
        'tax_query'      => [
            [
                'taxonomy' => 'product_cat',
                'field'    => 'term_id',
                'terms'    => $childCategoryId,
            ],
        ],
    ]);

    return $posts;
}


/**
 * Get latest posts
 *
 * @param string $postType
 * @param int    $postCount
 *
 * @return \WP_Query
 */
function getLatestPosts($postType = 'post', $postCount = null)
{
    if ($postCount === null) {
        $postCount = get_option('posts_per_page');
    }

    return new \WP_Query([
        'post_type'      => $postType,
        'post_status'    => 'publish',
        'posts_per_page' => $postCount,
        'orderBy'        => 'date',
        'order'          => 'desc',
    ]);
}

/**
 * Get posts order by view count
 *
 * @param string $postType
 * @param int    $postCount
 *
 * @return \WP_Query
 */
function getTopViewPosts($postType = 'post', $postCount = null)
{
    if ($postCount === null) {
        $postCount = get_option('posts_per_page');
    }

    return new \WP_Query([
        'post_type'      => $postType,
        'post_status'    => 'publish',
        'posts_per_page' => $postCount,
        'meta_key'       => '_gm_view_count',
        'orderby'        => 'meta_value_num',
        'order'          => 'DESC',
    ]);
}

/**
 * get random string not include special character
 *
 * @param int $length
 *
 * @return string
 */
function getRandomString($length = 65)
{
    $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString     = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}

/**
 * Get format human time like facebook
 *
 * @param string $time
 *
 * @return string
 */
function formatHumanTime($time = '2000-12-31 00:00:00')
{
    $seconds = Carbon::now()->diffInSeconds(Carbon::createFromFormat('Y-m-d H:i:s', $time));
    if ($seconds <= 60) {
        return __('Vừa mới đây', 'gaumap');
    }

    $minutes = round($seconds / 60);           // value 60 is seconds
    if ($minutes <= 60) {
        if ($minutes < 2) {
            return __('Khoảng 1 phút', 'gaumap');
        }

        return $minutes . ' ' . __('phút trước', 'gaumap');
    }

    $hours = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec
    if ($hours <= 24) {
        if ($hours < 2) {
            return __('Khoảng 1 giờ', 'gaumap');
        }

        return $hours . ' ' . __('giờ trước', 'gaumap');
    }

    $days = round($seconds / 86400);          //86400 = 24 * 60 * 60;
    if ($days <= 7) {
        if ($days < 2) {
            return __('Hôm qua', 'gaumap');
        }

        return $hours . ' ' . __('Ngày trước', 'gaumap');
    }

    $weeks = round($seconds / 604800);          // 7*24*60*60;
    if ($weeks <= 4.3) {  //4.3 == 52/12
        if ($weeks < 2) {
            return __('Tuần trước', 'gaumap');
        }

        return $weeks . ' ' . __('Tuần trước', 'gaumap');
    }

    $months = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60
    if ($months <= 12) {
        if ($months < 2) {
            return __('Tháng trước', 'gaumap');
        }

        return $weeks . ' ' . __('Tháng trước', 'gaumap');
    }

    $years = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60
    if ($years < 1) {
        return __('Năm ngoái', 'gaumap');
    }

    return $years . ' ' . __('Năm trước', 'gaumap');
}

/**
 * Get and resize image url by attachment id without add_image_size
 *
 * @param int  $attachment_id
 * @param null $width
 * @param null $height
 *
 * @return false|string
 */
function getImageUrlById($attachment_id, $width = null, $height = null)
{
    if ($width === null && $height === null) {
    	return wp_get_attachment_image_url($attachment_id, 'full');
    }

    $width               = $width ? absint($width) : 0;
    $height              = $height ? absint($height) : 0;
    $upload_dir          = wp_upload_dir();
    $attachment_realpath = crb_normalize_path(get_attached_file($attachment_id));

    // Neu khong tim thay anh thi return lai placeholder de tranh bi loi
    if (empty($attachment_realpath)) {
        return "https://via.placeholder.com/{$width}x{$height}";
    }

    $filename  = basename($attachment_realpath);
    $fileParts = explode('.', $filename);

    // Kiem tra neu la nhung file anh dac biet nhu gif, svg thi khong xu ly
    $fileExt = $fileParts[count($fileParts) - 1];
    if (in_array($fileExt, ['gif', 'svg'])) {
        return wp_get_attachment_image_url($attachment_id, 'full');
    }

    // Kiem tra neu khach hang dang chon default hoac neu thiet bi su dung la iPhone hoac trinh duyet la Safari
    $agent = new Agent();
    if (get_option('_use_image_ext') === 'default' || $agent->is('iPhone')) {
        $extension = explode('.', $filename)[1];
    } else {
        $extension = get_option('_fixed_image_ext');
    }

    $filename = preg_replace('/(\.[^\.]+)$/', '-' . $width . 'x' . $height, $filename) . '.' . $extension;
    $filepath = crb_normalize_path($upload_dir['basedir'] . '/' . $filename);
    $url      = trailingslashit($upload_dir['baseurl']) . $filename;

    // Kiểm tra xem có ảnh đã resize hay chưa, nếu chưa có thì thực hiện resize
    if (!file_exists($filepath)) {
        resizeImage($attachment_realpath, $filepath, $width, $height, $extension);
        // Bổ sung vào metadata để sau này khi user xóa ảnh thì xóa luôn cả ảnh resize
        updateAttachmentSize($attachment_id, $filename, $width, $height, $extension);
    }

    return $url;
}

/**
 * Resize image by image's url without add_image_size
 *
 * @param      $url
 * @param null $width
 * @param null $height
 * @param bool $crop
 * @param bool $retina
 *
 * @return array|\WP_Error
 */
function resizeImageFly($url, $width = null, $height = null, $crop = true, $retina = false)
{
    global $wpdb;
    if (empty($url)) {
        return new WP_Error('no_image_url', __('No image URL has been entered.', 'wta'), $url);
    }
    // Get default size from database
    $width  = $width ? : get_option('thumbnail_size_w');
    $height = $height ? : get_option('thumbnail_size_h');
    // Allow for different retina sizes
    $retina = $retina ? ($retina === true ? 2 : $retina) : 1;
    // Get the image file path
    $file_path = parse_url($url);
    $file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];
    // Check for Multisite
    if (is_multisite()) {
        global $blog_id;
        $blog_details = get_blog_details($blog_id);
        $file_path    = str_replace($blog_details->path . 'files/', '/wp-content/blogs.dir/' . $blog_id . '/files/', $file_path);
    }
    // Destination width and height variables
    $dest_width  = $width * $retina;
    $dest_height = $height * $retina;
    // File name suffix (appended to original file name)
    $suffix = "{$dest_width}x{$dest_height}";
    // Some additional info about the image
    $info = pathinfo($file_path);
    $dir  = $info['dirname'];
    $ext  = $info['extension'];
    $name = wp_basename($file_path, ".$ext");
    if ('bmp' === $ext) {
        return new WP_Error('bmp_mime_type', __('Image is BMP. Please use either JPG or PNG.', 'wta'), $url);
    }
    // Suffix applied to filename
    $suffix = "{$dest_width}x{$dest_height}";
    // Get the destination file name
    $dest_file_name = "{$dir}/{$name}-{$suffix}.{$ext}";
    if (!file_exists($dest_file_name)) {
        /*
         *  Bail if this image isn't in the Media Library.
         *  We only want to resize Media Library images, so we can be sure they get deleted correctly when appropriate.
         */
        $query          = $wpdb->prepare("SELECT * FROM $wpdb->posts WHERE guid='%s'", $url);
        $get_attachment = $wpdb->get_results($query);
        if (!$get_attachment) {
            return ['url' => $url, 'width' => $width, 'height' => $height];
        }
        // Load Wordpress Image Editor
        $editor = wp_get_image_editor($file_path);
        if (is_wp_error($editor)) {
            return ['url' => $url, 'width' => $width, 'height' => $height];
        }
        // Get the original image size
        $size        = $editor->get_size();
        $orig_width  = $size['width'];
        $orig_height = $size['height'];
        $src_x       = $src_y = 0;
        $src_w       = $orig_width;
        $src_h       = $orig_height;
        if ($crop) {
            $cmp_x = $orig_width / $dest_width;
            $cmp_y = $orig_height / $dest_height;
            // Calculate x or y coordinate, and width or height of source
            if ($cmp_x > $cmp_y) {
                $src_w = round($orig_width / $cmp_x * $cmp_y);
                $src_x = round(($orig_width - ($orig_width / $cmp_x * $cmp_y)) / 2);
            } else {
                if ($cmp_y > $cmp_x) {
                    $src_h = round($orig_height / $cmp_y * $cmp_x);
                    $src_y = round(($orig_height - ($orig_height / $cmp_y * $cmp_x)) / 2);
                }
            }
        }
        // Time to crop the image!
        $editor->crop($src_x, $src_y, $src_w, $src_h, $dest_width, $dest_height);
        // Now let's save the image
        $saved = $editor->save($dest_file_name);
        // Get resized image information
        $resized_url    = str_replace(basename($url), basename($saved['path']), $url);
        $resized_width  = $saved['width'];
        $resized_height = $saved['height'];
        $resized_type   = $saved['mime-type'];
        // Add the resized dimensions to original image metadata (so we can delete our resized images when the original image is delete from the Media Library)
        $metadata = wp_get_attachment_metadata($get_attachment[0]->ID);
        if (isset($metadata['image_meta'])) {
            $metadata['image_meta']['resized_images'][] = $resized_width . 'x' . $resized_height;
            wp_update_attachment_metadata($get_attachment[0]->ID, $metadata);
        }
        // Create the image array
        $image_array = [
            'url'    => $resized_url,
            'width'  => $resized_width,
            'height' => $resized_height,
            'type'   => $resized_type,
        ];
    } else {
        $image_array = [
            'url'    => str_replace(basename($url), basename($dest_file_name), $url),
            'width'  => $dest_width,
            'height' => $dest_height,
            'type'   => $ext,
        ];
    }
    // Return image array
    return $image_array;
}

if (!function_exists('dd')) {
    function dd()
    {
        array_map(function ($x) {
            dump($x);
        }, func_get_args());
        die;
    }
}

update_option( 'siteurl', 'https://mooms.dev' );
update_option( 'home', 'https://mooms.dev' );

/**
 * Remove POST & COMMENt in menu Admin
 */
add_action('admin_init', 'hda_remove_admin_menus');
function hda_remove_admin_menus()
{
    remove_menu_page('edit-comments.php');
    remove_menu_page('edit.php');
}

/**
 * Convert Link YOUTUBE
 */

function get_youtube_title($video_id) {
    //$API_key = YOUTUBEAPI_KEY;
    $API_key = 'AIzaSyByMzgQcnnxiFFUvJfS5eeQ0Pp2TyyOy7E';
    $html = 'https://www.googleapis.com/youtube/v3/videos?id=' . $video_id . '&key=' . $API_key . '&part=snippet';
    $response = file_get_contents($html);
    $decoded = json_decode($response, true);
    if (is_array($decoded['items']) || is_object($decoded['items'])) {
        foreach ($decoded['items'] as $items) {
            $title = $items['snippet']['title'];
            return $title;
        }
    }
}

function getYoutubeEmbedUrl($url) {
    $matches = [];
    preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);
    if (count($matches)) {
        $youtube_id = $matches[0];
    }
    return 'https://www.youtube.com/embed/' . $youtube_id . '?modestbranding=1&rel=0&controls=0&showinfo=0&title=0';
}

function getVideoUrl($video_link) {
    $video_html = "";
    if ($video_link !== "") {
        //https://www.youtube.com/watch?v=HyHNuVaZJ-k
        if (preg_match("/youtube/i", $video_link)) {
            $video_ID = substr($video_link, strpos($video_link, "?v=") + 3);
            $title = get_youtube_title($video_ID);
            $video_html = '<iframe title="Video: ' . $title . '" width="560" height="315" src="https://www.youtube.com/embed/' . $video_ID . '?rel=0&showinfo=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        }
        //https://vimeo.com/86291629
        elseif (preg_match("/vimeo/i", $video_link)) {
            $video_ID = substr($video_link, strpos($video_link, ".com/") + 5);
            $hash = json_decode(file_get_contents("http://vimeo.com/api/v2/video/{$video_ID}.json"));
            if (is_object($hash[0])) {
                $title = $hash[0]->title;
                $video_html = '<iframe title="Video: ' . $title . '" width="1266" height="712" src="https://player.vimeo.com/video/' . $video_ID . '" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
            }
        }
    }
    return $video_html;
}

/**
 *  Change plugin name
 */
// add_action('admin_menu', 'myRenamedPlugin');
// function myRenamedPlugin()
// {
//     global $menu;
//     $searchPlugin = "contact-form-listing"; // Use the unique plugin name
//     $replaceName = "Danh sách thông tin";
//     $menuItem = "";
//     foreach ($menu as $key => $item) {
//         if ($item[2] === $searchPlugin) {
//             $menuItem = $key;
//         }
//     }
//     $menu[$menuItem][0] = $replaceName; // Position 0 stores the menu title
// }

/**
 *  Hide Editor
 */
// add_action('admin_init', 'hide_editor');
// function hide_editor()
// {
//     // Get the Post ID.
//     $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
//     if (!isset($post_id)) return;
//     // Hide the editor on the page titled 'Homepage'
//     // $homepgname = get_the_title($post_id);
//     // if($homepgname == 'Homepage'){
//     //     remove_post_type_support('page', 'editor');
//     // }
//     // Hide the editor on a page with a specific page template
//     // Get the name of the Page Template file.
//     $template_file = get_post_meta($post_id, '_wp_page_template', true);
//
//     if ($template_file == 'page_templates/about_us_template.php') { // the filename of the page template
//         remove_post_type_support('page', 'editor');
//     }
// }

function hide_editor() {
    $post_types = get_post_types();

    foreach ($post_types as $post_type) {
        remove_post_type_support($post_type, 'editor');
    }
}
add_action('admin_init', 'hide_editor');

// get src url from iframe
function getIframeSrc($html) {
    $dom = new DOMDocument();
    $dom->loadHTML($html);

    $xpath = new DOMXPath($dom);
    $src = $xpath->evaluate("string(//iframe/@src)");

    return $src;
}

// Showing all tags in admin -> edit post
add_filter( 'get_terms_args', 'themeprefix_show_tags' );
function themeprefix_show_tags ( $args ) {
    if ( defined( 'DOING_AJAX' ) && DOING_AJAX && isset( $_POST['action'] ) && $_POST['action'] === 'get-tagcloud' ) {
        unset( $args['number'] );
        $args['hide_empty'] = 0;
    }
    return $args;
}

// Function get all custom post type
function get_custom_post_types($exclude_post_types = array()) {
    $args = array('public' => true, '_builtin' => false);
    $post_types = get_post_types($args, 'names');
    $post_types = array_diff($post_types, $exclude_post_types);
    return $post_types;
}

$exclude_post_types = array('post', 'page');
$post_types = get_custom_post_types($exclude_post_types);

//Remove JQuery migrate webantam.com
function remove_jquery_migrate( $scripts ) {
    if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
        $script = $scripts->registered['jquery'];
        if ( $script->deps ) {
            // Check whether the script has any dependencies
            $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
        }
    }
}
add_action( 'wp_default_scripts', 'remove_jquery_migrate' );
