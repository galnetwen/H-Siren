<?php
/**
 * COMMENTS TEMPLATE
 */

if (post_password_required()) {
    return;
}
?>
<?php if (comments_open()): ?>
    <section id="comments" class="comments">
        <div class="commentwrap comments-hidden">
            <div class="notification">
                <i class="iconfont">&#xe731;</i><?php esc_html_e('查看评论', 'akina'); ?> - <span class="noticom"><?php comments_number('NOTHING', '1 条评论', '% 条评论'); ?></span>
            </div>
        </div>
        <div class="comments-main">
            <h3 id="comments-list-title">叨叨几句... <span class="noticom"><?php comments_number('NOTHING', '1 条评论', '% 条评论'); ?></span></h3>
            <div id="loading-comments"><span></span></div>
            <?php if (have_comments()): ?>
                <ul class="commentwrap">
                    <?php wp_list_comments('type=comment&callback=akina_comment_format'); ?>
                </ul>
                <nav id="comments-navi">
                    <?php paginate_comments_links('prev_text=« Older&next_text=Newer »'); ?>
                </nav>
            <?php else : ?>
                <?php if (comments_open()): ?>
                    <div class="commentwrap">
                        <div class="notification-hidden"><i class="iconfont">&#xe731;</i> <?php esc_html_e('暂无评论', 'akina'); ?></div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <?php
            if (comments_open()) {
                $robot_comments = akina_option('norobot') ? '<label class="siren-checkbox-label"><input class="siren-checkbox-radio" type="checkbox" name="no-robot"><span class="siren-no-robot-checkbox siren-checkbox-radioInput"></span>打卡</label>' : '';
                $private_ms = akina_option('open_private_message') ? '<label class="siren-checkbox-label"><input class="siren-checkbox-radio" type="checkbox" name="is-private"><span class="siren-is-private-checkbox siren-checkbox-radioInput"></span>私密</label>' : '';
                $text = akina_option('comments_text');
                $args = array(
                    'id_form' => 'commentform',
                    'id_submit' => 'submit',
                    'title_reply' => '',
                    'title_reply_to' => esc_html__('回复给 %s', 'akina'),
                    'cancel_reply_link' => esc_html__('取消回复', 'akina'),
                    'label_submit' => esc_html__('发送评论', 'akina'),
                    'comment_field' => get_meme() . '<div id="comments_edit" placeholder="' . esc_attr__($text, 'akina') . '" contenteditable="true" class="textarea" onmouseup="comments_edit_mouseup();" onmouseout="comments_edit_mouseout();" onkeyup="comments_edit_keyup();"></div>' . '<input name="comment" type="hidden" />',
                    'comment_notes_after' => '<div class="comment_button">' . $robot_comments . $private_ms . '</div>',
                    'comment_notes_before' => '',
                    'submit_button' => '<input onclick="comments_submit();" name="%1$s" type="button" id="%2$s" class="%3$s" value="%4$s" />',
                    'fields' => apply_filters('comment_form_default_fields', array(
                            'author' => '<input type="text" placeholder="' . esc_attr__('昵称', 'akina') . ' ' . ($req ? '(' . esc_attr__('必填', 'akina') . ')' : '') . '" name="author" id="author" value="' . esc_attr($comment_author) . '" size="22" tabindex="1" ' . ($req ? "aria-required='true'" : '') . ' />',
                            'email' => '<input type="text" placeholder="' . esc_attr__('邮箱', 'akina') . ' ' . ($req ? '(' . esc_attr__('必填', 'akina') . ')' : '') . '" name="email" id="email" value="' . esc_attr($comment_author_email) . '" size="22" tabindex="1" ' . ($req ? "aria-required='true'" : '') . ' />',
                            'url' => '<input type="text" placeholder="' . esc_attr__('网站', 'akina') . ' ' . ($req ? '(' . esc_attr__('选填', 'akina') . ')' : '') . '" name="url" id="url" value="' . esc_attr($comment_author_url) . '" size="22" tabindex="1" />'
                        )
                    )
                );
                comment_form($args);
            }
            ?>
        </div>
    </section>
<?php endif; ?>