<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

    // 从样式表获取主题名称
    $themename = wp_get_theme();
    $themename = preg_replace("/\W/", "_", strtolower($themename) );

    $optionsframework_settings = get_option( 'optionsframework' );
    $optionsframework_settings['id'] = $themename;
    update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  请阅读:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {
    // 测试数据
    $test_array = array(
        'one' => __('1', 'options_framework_theme'),
        'two' => __('2', 'options_framework_theme'),
        'three' => __('3', 'options_framework_theme'),
        'four' => __('4', 'options_framework_theme'),
        'five' => __('5', 'options_framework_theme'),
        'six' => __('6', 'options_framework_theme'),
        'seven' => __('7', 'options_framework_theme')
    );
        

    // 复选框数组
    $multicheck_array = array(
        'one' => __('法国吐司', 'options_framework_theme'),
        'two' => __('薄煎饼', 'options_framework_theme'),
        'three' => __('煎蛋', 'options_framework_theme'),
        'four' => __('绉绸', 'options_framework_theme'),
        'five' => __('感化饼干', 'options_framework_theme')
    );

    // 复选框默认值
    $multicheck_defaults = array(
        'one' => '1',
        'five' => '1'
    );

    // 背景默认值
    $background_defaults = array(
        'color' => '',
        'image' => '',
        'repeat' => 'repeat',
        'position' => 'top center',
        'attachment'=>'scroll' );

    // 版式默认值
    $typography_defaults = array(
        'size' => '15px',
        'face' => 'georgia',
        'style' => 'bold',
        'color' => '#bada55' );
        
    // 版式设置选项
    $typography_options = array(
        'sizes' => array( '6','12','14','16','20' ),
        'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
        'styles' => array( 'normal' => '普通','bold' => '粗体' ),
        'color' => false
    );

    // 将所有分类（categories）加入数组
    $options_categories = array();
    $options_categories_obj = get_categories();
    foreach ($options_categories_obj as $category) {
        $options_categories[$category->cat_ID] = $category->cat_name;
    }
    
    // 将所有标签（tags）加入数组
    $options_tags = array();
    $options_tags_obj = get_tags();
    foreach ( $options_tags_obj as $tag ) {
        $options_tags[$tag->term_id] = $tag->name;
    }


    // 将所有页面（pages）加入数组
    $options_pages = array();
    $options_pages_obj = get_pages('sort_column=post_parent,menu_order');
    $options_pages[''] = 'Select a page:';
    foreach ($options_pages_obj as $page) {
        $options_pages[$page->ID] = $page->post_title;
    }

    // 如果使用图片单选按钮, define a directory path
    $imagepath =  get_template_directory_uri() . '/images/';

    $options = array();

    //基本设置
    $options[] = array(
        'name' => __('基本设置', 'options_framework_theme'),
        'type' => 'heading');

    $options[] = array(
        'name' => __("主题风格", 'akina'),
        'id' => 'theme_skin',
        'std' => "#f4a7b9",
        'desc' => __('自定义主题颜色，部分元素生效', ''),
        'type' => "color"
    );

    $options[] = array(
        'name' => __('主页图标', 'options_framework_theme'),
        'desc' => __('最佳高度尺寸40PX', 'options_framework_theme'),
        'id' => 'akina_logo',
        'type' => 'upload');    

    $options[] = array(
        'name' => __('关键词和描述', 'options_framework_theme'),
        'desc' => __('勾选开启，开启之后可使用下方自定义填写关键词和描述', 'options_framework_theme'),
        'id' => 'akina_meta',
        'std' => '0',
        'type' => 'checkbox');

    $options[] = array(
        'name' => __('网站关键词', 'options_framework_theme'),
        'desc' => __('各关键字间用半角逗号","分割，数量在5个以内最佳。', 'options_framework_theme'),
        'id' => 'akina_meta_keywords',
        'std' => '',
        'type' => 'text');    

    $options[] = array(
        'name' => __('网站描述', 'options_framework_theme'),
        'desc' => __('用简洁的文字描述本站点，字数建议在120个字以内。', 'options_framework_theme'),
        'id' => 'akina_meta_description',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('展开导航菜单', 'options_framework_theme'),
        'desc' => __('勾选开启，默认收缩', 'options_framework_theme'),
        'id' => 'shownav',
        'std' => '0',
        'type' => 'checkbox');

    $options[] = array(
        'name' => __('页面装饰图', 'options_framework_theme'),
        'desc' => __('默认开启，勾选关闭，显示在文章页面，独立页面以及分类页的顶部', 'options_framework_theme'),
        'id' => 'patternimg',
        'std' => '0',
        'type' => 'checkbox');

    $options[] = array(
        'name' => __('随机装饰图', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启，页面装饰图将使用 第一屏 设置的背景图API，懒人必备，写文章无需再专门设置特色图，当然手动设置的特色图不受影响', 'options_framework_theme'),
        'id' => 'thumbnail_o',
        'std' => '0',
        'type' => 'checkbox');

    $options[] = array(
        'name' => __('搜索按钮', 'akina'),
        'id' => 'top_search',
        'std' => "yes",
        'type' => "radio",
        'options' => array(
            'yes' => __('开启', ''),
            'no' => __('关闭', '')
        ));

    $options[] = array(
        'name' => __('网页背景风格', 'akina'),
        'id' => 'background_style',
        'std' => "simple",
        'type' => "radio",
        'options' => array(
            'simple' => __('白色简约', ''),
            'blur' => __('高斯模糊', '')
        ));

    $options[] = array(
        'name' => __('文章列表风格', 'akina'),
        'id' => 'post_list_style',
        'std' => "imageflow",
        'type' => "radio",
        'options' => array(
            'standard' => __('文字式', ''),
            'imageflow' => __('卡片式', '')
        ));

    $options[] = array(
        'name' => __('文字式特色图', 'akina'),
        'id' => 'list_type',
        'std' => "round",
        'type' => "radio",
        'options' => array(
            'round' => __('圆形', ''),
            'square' => __('方形', '')
        ));    

    $options[] = array(
        'name' => __('评论列表收缩', 'akina'),
        'id' => 'toggle-menu',
        'std' => "yes",
        'type' => "radio",
        'options' => array(
            'yes' => __('开启', ''),
            'no' => __('关闭', '')
        ));    

    $options[] = array(
        'name' => __('分页模式', 'akina'),
        'id' => 'pagenav_style',
        'std' => "ajax",
        'type' => "radio",
        'options' => array(
            'ajax' => __('AJAX加载', ''),
            'np' => __('翻页模式', '')
        ));

    $options[] = array(
        'name' => __('博主描述', 'options_framework_theme'),
        'desc' => __('一段自我描述的话', 'options_framework_theme'),
        'id' => 'admin_des',
        'std' => '公交车司机终于在众人的指责中将座位让给了老太太',
        'type' => 'textarea');    

    $options[] = array(
        'name' => __('页脚信息', 'options_framework_theme'),
        'desc' => __('页脚说明文字，支持HTML代码', 'options_framework_theme'),
        'id' => 'footer_info',
        'std' => '<a href="https://haremu.com/" target="_blank" rel="nofollow">H-Siren</a>',
        'type' => 'textarea');

    $options[] = array(
        'name' => __('显示网站运行时间', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启', 'options_framework_theme'),
        'id' => 'web_runtime',
        'std' => '0',
        'type' => 'checkbox');

    $options[] = array(
        'name' => __('建站日期', 'options_framework_theme'),
        'desc' => __('日期格式：10 31,2017（月 日,年)', 'options_framework_theme'),
        'id' => 'web_buildtime',
        'std' => '10 31,2017',
        'type' => 'text');

    $options[] = array(
        'name' => __('谷歌分析', 'options_framework_theme'),
        'desc' => __('填写统计 JS URL，无需标签', 'options_framework_theme'),
        'id' => 'google_analytics_1',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('谷歌分析', 'options_framework_theme'),
        'desc' => __('填写网页统计代码，无需标签', 'options_framework_theme'),
        'id' => 'google_analytics_2',
        'std' => '',
        'type' => 'textarea');

    $options[] = array(
        'name' => __('网页统计', 'options_framework_theme'),
        'desc' => __('填写网页统计代码，无需标签', 'options_framework_theme'),
        'id' => 'site_statistics',
        'std' => '',
        'type' => 'textarea');

    $options[] = array(
        'name' => __('站长统计后台', 'options_framework_theme'),
        'desc' => __('填写查看统计数据的链接', 'options_framework_theme'),
        'id' => 'site_statistics_link',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('网站地图地址', 'options_framework_theme'),
        'desc' => __('SITEMAP生成的地图链接', 'options_framework_theme'),
        'id' => 'site_map_link',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('ICP备案号', 'options_framework_theme'),
        'desc' => __('填写已备案成功的ICP号', 'options_framework_theme'),
        'id' => 'record',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('自定义CSS样式', 'options_framework_theme'),
        'desc' => __('直接填写CSS代码，无需标签', 'options_framework_theme'),
        'id' => 'site_custom_style',
        'std' => '',
        'type' => 'textarea');        


    //第一屏
    $options[] = array(
        'name' => __('第一屏', 'options_framework_theme'),
        'type' => 'heading');

    $options[] = array(
        'name' => __('总开关', 'options_framework_theme'),
        'desc' => __('默认开启，勾选关闭', 'options_framework_theme'),
        'id' => 'head_focus',
        'std' => '0',
        'type' => 'checkbox');

    $options[] = array(
        'name' => __('社交信息', 'options_framework_theme'),
        'desc' => __('默认开启，勾选关闭。显示头像、签名、SNS', 'options_framework_theme'),
        'id' => 'focus_infos',
        'std' => '0',
        'type' => 'checkbox');

    $options[] = array(
        'name' => __('动态名言', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启。使用“一言”代替博主描述名言', 'options_framework_theme'),
        'id' => 'hitokoto_o',
        'std' => '0',
        'type' => 'checkbox');

    $options[] = array(
        'name' => __('全屏显示', 'options_framework_theme'),
        'desc' => __('默认开启，勾选关闭', 'options_framework_theme'),
        'id' => 'focus_height',
        'std' => '0',
        'type' => 'checkbox');     

    $options[] = array(
        'name' => __('开启视频', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启', 'options_framework_theme'),
        'id' => 'focus_amv',
        'std' => '0',
        'type' => 'checkbox');

    $options[] = array(
        'name' => __('Live模式', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启，视频将自动续播，需要开启PJAX功能', 'options_framework_theme'),
        'id' => 'focus_mvlive',
        'std' => '0',
        'type' => 'checkbox');

    $options[] = array(
        'name' => __('视频地址', 'options_framework_theme'),
        'desc' => __('视频的来源地址，该地址拼接下方的视频名称，地址尾部不需要加斜杠', 'options_framework_theme'),
        'id' => 'amv_url',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('视频名称', 'options_framework_theme'),
        'desc' => __('比如 MV.mp4 ，只需要填写视频文件名 MV 即可，多个用英文逗号隔开如 MV,AV ，无需在意顺序，因为加载是随机的 ', 'options_framework_theme'),
        'id' => 'amv_title',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('个人头像', 'options_framework_theme'),
        'desc' => __('最佳尺寸130*130', 'options_framework_theme'),
        'id' => 'focus_logo',
        'type' => 'upload');

    $options[] = array(
        'name' => __('背景图API', 'options_framework_theme'),
        'desc' => __('这里填入一个图片API地址，比如漫月API', 'options_framework_theme'),
        'id' => 'focus_img_0',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('背景图 - 1', 'options_framework_theme'),
        'desc' => __('可选，最佳尺寸1920*1080，将替换首页图', 'options_framework_theme'),
        'id' => 'focus_img_1',
        'type' => 'upload');

    $options[] = array(
        'name' => __('背景图 - 2', 'options_framework_theme'),
        'desc' => __('可选，最佳尺寸1920*1080，将被随机显示', 'options_framework_theme'),
        'id' => 'focus_img_2',
        'type' => 'upload');

    $options[] = array(
        'name' => __('背景图 - 3', 'options_framework_theme'),
        'desc' => __('可选，最佳尺寸1920*1080，将被随机显示', 'options_framework_theme'),
        'id' => 'focus_img_3',
        'type' => 'upload');

    $options[] = array(
        'name' => __('背景图 - 4', 'options_framework_theme'),
        'desc' => __('可选，最佳尺寸1920*1080，将被随机显示', 'options_framework_theme'),
        'id' => 'focus_img_4',
        'type' => 'upload');

    $options[] = array(
        'name' => __('背景图 - 5', 'options_framework_theme'),
        'desc' => __('可选，最佳尺寸1920*1080，将被随机显示', 'options_framework_theme'),
        'id' => 'focus_img_5',
        'type' => 'upload');

    $options[] = array(
        'name' => __('背景图滤镜', 'akina'),
        'id' => 'focus_img_filter',
        'std' => "filter-nothing",
        'type' => "radio",
        'options' => array(
            'filter-nothing' => __('无', ''),
            'filter-undertint' => __('浅色', ''),
            'filter-dim' => __('暗淡', ''),
            'filter-grid' => __('网格', '')
        ));


    //文章页
    $options[] = array(
        'name' => __('文章页', 'options_framework_theme'),
        'type' => 'heading');

    $options[] = array(
        'name' => __('图片放大', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启', 'options_framework_theme'),
        'id' => 'zoom_c',
        'std' => '0',
        'type' => 'checkbox');

    $options[] = array(
        'name' => __('文章点赞', 'akina'),
        'id' => 'post_like',
        'std' => "yes",
        'type' => "radio",
        'options' => array(
            'yes' => __('开启', ''),
            'no' => __('关闭', '')
        ));    

    $options[] = array(
        'name' => __('文章分享', 'akina'),
        'id' => 'post_share',
        'std' => "no",
        'type' => "radio",
        'options' => array(
            'yes' => __('开启', ''),
            'no' => __('关闭', '')
        ));    

    $options[] = array(
        'name' => __('上一篇下一篇', 'akina'),
        'id' => 'post_nepre',
        'std' => "no",
        'type' => "radio",
        'options' => array(
            'yes' => __('开启', ''),
            'no' => __('关闭', '')
        ));    

    $options[] = array(
        'name' => __('博主信息', 'akina'),
        'id' => 'author_profile',
        'std' => "yes",
        'type' => "radio",
        'options' => array(
            'yes' => __('开启', ''),
            'no' => __('关闭', '')
        ));

    $options[] = array(
        'name' => __('微信打赏', 'options_framework_theme'),
        'desc' => __('微信二维码', 'options_framework_theme'),
        'id' => 'wechat_code',
        'type' => 'upload');

    $options[] = array(
        'name' => __('支付宝打赏', 'options_framework_theme'),
        'desc' => __('支付宝二维码', 'options_framework_theme'),
        'id' => 'alipay_code',
        'type' => 'upload');


    //社交选项
    $options[] = array(
        'name' => __('社交网络', 'options_framework_theme'),
        'type' => 'heading');    

    $options[] = array(
        'name' => __('微信', 'options_framework_theme'),
        'desc' => __('微信二维码', 'options_framework_theme'),
        'id' => 'wechat',
        'type' => 'upload');

    $options[] = array(
        'name' => __('新浪微博', 'options_framework_theme'),
        'desc' => __('微博地址', 'options_framework_theme'),
        'id' => 'sina',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('腾讯QQ', 'options_framework_theme'),
        'desc' => __('QQ号码', 'options_framework_theme'),
        'id' => 'qq',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('QQ空间', 'options_framework_theme'),
        'desc' => __('空间地址', 'options_framework_theme'),
        'id' => 'qzone',
        'std' => '',
        'type' => 'text');    

    $options[] = array(
        'name' => __('GitHub', 'options_framework_theme'),
        'desc' => __('GitHub地址', 'options_framework_theme'),
        'id' => 'github',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('乐乎', 'options_framework_theme'),
        'desc' => __('乐乎地址', 'options_framework_theme'),
        'id' => 'lofter',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('哔哩哔哩', 'options_framework_theme'),
        'desc' => __('B站地址', 'options_framework_theme'),
        'id' => 'bili',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('优酷视频', 'options_framework_theme'),
        'desc' => __('优酷地址', 'options_framework_theme'),
        'id' => 'youku',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('网易云音乐', 'options_framework_theme'),
        'desc' => __('云音乐地址', 'options_framework_theme'),
        'id' => 'wangyiyun',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('推特', 'options_framework_theme'),
        'desc' => __('推特地址', 'options_framework_theme'),
        'id' => 'twitter',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('脸书', 'options_framework_theme'),
        'desc' => __('脸书地址', 'options_framework_theme'),
        'id' => 'facebook',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('谷歌+', 'options_framework_theme'),
        'desc' => __('谷歌+地址', 'options_framework_theme'),
        'id' => 'googleplus',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('简书', 'options_framework_theme'),
        'desc' => __('简书地址', 'options_framework_theme'),
        'id' => 'jianshu',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('CSDN', 'options_framework_theme'),
        'desc' => __('CSND地址', 'options_framework_theme'),
        'id' => 'csdn',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('知乎', 'options_framework_theme'),
        'desc' => __('知乎地址', 'options_framework_theme'),
        'id' => 'zhihu',
        'std' => '',
        'type' => 'text');


    //聚焦图链
    $options[] = array(
        'name' => __('聚焦图', 'options_framework_theme'),
        'type' => 'heading' );

    $options[] = array(
        'name' => __('总开关', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启', 'options_framework_theme'),
        'id' => 'top_feature',
        'std' => '0',
        'type' => 'checkbox');    

    $options[] = array(
        'name' => __('聚焦标题', 'options_framework_theme'),
        'desc' => __('默认为聚焦，你也可以修改为其他，当然不能当广告用！不允许！！', 'options_framework_theme'),
        'id' => 'feature_title',
        'std' => '聚焦',
        'class' => 'mini',
        'type' => 'text');    

    $options[] = array(
        'name' => __('聚焦图一', 'options_framework_theme'),
        'desc' => __('尺寸257*160', 'options_framework_theme'),
        'id' => 'feature1_img',
        'std' => $imagepath.'temp.jpg',
        'type' => 'upload');

    $options[] = array(
        'name' => __('聚焦图一标题', 'options_framework_theme'),
        'desc' => __('聚焦图一标题', 'options_framework_theme'),
        'id' => 'feature1_title',
        'std' => '聚焦',
        'type' => 'text');    

    $options[] = array(
        'name' => __('聚焦图一链接', 'options_framework_theme'),
        'desc' => __('聚焦图一链接', 'options_framework_theme'),
        'id' => 'feature1_link',
        'std' => '',
        'type' => 'text');        

    $options[] = array(
        'name' => __('聚焦图二', 'options_framework_theme'),
        'desc' => __('尺寸257*160', 'options_framework_theme'),
        'id' => 'feature2_img',
        'std' => $imagepath.'temp.jpg',
        'type' => 'upload');

    $options[] = array(
        'name' => __('聚焦图二标题', 'options_framework_theme'),
        'desc' => __('聚焦图二标题', 'options_framework_theme'),
        'id' => 'feature2_title',
        'std' => '聚焦',
        'type' => 'text');

    $options[] = array(
        'name' => __('聚焦图二链接', 'options_framework_theme'),
        'desc' => __('聚焦图二链接', 'options_framework_theme'),
        'id' => 'feature2_link',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('聚焦图三', 'options_framework_theme'),
        'desc' => __('尺寸257*160', 'options_framework_theme'),
        'id' => 'feature3_img',
        'std' => $imagepath.'temp.jpg',
        'type' => 'upload');

    $options[] = array(
        'name' => __('聚焦图三标题', 'options_framework_theme'),
        'desc' => __('聚焦图三标题', 'options_framework_theme'),
        'id' => 'feature3_title',
        'std' => '聚焦',
        'type' => 'text');    

    $options[] = array(
        'name' => __('聚焦图三链接', 'options_framework_theme'),
        'desc' => __('聚焦图三链接', 'options_framework_theme'),
        'id' => 'feature3_link',
        'std' => '',
        'type' => 'text');


    //其他
    $options[] = array(
        'name' => __('其他', 'options_framework_theme'),
        'type' => 'heading' );

    $options[] = array(
        'name' => __('PJAX局部刷新', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启，原理与AJAX相同', 'options_framework_theme'),
        'id' => 'poi_pjax',
        'std' => '0',
        'type' => 'checkbox');

    $options[] = array(
        'name' => __('禁止页面右键', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启', 'options_framework_theme'),
        'id' => 'right_click',
        'std' => '0',
        'type' => 'checkbox');

    $options[] = array(
        'name' => __('页面点击特效', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启', 'options_framework_theme'),
        'id' => 'click_effect',
        'std' => '0',
        'type' => 'checkbox');

    $options[] = array(
        'name' => __('博客看板娘', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启', 'options_framework_theme'),
        'id' => 'live2d_s',
        'std' => '0',
        'type' => 'checkbox');

    $options[] = array(
        'name' => __('看板娘模型', 'akina'),
        'id' => 'live2d_m',
        'std' => "tia",
        'type' => "radio",
        'options' => array(
            'tia' => __('Tia', ''),
            'pio' => __('Pio', '')
        ));

    $options[] = array(
        'name' => __('使用衣服外链', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启，启用后看板娘衣服将从外链加载', 'options_framework_theme'),
        'id' => 'live2d_b',
        'std' => '0',
        'type' => 'checkbox');

    $options[] = array(
        'name' => __('衣服外链地址', 'options_framework_theme'),
        'desc' => __('此处填入一个看板娘衣服 PNG 图随机 API 接口，仅支持父目录，子目录选取自看板娘模型名字的小写字母', 'options_framework_theme'),
        'id' => 'live2d_i',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('网站公告', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启', 'options_framework_theme'),
        'id' => 'head_notice',
        'std' => '0',
        'type' => 'checkbox');    

    $options[] = array(
        'name' => __('公告内容', 'options_framework_theme'),
        'desc' => __('公告内容，文字超出142个字节将会被滚动显示（移动端无效），一个汉字 = 3字节，一个字母 = 1字节，自己计算吧', 'options_framework_theme'),
        'id' => 'notice_title',
        'std' => '',
        'type' => 'textarea');

    $options[] = array(
        'name' => __('文章隐藏分类', 'options_framework_theme'),
        'desc' => __('填写分类ID，多个用英文“ , ”分开，仅首页生效', 'options_framework_theme'),
        'id' => 'classify_display',
        'std' => '',
        'type' => 'text');    

    $options[] = array(
        'name' => __('图片展示分类', 'options_framework_theme'),
        'desc' => __('填写分类ID，多个用英文“ , ”分开', 'options_framework_theme'),
        'id' => 'image_category',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('发件地址前缀', 'options_framework_theme'),
        'desc' => __('用于发送系统邮件，在用户的邮箱中显示的发件人地址，不要使用中文，默认系统邮件地址为 Poi@你的域名.com', 'options_framework_theme'),
        'id' => 'mail_user_name',
        'std' => 'Poi',
        'type' => 'text');

    $options[] = array(
        'name' => __('允许私密评论', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启，允许用户设置自己的评论对其他人不可见', 'options_framework_theme'),
        'id' => 'open_private_message',
        'std' => '0',
        'type' => 'checkbox');

    $options[] = array(
        'name' => __('机器人验证', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启，开启机器人验证，过滤部分垃圾评论', 'options_framework_theme'),
        'id' => 'norobot',
        'std' => '0',
        'type' => 'checkbox');

    $options[] = array(
        'name' => __('评论UA信息', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启，开启将显示评论用户的浏览器，操作系统信息', 'options_framework_theme'),
        'id' => 'open_useragent',
        'std' => '0',
        'type' => 'checkbox');

    $options[] = array(
        'name' => __('浏览器滑动条', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启，仅支持 Chrome 内核的浏览器', 'options_framework_theme'),
        'id' => 'slider_bar',
        'std' => '0',
        'type' => 'checkbox');

    $options[] = array(
        'name' => __('多说插件支持', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启，如果使用多说插件，请开启此项', 'options_framework_theme'),
        'id' => 'general_disqus_plugin_support',
        'std' => '0',
        'type' => 'checkbox');

    $options[] = array(
        'name' => __('代码高亮PJAX', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启，仅支持 Prism 高亮插件的PJAX加载，使用前需要先安装该插件', 'options_framework_theme'),
        'id' => 'open_prism_codelamp',
        'std' => '0',
        'type' => 'checkbox');    

    $options[] = array(
        'name' => __('评论框富文本粘贴', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启，开启后可以在评论框粘贴带格式的富文本图文内容并且支持发表', 'options_framework_theme'),
        'id' => 'open_rtf',
        'std' => '0',
        'type' => 'checkbox');

    $options[] = array(
        'name' => __('网站标题自动判断', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启', 'options_framework_theme'),
        'id' => 'web_title',
        'std' => '0',
        'type' => 'checkbox');

    $options[] = array(
        'name' => __('失去焦点显示标题', 'options_framework_theme'),
        'id' => 'onblur',
        'std' => '(●—●) 哎呦，崩溃啦！',
        'type' => 'text');

    $options[] = array(
        'name' => __('获得焦点显示标题', 'options_framework_theme'),
        'id' => 'onfocus',
        'std' => 'o(≧∇≦o) 啊咧，又好了……',
        'type' => 'text');

    $options[] = array(
        'name' => __('页面复制友情提示', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启', 'options_framework_theme'),
        'id' => 'ctrl_c',
        'std' => '0',
        'type' => 'checkbox');

    $options[] = array(
        'name' => __('提示的文字', 'options_framework_theme'),
        'id' => 'ctrl_cs',
        'std' => '博主码文字不易，要转载的话记得留一个本站的链接哦……',
        'type' => 'text');

    $options[] = array(
        'name' => __('七牛图片CDN', 'options_framework_theme'),
        'desc' => __('格式：https://七牛三级域名/wp-content/uploads', 'options_framework_theme'),
        'id' => 'qiniu_cdn',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('后台登陆背景图', 'options_framework_theme'),
        'desc' => __('自定义登录背景图，如果这个地址为空则使用默认图片', 'options_framework_theme'),
        'id' => 'login_bg',
        'type' => 'upload');


    //前台登录
    $options[] = array(
        'name' => __('前台登录', 'options_framework_theme'),
        'type' => 'heading' );

    $options[] = array(
        'name' => __('指定登录地址', 'options_framework_theme'),
        'desc' => __('注意！需确定新URL可用，否则无法登陆后台', 'options_framework_theme'),
        'id' => 'new_login_url',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('指定注册地址', 'options_framework_theme'),
        'desc' => __('该链接使用在登录页面作为注册入口，建议填写', 'options_framework_theme'),
        'id' => 'exregister_url',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('允许用户注册', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启，允许用户在前台注册', 'options_framework_theme'),
        'id' => 'ex_register_open',
        'std' => '0',
        'type' => 'checkbox');    

    $options[] = array(
        'name' => __('登录自动跳转', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启，管理员跳转至后台，用户跳转至主页', 'options_framework_theme'),
        'id' => 'login_urlskip',
        'std' => '0',
        'type' => 'checkbox');

    $options[] = array(
        'name' => __('开启注册验证', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启，开启后用户注册时要滑动验证', 'options_framework_theme'),
        'id' => 'login_validate',
        'std' => '0',
        'type' => 'checkbox');    

    return $options;
}