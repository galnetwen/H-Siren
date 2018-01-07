<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Akina
 */

?>
<article class="post post-list" itemscope="" itemtype="http://schema.org/BlogPosting">
<div class="post-entry">
    <div class="feature">
    <?php if(has_post_thumbnail()) { ?>
        <a href="<?php the_permalink(); ?>"><div class="overlay"><i class="iconfont">&#xe791;</i></div><?php the_post_thumbnail(); ?></a>
        <?php } elseif(akina_option('thumbnail_o') == true && akina_option('focus_img_0')) {
        $date_strings = date('Y') . date('m') . date('d') . date('H') . date('i') . date('s') . mt_rand(100000, 999999);
        $md5_strings = md5($date_strings);
        $strings = substr($md5_strings, 0, 24);
        $random_thumbnail = akina_option('focus_img_0') . '?' . $strings;
        ?>
        <a href="<?php the_permalink();?>"><div class="overlay"><i class="iconfont">&#xe791;</i></div><img src="<?php echo $random_thumbnail; ?>" /></a>
        <?php } else { ?>
        <a href="<?php the_permalink();?>"><div class="overlay"><i class="iconfont">&#xe791;</i></div><img src="<?php bloginfo('template_url'); ?>/images/random/d-<?php echo rand(1,10)?>.jpg" /></a>
        <?php } ?>
    </div>    
    <h1 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
    <div class="p-time">
    <?php if(is_sticky()) : ?>
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
    </footer><!-- .entry-footer -->
</div>    
<hr>
</article><!-- #post-## -->
