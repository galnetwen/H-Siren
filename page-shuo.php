<?php

/**
 * Template Name: 说说
 */

get_header();
?>
    <section class="container">
        <div class="content-wrap">
            <div class="content">
                <div class="cbp_shuoshuo">
                    <?php
                    if (akina_option('shuoshuo') == 'yes') {
                        query_posts("post_type=shuoshuo & post_status=publish & posts_per_page=-1");
                        if (have_posts()) : ?>
                            <ul class="cbp_tmtimeline">
                                <?php
                                while (have_posts()) : the_post(); ?>
                                    <li>
                                        <time class="cbp_tmtime"><?php the_time('Y年m月d日 G:i'); ?></time>
                                        <div class="cbp_tmicon">
                                            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" itemprop="url" rel="author">
                                                <img src="<?php echo get_avatar_profile_url(get_the_author_meta('ID')); ?>">
                                            </a>
                                        </div>
                                        <div class="cbp_tmlabel">
                                            <?php the_content(); ?>
                                            <h3><?php the_title(); ?></h3>
                                        </div>
                                        <?php get_template_part('layouts/sharelike'); ?>
                                    </li>
                                <?php
                                endwhile; ?>
                            </ul>
                        <?php
                        else : ?>
                            <h3 style="text-align: center;">你还没有发表说说噢！</h3>
                            <p style="text-align: center;">赶快去发表你的第一条说说心情吧！</p>
                        <?php
                        endif;
                    } else { ?>
                        <h3 style="text-align: center;">你尚未开启说说心情功能！</h3>
                        <p style="text-align: center;">需要到主题设置里面打开功能，并且发布说说就可以显示啦！</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php
get_footer();