<?php
/**
 * Alternative post template
 */
 ?>
<?php get_header(); ?>
<?php $mts_options = get_option(MTS_THEME_NAME); ?>
<div id="page" class="single parallax">
	<?php if (mts_get_thumbnail_url()) : ?>
		<div id="parallax" <?php echo 'style="background-image: url('.mts_get_thumbnail_url().');"'; ?>></div>
	<?php endif; ?>
	<div class="container">
		<article class="<?php mts_article_class(); ?>" itemscope itemtype="http://schema.org/BlogPosting">
			<div id="content_box" class="panel">
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<div id="post-<?php the_ID(); ?>" <?php post_class('g post'); ?>>
						<div class="single_post">
							<?php if ($mts_options['mts_breadcrumb'] == '1') { ?>
								<div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#"><?php mts_the_breadcrumb(); ?></div>
							<?php } ?>
							<header class="entry-header">
								<h1 class="title single-title entry-title" itemprop="headline"><?php the_title(); ?></h1>
							</header>
							<?php mts_the_postinfo( 'single' ); ?>
							<div class="post-single-content box mark-links entry-content">
								<?php if ($mts_options['mts_posttop_adcode'] != '') { ?>
									<?php $toptime = $mts_options['mts_posttop_adcode_time']; if (strcmp( date("Y-m-d", strtotime( "-$toptime day")), get_the_time("Y-m-d") ) >= 0) { ?>
										<div class="topad">
											<?php echo do_shortcode($mts_options['mts_posttop_adcode']); ?>
										</div>
									<?php } ?>
								<?php } ?>
	                            <?php if (isset($mts_options['mts_social_button_position']) && $mts_options['mts_social_button_position'] == 'top') mts_social_buttons(); ?>
	                            <div class="thecontent" itemprop="articleBody">
			                        <?php the_content(); ?>
								</div>
	                            <?php wp_link_pages(array('before' => '<div class="pagination">', 'after' => '</div>', 'link_before'  => '<span class="current"><span class="currenttext">', 'link_after' => '</span></span>', 'next_or_number' => 'next_and_number', 'nextpagelink' => __('Next','mythemeshop'), 'previouspagelink' => __('Previous','mythemeshop'), 'pagelink' => '%','echo' => 1 )); ?>
								<?php if ($mts_options['mts_postend_adcode'] != '') { ?>
									<?php $endtime = $mts_options['mts_postend_adcode_time']; if (strcmp( date("Y-m-d", strtotime( "-$endtime day")), get_the_time("Y-m-d") ) >= 0) { ?>
										<div class="bottomad">
											<?php echo do_shortcode($mts_options['mts_postend_adcode']); ?>
										</div>
									<?php } ?>
								<?php } ?> 
								<?php if (empty($mts_options['mts_social_button_position']) || $mts_options['mts_social_button_position'] != 'top') mts_social_buttons(); ?>
								<?php if($mts_options['mts_tags'] == '1') { ?>
									<div class="tags"><?php mts_the_tags('<span class="tagtext">'.__('Tags','mythemeshop').':</span>',', ') ?></div>
								<?php } ?>
							</div><!--.entry-content-->
						</div><!--.single_post-->
	                    				
						<?php if($mts_options['mts_author_box'] == '1') { ?>
							<h4 class="section-title"><?php _e('About The Author', 'mythemeshop'); ?></h4>
							<div class="postauthor">
								<?php if(function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '80' );  } ?>
								<h5 class="vcard"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="nofollow" class="fn"><?php the_author_meta( 'nickname' ); ?></a></h5>
								<p><?php the_author_meta('description') ?></p>
							</div>
						<?php }?> 

						<?php mts_related_posts(); ?>
						 
					</div><!--.g post-->
					<?php comments_template( '', true ); ?>
				<?php endwhile; /* end loop */ ?>
			</div>
		</article>
		<?php get_sidebar(); ?>
	</div>
<?php get_footer(); ?>