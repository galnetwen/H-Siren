<?php

/**
 * Template Name: 友链
 */

get_header();
?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
        <?php while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
            <hr>
            <article id="post-<?php the_ID(); ?>" class="linkpage <?php echo akina_option('linkpage'); ?>">
                <?php
                $linkcats = $wpdb->get_results("SELECT T1.name AS name FROM $wpdb->terms T1, $wpdb->term_taxonomy T2 WHERE T1.term_id = T2.term_id AND T2.taxonomy = 'link_category'");
                if ($linkcats) :
                    foreach ($linkcats as $linkcat) :
                        ?>
                        <?php if (get_bookmarks('category_name=' . $linkcat->name)) { ?>
                        <h3><?php echo $linkcat->name; ?></h3>
                        <ul>
                            <?php
                            $bookmarks = get_bookmarks(array(
                                'orderby' => 'rand',
                                'category_name' => $linkcat->name
                            ));
                            foreach ($bookmarks as $bookmark) {
                                printf('<li><a href="%s" target="_blank"><img src="%s"><h4>%s</h4><p>%s</p></a></li>', $bookmark->link_url, $bookmark->link_image ? $bookmark->link_image : get_stylesheet_directory_uri() . '/images/links.jpg', $bookmark->link_name, $bookmark->link_description ? $bookmark->link_description : '这条咸鱼并没有什么名言和理想……');
                            }
                            ?>
                        </ul>
                    <?php } else { ?>
                        <h3><?php echo $linkcat->name; ?></h3>
                        <p>这个分类并没有链接噢 ~ </p>
                    <?php }
                    endforeach;
                else : ?>
                    <h2>链接不见了？</h2>
                    <p>不是噢！因为链接是按照分类显示的，只有把链接放在分类里面才会显示噢！</p>
                <?php endif; ?>
            </article>
        <?php endwhile; ?>
        </main>
    </div>
<?php
get_footer();