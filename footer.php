<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Akina
 */
?>
</div><!-- #content -->
<?php comments_template('', true); ?>
</div><!-- #page pjax container-->
<?php if (akina_option('live2d_s') != '0') { ?>
    <div id="landlord">
        <div class="message" style="opacity:0"></div>
        <canvas id="live2d" width="280" height="250" class="live2d"></canvas>
        <div class="hide-button">隐藏</div>
    </div>
<?php } ?>
<?php if (akina_option('click_effect') == 'click' || akina_option('click_effect') == 'all') { ?>
    <canvas class="fireworks"></canvas>
<?php } ?>
<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="site-info">
        <div class="footertext">
            <p class="foo-logo" style="background-image: url('<?php bloginfo('template_url'); ?>/images/f-logo.png');"></p>
            <p><?php echo akina_option('footer_info', ''); ?></p>
        </div>
        <div class="footer-device">
            <p>
                <?php
                $statistics_link = akina_option('site_statistics_link') ? '<a href="' . akina_option('site_statistics_link') . '" target="_blank" rel="nofollow">Statistics</a>' : '';
                $site_map_link = akina_option('site_map_link') ? '<a href="' . akina_option('site_map_link') . '" target="_blank" rel="nofollow">Sitemap</a>' : '';
                printf(esc_html__('%1$s &nbsp; %2$s &nbsp; %3$s &nbsp; %4$s', 'akina'), $site_map_link, '<a href="https://haremu.com" rel="designer" target="_blank" rel="nofollow">Theme</a>', '<a href="https://wordpress.org" target="_blank" rel="nofollow">WordPress</a>', $statistics_link);
                ?>
            </p>
        </div>
        <div class="footer-device">
            <p><?php echo akina_option('record') ? '<a href="http://www.beian.miit.gov.cn" target="_blank" rel="nofollow">' . akina_option('record') . '</a>' : ''; ?></p>
        </div>
        <?php if (akina_option('web_runtime') != '0') { ?>
            <div class="footer-device">
                <p>网站在各种灾难中运行了 <?php echo get_web_buildtime(); ?> 天</p>
            </div>
        <?php } ?>
    </div><!-- .site-info -->
</footer><!-- #colophon -->
<div class="openNav">
    <div class="iconflat">
        <div class="icon"></div>
    </div>
    <div class="site-branding">
        <?php if (akina_option('akina_logo')) { ?>
            <div class="site-title"><a href="<?php bloginfo('url'); ?>"><img src="<?php echo akina_option('akina_logo'); ?>"></a></div>
        <?php } else { ?>
            <h1 class="site-title"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
        <?php } ?>
    </div>
</div><!-- m-nav-bar -->
</section><!-- #section -->
<div id="mo-nav">
    <?php mobile_user_menu(); ?>
    <div class="m-search">
        <form class="m-search-form" method="get" action="<?php echo home_url(); ?>" role="search">
            <input class="m-search-input" type="search" name="s" placeholder="<?php _e('搜索', 'akina') ?>" required>
        </form>
    </div>
    <?php wp_nav_menu(array('depth' => 2, 'theme_location' => 'primary', 'container' => false)); ?>
</div><!-- m-nav-center -->
<a href="#" class="cd-top"></a>
<form class="js-search search-form search-form--modal" method="get" action="<?php echo home_url(); ?>" role="search">
    <div class="search-form__inner">
        <div>
            <p class="micro mb-"><?php _e('输入后按回车搜索 ...', 'akina') ?></p>
            <i class="iconfont">&#xe65c;</i>
            <input class="text-input" type="search" name="s" placeholder="<?php _e('输入你要搜索的内容', 'akina') ?>" required>
        </div>
    </div>
    <div class="search_close"></div>
</form><!-- search -->
<?php wp_footer(); ?>
<?php if (akina_option('live2d_s') != '0') { ?>
    <script type="text/javascript">
        var live2d_Path = '<?php bloginfo('template_url'); ?>/live2d/model/<?php echo akina_option('live2d_m'); ?>/';
        var message_Path = '<?php bloginfo('template_url'); ?>/live2d/';
        var home_Path = '<?php echo home_url('/'); ?>';
        <?php if (akina_option('live2d_b') == true && akina_option('live2d_i')) {
        $date_strings = date('Y') . date('m') . date('d') . date('H') . date('i') . date('s') . mt_rand(100000, 999999);
        $md5_strings = md5($date_strings);
        $strings = substr($md5_strings, 0, 8);
        ?>
        var live2d_Dress = '<?php echo akina_option('live2d_i'); ?>/<?php echo akina_option('live2d_m'); ?>?<?php echo $strings; ?>';
        <?php } ?>
    </script>
<?php } ?>
<?php if (akina_option('site_statistics')) { ?>
    <script type="text/javascript">
        <?php echo akina_option('site_statistics'); ?>
    </script>
<?php } ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/OwO/meme.js"></script>
<?php if (akina_option('click_effect') == 'click' || akina_option('click_effect') == 'all') { ?>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/animejs@2.2.0/anime.min.js"></script>
    <script type="text/javascript">
        if (screen && screen.width > 860) {
            document.write('<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/fireworks.js"><\/script>');
        }
    </script>
<?php } ?>
<?php if (akina_option('click_effect') == 'slide' || akina_option('click_effect') == 'all') { ?>
    <script type="text/javascript">
        if (screen && screen.width > 860) {
            document.write('<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/inc/js/cursor-effects.js"><\/script>');
        }
    </script>
<?php } ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/inc/js/sweet-alert.min.js"></script>
<?php if (akina_option('ctrl_c') != '0') { ?>
    <script type="text/javascript">
        document.body.oncopy = function () {
            swal({
                title: "复制成功",
                text: "<?php echo akina_option('ctrl_cs'); ?>",
                type: "success",
                confirmButtonText: "好的",
                timer: 2100
            });
        }
    </script>
<?php } ?>
<?php if (akina_option('live2d_s') != '0') { ?>
    <script type="text/javascript">
        if (screen && screen.width > 860) {
            document.write('<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/live2d/js/live2d.js"><\/script>');
            document.write('<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/live2d/js/message.js"><\/script>');
            document.write('<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/live2d/js/<?php if (akina_option('live2d_b') == true && akina_option('live2d_i')) { ?>run_field.js<?php } else { ?>run_local.js<?php } ?>"><\/script>');
        }
    </script>
<?php } ?>
</body>
</html>