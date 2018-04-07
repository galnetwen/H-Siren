<?php
function customizer_css() { ?>
<style type="text/css">
<?php // Style Settings
if ( akina_option('shownav') ) { ?>
.site-top .lower nav {
    display: block !important;
}

<?php } // Style Settings ?>
<?php // theme-skin
if ( akina_option('theme_skin') ) { ?>
.author-profile i,
.post-like a,
.post-share .show-share,
.sub-text,
.we-info a,
span.sitename,
.post-more i:hover,
#pagination a:hover,
.post-content a:hover,
.float-content i:hover,
.entry-content a:hover,
.site-info a:hover,
.comment h4 a,
#comments-navi a.prev,
#comments-navi a.next,
.comment h4 a:hover,
.site-top ul li a:hover,
.entry-title a:hover,
#archives-temp h3,
span.page-numbers.current,
.sorry li a:hover,
.site-title a:hover,
i.iconfont.js-toggle-search.iconsearch:hover {
    color: <?php echo akina_option('theme_skin'); ?>;
}

.feature i,
.download,
.navigator i:hover,
.links ul li:before,
.ar-time i,
span.ar-circle,
.object,
::selection,
::-webkit-scrollbar-thumb,
.comment .comment-reply-link,
.siren-checkbox-radio:checked + .siren-checkbox-radioInput:after {
    background: <?php echo akina_option('theme_skin'); ?>;
}

.download,
.navigator i:hover,
.link-title,
.links ul li:hover,
#pagination a:hover,
.form-submit .submit:hover {
    border-color: <?php echo akina_option('theme_skin'); ?>;
}

.notification:hover,
.meme_btn:hover,
.meme_body,
.meme_popup .meme_btn {
    border: 1px solid <?php echo akina_option('theme_skin'); ?>;
}

.meme_popup .meme_btn {
    color: <?php echo akina_option('theme_skin'); ?>;
}

#comments_edit:focus,
.comment-respond input:focus,
.search-form input:focus {
    border: 1px solid <?php echo akina_option('theme_skin'); ?>;
    box-shadow: 0 0 10px 0 <?php echo akina_option('theme_skin'); ?>;
}

.linkpage li:hover {
    box-shadow: 0 0 10px <?php echo akina_option('theme_skin'); ?>;
    -moz-box-shadow: 0 0 10px <?php echo akina_option('theme_skin'); ?>;
    -webkit-box-shadow: 0 0 10px <?php echo akina_option('theme_skin'); ?>;
}

<?php if (akina_option('open_rtf') != '1'){ ?>
#comments_edit {
    -webkit-user-modify: read-write-plaintext-only;
    -moz-user-modify: read-write-plaintext-only;
}

<?php } ?>
<?php if (akina_option('slider_bar') != '1'){ ?>
::-webkit-scrollbar {
    display: none;
}

<?php } ?>
<?php if (akina_option('thumbnail_o') == true && akina_option('focus_img_0')){ ?>
.entry-header {
    display: none;
}

header.page-header {
    display: none;
}

<?php } ?>
ol.children .comment .contents {
    border-left: 3px solid <?php echo akina_option('theme_skin'); ?>;
}

<?php } // theme-skin ?>
<?php // Custom style
if ( akina_option('site_custom_style') ) {
    echo akina_option('site_custom_style');
}
// Custom style end ?>
<?php // liststyle
if ( akina_option('list_type') == 'square') { ?>
.feature img {
    border-radius: 0!important;
}

.feature i {
    border-radius: 0!important;
}

<?php } // liststyle ?>
<?php // comments
if ( akina_option('toggle-menu') == 'no') { ?>
.comments .comments-main {
    display: block !important;
}

.comments .comments-hidden {
    display:none !important;
}

<?php } // comments ?>
<?php if (akina_option('background_style') == 'blur') {
    $image = get_template_directory_uri() . '/' . 'images/hd.jpg';
    $image_file = get_random_bg_url() ? get_random_bg_url() : $image ;
?>
body::before {
    content: '';
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    will-change: transform;
    z-index: -1;
    background-image: url('<?php echo $image_file; ?>');
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

.comments {
    max-width: 800px;
    margin: auto;
}

#content, .comments .comments-main{
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

@media (max-width: 860px) {
    body::before{
        background-image: none;
    }

    .centerbg {
        background-image: url('<?php echo $image_file; ?>') !important;
    }

    .pattern-center header.single-header {
        text-align: left !important;
        bottom: 20px !important;
        background: rgba(0, 0, 0, 0) !important;
    }

    .single-center .entry-census {
        padding: 18px 0 0 !important;
    }

    .headertop-bar::after, .pattern-center::after {
        background: #fff !important;
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
}

<?php } ?>
</style>
<?php }
add_action('wp_head', 'customizer_css');
