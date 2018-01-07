<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Akina
 */

?>
<article class="post works-list" itemscope="" itemtype="http://schema.org/BlogPosting">
<div class="works-entry">
    <div class="works-main">
        <div class="works-feature">
            <?php if(has_post_thumbnail()) { ?>
            <a href="<?php the_permalink();?>"><?php the_post_thumbnail('large'); ?></a>
            <?php } elseif(akina_option('thumbnail_o') == true && akina_option('focus_img_0')) {
            $date_strings = date('Y') . date('m') . date('d') . date('H') . date('i') . date('s') . mt_rand(100000, 999999);
            $md5_strings = md5($date_strings);
            $strings = substr($md5_strings, 0, 24);
            $random_thumbnail = akina_option('focus_img_0') . '?' . $strings;
            ?>
            <a href="<?php the_permalink();?>"><img src="<?php echo $random_thumbnail; ?>" /></a>
            <?php } else { ?>
            <a href="<?php the_permalink();?>"><img src="<?php bloginfo('template_url'); ?>/images/random/l-<?php echo rand(1,10)?>.jpg" /></a>
            <?php } ?>
        </div>
        <div class="works-overlay">
            <h1 class="works-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
            <div class="works-p-time">        
                <i class="iconfont">&#xe74a;</i> <?php echo poi_time_since(strtotime($post->post_date_gmt));//the_time('Y-m-d');?>
            </div>
            <div class="works-meta">
                <div class="works-comnum">  
                    <span><i class="iconfont">&#xe731;</i> <?php comments_popup_link('暂无', '1 ', '% '); ?></span>
                </div>
                <div class="works-views"> 
                    <span><i class="iconfont">&#xe73d;</i> <?php echo get_post_views(get_the_ID()); ?> </span>
                </div>   
            </div>
            <a class="worksmore" href="<?php the_permalink(); ?>"></a>
        </div>
    <!-- .entry-footer -->
    </div>
</div>
</article><!-- #post-## -->
