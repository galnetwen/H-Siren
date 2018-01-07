<?php 
/**
 Template Name: Login
 */

get_header();
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php if(!is_user_logged_in()){ ?>
			<div class="ex-login">
				<div class="ex-login-title">
					<p><img src="<?php echo bloginfo('template_url') ?>/images/none.png"></p>
				</div>
                <?php if (akina_option('new_login_url')){
                    $login_url = akina_option('new_login_url');
                    }else{
                    $login_url = get_bloginfo('url').'/wp-login.php';
                    }
                 ?>
				<form action="<?php echo $login_url; ?>" method="post">  
					<p><input type="text" name="log" id="log" value="<?php echo $_POST['log']; ?>" size="25" placeholder="Name" required /></p>
					<p><input type="password" name="pwd" id="pwd" value="<?php echo $_POST['pwd']; ?>" size="25" placeholder="Password" required /></p>
					<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
					<input class="button login-button" name="submit" type="submit" value="登 入">
				</form>
				<?php if (akina_option('exregister_url')){ ?>
				<div class="ex-new-account">
                    <a href="<?php echo akina_option('exregister_url'); ?>" target="_top">Create an account？</a>
                </div>
                <?php } ?>
            </div>
		<?php }else{ echo Exuser_center(); } ?>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
