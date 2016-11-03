<?php
$mts_options = get_option(MTS_THEME_NAME);

$mts_homepage_services_title       = $mts_options['mts_homepage_services_title'];
$mts_homepage_services_description = $mts_options['mts_homepage_services_description'];

$bg_cover_class     = ( $mts_options['mts_homepage_services_background_image_cover'] == '1' && $mts_options['mts_homepage_services_background_image'] != '' ) ? ' cover-bg' : '';
$parallax_class     = ( $mts_options['mts_homepage_services_parallax'] == '1' ) ? ' parallax-bg' : '';
$color_scheme_class = ( $mts_options['mts_homepage_services_color_scheme'] == 'dark' ) ? ' dark-colors' : ' light-colors';
?>
<div id="services" class="section clearfix<?php echo $bg_cover_class . $parallax_class . $color_scheme_class; ?>">
	<div class="container">
	<?php if ( !empty( $mts_homepage_services_title ) || !empty( $mts_homepage_services_description ) ) { ?>
		<div class="section-header">
		<?php if ( !empty( $mts_homepage_services_title ) ) { ?>
			<h3 class="section-title"><?php echo $mts_homepage_services_title; ?></h3>
		<?php }?>
		<?php if ( !empty( $mts_homepage_services_description ) ) { ?>
			<div class="section-description"><?php echo $mts_homepage_services_description; ?></div>
		<?php }?>
            <div class="separator"><span>&sect;</span></div>
		</div>
	<?php }

    if ( ! empty( $mts_options['mts_homepage_service'] ) ) {
        $services_carousel = ( count ( $mts_options['mts_homepage_service'] ) > 3 ) ? ' carousel' : ' no-carousel';
        ?>
        <div class="slider-container services-slider-container">
            <div class="services<?php echo $services_carousel; ?>">
            <?php
            foreach ( $mts_options['mts_homepage_service'] as $key => $section ) {
                $service_title       = $section['mts_homepage_service_title'];
                $service_image       = $section['mts_homepage_service_image'];
                $service_description = $section['mts_homepage_service_description'];

                $service_image_url = bfi_thumb( $service_image, array( 'width' => '200', 'height' => '200', 'crop' => true ) );

                $owl_lazy = '';
                if ( count ( $mts_options['mts_homepage_service'] ) > 3 ) {
                    $owl_lazy = 'data-';
                }

                ?>
                <div class="grid-box">
                    <div class="grid-box-inner">
                    	<?php if ( !empty( $service_image ) ) { ?><div class="img-container"><img class="owl-lazy" <?php echo $owl_lazy; ?>src="<?php echo $service_image_url; ?>" /></div><?php } ?>
                        <header>
                            <h2 class="title service-title" itemprop="headline"><?php echo $service_title; ?></h2>
                        </header>
                        <div class="description service-description">
                            <?php echo $service_description; ?>
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