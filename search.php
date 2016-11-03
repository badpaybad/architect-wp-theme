<?php $mts_options = get_option(MTS_THEME_NAME); ?>
<?php get_header(); ?>
<div id="page">
	<div class="container">
		<div class="article">
			<div id="content_box">
				<h1 class="postsby">
					<span><?php _e("Search Results for:", "mythemeshop"); ?></span> <?php the_search_query(); ?>
				</h1>
				<?php $j = 0; if (have_posts()) : while (have_posts()) : the_post(); ?>
					<article class="latestPost excerpt panel" itemscope itemtype="http://schema.org/BlogPosting">
						<?php get_template_part( 'post-format/format', get_post_format() ); ?>
						<header class="entry-header">
							<h2 class="title front-view-title" itemprop="headline"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
						</header>
						<?php mts_the_postinfo(); ?>
						<div class="front-view-content">
	                        <?php echo mts_excerpt(29); ?>
						</div>
					    <?php mts_readmore(); ?>
					</article><!--.post excerpt-->
				<?php $j++; endwhile; else: ?>
					<div class="no-results">
						<h2><?php _e('We apologize for any inconvenience, please hit back on your browser or use the search form below.', 'mythemeshop'); ?></h2>
						<?php get_search_form(); ?>
					</div><!--noResults-->
				<?php endif; ?>
				<?php if ( $j !== 0 ) { // No pagination if there is no results ?>
				<!--Start Pagination-->
	            <?php if (isset($mts_options['mts_pagenavigation_type']) && $mts_options['mts_pagenavigation_type'] == '1' ) { ?>
	                <?php mts_pagination(); ?> 
				<?php } else { ?>
					<div class="pagination">
						<ul>
							<li class="nav-previous"><?php next_posts_link( __( '&larr; '.'Older posts', 'mythemeshop' ) ); ?></li>
							<li class="nav-next"><?php previous_posts_link( __( 'Newer posts'.' &rarr;', 'mythemeshop' ) ); ?></li>
						</ul>
					</div>
				<?php } ?>
				<!--End Pagination-->
				<?php } ?>
			</div>
		</div>
		<?php get_sidebar(); ?>
	</div>
<?php get_footer(); ?>