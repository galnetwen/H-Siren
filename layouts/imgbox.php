<?php
$image_file = get_random_bg_url() ? 'background-image: url(' . get_random_bg_url() . ');' : '';
$bg_style = akina_option('focus_height') ? 'background-position: center center;background-attachment: inherit;' : '';
?>
<?php if (akina_option('background_style') == 'simple') { ?>
    <figure id="centerbg" class="centerbg" style="<?php echo $image_file . $bg_style ?>">
<?php } else { ?>
    <figure id="centerbg" class="centerbg" style="<?php echo 'background-image: none;' ?>">
<?php } ?>
<?php if (!akina_option('focus_infos')) { ?>
    <div class="focusinfo">
        <?php
        global $current_user ;
        get_currentuserinfo();
        if (is_user_logged_in()) :
            ?>
            <div class="header-tou">
                <a href="<?php bloginfo('url'); ?>"><img src="<?php echo get_avatar_profile_url($current_user->user_email); ?>"></a>
            </div>
        <?php elseif (akina_option('focus_logo')) : ?>
            <div class="header-tou">
                <a href="<?php bloginfo('url'); ?>"><img src="<?php echo akina_option('focus_logo'); ?>"></a>
            </div>
        <?php else : ?>
            <div class="header-tou">
                <a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/avatar.jpg"></a>
            </div>
        <?php endif; ?>
        <div class="header-info">
            <p><?php echo $current_user->description ? $current_user->description : akina_option('admin_des'); ?></p>
        </div>
        <div class="top-social">
            <?php if (akina_option('wechat')) { ?>
                <li class="wechat">
                    <a href="#"><img src="<?php bloginfo('template_url'); ?>/images/sns/wechat.png"/></a>
                    <div class="wechatInner">
                        <img src="<?php echo akina_option('wechat', ''); ?>" alt="微信名片">
                    </div>
                </li>
            <?php } ?>
            <?php if (akina_option('lofter')) { ?>
                <li>
                    <a href="<?php echo akina_option('lofter', ''); ?>" target="_blank" title="乐乎">
                        <img src="<?php bloginfo('template_url'); ?>/images/sns/lofter.png"/>
                    </a>
                </li>
            <?php } ?>
            <?php if (akina_option('qzone')) { ?>
                <li>
                    <a href="<?php echo akina_option('qzone', ''); ?>" target="_blank" title="QQ空间">
                        <img src="<?php bloginfo('template_url'); ?>/images/sns/qzone.png"/>
                    </a>
                </li>
            <?php } ?>
            <?php if (akina_option('sina')) { ?>
                <li>
                    <a href="<?php echo akina_option('sina', ''); ?>" target="_blank" title="新浪微博">
                        <img src="<?php bloginfo('template_url'); ?>/images/sns/sina.png"/>
                    </a>
                </li>
            <?php } ?>
            <?php if (akina_option('bili')) { ?>
                <li>
                    <a href="<?php echo akina_option('bili', ''); ?>" target="_blank" title="哔哩哔哩">
                        <img src="<?php bloginfo('template_url'); ?>/images/sns/bilibili.png"/>
                    </a>
                </li>
            <?php } ?>
            <?php if (akina_option('youku')) { ?>
                <li>
                    <a href="<?php echo akina_option('youku', ''); ?>" target="_blank" title="优酷视频">
                        <img src="<?php bloginfo('template_url'); ?>/images/sns/youku.png"/>
                    </a>
                </li>
            <?php } ?>
            <?php if (akina_option('twitter')) { ?>
                <li>
                    <a href="<?php echo akina_option('twitter', ''); ?>" target="_blank" title="Twitter">
                        <img src="<?php bloginfo('template_url'); ?>/images/sns/twitter.png"/>
                    </a>
                </li>
            <?php } ?>
            <?php if (akina_option('facebook')) { ?>
                <li>
                    <a href="<?php echo akina_option('facebook', ''); ?>" target="_blank" title="Facebook">
                        <img src="<?php bloginfo('template_url'); ?>/images/sns/facebook.png"/>
                    </a>
                </li>
            <?php } ?>
            <?php if (akina_option('douban')) { ?>
                <li>
                    <a href="<?php echo akina_option('douban', ''); ?>" target="_blank" title="豆瓣">
                        <img src="<?php bloginfo('template_url'); ?>/images/sns/douban.png"/>
                    </a>
                </li>
            <?php } ?>
            <?php if (akina_option('jianshu')) { ?>
                <li>
                    <a href="<?php echo akina_option('jianshu', ''); ?>" target="_blank" title="简书">
                        <img src="<?php bloginfo('template_url'); ?>/images/sns/jianshu.png"/>
                    </a>
                </li>
            <?php } ?>
            <?php if (akina_option('zhihu')) { ?>
                <li>
                    <a href="<?php echo akina_option('zhihu', ''); ?>" target="_blank" title="知乎">
                        <img src="<?php bloginfo('template_url'); ?>/images/sns/zhihu.png"/>
                    </a>
                </li>
            <?php } ?>
            <?php if (akina_option('csdn')) { ?>
                <li>
                    <a href="<?php echo akina_option('csdn', ''); ?>" target="_blank" title="CSDN">
                        <img src="<?php bloginfo('template_url'); ?>/images/sns/csdn.png"/>
                    </a>
                </li>
            <?php } ?>
            <?php if (akina_option('github')) { ?>
                <li>
                    <a href="<?php echo akina_option('github', ''); ?>" target="_blank" title="Github">
                        <img src="<?php bloginfo('template_url'); ?>/images/sns/github.png"/>
                    </a>
                </li>
            <?php } ?>
            <?php if (akina_option('netease')) { ?>
                <li>
                    <a href="<?php echo akina_option('netease', ''); ?>" target="_blank" title="网易云音乐">
                        <img src="<?php bloginfo('template_url'); ?>/images/sns/netease.png"/>
                    </a>
                </li>
            <?php } ?>
        </div>
    </div>
<?php } ?>
    </figure>
<?php
echo bgvideo(); //BGVideo