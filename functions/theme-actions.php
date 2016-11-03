<?php
$mts_options = get_option(MTS_THEME_NAME);
/*------------[ Meta ]-------------*/
if ( ! function_exists( 'mts_meta' ) ) {
	function mts_meta(){
	global $mts_options, $post;
?>
<?php if ($mts_options['mts_favicon'] != ''){ ?>
	<link rel="icon" href="<?php echo $mts_options['mts_favicon']; ?>" type="image/x-icon" />
<?php } ?>
<!--iOS/android/handheld specific -->
<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon.png" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<?php if($mts_options['mts_prefetching'] == '1') { ?>
<?php if (is_front_page()) { ?>
	<?php $my_query = new WP_Query('posts_per_page=1'); while ($my_query->have_posts()) : $my_query->the_post(); ?>
	<link rel="prefetch" href="<?php the_permalink(); ?>">
	<link rel="prerender" href="<?php the_permalink(); ?>">
	<?php endwhile; wp_reset_query(); ?>
<?php } elseif (is_singular()) { ?>
	<link rel="prefetch" href="<?php echo home_url(); ?>">
	<link rel="prerender" href="<?php echo home_url(); ?>">
<?php } ?>
<?php } ?>
    <meta itemprop="name" content="<?php bloginfo( 'name' ); ?>" />
    <meta itemprop="url" content="<?php echo site_url(); ?>" />
    <?php if ( is_singular() ) { ?>
    <meta itemprop="creator accountablePerson" content="<?php $user_info = get_userdata($post->post_author); echo $user_info->first_name.' '.$user_info->last_name; ?>" />
    <?php } ?>
<?php }
}

/*------------[ Head ]-------------*/
if ( ! function_exists( 'mts_head' ) ){
	function mts_head() {
	global $mts_options
?>
<?php echo $mts_options['mts_header_code']; ?>
<?php }
}
add_action('wp_head', 'mts_head');

/*------------[ Copyrights ]-------------*/
if ( ! function_exists( 'mts_copyrights_credit' ) ) {
    function mts_copyrights_credit() { 
    global $mts_options
?>
<!--start copyrights-->

<span><a href="<?php echo home_url(); ?>/" title="<?php bloginfo('description'); ?>" rel="nofollow"><?php bloginfo('name'); ?></a> Copyright &copy; <?php echo date("Y") ?>.</span>
<span><?php echo $mts_options['mts_copyrights']; ?></span>
<!--end copyrights-->
<?php }
}

/*------------[ footer ]-------------*/
if ( ! function_exists( 'mts_footer' ) ) {
	function mts_footer() { 
	global $mts_options;
?>
<?php if ( is_home() ) : ?>
<script type="text/javascript">
    // Enable parallax images for different sections
    jQuery(window).load(function() {
        <?php if ( $mts_options['mts_homepage_slider_parallax'] == '1' && mts_is_active_section('slider') ) : ?>
            <?php if ( '0' == $mts_options['mts_homepage_content_slider'] ) : ?>
                jQuery('.home-slide').parallax('50%', -0.5, true);
            <?php else : ?>
                jQuery('#home-slider').parallax('50%', 0.5, true);
            <?php endif; ?>
        <?php endif; ?>
        <?php if ( $mts_options['mts_homepage_features_parallax'] == '1' && mts_is_active_section('features') ) : ?>
            jQuery('#features').parallax('50%', 0.5, true);
        <?php endif; ?>
        <?php if ( $mts_options['mts_homepage_introduction_parallax'] == '1' && mts_is_active_section('introduction') ) : ?>
            jQuery('#introduction').parallax('50%', 0.5, true);
        <?php endif; ?>
        <?php if ( $mts_options['mts_homepage_services_parallax'] == '1' && mts_is_active_section('services') ) : ?>
            jQuery('#services').parallax('50%', 0.5, true);
        <?php endif; ?>
        <?php if ( $mts_options['mts_homepage_counters_parallax'] == '1' && mts_is_active_section('counters') ) : ?>
            jQuery('#counters').parallax('50%', 0.5, true);
        <?php endif; ?>
        <?php if ( $mts_options['mts_homepage_clients_parallax'] == '1' && mts_is_active_section('clients') ) : ?>
            jQuery('#clients').parallax('50%', 0.5, true);
        <?php endif; ?>
        <?php if ( $mts_options['mts_homepage_twitter_parallax'] == '1' && mts_is_active_section('twitter') ) : ?>
            jQuery('#twitter').parallax('50%', 0.5, true);
        <?php endif; ?>
        <?php if ( $mts_options['mts_homepage_team_parallax'] == '1' && mts_is_active_section('team') ) : ?>
            jQuery('#team').parallax('50%', 0.5, true);
        <?php endif; ?>
        <?php if ( $mts_options['mts_homepage_quotes_parallax'] == '1' && mts_is_active_section('quotes') ) : ?>
            jQuery('#quotes').parallax('50%', 0.5, true);
        <?php endif; ?>
        <?php if ( $mts_options['mts_homepage_projects_parallax'] == '1' && mts_is_active_section('projects') ) : ?>
            jQuery('#projects').parallax('50%', 0.5, true);
        <?php endif; ?>
        <?php if ( $mts_options['mts_homepage_contact_parallax'] == '1' && mts_is_active_section('contact') ) : ?>
            jQuery('#contact').parallax('50%', 0.5, true);
        <?php endif; ?>
    });
</script>
<?php endif; ?>
<?php if ($mts_options['mts_analytics_code'] != '') { ?>
<!--start footer code-->
<?php echo $mts_options['mts_analytics_code']; ?>
<!--end footer code-->
<?php } ?>
<?php }
}

