<?php
$mts_options = get_option(MTS_THEME_NAME);

$use_images = ( '0' == $mts_options['mts_homepage_content_slider'] ) ? true : false;

$bg_cover_class = '';
$parallax_class = '';

if ( ! $use_images ) {
	$bg_cover_class = ( $mts_options['mts_homepage_slider_background_image_cover'] == '1' && $mts_options['mts_homepage_slider_background_image'] != '' ) ? ' cover-bg' : '';
	$parallax_class = ( $mts_options['mts_homepage_slider_parallax'] == '1' ) ? ' parallax-bg' : '';
}

$color_scheme_class = ( $mts_options['mts_homepage_slider_color_scheme'] == 'dark' ) ? ' dark-colors' : ' light-colors';
?>

<?php if ( isset( $mts_options['mts_custom_slider'] ) ) { ?>
<div id="home-slider" class="section clearfix bg-slider<?php echo $bg_cover_class . $parallax_class . $color_scheme_class; ?> loading has-<?php echo count($mts_options['mts_custom_slider']); ?>-slides">
	<?php
	foreach( $mts_options['mts_custom_slider'] as $slide ) :

		//$image_url = wp_get_attachment_image_src( $slide['mts_custom_slider_image'], 'full' );
		//$image_url = $image_url[0];
		$image_url          = $slide['mts_custom_slider_image'];
		$slide_title        = $slide['mts_custom_slider_title'];
		$slide_button_label = $slide['mts_custom_slider_button_label'];
		$slider_button_link = $slide['mts_custom_slider_button_link'];

		$style = '';
		if ( $use_images ) {
			$style = empty( $image_url ) ? '' : ' style="background-image: url('.$image_url.');"';
		}
	?>
	<div class="home-slide bg-slide" <?php echo $style; ?>>
	<?php if ( !empty( $slide_title ) ) { ?>
		<h2 class="home-slide-title">
			<?php echo $slide_title; ?>
		</h2>
	<?php } ?>
	<?php if ( !empty( $slider_button_link ) && !empty( $slide_button_label ) ) { ?>
		<a href="<?php echo $slider_button_link; ?>" class="home-slide-button button"><?php echo $slide_button_label; ?>&nbsp;&nbsp;&#8594;</a>
	<?php } ?>
	</div><!-- .home-slide -->
	<?php
	endforeach;
	?>
</div><!-- #home-slider -->
<?php } ?>