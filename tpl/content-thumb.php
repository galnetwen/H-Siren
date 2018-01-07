<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package
 */

$i=0; while ( have_posts() ) : the_post(); $i++;

if(has_post_thumbnail()){
    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
    $post_img = $large_image_url[0];
} else {
    if (akina_option('thumbnail_o') == true && akina_option('focus_img_0')){
        $date_strings = date('Y') . date('m') . date('d') . date('H') . date('i') . date('s') . mt_rand(100000, 999999);
        $md5_strings = md5($date_strings);
        $strings = substr($md5_strings, 0, 24);
        $post_img = akina_option('focus_img_0') . '?' . $strings;
    } else {
        $post_img = get_bloginfo('template_url') . '/images/random/l-' . rand(1,10) . '.jpg';
    }
}

$the_cat = get_the_category();
?>
<article class="post post-list-thumbs" itemscope="" itemtype="http://schema.org/BlogPosting">
    <div class="post-thumbs" style="background-image: url(<?php echo $post_img; ?>);">
        <a href="<?php the_permalink(); ?>"></a>
    </div><!-- thumbnail-->
    <div class="post-content-wraps">
        <div class="post-content">
            <a href="<?php the_permalink(); ?>" class="post-title"><h3><?php the_title();?></h3></a>
            <div class="float-contents">
                <?php the_excerpt(); ?>
            </div>
            <div class="post-date">
                <i class="iconfont">&#xe65f;</i><?php echo poi_time_since(strtotime($post->post_date_gmt)); ?>
                <?php if(is_sticky()) : ?>
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
<?php
endwhile;