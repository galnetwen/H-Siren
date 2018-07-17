<?php

/**
 * like
 */

if (akina_option('post_like') == 'yes') { ?>
    <div class="post-like">
        <a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" class="specsZan <?php if (isset($_COOKIE['specs_zan_' . get_the_ID()])) echo 'done'; ?>">
            <i class="iconfont">&#xe669;</i>
            <span class="count">
		        <?php if (get_post_meta(get_the_ID(), 'specs_zan', true)) {
                    echo get_post_meta(get_the_ID(), 'specs_zan', true);
                } else {
                    echo '0';
                } ?>
            </span>
        </a>
    </div>
<?php }