/*------------[ breadcrumb ]-------------*/
if (!function_exists('mts_the_breadcrumb')) {
    function mts_the_breadcrumb() {
        echo '<span typeof="v:Breadcrumb" class="root"><a rel="v:url" property="v:title" href="';
        echo home_url();
        echo '" rel="nofollow">'.sprintf( __( "Home","mythemeshop"));
        echo '</a></span><span><i class="fa fa-angle-right"></i></span>';
        if (is_category() || is_single()) {
            $categories = get_the_category();
            $output = '';
            if($categories){
                foreach($categories as $category) {
                    echo '<span typeof="v:Breadcrumb"><a href="'.get_category_link( $category->term_id ).'" rel="v:url" property="v:title">'.$category->cat_name.'</a></span><span><i class="fa fa-angle-right"></i></span>';
                }
            }
            if (is_single()) {
                echo "<span typeof='v:Breadcrumb'><span property='v:title'>";
                the_title();
                echo "</span></span>";
            }
        } elseif (is_page()) {
            echo "<span typeof='v:Breadcrumb'><span property='v:title'>";
            the_title();
            echo "</span></span>";
        }
    }
}

/*------------[ schema.org-enabled the_category() and the_tags() ]-------------*/
function mts_the_category( $separator = ', ' ) {
    $categories = get_the_category();
    $count = count($categories);
    foreach ( $categories as $i => $category ) {
        echo '<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s", 'mythemeshop' ), $category->name ) . '" ' . ' itemprop="articleSection">' . $category->name.'</a>';
        if ( $i < $count - 1 )
            echo $separator;
    }
}
function mts_the_tags($before = null, $sep = ', ', $after = '') {
    if ( null === $before ) 
        $before = __('Tags: ', 'mythemeshop');
    
    $tags = get_the_tags();
    if (empty( $tags ) || is_wp_error( $tags ) ) {
        return;
    }
    $tag_links = array();
    foreach ($tags as $tag) {
        $link = get_tag_link($tag->term_id);
        $tag_links[] = '<a href="' . esc_url( $link ) . '" rel="tag" itemprop="keywords">' . $tag->name . '</a>';
    }
    echo $before.join($sep, $tag_links).$after;
}

/*------------[ pagination ]-------------*/
if (!function_exists('mts_pagination')) {
    function mts_pagination($pages = '', $range = 2) { 
    	$showitems = ($range * 2)+1;
    	global $paged; if(empty($paged)) $paged = 1;
    	if($pages == '') {
    		global $wp_query; $pages = $wp_query->max_num_pages; 
    		if(!$pages){ $pages = 1; } 
    	}
    	if(1 != $pages) { 
    		echo "<div class='pagination'><ul>";
    		if($paged > 1 && $showitems < $pages) 
    			echo "<li><a rel='nofollow' href='".get_pagenum_link($paged - 1)."' class='inactive'>&lsaquo; ".__('Prev','mythemeshop')."</a></li>";
    		for ($i=1; $i <= $pages; $i++){ 
    			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) { 
    				echo ($paged == $i)? "<li class='current'><span class='currenttext'>".$i."</span></li>":"<li><a rel='nofollow' href='".get_pagenum_link($i)."' class='inactive'>".$i."</a></li>";
    			} 
    		} 
    		if ($paged < $pages && $showitems < $pages) 
    			echo "<li><a rel='nofollow' href='".get_pagenum_link($paged + 1)."' class='inactive'>".__('Next','mythemeshop')." &rsaquo;</a></li>";
    			echo "</ul></div>"; 
    	}
    }
}

