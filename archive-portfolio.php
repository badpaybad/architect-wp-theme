<?php
$mts_options = get_option(MTS_THEME_NAME);

$mts_projects_layout = $mts_options['mts_projects_layout'];
if ( '3' == $mts_projects_layout ) {
	$cols    = ' three-cols';
	$thumb_w = 340;
	$thumb_h = 340;
} else {
	$cols    = ' two-cols';
	$thumb_w = 525;
	$thumb_h = 525;
}
$no_gap = ( '1' == $mts_projects_layout ) ? ' no-gap' : '';
?>
<?php get_header(); ?>
<div id="page">
	<div class="container">
		<div id="content_box" class="portfolio-grid<?php echo $cols . $no_gap; ?>">
		<?php $paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
			$args = array(
				'post_type' => 'portfolio',
				'post_status' => 'publish',
				'paged' => $paged,
				'ignore_sticky_posts'=> 1,
				'posts_per_page' => $mts_options['mts_projects_count']
			);
			$latest_posts = new WP_Query( $args );
			$j = 0; if ( $latest_posts->have_posts() ) : while ( $latest_posts->have_posts() ) : $latest_posts->the_post(); ?>
				<article class="latestPost excerpt project-box">
					<div class="latest-post-inner project-box-inner">
						<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" rel="nofollow">
							<?php
							if ( has_post_thumbnail() ) {

								$post_id = get_the_ID();
								$project_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
								$project_image = $project_image[0];

								$project_image_url = bfi_thumb( $project_image, array( 'width' => $thumb_w, 'height' => $thumb_h, 'crop' => true ) );

							} else {

								$project_image_url = get_template_directory_uri().'/images/nothumb-'.$thumb_w.'x'.$thumb_h.'.png';
							}
							echo '<img src="'.$project_image_url.'" class="project-image">';
							?>
							<div class="project-caption">
								<div class="project-caption-inner">
									<div>
										<div class="project-title"><?php the_title(); ?></div>
										<div class="separator"><span>&sect;</span></div>
										<div class="project-excerpt"><?php echo mts_excerpt(10); ?></div>
									</div>
								</div>
							</div>
						</a>
					</div>
				</article><!--.post excerpt-->
			<?php $j++; endwhile; endif;
			if ( $j !== 0 ) { // No pagination if there is no results ?>
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
<?php get_footer(); ?>