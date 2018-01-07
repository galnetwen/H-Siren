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

.site-header:hover {
    /* box-shadow: 0 0 10px <?php echo akina_option('theme_skin'); ?>;
    -moz-box-shadow: 0 0 10px <?php echo akina_option('theme_skin'); ?>;
    -webkit-box-shadow: 0 0 10px <?php echo akina_option('theme_skin'); ?>; */
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
</style>
<?php }
add_action('wp_head', 'customizer_css');