/*------------[ Cart ]-------------*/
if ( ! function_exists( 'mts_cart' ) ) {
	function mts_cart() { 
	   if (mts_isWooCommerce()) {
	   global $mts_options;
?>
<div class="mts-cart">
	<?php global $woocommerce; ?>
	<span>
		<i class="fa fa-user"></i> 
		<?php if ( is_user_logged_in() ) { ?>
			<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','mythemeshop'); ?>"><?php _e('My Account','mythemeshop'); ?></a>
		<?php } 
		else { ?>
			<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','mythemeshop'); ?>"><?php _e('Login ','mythemeshop'); ?></a>
		<?php } ?>
	</span>
	<span>
		<i class="fa fa-shopping-cart"></i> <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'mythemeshop'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'mythemeshop'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
	</span>
</div>
<?php } 
    }
}

/*------------[ Related Posts ]-------------*/
if (!function_exists('mts_related_posts')) {
    function mts_related_posts() {
        global $post;
        $mts_options = get_option(MTS_THEME_NAME);
        if(!empty($mts_options['mts_related_posts'])) { ?>	
    		<!-- Start Related Posts -->
    		<?php 
            $empty_taxonomy = false;
            if (empty($mts_options['mts_related_posts_taxonomy']) || $mts_options['mts_related_posts_taxonomy'] == 'tags') {
                // related posts based on tags
                $tags = get_the_tags($post->ID); 
                if (empty($tags)) { 
                    $empty_taxonomy = true;
                } else {
                    $tag_ids = array(); 
                    foreach($tags as $individual_tag) {
                        $tag_ids[] = $individual_tag->term_id; 
                    }
                    $args = array( 'tag__in' => $tag_ids, 
                        'post__not_in' => array($post->ID), 
                        'posts_per_page' => $mts_options['mts_related_postsnum'], 
                        'ignore_sticky_posts' => 1, 
                        'orderby' => 'rand' 
                    );
                }
             } else {
                // related posts based on categories
                $categories = get_the_category($post->ID); 
                if (empty($categories)) { 
                    $empty_taxonomy = true;
                } else {
                    $category_ids = array(); 
                    foreach($categories as $individual_category) 
                        $category_ids[] = $individual_category->term_id; 
                    $args = array( 'category__in' => $category_ids, 
                        'post__not_in' => array($post->ID), 
                        'posts_per_page' => $mts_options['mts_related_postsnum'],  
                        'ignore_sticky_posts' => 1, 
                        'orderby' => 'rand' 
                    );
                }
             }
            if (!$empty_taxonomy) {
    		$my_query = new wp_query( $args ); if( $my_query->have_posts() ) {
                echo '<h4 class="section-title">'.__('Related Posts','mythemeshop').'</h4>';
                echo '<div class="related-posts">';
                echo '<div class="related-posts-container clearfix">';
                while( $my_query->have_posts() ) { $my_query->the_post(); ?>
                    <article class="related-post post-box">
                        <div class="related-post-inner">
                            <div class="post-img">
                                <a href="<?php the_permalink(); ?>" rel="nofollow">
                                    <?php if (has_post_thumbnail()) { 
                                    $thumb_id  = get_post_thumbnail_id();
                                    $image     = wp_get_attachment_image_src( $thumb_id, 'full' );
                                    $image_url = $image[0];
                                    $thumbnail = bfi_thumb( $image_url, array( 'width' => 70, 'height' => 70, 'crop' => true ) );
                                } else {
                                    $thumbnail = get_template_directory_uri().'/images/nothumb-70x70.png';
                                }
                                echo '<img src="'.$thumbnail.'" class="wp-post-image">' ?>
                                </a>
                            </div>
                            <div class="post-data">
                                <div class="post-title"><a href="<?php the_permalink(); ?>"><?php echo mts_truncate( get_the_title(), '8', 'words' ); ?></a></div>
                                <div class="post-info"><?php the_time( get_option( 'date_format' ) ); ?></div>
                            </div>
                        </div>
                    </article><!--.related-post-->
                <?php } echo '</div></div>'; }} wp_reset_query(); ?>
            <!-- .related-posts -->
    	<?php }
    }
}


