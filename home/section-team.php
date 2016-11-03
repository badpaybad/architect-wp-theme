<?php
$mts_options = get_option(MTS_THEME_NAME);

$mts_homepage_team_title       = $mts_options['mts_homepage_team_title'];
$mts_homepage_team_description = $mts_options['mts_homepage_team_description'];

$bg_cover_class     = ( $mts_options['mts_homepage_team_background_image_cover'] == '1' && $mts_options['mts_homepage_team_background_image'] != '' ) ? ' cover-bg' : '';
$parallax_class     = ( $mts_options['mts_homepage_team_parallax'] == '1' ) ? ' parallax-bg' : '';
$color_scheme_class = ( $mts_options['mts_homepage_team_color_scheme'] == 'dark' ) ? ' dark-colors' : ' light-colors';
?>
<div id="team" class="section clearfix<?php echo $bg_cover_class . $parallax_class . $color_scheme_class; ?>">
	<div class="container">
	<?php if ( !empty( $mts_homepage_team_title ) || !empty( $mts_homepage_team_description ) ) { ?>
		<div class="section-header">
		<?php if ( !empty( $mts_homepage_team_title ) ) { ?>
			<h3 class="section-title"><?php echo $mts_homepage_team_title; ?></h3>
		<?php }?>
		<?php if ( !empty( $mts_homepage_team_description ) ) { ?>
			<div class="section-description"><?php echo $mts_homepage_team_description; ?></div>
		<?php } ?>
            <div class="separator"><span>&sect;</span></div>
		</div>
	<?php }

    if ( ! empty( $mts_options['mts_homepage_team'] ) ) {

            $team_carousel = ( count ( $mts_options['mts_homepage_team'] ) > 3 ) ? ' carousel' : ' no-carousel';
        ?>
        <div class="slider-container team-slider-container">
            <div class="team<?php echo $team_carousel; ?>">
            <?php
            foreach ( $mts_options['mts_homepage_team'] as $key => $section ) {
                $team_name        = $section['mts_homepage_team_name'];
                $team_image       = $section['mts_homepage_team_image'];
                $team_description = $section['mts_homepage_team_info'];
                $team_facebook    = $section['mts_homepage_team_facebook'];
                $team_twitter     = $section['mts_homepage_team_twitter'];
                $team_google      = $section['mts_homepage_team_google'];
                $team_instagram   = $section['mts_homepage_team_instagram'];

                $team_image_url = bfi_thumb( $team_image, array( 'width' => '250', 'height' => '250', 'crop' => true ) );

                $owl_lazy = '';
                if ( count ( $mts_options['mts_homepage_team'] ) > 3 ) {
                    $owl_lazy = 'data-';
                }

                ?>
                <div class="grid-box">
                    <div class="grid-box-inner">
                    	<?php if ( !empty( $team_image ) ) { ?><div class="img-container"><img class="owl-lazy" <?php echo $owl_lazy; ?>src="<?php echo $team_image_url; ?>"/></div><?php } ?>
                        <header>
                            <h2 class="title" itemprop="headline"><?php echo $team_name; ?></h2>
                        </header>
                        <div class="description">
                            <?php echo $team_description; ?>
                        </div>
                        <div class="separator"><span>&sect;</span></div>
                        <div class="social-list">
                        	<?php if ( !empty($team_facebook) ) { ?>
                        		<a href="<?php echo $team_facebook; ?>"><i class="fa fa-facebook"></i></a>
                        	<?php }?>
                        	<?php if ( !empty($team_twitter) ) { ?>
                        		<a href="<?php echo $team_twitter; ?>"><i class="fa fa-twitter"></i></a>
                        	<?php }?>
                        	<?php if ( !empty($team_google) ) { ?>
                        		<a href="<?php echo $team_google; ?>"><i class="fa fa-google-plus"></i></a>
                        	<?php }?>
                        	<?php if ( !empty($team_instagram) ) { ?>
                        		<a href="<?php echo $team_instagram; ?>"><i class="fa fa-instagram"></i></a>
                        	<?php }?>
                        </div>
                    </div>
                </div>
        <?php
            }
            ?>
            </div>
        </div>
        <?php
    }
    ?>
	</div>
</div>