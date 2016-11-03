<?php
$mts_options = get_option(MTS_THEME_NAME);

$mts_homepage_projects_title       = $mts_options['mts_homepage_projects_title'];
$mts_homepage_projects_description = $mts_options['mts_homepage_projects_description'];

$bg_cover_class     = ( $mts_options['mts_homepage_projects_background_image_cover'] == '1' && $mts_options['mts_homepage_projects_background_image'] != '' ) ? ' cover-bg' : '';
$parallax_class     = ( $mts_options['mts_homepage_projects_parallax'] == '1' ) ? ' parallax-bg' : '';
$color_scheme_class = ( $mts_options['mts_homepage_projects_color_scheme'] == 'dark' ) ? ' dark-colors' : ' light-colors';

$mts_projects_num    = empty ( $mts_options['mts_projects_count_home'] ) ? '6' : $mts_options['mts_projects_count_home'];
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
<div id="projects" class="section clearfix<?php echo $bg_cover_class . $parallax_class . $color_scheme_class; ?>">
	<div class="container">
	<?php if ( !empty( $mts_homepage_projects_title ) || !empty( $mts_homepage_projects_description ) ) { ?>
		<div class="section-header">
		<?php if ( !empty( $mts_homepage_projects_title ) ) { ?>
			<h3 class="section-title"><?php echo $mts_homepage_projects_title; ?></h3>
		<?php }?>
		<?php if ( !empty( $mts_homepage_projects_description ) ) { ?>
			<div class="section-description"><?php echo $mts_homepage_projects_description; ?></div>
		<?php }?>
			<div class="separator"><span>&sect;</span></div>
		</div>
		<div id="portfolio-grid" class="portfolio-grid<?php echo $cols . $no_gap; ?>">
		<?php
		$query = new WP_Query();
		$query->query('post_type=portfolio&ignore_sticky_posts=1&posts_per_page='.$mts_projects_num);

		while ( $query->have_posts() ) : $query->the_post(); ?>
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
        <?php endwhile; ?>
        <?php wp_reset_query(); ?>
        <div class="clearfix"></div>
        <a href="<?php echo get_post_type_archive_link( 'portfolio' ); ?>" class="button"><?php _e( 'All projects', 'mythemeshop' ); ?>&nbsp;&nbsp;&#8594;</a>
        </div>
	<?php }?>
	</div>
</div>