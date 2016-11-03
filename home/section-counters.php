<?php
$mts_options = get_option(MTS_THEME_NAME);

$mts_homepage_counters_title       = $mts_options['mts_homepage_counters_title'];
$mts_homepage_counters_description = $mts_options['mts_homepage_counters_description'];

$bg_cover_class     = ( $mts_options['mts_homepage_counters_background_image_cover'] == '1' && $mts_options['mts_homepage_counters_background_image'] != '' ) ? ' cover-bg' : '';
$parallax_class     = ( $mts_options['mts_homepage_counters_parallax'] == '1' ) ? ' parallax-bg' : '';
$color_scheme_class = ( $mts_options['mts_homepage_counters_color_scheme'] == 'dark' ) ? ' dark-colors' : ' light-colors';
?>
<div id="counters" class="section clearfix<?php echo $bg_cover_class . $parallax_class . $color_scheme_class; ?>">
	<div class="container">
	<?php if ( !empty( $mts_homepage_counters_title ) || !empty( $mts_homepage_counters_description ) ) { ?>
		<div class="section-header">
		<?php if ( !empty( $mts_homepage_counters_title ) ) { ?>
			<h3 class="section-title"><?php echo $mts_homepage_counters_title; ?></h3>
		<?php }?>
		<?php if ( !empty( $mts_homepage_counters_description ) ) {?>
			<div class="section-description"><?php echo $mts_homepage_counters_description; ?></div>
		<?php }?>
			<div class="separator"><span>&sect;</span></div>
		</div>
	<?php } ?>
		<div class="counter-items section-content">
			<?php
			$counter_items = count( $mts_options['mts_homepage_counter'] );

			if ($counter_items):
				$i=0;
				foreach( $mts_options['mts_homepage_counter'] as $count ) : 
					$counter_icon = $count['mts_homepage_counter_icon'];
					$counter_title = $count['mts_homepage_counter_title'];
					?>
					<div class="counter-item" style="width: <?php echo 100 / $counter_items; ?>%;">
						<?php if ( !empty( $counter_icon ) ) { ?><i class="counter-icon fa fa-<?php echo $counter_icon; ?>"></i><?php } ?>
						<span class="count count-<?php echo $i ?>">0</span>
						<?php if ( !empty( $counter_title ) ) { ?><span class="sub"><?php echo $counter_title; ?></span><?php } ?>
						<script type="text/javascript">
						jQuery(window).load(function() {
							jQuery(document).scroll(function(){
								if(jQuery(this).scrollTop()>=jQuery('#counters').position().top - 200){
									jQuery('#counters .count-<?php echo $i; ?>').animateNumbers(<?php echo $count['mts_homepage_counter_number']; ?>,200);
								}
							});
						});
						</script>
					</div>
					<?php
					$i++;
				endforeach;
			endif;
			?>
		</div>
	</div>
</div>