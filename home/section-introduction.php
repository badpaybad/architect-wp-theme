<?php
$mts_options = get_option(MTS_THEME_NAME);

$mts_homepage_introduction_title       = $mts_options['mts_homepage_introduction_title'];
$mts_homepage_introduction_description = $mts_options['mts_homepage_introduction_description'];
$mts_homepage_introduction_text        = $mts_options['mts_homepage_introduction_text'];
$mts_homepage_introduction_image       = $mts_options['mts_homepage_introduction_image'];

$content_class = empty( $mts_homepage_introduction_image ) ? 'introduction-content' : 'introduction-content half-width';

$bg_cover_class     = ( $mts_options['mts_homepage_introduction_background_image_cover'] == '1' && $mts_options['mts_homepage_introduction_background_image'] != '' ) ? ' cover-bg' : '';
$parallax_class     = ( $mts_options['mts_homepage_introduction_parallax'] == '1' ) ? ' parallax-bg' : '';
$color_scheme_class = ( $mts_options['mts_homepage_introduction_color_scheme'] == 'dark' ) ? ' dark-colors' : ' light-colors';
?>
<div id="introduction" class="section clearfix<?php echo $bg_cover_class . $parallax_class . $color_scheme_class; ?>">
	<div class="container">
		<div class="introduction">
			<div class="<?php echo $content_class;?>">
				<?php if ( !empty( $mts_homepage_introduction_title ) || !empty( $mts_homepage_introduction_description ) ) { ?>
					<div class="section-header">
					<?php if ( !empty( $mts_homepage_introduction_title ) ) { ?>
						<h3 class="section-title"><?php echo $mts_homepage_introduction_title; ?></h3>
					<?php }?>
					<?php if ( !empty( $mts_homepage_introduction_description ) ) { ?>
						<div class="section-description"><?php echo $mts_homepage_introduction_description; ?></div>
					<?php }?>
						<div class="separator"><span>&sect;</span></div>
					</div>
				<?php } ?>
				<?php if ( !empty( $mts_homepage_introduction_text ) ) { ?>
					<div class="introduction-text">
						<?php echo $mts_homepage_introduction_text; ?>
					</div>
				<?php } ?>
			</div>
			<?php if ( !empty( $mts_homepage_introduction_image ) ) { ?>
			<div class="introduction-image half-width ">
				<img src="<?php echo $mts_homepage_introduction_image;?> "/>
			</div>
			<?php } ?>
		</div>
	</div>
</div>