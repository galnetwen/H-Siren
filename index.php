<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Akina
 */
get_header();
?>

<?php if (akina_option('head_notice') != '0') {
    $text = akina_option('notice_title');
    ?>
    <div class="notice">
        <i class="iconfont">&#xe66b;</i>
        <?php if (strlen($text) > 142 && !wp_is_mobile()) { ?>
            <marquee align="middle" behavior="scroll" loop="-1" scrollamount="6" style="margin: 0 8px 0 20px; display: block;" onMouseOut="this.start()" onMouseOver="this.stop()">
                <div class="notice-content"><?php echo $text; ?></div>
            </marquee>
        <?php } else { ?>
            <div class="notice-content"><?php echo $text; ?></div>
        <?php } ?>
    </div>
<?php } ?>
<?php
if (akina_option('top_feature') == '1') {
    get_template_part('layouts/feature');
}
?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <h1 class="main-title">文章</h1>
            <?php
            if (have_posts()) :
                if (is_home() && !is_front_page()) : ?>
                    <header>
                        <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                    </header>
                <?php
                endif;
                while (have_posts()) : the_post();
                    if (akina_option('post_list_style') == 'standard') {
                        get_template_part('tpl/content', get_post_format());
                    }
                    if (akina_option('post_list_style') == 'imageflow') {
                        get_template_part('tpl/content', 'thumb');
                    }
                endwhile;
            else :
                get_template_part('tpl/content', 'none');
            endif;
            ?>
        </main>
        <?php if (akina_option('pagenav_style') == 'ajax') { ?>
            <div id="pagination"><?php next_posts_link('Previous'); ?></div>
        <?php } else { ?>
            <nav class="navigator">
                <?php previous_posts_link('<i class="iconfont">&#xe679;</i>') ?><?php next_posts_link('<i class="iconfont">&#xe6a3;</i>') ?>
            </nav>
        <?php } ?>
    </div>
<?php
get_footer();