<?php
$mts_options = get_option(MTS_THEME_NAME);

$mts_homepage_features_title       = $mts_options['mts_homepage_features_title'];
$mts_homepage_features_description = $mts_options['mts_homepage_features_description'];

$bg_cover_class     = ( $mts_options['mts_homepage_features_background_image_cover'] == '1' && $mts_options['mts_homepage_features_background_image'] != '' ) ? ' cover-bg' : '';
$parallax_class     = ( $mts_options['mts_homepage_features_parallax'] == '1' ) ? ' parallax-bg' : '';
$color_scheme_class = ( $mts_options['mts_homepage_features_color_scheme'] == 'dark' ) ? ' dark-colors' : ' light-colors';
?>
<div id="features" class="section clearfix<?php echo $bg_cover_class . $parallax_class . $color_scheme_class; ?>">
	<div class="container">
	<?php if ( !empty( $mts_homepage_features_title ) || !empty( $mts_homepage_features_description ) ) { ?>
		<div class="section-header">
		<?php if ( !empty( $mts_homepage_features_title ) ) { ?>
			<h3 class="section-title"><?php echo $mts_homepage_features_title; ?></h3>
		<?php }?>
		<?php if ( !empty( $mts_homepage_features_description ) ) { ?>
			<div class="section-description"><?php echo $mts_homepage_features_description; ?></div>
		<?php }?>
            <div class="separator"><span>&sect;</span></div>
		</div>
	<?php }

    if ( ! empty( $mts_options['mts_homepage_features'] ) ) {
        ?>
        <div class="grid">
        <?php
        foreach ( $mts_options['mts_homepage_features'] as $key => $section ) {
            $feature_title       = $section['mts_homepage_feature_title'];
            $feature_icon        = $section['mts_homepage_feature_icon'];
            $feature_description = $section['mts_homepage_feature_description'];
            ?>
            <div class="grid-box">
                <div class="grid-box-inner">
                    <header>
                        <h2 class="title feature-title" itemprop="headline"><?php if ( !empty( $feature_icon ) ) { ?><i class="feature-icon fa fa-<?php echo $feature_icon; ?>"></i><?php } ?><?php echo $feature_title; ?></h2>
                    </header>
                    <div class="description feature-description">
                        <?php echo $feature_description; ?>
                    </div>
                </div>
            </div>
    <?php
        }
        ?>
        </div>
        <?php
    }
    ?>
	</div>
</div>