<?php
$mts_options = get_option(MTS_THEME_NAME);

$bg_cover_class     = ( $mts_options['mts_homepage_quotes_background_image_cover'] == '1' && $mts_options['mts_homepage_quotes_background_image'] != '' ) ? ' cover-bg' : '';
$parallax_class     = ( $mts_options['mts_homepage_quotes_parallax'] == '1' ) ? ' parallax-bg' : '';
$color_scheme_class = ( $mts_options['mts_homepage_quotes_color_scheme'] == 'dark' ) ? ' dark-colors' : ' light-colors';
?>
<div id="quotes" class="section clearfix<?php echo $bg_cover_class . $parallax_class . $color_scheme_class; ?>">
	<div class="container">
	<div class="section-header"><i class="fa fa-quote-right"></i></div>
	<?php
	if ( ! empty( $mts_options['mts_homepage_quotes'] ) ) {
        ?>
        <div class="quotes-slider section-content">
        <?php
        $nav   = '';
        foreach ( $mts_options['mts_homepage_quotes'] as $key => $section ) {
            $quote_text  = $section['mts_homepage_quote_text'];
            $quote_image = $section['mts_homepage_quote_image'];

            $quote_image_url = bfi_thumb( $quote_image, array( 'width' => '140', 'height' => '80', 'crop' => true ) );

            $nav.= '<div class="quotes-slider-page"><span class="quotes-arrow-wrap"><span class="quotes-arrow"><span class="arrow"></span></span></span><img src="'.$quote_image_url.'" /></div>';
            ?>
            <div class="quote-text">
            	<?php echo $quote_text; ?>
            </div>
    <?php
        }
        ?>
        </div>
        <div class="quotes-slider-nav">
        	<?php echo $nav; ?>
        </div>
        <?php
    }
    ?>
	</div>
</div>