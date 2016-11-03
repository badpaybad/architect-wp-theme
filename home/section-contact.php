<?php
$mts_options = get_option(MTS_THEME_NAME);

$mts_homepage_contact_title       = $mts_options['mts_homepage_contact_title'];
$mts_homepage_contact_description = $mts_options['mts_homepage_contact_description'];

$mts_homepage_contact_social_icons = $mts_options['mts_homepage_contact_social_icons'];
$mts_homepage_contact_facebook     = $mts_options['mts_homepage_contact_facebook'];
$mts_homepage_contact_twitter      = $mts_options['mts_homepage_contact_twitter'];
$mts_homepage_contact_googleplus   = $mts_options['mts_homepage_contact_googleplus'];
$mts_homepage_contact_linkedin     = $mts_options['mts_homepage_contact_linkedin'];
$mts_homepage_contact_email        = $mts_options['mts_homepage_contact_email'];

$bg_cover_class     = ( $mts_options['mts_homepage_contact_background_image_cover'] == '1' && $mts_options['mts_homepage_contact_background_image'] != '' ) ? ' cover-bg' : '';
$parallax_class     = ( $mts_options['mts_homepage_contact_parallax'] == '1' ) ? ' parallax-bg' : '';
$color_scheme_class = ( $mts_options['mts_homepage_contact_color_scheme'] == 'dark' ) ? ' dark-colors' : ' light-colors';
?>
<div id="contact" class="section clearfix<?php echo $bg_cover_class . $parallax_class . $color_scheme_class; ?>">
	<?php if( $mts_options['mts_map_coordinates'] != '' ) : ?>
		<div class="contact_map">
			<div id="map-canvas" style="width: 100%; height: 435px"></div>
		</div>
	<?php endif; ?>
	<div class="container">
	<?php if ( !empty( $mts_homepage_contact_title ) || !empty( $mts_homepage_contact_description ) ) { ?>
		<div class="section-header">
		<?php if ( !empty( $mts_homepage_contact_title ) ) { ?>
			<h3 class="section-title"><?php echo $mts_homepage_contact_title; ?></h3>
		<?php }?>
		<?php if ( !empty( $mts_homepage_contact_description ) ) {?>
			<div class="section-description"><?php echo $mts_homepage_contact_description; ?></div>
		<?php }?>
			<div class="separator"><span>&sect;</span></div>
		</div>
	<?php }?>
		<div class="section-content">
		<?php if ( '1' ==  $mts_homepage_contact_social_icons ) { ?>
			<div class="social-list">
				<?php if ( !empty( $mts_homepage_contact_facebook ) ) { ?>
					<a href="<?php echo $mts_homepage_contact_facebook; ?>"><i class="fa fa-facebook"></i></a>
				<?php }?>
				<?php if ( !empty( $mts_homepage_contact_twitter ) ) { ?>
					<a href="<?php echo $mts_homepage_contact_twitter; ?>"><i class="fa fa-twitter"></i></a>
				<?php }?>
				<?php if ( !empty( $mts_homepage_contact_googleplus ) ) { ?>
					<a href="<?php echo $mts_homepage_contact_googleplus; ?>"><i class="fa fa-google-plus"></i></a>
				<?php }?>
				<?php if ( !empty( $mts_homepage_contact_linkedin ) ) { ?>
					<a href="<?php echo $mts_homepage_contact_linkedin; ?>"><i class="fa fa-linkedin"></i></a>
				<?php }?>
				<?php if ( !empty( $mts_homepage_contact_email ) && is_email( $mts_homepage_contact_email ) ) { ?>
					<a href="mailto:<?php echo antispambot($mts_homepage_contact_email); ?>"><i class="fa fa-envelope"></i></a>
				<?php }?>
			</div>
		<?php }?>

			<? /* php mts_contact_form();*/ ?>
		</div>
	</div>
</div>