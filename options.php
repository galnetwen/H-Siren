<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name()
{
    // 从样式表获取主题名称
    $themename = wp_get_theme();
    $themename = preg_replace("/\W/", "_", strtolower($themename));
    $optionsframework_settings = get_option('optionsframework');
    $optionsframework_settings['id'] = $themename;
    update_option('optionsframework', $optionsframework_settings);
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * With the actual text domain for your theme, please read:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options()
{
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
        'attachment' => 'scroll'
    );

    // 版式默认值
    $typography_defaults = array(
        'size' => '15px',
        'face' => 'georgia',
        'style' => 'bold',
        'color' => '#bada55'
    );

    // 版式设置选项
    $typography_options = array(
        'sizes' => array('6', '12', '14', '16', '20'),
        'faces' => array('Helvetica Neue' => 'Helvetica Neue', 'Arial' => 'Arial'),
        'styles' => array('normal' => '普通', 'bold' => '粗体'),
        'color' => false
    );

    // 将所有分类加入数组
    $options_categories = array();
    $options_categories_obj = get_categories();
    foreach ($options_categories_obj as $category) {
        $options_categories[$category->cat_ID] = $category->cat_name;
    }

    // 将所有标签加入数组
    $options_tags = array();
    $options_tags_obj = get_tags();
    foreach ($options_tags_obj as $tag) {
        $options_tags[$tag->term_id] = $tag->name;
    }


    // 将所有页面加入数组
    $options_pages = array();
    $options_pages_obj = get_pages('sort_column=post_parent,menu_order');
    $options_pages[''] = 'Select a page:';
    foreach ($options_pages_obj as $page) {
        $options_pages[$page->ID] = $page->post_title;
    }

    // 定义预置的图片路径
    $imagepath = get_template_directory_uri() . '/images/';

    $options = array();

    //基本设置
    $options[] = array(
        'name' => __('基本设置', 'options_framework_theme'),
        'type' => 'heading'
    );

    $options[] = array(
        'name' => __('主题风格', 'options_framework_theme'),
        'id' => 'theme_skin',
        'std' => "#f4a7b9",
        'desc' => __('自定义主题颜色，部分元素生效', 'options_framework_theme'),
        'type' => "color"
    );

    $options[] = array(
        'name' => __('主页图标', 'options_framework_theme'),
        'desc' => __('最佳高度尺寸40PX，不上传图标默认显示网站名称', 'options_framework_theme'),
        'id' => 'akina_logo',
        'type' => 'upload'
    );

    $options[] = array(
        'name' => __('关键词和描述', 'options_framework_theme'),
        'desc' => __('勾选开启，开启之后可使用下方自定义填写关键词和描述', 'options_framework_theme'),
        'id' => 'akina_meta',
        'std' => '0',
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __('网站关键词', 'options_framework_theme'),
        'desc' => __('各关键字间用半角逗号","分割，数量在5个以内最佳', 'options_framework_theme'),
        'id' => 'akina_meta_keywords',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('网站描述', 'options_framework_theme'),
        'desc' => __('用简洁的文字描述本站点，字数建议在120个字以内', 'options_framework_theme'),
        'id' => 'akina_meta_description',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('展开导航菜单', 'options_framework_theme'),
        'desc' => __('勾选开启，默认收缩', 'options_framework_theme'),
        'id' => 'shownav',
        'std' => '0',
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __('页面装饰图', 'options_framework_theme'),
        'desc' => __('默认开启，勾选关闭，显示在文章页面，独立页面以及分类页的顶部', 'options_framework_theme'),
        'id' => 'patternimg',
        'std' => '0',
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __('搜索按钮', 'options_framework_theme'),
        'id' => 'top_search',
        'std' => "yes",
        'type' => "radio",
        'options' => array(
            'yes' => __('开启', 'options_framework_theme'),
            'no' => __('关闭', 'options_framework_theme')
        )
    );

    $options[] = array(
        'name' => __('说说心情', 'options_framework_theme'),
        'id' => 'shuoshuo',
        'std' => "no",
        'type' => "radio",
        'options' => array(
            'yes' => __('开启', 'options_framework_theme'),
            'no' => __('关闭', 'options_framework_theme')
        )
    );

    $options[] = array(
        'name' => __('网页背景风格', 'options_framework_theme'),
        'id' => 'background_style',
        'std' => "blur",
        'type' => "radio",
        'options' => array(
            'simple' => __('白色简约', 'options_framework_theme'),
            'blur' => __('高斯模糊', 'options_framework_theme')
        )
    );

    $options[] = array(
        'name' => __('移动高斯模糊', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启，仅对“高斯模糊”网页背景风格生效', 'options_framework_theme'),
        'id' => 'mobile_blur',
        'std' => '0',
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __('文章列表风格', 'options_framework_theme'),
        'id' => 'post_list_style',
        'std' => "imageflow",
        'type' => "radio",
        'options' => array(
            'standard' => __('文字式', 'options_framework_theme'),
            'imageflow' => __('卡片式', 'options_framework_theme')
        )
    );

    $options[] = array(
        'name' => __('文字式特色图', 'options_framework_theme'),
        'id' => 'list_type',
        'std' => "round",
        'type' => "radio",
        'options' => array(
            'round' => __('圆形', 'options_framework_theme'),
            'square' => __('方形', 'options_framework_theme')
        )
    );

    $options[] = array(
        'name' => __('文章分页模式', 'options_framework_theme'),
        'id' => 'pagenav_style',
        'std' => "ajax",
        'type' => "radio",
        'options' => array(
            'ajax' => __('AJAX加载', 'options_framework_theme'),
            'np' => __('翻页模式', 'options_framework_theme')
        )
    );

    $options[] = array(
        'name' => __('评论列表收缩', 'options_framework_theme'),
        'id' => 'toggle-menu',
        'std' => "yes",
        'type' => "radio",
        'options' => array(
            'yes' => __('开启', 'options_framework_theme'),
            'no' => __('关闭', 'options_framework_theme')
        )
    );

    $options[] = array(
        'name' => __('博主描述', 'options_framework_theme'),
        'desc' => __('一段自我描述的话', 'options_framework_theme'),
        'id' => 'admin_des',
        'std' => '公交车司机终于在众人的指责中将座位让给了老太太',
        'type' => 'textarea'
    );

    $options[] = array(
        'name' => __('页脚信息', 'options_framework_theme'),
        'desc' => __('页脚说明文字，支持HTML代码', 'options_framework_theme'),
        'id' => 'footer_info',
        'std' => '<a href="https://www.cssplus.org" target="_blank" rel="nofollow">Siren</a>',
        'type' => 'textarea'
    );

    $options[] = array(
        'name' => __('显示网站运行时间', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启', 'options_framework_theme'),
        'id' => 'web_runtime',
        'std' => '0',
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __('建站日期', 'options_framework_theme'),
        'desc' => __('日期格式：2017-10-31（年-月-日）', 'options_framework_theme'),
        'id' => 'web_buildtime',
        'std' => '2017-10-31',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('谷歌分析', 'options_framework_theme'),
        'desc' => __('填写统计 JS URL，无需标签', 'options_framework_theme'),
        'id' => 'google_analytics_1',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('谷歌分析', 'options_framework_theme'),
        'desc' => __('填写网页统计代码，无需标签', 'options_framework_theme'),
        'id' => 'google_analytics_2',
        'std' => '',
        'type' => 'textarea'
    );

    $options[] = array(
        'name' => __('网页统计', 'options_framework_theme'),
        'desc' => __('填写网页统计代码，无需标签', 'options_framework_theme'),
        'id' => 'site_statistics',
        'std' => '',
        'type' => 'textarea'
    );

    $options[] = array(
        'name' => __('站长统计后台', 'options_framework_theme'),
        'desc' => __('填写查看统计数据的链接', 'options_framework_theme'),
        'id' => 'site_statistics_link',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('网站地图地址', 'options_framework_theme'),
        'desc' => __('SITEMAP生成的地图链接', 'options_framework_theme'),
        'id' => 'site_map_link',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('ICP备案号', 'options_framework_theme'),
        'desc' => __('填写已备案成功的ICP号', 'options_framework_theme'),
        'id' => 'record',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('自定义前台CSS样式', 'options_framework_theme'),
        'desc' => __('直接填写CSS代码，无需 HTML 标签，在前台展示页面生效', 'options_framework_theme'),
        'id' => 'site_custom_style',
        'std' => '',
        'type' => 'textarea'
    );

    $options[] = array(
        'name' => __('自定义后台CSS样式', 'options_framework_theme'),
        'desc' => __('直接填写CSS代码，无需 HTML 标签，仅对模糊配色后生效', 'options_framework_theme'),
        'id' => 'blur_custom_style',
        'std' => '',
        'type' => 'textarea'
    );


    //第一屏
    $options[] = array(
        'name' => __('第一屏', 'options_framework_theme'),
        'type' => 'heading'
    );

    $options[] = array(
        'name' => __('总开关', 'options_framework_theme'),
        'desc' => __('默认开启，勾选关闭，仅在 PC 端生效', 'options_framework_theme'),
        'id' => 'head_focus',
        'std' => '0',
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __('社交信息', 'options_framework_theme'),
        'desc' => __('默认开启，勾选关闭，显示头像、签名、SNS', 'options_framework_theme'),
        'id' => 'focus_infos',
        'std' => '0',
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __('动态名言', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启，使用“一言”代替主页博主描述名言', 'options_framework_theme'),
        'id' => 'hitokoto_o',
        'std' => '0',
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __('全屏显示', 'options_framework_theme'),
        'desc' => __('默认开启，勾选关闭', 'options_framework_theme'),
        'id' => 'focus_height',
        'std' => '0',
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __('开启视频', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启', 'options_framework_theme'),
        'id' => 'focus_amv',
        'std' => '0',
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __('Live模式', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启，视频将自动续播，需要开启PJAX功能', 'options_framework_theme'),
        'id' => 'focus_mvlive',
        'std' => '0',
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __('视频地址', 'options_framework_theme'),
        'desc' => __('视频的来源地址，该地址拼接下方的视频名称，地址尾部不需要加斜杠，比如“https://1.cn/MV.mp4”，只需要填写“https://1.cn”，这个地址是固定的', 'options_framework_theme'),
        'id' => 'amv_url',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('视频名称', 'options_framework_theme'),
        'desc' => __('仅支持MP4格式，比如“https://1.cn/MV.mp4”，只需要填写视频文件名“MV”即可，多个视频用英文逗号隔开如“MV,AV”，无需在意顺序，因为加载是随机的', 'options_framework_theme'),
        'id' => 'amv_title',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('个人头像', 'options_framework_theme'),
        'desc' => __('最佳尺寸130*130', 'options_framework_theme'),
        'id' => 'focus_logo',
        'type' => 'upload'
    );

    $options[] = array(
        'name' => __('背景图API', 'options_framework_theme'),
        'desc' => __('这里填入一个图片API地址，比如漫月API，仅支持静态URL', 'options_framework_theme'),
        'id' => 'focus_img_0',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('背景图滤镜', 'options_framework_theme'),
        'id' => 'focus_img_filter',
        'std' => "filter-nothing",
        'type' => "radio",
        'options' => array(
            'filter-nothing' => __('无', 'options_framework_theme'),
            'filter-undertint' => __('浅色', 'options_framework_theme'),
            'filter-dim' => __('暗淡', 'options_framework_theme'),
            'filter-grid' => __('网格', 'options_framework_theme')
        )
    );


    //文章页
    $options[] = array(
        'name' => __('文章页', 'options_framework_theme'),
        'type' => 'heading'
    );

    $options[] = array(
        'name' => __('文章点赞', 'options_framework_theme'),
        'id' => 'post_like',
        'std' => "yes",
        'type' => "radio",
        'options' => array(
            'yes' => __('开启', 'options_framework_theme'),
            'no' => __('关闭', 'options_framework_theme')
        )
    );

    $options[] = array(
        'name' => __('上一篇下一篇', 'options_framework_theme'),
        'id' => 'post_nepre',
        'std' => "no",
        'type' => "radio",
        'options' => array(
            'yes' => __('开启', 'options_framework_theme'),
            'no' => __('关闭', 'options_framework_theme')
        )
    );

    $options[] = array(
        'name' => __('博主信息', 'options_framework_theme'),
        'id' => 'author_profile',
        'std' => "yes",
        'type' => "radio",
        'options' => array(
            'yes' => __('开启', 'options_framework_theme'),
            'no' => __('关闭', 'options_framework_theme')
        )
    );

    $options[] = array(
        'name' => __('微信打赏', 'options_framework_theme'),
        'desc' => __('上传一个微信收款码图片', 'options_framework_theme'),
        'id' => 'wechat_code',
        'type' => 'upload'
    );

    $options[] = array(
        'name' => __('支付宝打赏', 'options_framework_theme'),
        'desc' => __('上传一个支付宝收款码图片', 'options_framework_theme'),
        'id' => 'alipay_code',
        'type' => 'upload'
    );


    //社交选项
    $options[] = array(
        'name' => __('社交网络', 'options_framework_theme'),
        'type' => 'heading'
    );

    $options[] = array(
        'name' => __('微信', 'options_framework_theme'),
        'desc' => __('上传一个微信二维码图片', 'options_framework_theme'),
        'id' => 'wechat',
        'type' => 'upload'
    );

    $options[] = array(
        'name' => __('乐乎', 'options_framework_theme'),
        'desc' => __('填入一个 URL 地址', 'options_framework_theme'),
        'id' => 'lofter',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('QQ空间', 'options_framework_theme'),
        'desc' => __('填入一个 URL 地址', 'options_framework_theme'),
        'id' => 'qzone',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('新浪微博', 'options_framework_theme'),
        'desc' => __('填入一个 URL 地址', 'options_framework_theme'),
        'id' => 'sina',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('哔哩哔哩', 'options_framework_theme'),
        'desc' => __('填入一个 URL 地址', 'options_framework_theme'),
        'id' => 'bili',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('优酷视频', 'options_framework_theme'),
        'desc' => __('填入一个 URL 地址', 'options_framework_theme'),
        'id' => 'youku',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('推特', 'options_framework_theme'),
        'desc' => __('填入一个 URL 地址', 'options_framework_theme'),
        'id' => 'twitter',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('脸书', 'options_framework_theme'),
        'desc' => __('填入一个 URL 地址', 'options_framework_theme'),
        'id' => 'facebook',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('豆瓣', 'options_framework_theme'),
        'desc' => __('填入一个 URL 地址', 'options_framework_theme'),
        'id' => 'douban',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('简书', 'options_framework_theme'),
        'desc' => __('填入一个 URL 地址', 'options_framework_theme'),
        'id' => 'jianshu',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('知乎', 'options_framework_theme'),
        'desc' => __('填入一个 URL 地址', 'options_framework_theme'),
        'id' => 'zhihu',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('CSDN', 'options_framework_theme'),
        'desc' => __('填入一个 URL 地址', 'options_framework_theme'),
        'id' => 'csdn',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('GitHub', 'options_framework_theme'),
        'desc' => __('填入一个 URL 地址', 'options_framework_theme'),
        'id' => 'github',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('网易云音乐', 'options_framework_theme'),
        'desc' => __('填入一个 URL 地址', 'options_framework_theme'),
        'id' => 'netease',
        'std' => '',
        'type' => 'text'
    );


    //聚焦图链
    $options[] = array(
        'name' => __('聚焦图', 'options_framework_theme'),
        'type' => 'heading'
    );

    $options[] = array(
        'name' => __('总开关', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启，仅在 PC 端生效', 'options_framework_theme'),
        'id' => 'top_feature',
        'std' => '0',
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __('聚焦标题', 'options_framework_theme'),
        'desc' => __('默认为聚焦，你也可以修改为其他，当然不能当广告用！不允许！！', 'options_framework_theme'),
        'id' => 'feature_title',
        'std' => '聚焦',
        'class' => 'mini',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('聚焦图一', 'options_framework_theme'),
        'desc' => __('尺寸257*160', 'options_framework_theme'),
        'id' => 'feature1_img',
        'std' => $imagepath . 'temp.jpg',
        'type' => 'upload'
    );

    $options[] = array(
        'name' => __('聚焦图一标题', 'options_framework_theme'),
        'desc' => __('聚焦图一标题', 'options_framework_theme'),
        'id' => 'feature1_title',
        'std' => '聚焦',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('聚焦图一链接', 'options_framework_theme'),
        'desc' => __('聚焦图一链接', 'options_framework_theme'),
        'id' => 'feature1_link',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('聚焦图二', 'options_framework_theme'),
        'desc' => __('尺寸257*160', 'options_framework_theme'),
        'id' => 'feature2_img',
        'std' => $imagepath . 'temp.jpg',
        'type' => 'upload'
    );

    $options[] = array(
        'name' => __('聚焦图二标题', 'options_framework_theme'),
        'desc' => __('聚焦图二标题', 'options_framework_theme'),
        'id' => 'feature2_title',
        'std' => '聚焦',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('聚焦图二链接', 'options_framework_theme'),
        'desc' => __('聚焦图二链接', 'options_framework_theme'),
        'id' => 'feature2_link',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('聚焦图三', 'options_framework_theme'),
        'desc' => __('尺寸257*160', 'options_framework_theme'),
        'id' => 'feature3_img',
        'std' => $imagepath . 'temp.jpg',
        'type' => 'upload'
    );

    $options[] = array(
        'name' => __('聚焦图三标题', 'options_framework_theme'),
        'desc' => __('聚焦图三标题', 'options_framework_theme'),
        'id' => 'feature3_title',
        'std' => '聚焦',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('聚焦图三链接', 'options_framework_theme'),
        'desc' => __('聚焦图三链接', 'options_framework_theme'),
        'id' => 'feature3_link',
        'std' => '',
        'type' => 'text'
    );


    //其它
    $options[] = array(
        'name' => __('其它项', 'options_framework_theme'),
        'type' => 'heading'
    );

    $options[] = array(
        'name' => __('页面PJAX加载', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启', 'options_framework_theme'),
        'id' => 'poi_pjax',
        'std' => '0',
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __('代码高亮PJAX', 'options_framework_theme'),
        'desc' => __('开启前需要先安装对应插件', 'options_framework_theme'),
        'id' => 'code_pjax',
        'std' => "off",
        'type' => "radio",
        'options' => array(
            'off' => __('关闭', 'options_framework_theme'),
            'prism' => __('（PRISM.JS）', 'options_framework_theme'),
            'highlight' => __('（HIGHLIGHT.JS）', 'options_framework_theme')
        )
    );

    $options[] = array(
        'name' => __('禁止页面右键', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启', 'options_framework_theme'),
        'id' => 'right_click',
        'std' => '0',
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __('页面点击特效', 'options_framework_theme'),
        'desc' => __('该功能仅在 PC 端有效果', 'options_framework_theme'),
        'id' => 'click_effect',
        'std' => "off",
        'type' => "radio",
        'options' => array(
            'off' => __('关闭', 'options_framework_theme'),
            'click' => __('点击大爆炸', 'options_framework_theme'),
            'slide' => __('滑动小星星', 'options_framework_theme'),
            'all' => __('以上全都要', 'options_framework_theme')
        )
    );

    $options[] = array(
        'name' => __('净化图片标签', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启，去除 IMG 中多余的标签元素，开启后可能会产生新 BUG ，关闭恢复。BETA', 'options_framework_theme'),
        'id' => 'remove_attribute',
        'std' => '0',
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __('图片放大方式', 'options_framework_theme'),
        'desc' => __('该功能仅在 PC 端有效果', 'options_framework_theme'),
        'id' => 'picture_m',
        'std' => "off",
        'type' => "radio",
        'options' => array(
            'off' => __('关闭', 'options_framework_theme'),
            'single' => __('单张放大查看，兼容性高（ZOOMING.JS）', 'options_framework_theme'),
            'multiple' => __('画廊多张浏览，兼容性低，仅对媒体库中有“链接到-媒体文件”的图片生效（BAGUETTEBOX.JS）', 'options_framework_theme')
        )
    );

    $options[] = array(
        'name' => __('图片延迟加载', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启，仅对首页文章列表和文章内的图片生效', 'options_framework_theme'),
        'id' => 'laziness_img',
        'std' => '0',
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __('博客看板娘', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启，该功能仅在 PC 端有效果', 'options_framework_theme'),
        'id' => 'live2d_s',
        'std' => '0',
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __('看板娘模型', 'options_framework_theme'),
        'id' => 'live2d_m',
        'std' => "tia",
        'type' => "radio",
        'options' => array(
            'tia' => __('Tia', 'options_framework_theme'),
            'pio' => __('Pio', 'options_framework_theme')
        )
    );

    $options[] = array(
        'name' => __('使用衣服外链', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启，启用后看板娘衣服将从外链加载', 'options_framework_theme'),
        'id' => 'live2d_b',
        'std' => '0',
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __('衣服外链地址', 'options_framework_theme'),
        'desc' => __('此处填入一个看板娘衣服 PNG 图随机 API 接口，仅支持父目录，子目录选取自看板娘模型名字的小写字母', 'options_framework_theme'),
        'id' => 'live2d_i',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('友链样式', 'options_framework_theme'),
        'id' => 'linkpage',
        'std' => 'waterfall',
        'type' => 'radio',
        'options' => array(
            'waterfall' => __('瀑布流', 'options_framework_theme'),
            'paved' => __('纯平铺', 'options_framework_theme')
        )
    );

    $options[] = array(
        'name' => __('网站公告', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启', 'options_framework_theme'),
        'id' => 'head_notice',
        'std' => '0',
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __('公告内容', 'options_framework_theme'),
        'desc' => __('公告内容，文字超出142个字节将会被滚动显示（移动端无效），一个汉字 = 3字节，一个字母 = 1字节，自己计算吧', 'options_framework_theme'),
        'id' => 'notice_title',
        'std' => '',
        'type' => 'textarea'
    );

    $options[] = array(
        'name' => __('文章隐藏分类', 'options_framework_theme'),
        'desc' => __('填写分类ID，多个用英文“ , ”分开，仅首页生效', 'options_framework_theme'),
        'id' => 'classify_display',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('图片展示分类', 'options_framework_theme'),
        'desc' => __('填写分类ID，多个用英文“ , ”分开', 'options_framework_theme'),
        'id' => 'image_category',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('发件地址前缀', 'options_framework_theme'),
        'desc' => __('用于发送系统邮件，在用户的邮箱中显示的发件人地址，不要使用中文，默认系统邮件地址为“Poi@你的域名.com”，仅适用于 WordPress 不需要装插件就能发信的服务器，但多数服务器已屏蔽', 'options_framework_theme'),
        'id' => 'mail_user_name',
        'std' => 'Poi',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('允许私密评论', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启，允许用户设置自己的评论对其他人不可见', 'options_framework_theme'),
        'id' => 'open_private_message',
        'std' => '0',
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __('机器人验证', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启，开启机器人验证，过滤部分垃圾评论', 'options_framework_theme'),
        'id' => 'norobot',
        'std' => '0',
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __('评论UA信息', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启，开启将显示评论用户的浏览器，操作系统信息', 'options_framework_theme'),
        'id' => 'open_useragent',
        'std' => '0',
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __('隐藏滑动条', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启，仅支持 Chrome 内核的浏览器', 'options_framework_theme'),
        'id' => 'slider_bar',
        'std' => '0',
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __('评论框预置文字', 'options_framework_theme'),
        'id' => 'comments_text',
        'std' => '还不快点说点什么呀……',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('评论框富文本粘贴', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启，开启后可以在评论框粘贴带格式的富文本图文内容并且支持发表', 'options_framework_theme'),
        'id' => 'open_rtf',
        'std' => '0',
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __('网站标题自动判断', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启', 'options_framework_theme'),
        'id' => 'web_title',
        'std' => '0',
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __('失去焦点显示标题', 'options_framework_theme'),
        'id' => 'onblur',
        'std' => '(●—●) 哎呦，崩溃啦！',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('获得焦点显示标题', 'options_framework_theme'),
        'id' => 'onfocus',
        'std' => 'o(≧∇≦o) 啊咧，又好了……',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('页面复制友情提示', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启', 'options_framework_theme'),
        'id' => 'ctrl_c',
        'std' => '0',
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => __('提示的文字', 'options_framework_theme'),
        'id' => 'ctrl_cs',
        'std' => '博主码文字不易，要转载的话记得留一个本站的链接哦……',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('七牛图片CDN', 'options_framework_theme'),
        'desc' => __('格式：https://七牛三级域名/wp-content/uploads', 'options_framework_theme'),
        'id' => 'qiniu_cdn',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('后台登陆背景图', 'options_framework_theme'),
        'desc' => __('自定义后台登录背景图，如果这个地址为空则使用随机图', 'options_framework_theme'),
        'id' => 'login_bg',
        'type' => 'upload'
    );

    $options[] = array(
        'name' => __('模糊配色背景图', 'options_framework_theme'),
        'desc' => __('自定义模糊配色背景图，如果这个地址为空则使用随机图', 'options_framework_theme'),
        'id' => 'blur_bg',
        'type' => 'upload'
    );


    //前台登录
    $options[] = array(
        'name' => __('前台登录', 'options_framework_theme'),
        'type' => 'heading'
    );

    $options[] = array(
        'name' => __('指定登录地址', 'options_framework_theme'),
        'desc' => __('仅是替换登录入口处的 URL，不能修改 WordPress 的登录地址，推荐使用 WPS Hide LOGIN 插件修改后台登陆地址', 'options_framework_theme'),
        'id' => 'new_login_url',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('指定注册地址', 'options_framework_theme'),
        'desc' => __('填写该链接将出现在前台登录页面模板作为注册入口，目前前台注册模板失效已去除，可以填写后台注册地址', 'options_framework_theme'),
        'id' => 'exregister_url',
        'std' => '',
        'type' => 'text'
    );

    $options[] = array(
        'name' => __('登录自动跳转', 'options_framework_theme'),
        'desc' => __('默认关闭，勾选开启，管理员跳转至后台，用户跳转至主页，但已登录用户进入前台登录模板又会跳转至后台，不打算修复，建议不开启', 'options_framework_theme'),
        'id' => 'login_urlskip',
        'std' => '0',
        'type' => 'checkbox'
    );

    return $options;
}
