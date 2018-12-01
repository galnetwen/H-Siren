<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Akina
 */

if (has_post_thumbnail()) {
    $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail');
    $post_img = $large_image_url[0];
} else {
    $post_img = get_random_bg_url();
}

?>
<article class="post post-list" itemscope="" itemtype="http://schema.org/BlogPosting">
    <div class="post-entry">
        <div class="feature">
            <a href="<?php the_permalink(); ?>">
                <div class="overlay"><i class="iconfont">&#xe791;</i></div>
                <?php if (akina_option('laziness_img') != '0') {
                    global $preset;
                    ?>
                    <img class="lazinessImg" src="<?php echo $preset; ?>" data-src="<?php echo $post_img; ?>">
                <?php } else { ?>
                    <img src="<?php echo $post_img; ?>">
                <?php } ?>
            </a>
        </div>
        <h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <div class="p-time">
            <?php if (is_sticky()) : ?>
                <i class="iconfont hotpost">&#xe758;</i>
            <?php endif ?>
            <i class="iconfont">&#xe65f;</i><?php echo poi_time_since(strtotime($post->post_date_gmt)); ?>
        </div>
        <?php the_excerpt(); ?>
        <footer class="entry-footer">
            <div class="post-more">
                <a href="<?php the_permalink(); ?>"><i class="iconfont">&#xe6a0;</i></a>
            </div>
            <div class="info-meta">
                <div class="comnum">
                    <span><i class="iconfont">&#xe731;</i><?php comments_popup_link('NOTHING', '1 条评论', '% 条评论'); ?></span>
                </div>
                <div class="views">
                    <span><i class="iconfont">&#xe73d;</i><?php echo get_post_views(get_the_ID()); ?> 热度</span>
                </div>
            </div>
        </footer>
    </div>
    <hr>
</article>
