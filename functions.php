<?php
/**
 * Akina functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Akina
 */

define( 'SIREN_VERSION', '3.0.3.180407' );

if ( !function_exists( 'akina_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
 
if ( !function_exists( 'optionsframework_init' ) ) {
    define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
    require_once dirname( __FILE__ ) . '/inc/options-framework.php';
}

function akina_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on Akina, use a find and replace
     * to change 'akina' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'akina', get_template_directory() . '/languages' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 150, 150, true );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => esc_html__( '导航菜单', 'akina' ),
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );

    /*
     * Enable support for Post Formats.
     * See https://developer.wordpress.org/themes/functionality/post-formats/
     */
    add_theme_support( 'post-formats', array(
        'aside',
        'image',
        'status',
    ) );

    // Set up the WordPress core custom background feature.
    add_theme_support( 'custom-background', apply_filters( 'akina_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    ) ) );

    add_filter('pre_option_link_manager_enabled','__return_true');

    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wp_generator' );    //隐藏WordPress版本
    remove_filter('the_content', 'wptexturize');    //取消标点符号转义

    remove_action('rest_api_init', 'wp_oembed_register_route');
    remove_filter('rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4);
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
    remove_filter('oembed_response_data', 'get_oembed_response_data_rich', 10, 4);
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'wp_oembed_add_host_js');
    // Remove the Link header for the WP REST API
    // [link] => <http://cnzhx.net/wp-json/>; rel="https://api.w.org/"
    remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );

    add_filter('automatic_updater_disabled', '__return_true');    //彻底关闭自动更新

    remove_action('init', 'wp_schedule_update_checks');    //关闭更新检查定时计划

    wp_clear_scheduled_hook('wp_version_check');    //移除版本检查定时计划
    wp_clear_scheduled_hook('wp_update_plugins');    //移除插件更新定时计划
    wp_clear_scheduled_hook('wp_update_themes');    //移除主题更新定时计划
    wp_clear_scheduled_hook('wp_maybe_auto_update');    //移除自动更新定时计划

    remove_action( 'admin_init', '_maybe_update_core' );    //移除后台内核更新检查
    remove_action( 'load-plugins.php', 'wp_update_plugins' );    //移除后台插件更新检查
    remove_action( 'load-update.php', 'wp_update_plugins' );
    remove_action( 'load-update-core.php', 'wp_update_plugins' );
    remove_action( 'admin_init', '_maybe_update_plugins' );

    remove_action( 'load-themes.php', 'wp_update_themes' );    //移除后台主题更新检查
    remove_action( 'load-update.php', 'wp_update_themes' );
    remove_action( 'load-update-core.php', 'wp_update_themes' );
    remove_action( 'admin_init', '_maybe_update_themes' );
  
    add_action('wp_print_scripts', 'fanly_no_autosave');    //禁用文章自动保存
    function fanly_no_autosave() { wp_deregister_script('autosave'); }

    add_filter( 'wp_revisions_to_keep', 'fanly_wp_revisions_to_keep', 10, 2 );    //禁用文章修订版本
    function fanly_wp_revisions_to_keep( $num, $post ) { return 0;}

    function coolwp_remove_open_sans_from_wp_core() {
        wp_deregister_style( 'open-sans' );
        wp_register_style( 'open-sans', false );
        wp_enqueue_style('open-sans','');
    }
    add_action( 'init', 'coolwp_remove_open_sans_from_wp_core' );

    add_filter( 'contextual_help', 'wpse50723_remove_help', 999, 3 );

    function wpse50723_remove_help($old_help, $screen_id, $screen) {
        $screen->remove_help_tabs();
    return $old_help;
    }

    /**
     * 禁用原生EMOJI
     */
    function disable_emojis() {
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
        add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
    }
    add_action( 'init', 'disable_emojis' );

    /**
     * 禁用原生编辑器EMOJI选项
     */
    function disable_emojis_tinymce( $plugins ) {
        if ( is_array( $plugins ) ) {
            return array_diff( $plugins, array( 'wpemoji' ) );
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
    function my_css_attributes_filter($var) {
        return is_array($var) ? array_intersect($var, array('current-menu-item','current-post-ancestor','current-menu-ancestor','current-menu-parent')) : '';
    }
}
endif;
add_action( 'after_setup_theme', 'akina_setup' );

function admin_lettering(){
    echo'<style type="text/css">body{font-family: Microsoft YaHei;}</style>';
}
add_action('admin_head', 'admin_lettering');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function akina_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'akina_content_width', 640 );
}
add_action( 'after_setup_theme', 'akina_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
/*function akina_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'akina' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'akina' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'akina_widgets_init' );
*/

/**
 * Enqueue scripts and styles.
 */
function akina_scripts() {
    wp_enqueue_style( 'siren', get_stylesheet_uri(), array(), SIREN_VERSION );
    //wp_enqueue_script( 'jq', get_template_directory_uri() . '/js/jquery.min.js', array(), SIREN_VERSION, true ); 
    wp_enqueue_script( 'pjax-libs', get_template_directory_uri() . '/js/jquery.pjax.js', array(), SIREN_VERSION, true );
    wp_enqueue_script( 'input', get_template_directory_uri() . '/js/input.min.js', array(), SIREN_VERSION, true );
    wp_enqueue_script( 'app', get_template_directory_uri() . '/js/app.js', array(), SIREN_VERSION, true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    //20161116 @Louie
    $mv_live = akina_option('focus_mvlive') ? 'open' : 'close';
    $movies = akina_option('focus_amv') ? array('url' => akina_option('amv_url'), 'name' => akina_option('amv_title'), 'live' => $mv_live) : 'close';
    $auto_height = akina_option('focus_height') ? 'fixed' : 'auto';
    $code_lamp = akina_option('open_prism_codelamp') ? 'open' : 'close';
    $live2d_tips = akina_option('live2d_s') ? 'open' : 'close';
    $hitokoto = akina_option('hitokoto_o') ? 'open' : 'close';
    $picture_zoom = akina_option('zoom_c') ? 'open' : 'close';
    if(wp_is_mobile()) $auto_height = 'fixed';    //拦截移动端
    wp_localize_script( 'app', 'Poi' , array(
        'pjax' => akina_option('poi_pjax'),
        'movies' => $movies,
        'windowheight' => $auto_height,
        'codelamp' => $code_lamp,
        'live2d_tips' => $live2d_tips,
        'hitokoto' => $hitokoto,
        'picture_zoom' => $picture_zoom,
        'ajaxurl' => admin_url('admin-ajax.php'),
        'order' => get_option('comment_order'),    //ajax comments
        'formpostion' => 'bottom'    //ajax comments 默认为bottom，如果你的表单在顶部则设置为top。
    ));
}
add_action( 'wp_enqueue_scripts', 'akina_scripts' );

/**
 * load .php.
 */
require get_template_directory() .'/inc/decorate.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * function update
 */
require get_template_directory() . '/inc/siren-update.php';
require get_template_directory() . '/inc/categories-images.php';

/**
 * Disable Embeds.
 */
require get_template_directory() . '/inc/disable-embeds.php';

/**
 * COMMENT FORMATTING
 */
if(!function_exists('akina_comment_format')){
    function akina_comment_format($comment, $args, $depth){
        $GLOBALS['comment'] = $comment;
        ?>
        <li <?php comment_class(); ?> id="comment-<?php echo esc_attr(comment_ID()); ?>">
            <div class="contents">
                <div class="comment-arrow">
                    <div class="main shadow">
                        <div class="profile">
                            <a href="<?php comment_author_url(); ?>"><?php echo get_avatar( $comment->comment_author_email, '80', '', get_comment_author() ); ?></a>
                        </div>
                        <div class="commentinfo">
                            <section class="commeta">
                                <div class="left">
                                    <h4 class="author"><a href="<?php comment_author_url(); ?>" target="_blank"><?php echo get_avatar( $comment->comment_author_email, '24', '', get_comment_author() ); ?><?php comment_author(); ?> <span class="isauthor" title="<?php esc_attr_e('Author', 'akina'); ?>">博主</span></a></h4>
                                </div>
                                <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                                <?php if (current_user_can('level_10')) {
                                $home = home_url();
                                echo '
                                <span class="deleteComments" onclick="deleteComments(this);" data-url="' .wp_nonce_url( "$home/wp-admin/comment.php?c=" . $comment->comment_ID . '&amp;action=deletecomment', 'delete-comment_' . $comment->comment_ID ) . '">删除</span>
                                ';
                                } ?>
                                <div class="right">
                                    <div class="info"><time datetime="<?php comment_date('Y-m-d'); ?>"><?php echo poi_time_since(strtotime($comment->comment_date_gmt), true );//comment_date(get_option('date_format')); ?></time><?php echo siren_get_useragent($comment->comment_agent); ?></div>
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
 * post views.
 * @bigfa
 */
function restyle_text($number) {
    if($number >= 1000) {
        return round($number/1000,2) . 'k';
    }else{
        return $number;
    }
}

function set_post_views() {
    global $post;
    $post_id = intval($post->ID);
    $count_key = 'views';
    $views = get_post_custom($post_id);
    $views = intval($views['views'][0]);
    if(is_single() || is_page()) {
        if(!update_post_meta($post_id, 'views', ($views + 1))) {
            add_post_meta($post_id, 'views', 1, true);
        }
    }
}
add_action('get_header', 'set_post_views');

function get_post_views($post_id) {
    $count_key = 'views';
    $views = get_post_custom($post_id);
    $views = intval($views['views'][0]);
    $post_views = intval(post_custom('views'));
    if($views == '') {
        return 0;
    }else{
        return restyle_text($views);
    }
}

/*
 * AJAX点赞
 */
add_action('wp_ajax_nopriv_specs_zan', 'specs_zan');
add_action('wp_ajax_specs_zan', 'specs_zan');
function specs_zan(){
    global $wpdb,$post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if ( $action == 'ding'){
        $specs_raters = get_post_meta($id,'specs_zan',true);
        $expire = time() + 99999999;
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;    //make cookies work with localhost
        setcookie('specs_zan_'.$id,$id,$expire,'/',$domain,false);
        if (!$specs_raters || !is_numeric($specs_raters)) {
            update_post_meta($id, 'specs_zan', 1);
        } 
        else {
            update_post_meta($id, 'specs_zan', ($specs_raters + 1));
        }
        echo get_post_meta($id,'specs_zan',true);
    } 
    die;
}

/*
 * Gravatar头像使用中国服务器
 */
function gravatar_cn( $url ){ 
    $gravatar_url = array('0.gravatar.com','1.gravatar.com','2.gravatar.com');
    return str_replace( $gravatar_url, 'cn.gravatar.com', $url );
}
add_filter( 'get_avatar_url', 'gravatar_cn', 4 );

/*
 * 阻止站内文章互相Pingback 
 */
function theme_noself_ping( &$links ) { 
    $home = get_option( 'home' );
    foreach ( $links as $l => $link )
    if ( 0 === strpos( $link, $home ) )
    unset($links[$l]); 
}
add_action('pre_ping','theme_noself_ping');

/*
 * 订制body类
 */
function akina_body_classes( $classes ) {
    //Adds a class of group-blog to blogs with more than 1 published author.
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }
    //Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }
    return $classes;
}
add_filter( 'body_class', 'akina_body_classes' );

/*
 * 图片七牛云缓存
 */
add_filter( 'upload_dir', 'wpjam_custom_upload_dir' );
function wpjam_custom_upload_dir( $uploads ) {
    $upload_path = '';
    $upload_url_path = akina_option('qiniu_cdn');

    if ( empty( $upload_path ) || 'wp-content/uploads' == $upload_path ) {
        $uploads['basedir']  = WP_CONTENT_DIR . '/uploads';
    } elseif ( 0 !== strpos( $upload_path, ABSPATH ) ) {
        $uploads['basedir'] = path_join( ABSPATH, $upload_path );
    } else {
        $uploads['basedir'] = $upload_path;
    }

    $uploads['path'] = $uploads['basedir'].$uploads['subdir'];

    if ( $upload_url_path ) {
        $uploads['baseurl'] = $upload_url_path;
        $uploads['url'] = $uploads['baseurl'].$uploads['subdir'];
    }
    return $uploads;
}

/*
 * 删除自带小工具
 */
function unregister_default_widgets() {
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
function akina_jetpack_setup() {
    //Add theme support for Infinite Scroll.
    add_theme_support( 'infinite-scroll', array(
        'container' => 'main',
        'render'    => 'akina_infinite_scroll_render',
        'footer'    => 'page',
    ) );

    //Add theme support for Responsive Videos.
    add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'akina_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function akina_infinite_scroll_render() {
    while ( have_posts() ) {
        the_post();
    if ( is_search() ) :
        get_template_part( 'tpl/content', 'search' );
    else :
        get_template_part( 'tpl/content', get_post_format() );
    endif;
  }
}

//下载按钮
function download($atts, $content = null) {  
return '<a class="download" href="'.$content.'" rel="external"  
target="_blank" title="下载地址">  
<span><i class="iconfont down">&#xe69f;</i>Download</span></a>';}  
add_shortcode("download", "download"); 

add_action('after_wp_tiny_mce', 'bolo_after_wp_tiny_mce');  
function bolo_after_wp_tiny_mce($mce_settings) {  
?>  
<script type="text/javascript">  
    QTags.addButton( 'download', '下载按钮', "[download]下载地址[/download]" );
    function bolo_QTnextpage_arg1() {}
</script>
<?php } 

/*
 * 后台登录页
 * @M.J
 */

//Login Page style
function custom_login() {
    echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/inc/login.css" />'."\n";
    echo '<script type="text/javascript" src="'.get_bloginfo('template_directory').'/js/jquery.min.js"></script>'."\n";
}
add_action('login_head', 'custom_login');

//Login Page Title
function custom_headertitle ( $title ) {
    return get_bloginfo('name');
}
add_filter('login_headertitle','custom_headertitle');

//Login Page Link
function custom_loginlogo_url($url) {
    return esc_url( home_url('/') );
}
add_filter( 'login_headerurl', 'custom_loginlogo_url' );

//Login Page Footer
function custom_html() {
    if ( akina_option('login_bg') ) {
        $loginbg = akina_option('login_bg'); 
    }else{
        $loginbg = get_bloginfo('template_directory').'/images/hd.jpg';
    }
    echo '<script type="text/javascript" src="'.get_bloginfo('template_directory').'/js/login.js"></script>'."\n";
    echo '<script type="text/javascript">'."\n";
    echo 'jQuery("body").prepend("<div class=\"loading\"><img src=\"'.get_bloginfo('template_directory').'/images/login_loading.gif\" width=\"58\" height=\"10\"></div><div id=\"bg\"><img /></div>");'."\n";
    echo 'jQuery(\'#bg\').children(\'img\').attr(\'src\', \''.$loginbg.'\').load(function(){'."\n";
    echo 'resizeImage(\'bg\');'."\n";
    echo 'jQuery(window).bind("resize", function() { resizeImage(\'bg\'); });'."\n";
    echo 'jQuery(\'.loading\').fadeOut();'."\n";
    echo '});';
    echo '</script>'."\n";
}
add_action('login_footer', 'custom_html');

/*
 * 评论邮件回复
 */
function comment_mail_notify($comment_id){
    $mail_user_name = akina_option('mail_user_name') ? akina_option('mail_user_name') : 'Poi';
    $comment = get_comment($comment_id);
    $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
    $spam_confirmed = $comment->comment_approved;
    if(($parent_id != '') && ($spam_confirmed != 'spam')){
    $wp_email = $mail_user_name . '@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME']));
    $to = trim(get_comment($parent_id)->comment_author_email);
    $subject = '你在「' . get_option("blogname") . '」的留言有了回应';
    $message = '
    <table border="1" cellpadding="0" cellspacing="0" width="600" align="center" style="border-collapse: collapse; border-style: solid; border-width: 1;border-color:#ddd;">
    <tbody>
        <tr>
            <td>
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" height="48" >
                    <tbody>
                        <tr>
                            <td width="100" align="center" style="border-right:1px solid #ddd;"><a href="'.home_url().'/" target="_blank">'. get_option("blogname") .'</a></td>
                            <td width="300" style="padding-left:20px;"><strong>你有一条来自<a href="'.home_url().'" target="_blank" style="color:#6ec3c8;text-decoration:none;">' . get_option("blogname") . '</a>的回复</strong></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding:20px 40px 0;"><p><strong>' . trim(get_comment($parent_id)->comment_author) . '</strong>, 你好!</span>
                <p>
                你在「' . get_the_title($comment->comment_post_ID) . '」的留言:</p><p style="border-left:3px solid #ddd;padding-left:1rem;color:#999;">'
                . trim(get_comment($parent_id)->comment_content) . '</p><p>
                    ' . trim($comment->comment_author) . ' 给你的回复:</p><p style="border-left:3px solid #ddd;padding-left:1rem;color:#999;">'
                . trim($comment->comment_content) . '
                </p>
            <center><a href="' . htmlspecialchars(get_comment_link($parent_id)) . '" target="_blank" style="background-color:#6ec3c8; border-radius:10px; display:inline-block; color:#fff; padding:15px 20px 15px 20px; text-decoration:none;margin-top:20px; margin-bottom:20px;">点击查看完整内容</a></center>
            </td>
        </tr>
        <tr>
            <td align="center" valign="center" height="38" style="font-size:0.8rem; color:#999;">© '.get_option("blogname").'</td>
        </tr>
    </tbody>
    </table>';
    $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
    $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
    wp_mail( $to, $subject, $message, $headers );
    }
}
add_action('comment_post', 'comment_mail_notify');

//开放访客评论HTML标签
function sig_allowed_html_tags_in_comments() {
    define('CUSTOM_TAGS', true);
    global $allowedtags;
    $allowedtags = array(
        'a' => array(
            'href' => array ()
        ),
        'img' => array (
            'class' => array (), 'src' => array ()
        ),
        'code' => array()
    );
}
add_action('init', 'sig_allowed_html_tags_in_comments', 10);

//后台编辑器添加主题CSS
function sig_add_editor_styles() {
    //add_editor_style( '//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' );
    add_editor_style( 'style.css' );
}
add_action( 'init', 'sig_add_editor_styles' );
