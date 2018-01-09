<?php

/**
  * Template Name: links
  */

get_header(); 
?>
<div class="main">
    <?php while ( have_posts() ) : the_post(); ?>
    <?php the_content(); ?>
    <hr>
        <article id="post-<?php the_ID(); ?>" class="linkpage">
            <?php if(get_bookmarks(
            array(
                'category_name'  => 'LINK'
            ))) { ?>
            <h3>后宫乐园</h3>
            <ul>
                <?php
                $bookmarks = get_bookmarks( array(
                    'orderby'        => 'name',
                    'order'          => 'ASC',
                    'category_name'  => 'LINK'
                ));

                // Loop through each bookmark and print formatted output
                foreach ( $bookmarks as $bookmark ) {
                    printf( '<li><a href="%s" target="_blank"><img src="%s"><h4>%s</h4><p>%s</p></a></li>', $bookmark->link_url, $bookmark->link_image ? $bookmark->link_image : get_stylesheet_directory_uri() . '/images/links.jpg', $bookmark->link_name, $bookmark->link_description ? $bookmark->link_description : '这家伙很懒，什么也没有留下……' );
                }
                ?>
            </ul>
            <?php } ?>
            <?php if(get_bookmarks(
            array(
                'category_name'  => 'BANS'
            ))) { ?>
            <h3>挂掉了哎</h3>
            <ul>
                <?php
                $bookmarks = get_bookmarks( array(
                    'orderby'        => 'name',
                    'order'          => 'ASC',
                    'category_name'  => 'BANS'
                ));

                // Loop through each bookmark and print formatted output
                foreach ( $bookmarks as $bookmark ) {
                    printf( '<li><a href="%s" target="_blank"><img src="%s"><h4>%s</h4><p>%s</p></a></li>', $bookmark->link_url, $bookmark->link_image ? $bookmark->link_image : get_stylesheet_directory_uri() . '/images/links.jpg', $bookmark->link_name, $bookmark->link_description ? $bookmark->link_description : '这家伙很懒，什么也没有留下……' );
                }
                ?>
            </ul>
            <?php } ?>
        </article><!-- #post -->
    <?php endwhile; // end of the loop. ?>
</div><!-- main -->
<?php
get_footer();