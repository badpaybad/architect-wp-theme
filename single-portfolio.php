<?php get_header(); ?>
<div id="page" class="single single-project">
	<div class="section clearfix project-showcase-wrap">
	<?php
	$showcase_type = get_post_meta( get_the_ID(), '_mts_project_showcase_type', true );
	$showcase_parallax = get_post_meta( get_the_ID(), '_mts_project_showcase_parallax', true );

	$parallax_class = ( 'on' == $showcase_parallax ) ? ' parallax' : '';

	if ( 'image' == $showcase_type ) {
		if( has_post_thumbnail() ) {
            $thumb_id = get_post_thumbnail_id();
            $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
            $thumb_url = $thumb_url_array[0];
	        ?>
	        <div class="project-showcase project-showcase-image<?php echo $parallax_class; ?>" style="background-image: url(<?php echo $thumb_url;?>);">
	        </div>
	        <?php
	    }
	} else {
		$args = array(
			'post_type'   => 'attachment',
			'numberposts' => -1,
			'post_parent' => get_the_ID(),
			'order' => 'ASC',
			'orderby' => 'menu_order',
			'post_mime_type' => 'image',
			'exclude' => get_post_thumbnail_id(get_the_ID())
			);

		$attachments = get_posts( $args );
		if ( $attachments ){
			?>
			<div class="project-showcase project-showcase-slider bg-slider loading">
			<?php
			foreach ( $attachments as $attachment ){
				$id = $attachment->ID;
				$src =  wp_get_attachment_url($id, 'full');
				?>
				<div class="bg-slide project-showcase-image<?php echo $parallax_class; ?>" style="background-image: url(<?php echo $src;?>);"></div>
				<?php
			}
			?>
			</div>
			<?php
		}
	}
	?>
	</div>
	<div class="container">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<article class="<?php mts_article_class(); ?>" itemscope itemtype="http://schema.org/BlogPosting">
			<div id="content_box" class="panel">
				<div id="post-<?php the_ID(); ?>" <?php post_class('g post project'); ?>>
					<div class="single_post">
						<header class="entry-header">
							<div class="prev-project left"><?php previous_post_link('%link', '<i class="fa fa-angle-left"></i>'); ?></div>
							<div class="next-project right"><?php next_post_link('%link', '<i class="fa fa-angle-right"></i>'); ?></div>
							<h1 class="title single-title single-project-title entry-title" itemprop="headline"><?php the_title(); ?></h1>
						</header>
						<div class="separator"><span>&sect;</span></div>
						<div class="post-single-content project-single-content box mark-links entry-content">
							<div class="thecontent" itemprop="articleBody">
		                        <?php the_content(); ?>
							</div>
                            <?php wp_link_pages(array('before' => '<div class="pagination">', 'after' => '</div>', 'link_before'  => '<span class="current"><span class="currenttext">', 'link_after' => '</span></span>', 'next_or_number' => 'next_and_number', 'nextpagelink' => __('Next','mythemeshop'), 'previouspagelink' => __('Previous','mythemeshop'), 'pagelink' => '%','echo' => 1 )); ?>
						</div><!--.entry-content-->
					</div><!--.single_post-->
				</div><!--.g post-->
			</div>
		</article>
		<div class="sidebar c-4-12">
			<?php
			$entries = get_post_meta( get_the_ID(), '_mts_project_info_group', true );

			if ( !empty( $entries ) ) { ?>
			<div class="project-info panel widget">
				<dl>
				<?php
				foreach ( (array) $entries as $key => $entry ) {

					$name = $value = '';
					if ( isset( $entry['key'] ) ) $name = esc_html( $entry['key'] );
				    if ( isset( $entry['value'] ) ) $value = esc_html( $entry['value'] );

				    if ( !empty( $name ) ) {
				    	echo '<dt>'.$name.'</dt><dd>'.$value.'</dd>';
				    }
				}
				?>
				<dl>
			</div><!--.project-info-->
			<?php }?>
			
			<?php
			$client_logo = wp_get_attachment_image( get_post_meta( get_the_ID(), '_mts_project_client_logo_id', 1 ), 'full' );
			$client_info = get_post_meta( get_the_ID(), '_mts_project_client_info', true );
			if( ! empty( $client_logo ) || ! empty ( $client_info ) ) {
				echo '<div class="project-client widget">';
					echo $client_logo;
					if( !empty( $client_logo ) && ! empty ( $client_info ) ) echo '<div class="separator"><span>&sect;</span></div>';
					echo wpautop($client_info);
				echo '</div><!--.project-client-->';
			}
			?>
			<div class="project-go-home widget">
				<a href="<?php echo home_url( '/' ); ?>" class="button">&#8592; <?php _e('Back Home', 'mythemeshop' ); ?></a>
			</div>
		</div>
		<?php endwhile; endif; /* end loop */ ?>
	</div>
<?php get_footer(); ?>
