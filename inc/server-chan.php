<?php
//WordPress评论微信推送
function kfang_serverchan_send($comment_id) {
    $comment = get_comment($comment_id);
    $text =
        '<p style="margin:0;line-height:0;color:#6ec3c8">'.($comment->comment_author).'</p><br>'.
        '<p style="margin:0;color:#f4a7b9;font-size:20px">在文章「'.get_the_title($comment->comment_post_ID).'」上发表了新评论！</p>';
    $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
    $url=$comment->comment_author_url;
    if ($url != '') {
        $desp ='> '.
        '昵称：'.($comment->comment_author).'  
        '.
        '邮箱：'.($comment->comment_author_email).'  
        '.
        '链接：'.'['.($comment->comment_author_url).']('.($comment->comment_author_url).')'.'  
        '.
        'IP：'.($comment->comment_author_IP).'  
        '.
        '文章：'.'['.get_the_title($comment->comment_post_ID).']('.get_page_link($comment->comment_post_ID).')'.'  
        '.
        '内容：'.($comment->comment_content);
    } else {
        $desp ='> '.
        '昵称：'.($comment->comment_author).'  
        '.
        '邮箱：'.($comment->comment_author_email).'  
        '.
        'IP：'.($comment->comment_author_IP).'  
        '.
        '文章：'.'['.get_the_title($comment->comment_post_ID).']('.get_page_link($comment->comment_post_ID).')'.'  
        '.
        '内容：'.($comment->comment_content);
    }
    //$key = '';  //此处填写SCKEY
    $key = akina_option('serverchan_i');
    $postdata = http_build_query (
        array (
            'text' => $text,
            'desp' => $desp
        )
    );
    $opts = array ('http' =>
        array (
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded',
            'content' => $postdata
        ) 
    );
    $context = stream_context_create($opts);
    return $result = file_get_contents('https://sc.ftqq.com/'.$key.'.send', false, $context);
}
add_action('comment_post', 'kfang_serverchan_send', 19, 2)
?>