<?php

/**
 * NEXT / PREVIOUS POSTS (精华版)
 */

if (akina_option('post_nepre') == 'yes') {
    $prev_post = get_previous_post();
    $next_post = get_next_post();
    ?>
    <section class="post-squares nextprev">
        <div class="post-nepre <?php if (get_next_post()) { echo 'half'; } else { echo 'full'; } ?> previous">
            <?php previous_post_link('%link', '<div class="background" style="background-image:url(' . get_catch_thumbnail($prev_post->ID) . ');"></div><span class="label">Previous Post</span><div class="info"><h3>%title</h3><hr></div>') ?>
        </div>
        <div class="post-nepre <?php if (get_previous_post()) { echo 'half'; } else { echo 'full'; } ?> next">
            <?php next_post_link('%link', '<div class="background" style="background-image:url(' . get_catch_thumbnail($next_post->ID) . ');"></div><span class="label">Next Post</span><div class="info"><h3>%title</h3><hr></div>') ?>
        </div>
    </section>
<?php }