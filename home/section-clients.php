<?php
$mts_options = get_option(MTS_THEME_NAME);

$mts_homepage_clients_title       = $mts_options['mts_homepage_clients_title'];
$mts_homepage_clients_description = $mts_options['mts_homepage_clients_description'];

$mts_homepage_clients_slide_items = $mts_options['mts_homepage_clients_slide_items'];

$bg_cover_class     = ( $mts_options['mts_homepage_clients_background_image_cover'] == '1' && $mts_options['mts_homepage_clients_background_image'] != '' ) ? ' cover-bg' : '';
$parallax_class     = ( $mts_options['mts_homepage_clients_parallax'] == '1' ) ? ' parallax-bg' : '';
$color_scheme_class = ( $mts_options['mts_homepage_clients_color_scheme'] == 'dark' ) ? ' dark-colors' : ' light-colors';
?>
<div id="clients" class="section clearfix<?php echo $bg_cover_class . $parallax_class . $color_scheme_class; ?>">
	<div class="container">
	<?php if ( !empty( $mts_homepage_clients_title ) || !empty( $mts_homepage_clients_description ) ) { ?>
		<div class="section-header">
		<?php if ( !empty( $mts_homepage_clients_title ) ) { ?>
			<h3 class="section-title"><?php echo $mts_homepage_clients_title; ?></h3>
		<?php }?>
		<?php if ( !empty( $mts_homepage_clients_description ) ) {?>
			<div class="section-description"><?php echo $mts_homepage_clients_description; ?></div>
		<?php }?>
            <div class="separator"><span>&sect;</span></div>
		</div>
	<?php }

    if ( ! empty( $mts_options['mts_homepage_clients'] ) ) {
        ?>
        <div class="slider-container">
            <div class="clients carousel">
            <?php
            $count = 0;
            foreach ( $mts_options['mts_homepage_clients'] as $key => $section ) {
                ++$count;
                $client_image = $section['mts_homepage_client_image'];
                $client_url   = $section['mts_homepage_client_url'];

                $client_image_url = bfi_thumb( $client_image, array( 'width' => '340', 'height' => '250', 'crop' => true ) );

                $client_image_html = empty( $client_image ) ? '' : '<div class="img-container"><img class="owl-lazy" data-src="'.$client_image_url.'" /></div>';
                $client_image_html = empty( $client_url ) ? $client_image_html : '<a href="'.$client_url.'">'.$client_image_html.'</a>';
                ?>
                <?php if ( '6' == $mts_homepage_clients_slide_items && $count % 2 !== 0 ) echo '<div>'; ?>
                <div class="grid-box">
                    <div class="grid-box-inner">
                    	<?php echo  $client_image_html; ?>
                    </div>
                </div>
                <?php if ( '6' == $mts_homepage_clients_slide_items && $count % 2 === 0 ) echo '</div>';?>
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