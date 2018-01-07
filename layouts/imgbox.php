<?php
$image_file = get_random_bg_url() ? 'background-image: url('.get_random_bg_url().');' : '';
$bg_style = akina_option('focus_height') ? 'background-position: center center;background-attachment: inherit;' : '';
?>
<figure id="centerbg" class="centerbg" style="<?php echo $image_file.$bg_style ?>">
	<?php if ( !akina_option('focus_infos') ){ ?>
	<div class="focusinfo">
   		<?php if (akina_option('focus_logo')):?>
	     <div class="header-tou"><a href="<?php bloginfo('url');?>" ><img src="<?php echo akina_option('focus_logo', ''); ?>"></a></div>
	  	<?php else :?>
         <div class="header-tou" ><a href="<?php bloginfo('url');?>"><img src="<?php bloginfo('template_url'); ?>/images/avatar.jpg"></a></div>	
      	<?php endif; ?>
		<div class="header-info"><p><?php echo akina_option('admin_des', 'Carpe Diem and Do what I like'); ?></p></div>
		<div class="top-social">
		<?php if (akina_option('wechat')){ ?>
		<li class="wechat"><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/sns/wechat.png"/></a>
			<div class="wechatInner">
				<img src="<?php echo akina_option('wechat', ''); ?>" alt="微信公众号">
			</div>
		</li>
		<?php } ?> 
		<?php if (akina_option('sina')){ ?>
		<li><a href="<?php echo akina_option('sina', ''); ?>" target="_blank" class="social-sina" title="sina"><img src="<?php bloginfo('template_url'); ?>/images/sns/sina.png"/></a></li>
		<?php } ?>
		<?php if (akina_option('qq')){ ?>
		<li class="qq"><a href="//wpa.qq.com/msgrd?v=3&uin=<?php echo akina_option('qq', ''); ?>&site=qq&menu=yes" target="_blank" title="Initiate chat ?"><img src="<?php bloginfo('template_url'); ?>/images/sns/qq.png"/></a></li>
		<?php } ?>	
		<?php if (akina_option('qzone')){ ?>
		<li><a href="<?php echo akina_option('qzone', ''); ?>" target="_blank" class="social-qzone" title="qzone"><img src="<?php bloginfo('template_url'); ?>/images/sns/qzone.png"/></a></li>
		<?php } ?>
		<?php if (akina_option('github')){ ?>
		<li><a href="<?php echo akina_option('github', ''); ?>" target="_blank" class="social-github" title="github"><img src="<?php bloginfo('template_url'); ?>/images/sns/github.png"/></a></li>
		<?php } ?>	
		<?php if (akina_option('lofter')){ ?>
		<li><a href="<?php echo akina_option('lofter', ''); ?>" target="_blank" class="social-lofter" title="lofter"><img src="<?php bloginfo('template_url'); ?>/images/sns/lofter.png"/></a></li>
		<?php } ?>	
		<?php if (akina_option('bili')){ ?>
		<li><a href="<?php echo akina_option('bili', ''); ?>" target="_blank" class="social-bili" title="bilibili"><img src="<?php bloginfo('template_url'); ?>/images/sns/bilibili.png"/></a></li>
		<?php } ?>
		<?php if (akina_option('youku')){ ?>
		<li><a href="<?php echo akina_option('youku', ''); ?>" target="_blank" class="social-youku" title="youku"><img src="<?php bloginfo('template_url'); ?>/images/sns/youku.png"/></a></li>
		<?php } ?>
		<?php if (akina_option('wangyiyun')){ ?>
		<li><a href="<?php echo akina_option('wangyiyun', ''); ?>" target="_blank" class="social-wangyiyun" title="CloudMusic"><img src="<?php bloginfo('template_url'); ?>/images/sns/wangyiyun.png"/></a></li>
		<?php } ?>
		<?php if (akina_option('twitter')){ ?>
		<li><a href="<?php echo akina_option('twitter', ''); ?>" target="_blank" class="social-wangyiyun" title="Twitter"><img src="<?php bloginfo('template_url'); ?>/images/sns/twitter.png"/></a></li>
		<?php } ?>	
		<?php if (akina_option('facebook')){ ?>
		<li><a href="<?php echo akina_option('facebook', ''); ?>" target="_blank" class="social-wangyiyun" title="Facebook"><img src="<?php bloginfo('template_url'); ?>/images/sns/facebook.png"/></a></li>
		<?php } ?>	
		<?php if (akina_option('googleplus')){ ?>
		<li><a href="<?php echo akina_option('googleplus', ''); ?>" target="_blank" class="social-wangyiyun" title="Google+"><img src="<?php bloginfo('template_url'); ?>/images/sns/googleplus.png"/></a></li>
		<?php } ?>
		<?php if (akina_option('jianshu')){ ?>
		<li><a href="<?php echo akina_option('jianshu', ''); ?>" target="_blank" class="social-wangyiyun" title="简书"><img src="<?php bloginfo('template_url'); ?>/images/sns/jianshu.png"/></a></li>
		<?php } ?>
		<?php if (akina_option('zhihu')){ ?>
		<li><a href="<?php echo akina_option('zhihu', ''); ?>" target="_blank" class="social-wangyiyun" title="知乎"><img src="<?php bloginfo('template_url'); ?>/images/sns/zhihu.png"/></a></li>
		<?php } ?>	
		<?php if (akina_option('csdn')){ ?>
		<li><a href="<?php echo akina_option('csdn', ''); ?>" target="_blank" class="social-wangyiyun" title="CSDN"><img src="<?php bloginfo('template_url'); ?>/images/sns/csdn.png"/></a></li>
		<?php } ?>		
	  	</div>		 
	</div>
	<?php } ?>
</figure>
<?php
echo bgvideo(); //BGVideo 