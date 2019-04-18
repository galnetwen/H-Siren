<?php
function customizer_css()
{ ?>
    <style type="text/css">
        <?php if ( akina_option('shownav') ) { ?>
        .site-top .lower nav {
            display: block !important;
        }

        <?php }

        if ( akina_option('theme_skin') ) { ?>
        #archives-temp h3, #comments-navi a.next, #comments-navi a.prev, #pagination a:hover, .author-profile i, .comment h4 a, .comment h4 a:hover, .entry-content a:hover, .entry-title a:hover, .float-content i:hover, .post-content a:hover, .post-like a, .post-more i:hover, .post-share .show-share, .site-info a:hover, .site-title a:hover, .site-top ul li a:hover, .sorry li a:hover, .sub-text, .we-info a, i.iconfont.js-toggle-search.iconsearch:hover, span.page-numbers.current, span.sitename {
            color: <?php echo akina_option('theme_skin'); ?>;
        }

        .ar-time i, .comment .comment-reply-link, .download, .feature i, .links ul li:before, .navigator i:hover, .object, .siren-checkbox-radio:checked + .siren-checkbox-radioInput:after, ::selection, span.ar-circle {
            background: <?php echo akina_option('theme_skin'); ?>;
        }

        #pagination a:hover, .download, .form-submit .submit:hover, .link-title, .links ul li:hover, .navigator i:hover {
            border-color: <?php echo akina_option('theme_skin'); ?>;
        }

        .notification:hover, .meme_btn:hover, .meme_body, .meme_popup .meme_btn {
            border: 1px solid<?php echo akina_option('theme_skin'); ?>;
        }

        .meme_popup .meme_btn {
            color: <?php echo akina_option('theme_skin'); ?>;
        }

        #comments_edit:focus, .comment-respond input:focus, .search-form input:focus {
            border: 1px solid<?php echo akina_option('theme_skin'); ?>;
            box-shadow: 0 0 10px 0<?php echo akina_option('theme_skin'); ?>;
        }

        #mo-nav .m-search input:focus {
            box-shadow: 0 0 10px 0<?php echo akina_option('theme_skin'); ?>;
        }

        .linkpage li:hover {
            box-shadow: 0 0 10px<?php echo akina_option('theme_skin'); ?>;
            -moz-box-shadow: 0 0 10px<?php echo akina_option('theme_skin'); ?>;
            -webkit-box-shadow: 0 0 10px<?php echo akina_option('theme_skin'); ?>;
        }

        ol.children .comment .contents {
            border-left: 3px solid<?php echo akina_option('theme_skin'); ?>;
        }

        <?php }

        if (akina_option('open_rtf') != '1') { ?>
        #comments_edit {
            -webkit-user-modify: read-write-plaintext-only;
            -moz-user-modify: read-write-plaintext-only;
        }

        <?php }

        if (akina_option('slider_bar') != '0') { ?>
        ::-webkit-scrollbar {
            display: none;
        }

        <?php }

        if (akina_option('patternimg') == '0') { ?>
        header.page-header,
        .entry-header {
            display: none;
        }

        <?php }

        if ( akina_option('list_type') == 'square') { ?>
        .feature i, .feature img {
            border-radius: 0 !important;
        }

        <?php }

        if ( akina_option('toggle-menu') == 'no') { ?>
        .comments .comments-main {
            display: block !important;
        }

        .comments .comments-hidden {
            display: none !important;
        }

        <?php }

        if (akina_option('background_style') == 'blur') { ?>
        body::before {
            content: '';
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            will-change: transform;
            z-index: -1;
            background-image: url('<?php echo get_random_bg_url(); ?>');
            background-repeat: no-repeat;
            background-position: top right;
            background-size: cover;
            -moz-filter: blur(10px) brightness(.88);
            -webkit-filter: blur(10px) brightness(.88);
            -o-filter: blur(10px) brightness(.88);
            -ms-filter: blur(10px) brightness(.88);
            filter: blur(10px) brightness(.88);
        }

        .pattern-center {
            max-width: 800px;
            margin: auto;
            margin-top: 75px;
        }

        .pattern-center::before {
            z-index: 1;
        }

        .pattern-center::after {
            z-index: 2;
        }

        .pattern-center header.single-header {
            text-align: center;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
        }

        .single-center .entry-census span img {
            float: none;
            vertical-align: middle;
        }

        #content, .notification, .comments .comments-main, .info-meta, .notice {
            background: rgba(255, 255, 255, .53);
        }

        .notification span {
            color: #6F6F6F;
        }

        .info-meta {
            border-radius: 8px;
            border: none;
        }

        .info-meta a, .info-meta span {
            color: #6F6F6F;
        }

        #content, .comments .comments-main {
            border-radius: 0 0 10px 10px;
        }

        .meme_btn, .form-submit .submit, #comments_edit, .notification, #pagination a {
            border: 1px solid #545454;
        }

        .author-profile p {
            border-top: 1px solid #545454;
            border-bottom: 1px solid #545454;
        }

        .post-footer {
            border-bottom: 1px dashed #545454;
            border-top: 1px dashed #545454;
        }

        .single-center::before {
            background: rgba(0, 0, 0, 0);
        }

        .single-center .entry-census {
            padding: 8px 0;
        }

        .headertop-bar::after, .pattern-center::after, .comments, .site-footer {
            background: none;
        }

        .pattern-center .pattern-attachment-img {
            -webkit-transition: -webkit-transform .5s ease-out;
            -webkit-transition: transform .5s ease-out;
            transition: transform .5s ease-out;
        }

        .pattern-center:hover .pattern-attachment-img {
            -webkit-transform: scale(1.07);
            transform: scale(1.07);
            -ms-transform: scale(1.07);
        }

        .headertop::before {
            position: unset;
        }

        .linkpage li {
            background-color: rgba(0, 0, 0, 0.3);
        }

        .linkpage li a p {
            color: #ddd;
        }

        @media (max-width: 860px) {
        <?php if (akina_option('mobile_blur') == '0') { ?>
            body::before {
                background-image: none;
            }

            .headertop-bar::after, .pattern-center::after {
                background: #fff !important;
            }

        <?php } ?>
            .centerbg {
                background-image: url('<?php echo get_random_bg_url(); ?>') !important;
            }

            .pattern-center header.single-header {
                text-align: left !important;
                bottom: 20px !important;
                background: rgba(0, 0, 0, 0) !important;
            }

            .single-center .entry-census {
                padding: 18px 0 0 !important;
            }

            .pattern-center {
                margin-top: 0;
            }

            .single-center::before {
                background: rgba(0, 0, 0, .3);
            }

            .headertop::before {
                position: absolute;
            }

            .linkpage li {
                background-color: #fff;
            }

            .linkpage li a p {
                color: #bbc;
            }

        <?php if (akina_option('mobile_blur') == '1') { ?>
            .wrapper {
                background: none;
            }

            #mo-nav {
                background: none;
            }

            #mo-nav .m-search form {
                background: none;
            }

            #mo-nav .m-search input {
                background: rgba(255, 255, 255, .53);
            }

            #mo-nav ul li a {
                background: rgba(255, 255, 255, .53);
                border-radius: 5px;
            }

        <?php } ?>
        }

        <?php }

        if ( akina_option('site_custom_style') ) {
            echo akina_option('site_custom_style');
        }

        ?>
    </style>
<?php }

add_action('wp_head', 'customizer_css');
