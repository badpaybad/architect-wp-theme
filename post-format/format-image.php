<?php
global $content_width;
if ( 609 == $content_width ) {
	$w = 689;
	$h = 350;
} else {
	$w = 1074;
	$h = 545;
}
if(!is_singular()) { ?>
<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="nofollow" id="featured-thumbnail">
<?php } ?>
<div class="featured-thumbnail">
	<?php if ( has_post_thumbnail() ) {
		$id        = get_post_thumbnail_id();
		$image     = wp_get_attachment_image_src( $id, 'full' );
		$image_url = $image[0];
		$thumbnail = bfi_thumb( $image_url, array( 'width' => $w, 'height' => $h, 'crop' => true ) );
	} else {
		$thumbnail = get_template_directory_uri().'/images/nothumb-'.$w.'x'.$h.'.png';
	}
	echo '<img src="'.$thumbnail.'" class="wp-post-image">';
	?>
<?php if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'latestPost-review-wrapper'); ?>
</div>
<?php if(!is_singular()) { ?>
</a>
<?php } ?>