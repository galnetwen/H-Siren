<?php
/**
 * Akina functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Akina
 */

//获取当前主题版本
$theme = wp_get_theme();
$theme_version = $theme->get('Version');
define('SIREN_VERSION', $theme_version);

if (!function_exists('akina_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */

    if (!function_exists('optionsframework_init')) {
        define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/');
        require_once dirname(__FILE__) . '/inc/options-framework.php';
    }

    function akina_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Akina, use a find and replace
         * to change 'akina' to the name of your theme in all the template files.
         */
        // load_theme_textdomain('akina', get_template_directory() . '/languages');
        // load_theme_textdomain('options_framework_theme', get_template_directory() . '/languages');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(150, 150, true);

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('导航菜单', 'akina'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        /*
         * Enable support for Post Formats.
         * See https://developer.wordpress.org/themes/functionality/post-formats/
         */
        add_theme_support('post-formats', array(
            'aside',
            'image',
            'status',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('akina_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        add_filter('pre_option_link_manager_enabled', '__return_true');

        remove_action('wp_head', 'wp_shortlink_wp_head');    //移除文章短链接
        remove_action('wp_head', 'feed_links', 2);
        remove_action('wp_head', 'feed_links_extra', 3);
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'index_rel_link');
        remove_action('wp_head', 'start_post_rel_link', 10, 0);
        remove_action('wp_head', 'rest_output_link_wp_head', 10);
        remove_action('wp_head', 'wp_generator');    //隐藏WordPress版本
        remove_filter('the_content', 'wptexturize');    //取消标点符号转义
        remove_action('rest_api_init', 'wp_oembed_register_route');
        remove_filter('rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4);
        remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
        remove_filter('oembed_response_data', 'get_oembed_response_data_rich', 10, 4);
        remove_action('wp_head', 'wp_oembed_add_discovery_links');
        remove_action('wp_head', 'wp_oembed_add_host_js');
        remove_action('template_redirect', 'rest_output_link_header', 11, 0);

        add_filter('automatic_updater_disabled', '__return_true');    //彻底关闭自动更新

        remove_action('init', 'wp_schedule_update_checks');    //关闭更新检查定时计划

        wp_clear_scheduled_hook('wp_version_check');    //移除版本检查定时计划
        wp_clear_scheduled_hook('wp_update_plugins');    //移除插件更新定时计划
        wp_clear_scheduled_hook('wp_update_themes');    //移除主题更新定时计划
        wp_clear_scheduled_hook('wp_maybe_auto_update');    //移除自动更新定时计划

        remove_action('admin_init', '_maybe_update_core');    //移除后台内核更新检查
        remove_action('load-plugins.php', 'wp_update_plugins');    //移除后台插件更新检查
        remove_action('load-update.php', 'wp_update_plugins');
        remove_action('load-update-core.php', 'wp_update_plugins');
        remove_action('admin_init', '_maybe_update_plugins');

        remove_action('load-themes.php', 'wp_update_themes');    //移除后台主题更新检查
        remove_action('load-update.php', 'wp_update_themes');
        remove_action('load-update-core.php', 'wp_update_themes');
        remove_action('admin_init', '_maybe_update_themes');

        add_action('wp_print_scripts', 'fanly_no_autosave');    //禁用文章自动保存
        function fanly_no_autosave()
        {
            wp_deregister_script('autosave');
        }

        add_filter('wp_revisions_to_keep', 'fanly_wp_revisions_to_keep', 10, 2);    //禁用文章修订版本
        function fanly_wp_revisions_to_keep($num, $post)
        {
            return 0;
        }

        function coolwp_remove_open_sans_from_wp_core()
        {
            wp_deregister_style('open-sans');
            wp_register_style('open-sans', false);
            wp_enqueue_style('open-sans', '');
        }

        add_action('init', 'coolwp_remove_open_sans_from_wp_core');

        add_filter('contextual_help', 'wpse50723_remove_help', 999, 3);

        function wpse50723_remove_help($old_help, $screen_id, $screen)
        {
            $screen->remove_help_tabs();
            return $old_help;
        }

        /**
         * 禁用原生 EMOJI
         */
        function disable_emojis()
        {
            remove_action('wp_head', 'print_emoji_detection_script', 7);
            remove_action('admin_print_scripts', 'print_emoji_detection_script');
            remove_action('wp_print_styles', 'print_emoji_styles');
            remove_action('admin_print_styles', 'print_emoji_styles');
            remove_filter('the_content_feed', 'wp_staticize_emoji');
            remove_filter('comment_text_rss', 'wp_staticize_emoji');
            remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
            add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
        }

        add_action('init', 'disable_emojis');

        /**
         * 禁用编辑器 EMOJI
         */
        function disable_emojis_tinymce($plugins)
        {
            if (is_array($plugins)) {
                return array_diff($plugins, array('wpemoji'));
            } else {
                return array();
            }
        }

        /**
         * 移除菜单冗余代码
         */
        add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
        add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
        add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
        function my_css_attributes_filter($var)
        {
            return is_array($var) ? array_intersect($var, array('current-menu-item', 'current-post-ancestor', 'current-menu-ancestor', 'current-menu-parent')) : '';
        }

        /**
         * 移除前端 DNS 预获取
         */
        function remove_dns_prefetch($hints, $relation_type)
        {
            if ('dns-prefetch' === $relation_type) {
                return array_diff(wp_dependencies_unique_hosts(), $hints);
            }

            return $hints;
        }

        add_filter('wp_resource_hints', 'remove_dns_prefetch', 10, 2);

        /**
         * 移除古腾堡编辑器前端样式
         * 适用于 WordPress 5.0+
         */
        add_action('wp_enqueue_scripts', 'remove_block_library_css', 100);
        function remove_block_library_css()
        {
            wp_dequeue_style('wp-block-library');
        }
    }
endif;
add_action('after_setup_theme', 'akina_setup');

/**
 * 定义管理后台字体
 */
function admin_font()
{ ?>
    <style type="text/css">
        body {
            font-family: "Microsoft JhengHei", miranafont, "Hiragino Sans GB", STXihei, "Microsoft YaHei", SimSun, Sans-Serif;
            font-weight: bold;
        }
    </style>
<?php }

add_action('admin_head', 'admin_font');

/**
 * 添加高斯模糊配色
 */
wp_admin_css_color('blur', __('高斯'), get_template_directory_uri() . '/inc/css/blur-colors.css', array('#00000080', '#ffffff87', '#ffffff87', '#ffffff87'));

if (get_user_option('admin_color') == "blur") {
    function blur_image()
    {
        if (akina_option('blur_bg')) {
            $blurbg = akina_option('blur_bg');
        } else {
            $blurbg = get_random_bg_url();
        } ?>
        <style type="text/css">
            body::before {
                background-image: url('<?php echo $blurbg; ?>');
            }
        </style>
    <?php }
    add_action('admin_head', 'blur_image');

    if (akina_option('blur_custom_style')) {
        function blur_custom()
        { ?>
            <style type="text/css">
                <?php echo akina_option('blur_custom_style'); ?>
            </style>
        <?php }
        add_action('admin_head', 'blur_custom');
    }

    if (akina_option('mobile_blur') == '0') {
        function blur_mobile()
        { ?>
            <style type="text/css">
                @media (max-width: 860px) {
                    body {
                        background: #f1f1f1;
                    }

                    body::before {
                        background-image: none !important;
                    }
                }
            </style>
        <?php }
        add_action('admin_head', 'blur_mobile');
    }
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function akina_content_width()
{
    $GLOBALS['content_width'] = apply_filters('akina_content_width', 640);
}

add_action('after_setup_theme', 'akina_content_width', 0);

/**
 * Enqueue Scripts And Styles
 */
function akina_scripts()
{
    wp_enqueue_style('siren', get_stylesheet_uri(), array(), SIREN_VERSION);
    wp_enqueue_script('jq', 'https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js', array(), SIREN_VERSION, true);
    wp_enqueue_script('pjax-libs', get_template_directory_uri() . '/js/jquery.pjax.js', array(), SIREN_VERSION, true);
    wp_enqueue_script('input', get_template_directory_uri() . '/js/input.min.js', array(), SIREN_VERSION, true);
    wp_enqueue_script('app', get_template_directory_uri() . '/js/app.js', array(), SIREN_VERSION, true);
    $mv_live = akina_option('focus_mvlive') ? 'open' : 'close';
    $movies = akina_option('focus_amv') ? array('url' => akina_option('amv_url'), 'name' => akina_option('amv_title'), 'live' => $mv_live) : 'close';
    $auto_height = akina_option('focus_height') ? 'fixed' : 'auto';
    $live2d_tips = akina_option('live2d_s') ? 'open' : 'close';
    $hitokoto = akina_option('hitokoto_o') ? 'open' : 'close';
    $laziness_img = akina_option('laziness_img') ? 'open' : 'close';
    if (wp_is_mobile()) $auto_height = 'fixed';    //拦截移动端
    global $theme_version;
    wp_localize_script('app', 'Poi', array(
        'pjax' => akina_option('poi_pjax'),
        'code_pjax' => akina_option('code_pjax'),
        'movies' => $movies,
        'windowheight' => $auto_height,
        'live2d_tips' => $live2d_tips,
        'hitokoto' => $hitokoto,
        'laziness_img' => $laziness_img,
        'theme_version' => $theme_version,
        'web_title' => akina_option('web_title'),
        'picture_m' => akina_option('picture_m'),
        'ajaxurl' => admin_url('admin-ajax.php'),
        'order' => get_option('comment_order'),    //ajax comments
        'formpostion' => 'bottom'    //ajax comments
    ));
}

add_action('wp_enqueue_scripts', 'akina_scripts');

/**
 * Load Other Functions
 */
require get_template_directory() . '/inc/decorate.php';
require get_template_directory() . '/inc/random.php';
require get_template_directory() . '/inc/useragent.php';

/**
 * Custom Template Tags
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer Additions
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Function Update
 */
require get_template_directory() . '/inc/siren-update.php';
require get_template_directory() . '/inc/categories-images.php';

/**
 * Disable Embeds
 */
require get_template_directory() . '/inc/disable-embeds.php';

/**
 * 心情说说
 */
if (akina_option('shuoshuo') == 'yes') {
    require get_template_directory() . '/inc/shuoshuo.php';
}

/**
 * 评论模板
 */
if (!function_exists('akina_comment_format')) {
    function akina_comment_format($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        ?>
        <li <?php comment_class(); ?> id="comment-<?php echo esc_attr(comment_ID()); ?>">
        <div class="contents">
            <div class="comment-arrow">
                <div class="main shadow">
                    <div class="profile">
                        <a href="<?php comment_author_url(); ?>"><?php echo get_avatar($comment->comment_author_email, '80', '', get_comment_author()); ?></a>
                    </div>
                    <div class="commentinfo">
                        <section class="commeta">
                            <div class="left">
                                <h4 class="author">
                                    <a href="<?php comment_author_url(); ?>" target="_blank" rel="nofollow"><?php echo get_avatar($comment->comment_author_email, '24', '', get_comment_author()); ?><?php comment_author(); ?>
                                        <span class="isauthor" title="<?php esc_attr_e('Author', 'akina'); ?>">博主</span>
                                    </a>
                                </h4>
                            </div>
                            <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                            <?php if (current_user_can('level_10')) {
                                $admin_url = admin_url();
                                echo '
                                <span class="deleteComments" onclick="deleteComments(this);" data-url="' . wp_nonce_url($admin_url . 'comment.php?c=' . $comment->comment_ID . '&amp;action=deletecomment', 'delete-comment_' . $comment->comment_ID) . '">删除</span>
                                ';
                            } ?>
                            <div class="right">
                                <div class="info">
                                    <time datetime="<?php comment_date('Y-m-d'); ?>"><?php echo poi_time_since(strtotime($comment->comment_date_gmt), true); ?></time>
                                    <?php echo siren_get_useragent($comment->comment_agent); ?>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="body">
                        <?php comment_text(); ?>
                    </div>
                </div>
                <div class="arrow-left"></div>
            </div>
        </div>
        <hr>
        <?php
    }
}

/**
 * Post Views
 */
function restyle_text($number)
{
    if ($number >= 1000) {
        return round($number / 1000, 2) . 'k';
    } else {
        return $number;
    }
}

function set_post_views()
{
    global $post;
    $post_id = intval($post->ID);
    $count_key = 'views';
    $views = get_post_custom($post_id);
    $views = intval($views['views'][0]);
    if (is_single() || is_page()) {
        if (!update_post_meta($post_id, 'views', ($views + 1))) {
            add_post_meta($post_id, 'views', 1, true);
        }
    }
}

add_action('get_header', 'set_post_views');

function get_post_views($post_id)
{
    $count_key = 'views';
    $views = get_post_custom($post_id);
    $views = intval($views['views'][0]);
    $post_views = intval(post_custom('views'));
    if ($views == '') {
        return 0;
    } else {
        return restyle_text($views);
    }
}

/**
 * AJAX点赞
 */
add_action('wp_ajax_nopriv_specs_zan', 'specs_zan');
add_action('wp_ajax_specs_zan', 'specs_zan');
function specs_zan()
{
    global $wpdb, $post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if ($action == 'ding') {
        $specs_raters = get_post_meta($id, 'specs_zan', true);
        $expire = time() + 99999999;
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;    //make cookies work with localhost
        setcookie('specs_zan_' . $id, $id, $expire, '/', $domain, false);
        if (!$specs_raters || !is_numeric($specs_raters)) {
            update_post_meta($id, 'specs_zan', 1);
        } else {
            update_post_meta($id, 'specs_zan', ($specs_raters + 1));
        }
        echo get_post_meta($id, 'specs_zan', true);
    }
    die;
}

/**
 * GRAVATAR头像使用中国服务器
 */
function gravatar_cn($url)
{
    $gravatar_url = array('0.gravatar.com/', '1.gravatar.com/', '2.gravatar.com/', 's.gravatar.com/', 'secure.gravatar.com/');
    return str_replace($gravatar_url, 'cdn.v2ex.com/gr', $url);
}

add_filter('get_avatar_url', 'gravatar_cn', 4);

/**
 * 阻止站内文章互相 PINGBACK
 */
function theme_noself_ping(&$links)
{
    $home = get_option('home');
    foreach ($links as $l => $link)
        if (0 === strpos($link, $home))
            unset($links[$l]);
}

add_action('pre_ping', 'theme_noself_ping');

/**
 * 订制 BODY 类
 */
function akina_body_classes($classes)
{
    //Adds a class of group-blog to blogs with more than 1 published author.
    if (is_multi_author()) {
        $classes[] = 'group-blog';
    }
    //Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }
    return $classes;
}

add_filter('body_class', 'akina_body_classes');

/**
 * 图片七牛云缓存
 */
add_filter('upload_dir', 'wpjam_custom_upload_dir');
function wpjam_custom_upload_dir($uploads)
{
    $upload_path = '';
    $upload_url_path = akina_option('qiniu_cdn');

    if (empty($upload_path) || 'wp-content/uploads' == $upload_path) {
        $uploads['basedir'] = WP_CONTENT_DIR . '/uploads';
    } elseif (0 !== strpos($upload_path, ABSPATH)) {
        $uploads['basedir'] = path_join(ABSPATH, $upload_path);
    } else {
        $uploads['basedir'] = $upload_path;
    }

    $uploads['path'] = $uploads['basedir'] . $uploads['subdir'];

    if ($upload_url_path) {
        $uploads['baseurl'] = $upload_url_path;
        $uploads['url'] = $uploads['baseurl'] . $uploads['subdir'];
    }
    return $uploads;
}

/**
 * 删除自带小工具
 */
function unregister_default_widgets()
{
    unregister_widget("WP_Widget_Pages");
    unregister_widget("WP_Widget_Calendar");
    unregister_widget("WP_Widget_Archives");
    unregister_widget("WP_Widget_Links");
    unregister_widget("WP_Widget_Meta");
    unregister_widget("WP_Widget_Search");
    unregister_widget("WP_Widget_Text");
    unregister_widget("WP_Widget_Categories");
    unregister_widget("WP_Widget_Recent_Posts");
    unregister_widget("WP_Widget_Recent_Comments");
    unregister_widget("WP_Widget_RSS");
    unregister_widget("WP_Widget_Tag_Cloud");
    unregister_widget("WP_Nav_Menu_Widget");
}

add_action("widgets_init", "unregister_default_widgets", 11);

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 */
function akina_jetpack_setup()
{
    //Add theme support for Infinite Scroll.
    add_theme_support('infinite-scroll', array(
        'container' => 'main',
        'render' => 'akina_infinite_scroll_render',
        'footer' => 'page',
    ));

    //Add theme support for Responsive Videos.
    add_theme_support('jetpack-responsive-videos');
}

add_action('after_setup_theme', 'akina_jetpack_setup');

/**
 * Custom render function for Infinite Scroll.
 */
function akina_infinite_scroll_render()
{
    while (have_posts()) {
        the_post();
        if (is_search()) :
            get_template_part('tpl/content', 'search');
        else :
            get_template_part('tpl/content', get_post_format());
        endif;
    }
}

/**
 * 编辑器下载按钮
 */
function download($atts, $content = null)
{
    return '<a class="download" href="' . $content . '" rel="external" target="_blank" title="下载地址"><span><i class="iconfont down">&#xe69f;</i>Download</span></a>' ;
}

add_shortcode("download", "download");

function bolo_after_wp_tiny_mce($mce_settings)
{ ?>
    <script type="text/javascript">
        QTags.addButton('download', '下载按钮', "[download] 把文件地址填写在这里 [/download]");
    </script>
<?php }

add_action('after_wp_tiny_mce', 'bolo_after_wp_tiny_mce');

/**
 * 后台登录页美化
 */
function custom_login()
{
    if (akina_option('login_bg')) {
        $loginbg = akina_option('login_bg');
    } else {
        $loginbg = get_random_bg_url();
    } ?>
    <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_directory'); ?>/inc/css/login.css">
    <style type="text/css">
        body::before {
            background-image: url('<?php echo $loginbg; ?>');
        }
    </style>
<?php }

add_action('login_head', 'custom_login');

function custom_headertitle($title)
{
    return get_bloginfo('name');
}

add_filter('login_headertitle', 'custom_headertitle');

function custom_loginlogo_url($url)
{
    return esc_url(home_url('/'));
}

add_filter('login_headerurl', 'custom_loginlogo_url');

/**
 * 评论回复邮件模板
 */
function comment_mail_notify($comment_id)
{
    $mail_user_name = akina_option('mail_user_name') ? akina_option('mail_user_name') : 'Poi';
    $comment = get_comment($comment_id);
    $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
    $spam_confirmed = $comment->comment_approved;
    if (($parent_id != '') && ($spam_confirmed != 'spam')) {
        $wp_email = $mail_user_name . '@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME']));
        $to = trim(get_comment($parent_id)->comment_author_email);
        $subject = '你在「' . get_option("blogname") . '」的留言有了回应';
        $message = '
    <table border="1" cellpadding="0" cellspacing="0" width="600" align="center" style="border-collapse: collapse; border-style: solid; border-width: 1; border-color:#ddd;">
    <tbody>
        <tr>
            <td>
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" height="48" >
                    <tbody>
                        <tr>
                            <td width="100" align="center" style="border-right: 1px solid #ddd;">
                                <a href="' . home_url() . '/" target="_blank">' . get_option("blogname") . '</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px 40px 0;">
                <p><strong>' . trim(get_comment($parent_id)->comment_author) . '</strong>, 你好!</p>
                <p>你在「' . get_the_title($comment->comment_post_ID) . '」的留言:</p>
                <p style="border-left: 3px solid #ddd; padding-left: 1rem; color: #999;">' . trim(get_comment($parent_id)->comment_content) . '</p>
                <p>' . trim($comment->comment_author) . ' 给你的回复:</p>
                <p style="border-left: 3px solid #ddd; padding-left: 1rem; color:#999;">' . trim($comment->comment_content) . '</p>
                <center><a href="' . htmlspecialchars(get_comment_link($parent_id)) . '" target="_blank" style="background-color: #6ec3c8; border-radius: 10px; display:inline-block; color:#fff; padding: 15px 20px 15px 20px; text-decoration: none; margin-top: 20px; margin-bottom: 20px;">点击查看完整内容</a></center>
            </td>
        </tr>
        <tr>
            <td align="center" valign="center" height="38" style="font-size: 0.8rem; color: #999;">© ' . get_option("blogname") . '</td>
        </tr>
    </tbody>
    </table>
    ';
        $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
        $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
        wp_mail($to, $subject, $message, $headers);
    }
}

add_action('comment_post', 'comment_mail_notify');

/**
 * 开放访客评论HTML标签
 */
function sig_allowed_html_tags_in_comments()
{
    define('CUSTOM_TAGS', true);
    global $allowedtags;
    $allowedtags = array(
        'a' => array(
            'href' => array()
        ),
        'img' => array(
            'class' => array(),
            'src' => array()
        ),
        'code' => array()
    );
}

add_action('init', 'sig_allowed_html_tags_in_comments', 10);

/**
 * 后台编辑器添加前台CSS
 */
function sig_add_editor_styles()
{
    add_editor_style('style.css');
}

add_action('init', 'sig_add_editor_styles');

/**
 * 净化图片多余标签结构
 */
if (akina_option('remove_attribute') == '1') {
    function remove_attribute_a($content)
    {
        $content = preg_replace('/class=\"[^\"]*\"/', "", $content);
        $content = preg_replace('/(width|height)="\d*"\s/', "", $content);
        $content = preg_replace('/  /', "", $content);
        return $content;
    }

    function remove_attribute_b($content)
    {
        $content = preg_replace('/(width|height)="\d*"\s/', "", $content);
        $content = preg_replace('/srcset=\"[^\"]*\"\s+sizes=\"[^\"]*\"/', "", $content);
        $content = preg_replace('/  /', "", $content);
        return $content;
    }

    add_filter('post_thumbnail_html', 'remove_attribute_a', 10);
    add_filter('image_send_to_editor', 'remove_attribute_a', 10);
    add_filter('the_content', 'remove_attribute_b', 10);

    function custom_caption_shortcode($attr, $content = null)
    {
        if (!isset($attr['caption'])) {
            if (preg_match('#((?:<a [^>]+>s*)?<img [^>]+>(?:s*</a>)?)(.*)#is', $content, $matches)) {
                $content = $matches[1];
                $attr['caption'] = trim($matches[2]);
            }
        }
        $output = apply_filters('img_caption_shortcode', '', $attr, $content);
        if ($output != '') return $output;
        extract(shortcode_atts(array(
            'id' => '',
            'align' => 'alignnone',
            'width' => '',
            'caption' => ''
        ), $attr, 'caption'));
        if (1 > (int)$width || empty($caption)) return $content;
        return '<figure class="wp-caption ' . esc_attr($align) . '">' . do_shortcode($content) . '<figcaption class="wp-caption-text">' . $caption . '</figcaption></figure>';
    }

    add_shortcode('caption', 'custom_caption_shortcode');
}

/**
 * 文章图片延迟加载处理
 */
if (akina_option('laziness_img') == true) {
    $preset = get_template_directory_uri() . '/images/preloader.svg';
    function lazinessImg($content)
    {
        global $preset;
        $imgsrc = '/<img(.+)src=[\'"]([^\'"]+)[\'"](.*)>/i';
        $replace = "<img class=\"lazinessImg\" src=\"$preset\" data-src=\"\$2\" \$3>";
        $content = preg_replace($imgsrc, $replace, $content);
        return $content;
    }

    add_filter('the_content', 'lazinessImg');
}

/**
 * 修改评论回复按钮链接
 */
global $wp_version;
if (version_compare($wp_version, '5.1.1', '>=')) {
    add_filter('comment_reply_link', 'haremu_replace_comment_reply_link', 10, 4);
    function haremu_replace_comment_reply_link($link, $args, $comment, $post)
    {
        if (get_option('comment_registration') && !is_user_logged_in()) {
            $link = sprintf(
                '<a rel="nofollow" class="comment-reply-login" href="%s">%s</a>',
                esc_url(wp_login_url(get_permalink())),
                $args['login_text']
            );
        } else {
            $onclick = sprintf(
                'return addComment.moveForm( "%1$s-%2$s", "%2$s", "%3$s", "%4$s" )',
                $args['add_below'],
                $comment->comment_ID,
                $args['respond_id'],
                $post->ID
            );
            $link = sprintf(
                "<a rel='nofollow' class='comment-reply-link' href='%s' onclick='%s' aria-label='%s'>%s</a>",
                esc_url(add_query_arg('replytocom', $comment->comment_ID, get_permalink($post->ID))) . "#" . $args['respond_id'],
                $onclick,
                esc_attr(sprintf($args['reply_to_text'], $comment->comment_author)),
                $args['reply_text']
            );
        }
        return $link;
    }
}
