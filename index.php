<?php 
$mts_options = get_option(MTS_THEME_NAME);
    
if ( is_array( $mts_options['mts_homepage_layout'] ) && array_key_exists( 'enabled', $mts_options['mts_homepage_layout'] ) ) {
    $homepage_layout = $mts_options['mts_homepage_layout']['enabled'];
} else {
    $homepage_layout = array();
}
?>

<?php get_header(); ?>

<div id="page">

    <?php foreach( $homepage_layout as $key => $section ) { get_template_part( 'home/section', $key ); } ?>

<?php get_footer(); ?>