if ( ! function_exists('mts_the_postinfo' ) ) {
    function mts_the_postinfo( $section = 'home' ) {
        $mts_options = get_option( MTS_THEME_NAME );
        if ( ! empty( $mts_options["mts_{$section}_headline_meta"] ) ) { ?>
			<div class="post-info">
				<?php if ( ! empty( $mts_options["mts_{$section}_headline_meta_info"]['author']) ) { ?>
					<span class="theauthor"><i class="fa fa-user"></i> <span itemprop="author"><?php the_author_posts_link(); ?></span></span>
				<?php } ?>
				<?php if( ! empty( $mts_options["mts_{$section}_headline_meta_info"]['date']) ) { ?>
					<span class="thetime updated"><i class="fa fa-clock-o"></i> <span itemprop="datePublished"><?php the_time( get_option( 'date_format' ) ); ?></span></span>
				<?php } ?>
				<?php if( ! empty( $mts_options["mts_{$section}_headline_meta_info"]['category']) ) { ?>
					<span class="thecategory"><i class="fa fa-tags"></i> <?php mts_the_category(', ') ?></span>
				<?php } ?>
				<?php if( ! empty( $mts_options["mts_{$section}_headline_meta_info"]['comment']) ) { ?>
					<span class="thecomment"><i class="fa fa-comments"></i> <a rel="nofollow" href="<?php comments_link(); ?>" itemprop="interactionCount"><?php echo comments_number();?></a></span>
				<?php } ?>
			</div>
		<?php }
    }
}

if (!function_exists('mts_social_buttons')) {
    function mts_social_buttons() {
        $mts_options = get_option( MTS_THEME_NAME );
        if ( $mts_options['mts_social_buttons'] == '1' ) { ?>
    		<!-- Start Share Buttons -->
    		<div class="shareit  <?php echo $mts_options['mts_social_button_position']; ?>">
    			<?php if($mts_options['mts_twitter'] == '1') { ?>
    				<!-- Twitter -->
    				<span class="share-item twitterbtn">
    					<a href="https://twitter.com/share" class="twitter-share-button" data-via="<?php echo $mts_options['mts_twitter_username']; ?>">Tweet</a>
    				</span>
    			<?php } ?>
    			<?php if($mts_options['mts_gplus'] == '1') { ?>
    				<!-- GPlus -->
    				<span class="share-item gplusbtn">
    					<g:plusone size="medium"></g:plusone>
    				</span>
    			<?php } ?>
    			<?php if($mts_options['mts_facebook'] == '1') { ?>
    				<!-- Facebook -->
    				<span class="share-item facebookbtn">
    					<div id="fb-root"></div>
    					<div class="fb-like" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false"></div>
    				</span>
    			<?php } ?>
    			<?php if($mts_options['mts_linkedin'] == '1') { ?>
    				<!--Linkedin -->
    				<span class="share-item linkedinbtn">
    					<script type="IN/Share" data-url="<?php get_permalink(); ?>"></script>
    				</span>
    			<?php } ?>
    			<?php if($mts_options['mts_stumble'] == '1') { ?>
    				<!-- Stumble -->
    				<span class="share-item stumblebtn">
    					<su:badge layout="1"></su:badge>
    				</span>
    			<?php } ?>
    			<?php if($mts_options['mts_pinterest'] == '1') { global $post; ?>
    				<!-- Pinterest -->
    				<span class="share-item pinbtn">
    					<a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' ); echo $thumb['0']; ?>&description=<?php the_title(); ?>" class="pin-it-button" count-layout="horizontal">Pin It</a>
    				</span>
    			<?php } ?>
    		</div>
    		<!-- end Share Buttons -->
    	<?php }
    }
}

/*------------[ Class attribute for <article> element ]-------------*/
if ( ! function_exists( 'mts_article_class' ) ) {
    function mts_article_class() {
        $mts_options = get_option( MTS_THEME_NAME );
        $class = '';
        
        // sidebar or full width
        if ( mts_custom_sidebar() == 'mts_nosidebar' ) {
            $class = 'ss-full-width';
        } else {
            $class = 'article';
        }
        
        // single post/related posts layout
        //if ( is_singular( 'post' ) && $mts_options['mts_related_posts'] ) {
            //$class .= ' '.$mts_options['mts_single_post_layout'];
        //}
        
        echo $class;
    }
}
?>