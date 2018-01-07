<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Akina
 */

get_header(); ?>

		<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>
			<?php if(akina_option('patternimg') || !get_random_bg_url()){ ?>
			<header class="page-header">
				<h1 class="page-title"><?php printf( esc_html__( '搜索结果: %s', 'akina' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->
			<?php } ?>
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'tpl/content', get_post_format() );

			endwhile;

			the_posts_navigation();

		 else : ?>
		 <div class="search-box">
		<!-- search start -->
		<form class="s-search">
			<i class="iconfont">&#xe65c;</i>
			<input class="text-input" type="search" name="s" placeholder="<?php _e('Search...', 'akina') ?>" required>	
		</form>
		<!-- search end -->
			</div>	
          <?php
			get_template_part( 'tpl/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->
<?php
get_footer();
