<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package
 */

if (has_post_thumbnail()) {
    $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
    $post_img = $large_image_url[0];
} else {
    $post_img = get_random_bg_url();
}

$the_cat = get_the_category();

?>
<article class="post post-list-thumbs" itemscope="" itemtype="http://schema.org/BlogPosting">
    <?php if (akina_option('laziness_img') != '0') {
    global $preset;
    ?>
    <div class="post-thumbs lazinessImg" style="background-image: url(<?php echo $preset; ?>);" data-src="<?php echo $post_img; ?>">
        <?php } else { ?>
        <div class="post-thumbs" style="background-image: url(<?php echo $post_img; ?>);">
            <?php } ?>
            <a href="<?php the_permalink(); ?>"></a>
        </div>
        <div class="post-content-wraps">
            <div class="post-content">
                <a href="<?php the_permalink(); ?>" class="post-title"><h3><?php the_title(); ?></h3></a>
                <div class="float-contents">
                    <?php the_excerpt(); ?>
                </div>
                <div class="post-date">
                    <i class="iconfont">&#xe65f;</i><?php echo poi_time_since(strtotime($post->post_date_gmt)); ?>
                    <?php if (is_sticky()) : ?>
                        &nbsp;<i class="iconfont hotpost">&#xe758;</i>
                    <?php endif ?>
                </div>
                <div class="post-meta">
                    <span class="enthusiasm"><i class="iconfont">&#xe73d;</i><?php echo get_post_views(get_the_ID()); ?> 热度</span>
                    <span class="comment-number"><i class="iconfont">&#xe731;</i><?php comments_popup_link('NOTHING', '1 条评论', '% 条评论'); ?></span>
                    <span class="classification"><i class="iconfont">&#xe739;</i><a href="<?php echo esc_url(get_category_link($the_cat[0]->cat_ID)); ?>"><?php echo $the_cat[0]->cat_name; ?></a></span>
                </div>
            </div>
        </div>
</article>
