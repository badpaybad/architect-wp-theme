<?php
/**
 * Template Name: Latest Posts
 * 
 * To be used as a sample
 */
$mts_options = get_option(MTS_THEME_NAME);
?>
<?php get_header(); ?>
<div id="page" class="blog-home">
	<div class="container">
		<div class="<?php mts_article_class(); ?>">
			<div id="content_box">
				<?php
				
				if ( get_query_var('paged') && get_query_var('paged') > 1 ){
					$paged = get_query_var('paged');
				} elseif (  get_query_var('page') && get_query_var('page') > 1  ){
					$paged = get_query_var('page');
				} else {
					$paged = 1;
				}

				$args = array(
					'post_type' => 'post',
					'post_status' => 'publish',
					'paged' => $paged,
					'ignore_sticky_posts'=> 1,
				);
				$latest_posts = new WP_Query( $args );

				global $wp_query;
				// Put default query object in a temp variable
				$tmp_query = $wp_query;
				// Now wipe it out completely
				$wp_query = null;
				// Re-populate the global with our custom query
				$wp_query = $latest_posts;

				$j = 0; if ( $latest_posts->have_posts() ) : while ( $latest_posts->have_posts() ) : $latest_posts->the_post(); ?>
					<article class="latestPost excerpt panel" itemscope itemtype="http://schema.org/BlogPosting">
						<?php get_template_part( 'post-format/format', get_post_format() ); ?>
						<header class="entry-header">
							<h2 class="title front-view-title" itemprop="headline"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
						</header>
						<?php mts_the_postinfo(); ?>
						<?php if (empty($mts_options['mts_full_posts'])) : ?>
	    					<div class="front-view-content">
	                            <?php echo mts_excerpt(29); ?>
	    					</div>
						    <?php mts_readmore(); ?>
					    <?php else : ?>
	                        <div class="front-view-content full-post">
	                            <?php the_content(); ?>
	                        </div>
	                        <?php if (mts_post_has_moretag()) : ?>
	                            <?php mts_readmore(); ?>
	                        <?php endif; ?>
	                    <?php endif; ?>
					</article><!--.post excerpt-->
					
				<?php
				$j++; endwhile; endif;

				?>
				<?php if ( $j !== 0 ) { // No pagination if there is no posts ?>
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
				<?php }
				// Restore original query object
				$wp_query = $tmp_query;
				// Be kind; rewind
				wp_reset_postdata();
				?>
			</div>
		</div>
		<?php get_sidebar(); ?>
	</div>
<?php get_footer(); ?>