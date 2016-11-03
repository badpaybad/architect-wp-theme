<?php

defined('ABSPATH') or die;

/*
 * 
 * Require the framework class before doing anything else, so we can use the defined urls and dirs
 *
 */
require_once( dirname( __FILE__ ) . '/options/options.php' );
/*
 * 
 * Custom function for filtering the sections array given by theme, good for child themes to override or add to the sections.
 * Simply include this function in the child themes functions.php file.
 *
 * NOTE: the defined constansts for urls, and dir will NOT be available at this point in a child theme, so you must use
 * get_template_directory_uri() if you want to use any of the built in icons
 *
 */
function add_another_section($sections){
	
	//$sections = array();
	$sections[] = array(
				'title' => __('A Section added by hook', 'mythemeshop'),
				'desc' => __('<p class="description">This is a section created by adding a filter to the sections array, great to allow child themes, to add/remove sections from the options.</p>', 'mythemeshop'),
				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
				//You dont have to though, leave it blank for default.
				'icon' => trailingslashit(get_template_directory_uri()).'options/img/glyphicons/glyphicons_062_attach.png',
				//Lets leave this as a blank section, no options just some intro text set above.
				'fields' => array()
				);
	
	return $sections;
	
}//function
//add_filter('nhp-opts-sections-twenty_eleven', 'add_another_section');


/*
 * 
 * Custom function for filtering the args array given by theme, good for child themes to override or add to the args array.
 *
 */
function change_framework_args($args){
	
	//$args['dev_mode'] = false;
	
	return $args;
	
}//function
//add_filter('nhp-opts-args-twenty_eleven', 'change_framework_args');

/*
 * This is the meat of creating the optons page
 *
 * Override some of the default values, uncomment the args and change the values
 * - no $args are required, but there there to be over ridden if needed.
 *
 *
 */
function setup_framework_options(){
	$args = array();

	//Set it to dev mode to view the class settings/info in the form - default is false
	$args['dev_mode'] = false;
	//Remove the default stylesheet? make sure you enqueue another one all the page will look whack!
	//$args['stylesheet_override'] = true;

	//Add HTML before the form
	//$args['intro_text'] = __('<p>This is the HTML which can be displayed before the form, it isnt required, but more info is always better. Anything goes in terms of markup here, any HTML.</p>', 'mythemeshop');

	//Setup custom links in the footer for share icons
	$args['share_icons']['twitter'] = array(
											'link' => 'http://twitter.com/mythemeshopteam',
											'title' => 'Follow Us on Twitter', 
											'img' => 'fa fa-twitter-square'
											);
	$args['share_icons']['facebook'] = array(
											'link' => 'http://www.facebook.com/mythemeshop',
											'title' => 'Like us on Facebook', 
											'img' => 'fa fa-facebook-square'
											);

	//Choose to disable the import/export feature
	//$args['show_import_export'] = false;

	//Choose a custom option name for your theme options, the default is the theme name in lowercase with spaces replaced by underscores
	$args['opt_name'] = MTS_THEME_NAME;

	//Custom menu icon
	//$args['menu_icon'] = '';

	//Custom menu title for options page - default is "Options"
	$args['menu_title'] = __('Theme Options', 'mythemeshop');

	//Custom Page Title for options page - default is "Options"
	$args['page_title'] = __('Theme Options', 'mythemeshop');

	//Custom page slug for options page (wp-admin/themes.php?page=***) - default is "nhp_theme_options"
	$args['page_slug'] = 'theme_options';

	//Custom page capability - default is set to "manage_options"
	//$args['page_cap'] = 'manage_options';

	//page type - "menu" (adds a top menu section) or "submenu" (adds a submenu) - default is set to "menu"
	//$args['page_type'] = 'submenu';

	//parent menu - default is set to "themes.php" (Appearance)
	//the list of available parent menus is available here: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	//$args['page_parent'] = 'themes.php';

	//custom page location - default 100 - must be unique or will override other items
	$args['page_position'] = 62;

	//Custom page icon class (used to override the page icon next to heading)
	//$args['page_icon'] = 'icon-themes';
			
	//Set ANY custom page help tabs - displayed using the new help tab API, show in order of definition		
	$args['help_tabs'][] = array(
								'id' => 'nhp-opts-1',
								'title' => __('Support', 'mythemeshop'),
								'content' => __('<p>If you are facing any problem with our theme or theme option panel, head over to our <a href="http://mythemeshop.com/support">Knowledge Base</a></p>', 'mythemeshop')
								);
	$args['help_tabs'][] = array(
								'id' => 'nhp-opts-3',
								'title' => __('Credit', 'mythemeshop'),
								'content' => __('<p>Options Panel created using the <a href="http://leemason.github.com/NHP-Theme-Options-Framework/" target="_blank">NHP Theme Options Framework</a> Version 1.0.5</p>', 'mythemeshop')
								);
	$args['help_tabs'][] = array(
								'id' => 'nhp-opts-2',
								'title' => __('Earn Money', 'mythemeshop'),
								'content' => __('<p>Earn 60% commision on every sale by refering your friends and readers. Join our <a href="http://mythemeshop.com/affiliate-program/">Affiliate Program</a>.</p>', 'mythemeshop')
								);

	//Set the Help Sidebar for the options page - no sidebar by default										
	//$args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'mythemeshop');

	$sections = array();

	$sections[] = array(
		'icon' => 'fa fa-cogs',
		'title' => __('General Settings', 'mythemeshop'),
		'desc' => __('<p class="description">This tab contains common setting options which will be applied to the whole theme.</p>', 'mythemeshop'),
		'fields' => array(
			array(
				'id' => 'mts_logo',
				'type' => 'upload',
				//'type' => 'text',
				'title' => __('Logo Image', 'mythemeshop'), 
				'sub_desc' => __('ImgUrl, Upload your logo using the Upload Button or insert image URL.(Recommended height 30px)', 'mythemeshop')
			),
			array(
				'id' => 'mts_favicon',
				'type' => 'upload',
				//'type' => 'text',
				'title' => __('Favicon', 'mythemeshop'), 
				'sub_desc' => __('ImgUrl, Upload a <strong>16 x 16 px</strong> image that will represent your website\'s favicon. You can refer to this link for more information on how to make it: <a href="http://www.favicon.cc/" target="blank" rel="nofollow">http://www.favicon.cc/</a>', 'mythemeshop')
			),
			array(
				'id' => 'mts_twitter_username',
				'type' => 'text',
				'title' => __('Twitter Username', 'mythemeshop'),
				'sub_desc' => __('Enter your Username here.', 'mythemeshop'),
			),
			array(
				'id' => 'mts_feedburner',
				'type' => 'text',
				'title' => __('FeedBurner URL', 'mythemeshop'),
				'sub_desc' => __('Enter your FeedBurner\'s URL here, ex: <strong>http://feeds.feedburner.com/mythemeshop</strong> and your main feed (http://example.com/feed) will get redirected to the FeedBurner ID entered here.)', 'mythemeshop'),
				'validate' => 'url'
			),
			array(
				'id' => 'mts_header_code',
				'type' => 'textarea',
				'title' => __('Header Code', 'mythemeshop'), 
				'sub_desc' => __('Enter the code which you need to place <strong>before closing </head> tag</strong>. (ex: Google Webmaster Tools verification, Bing Webmaster Center, BuySellAds Script, Alexa verification etc.)', 'mythemeshop')
			),
			array(
				'id' => 'mts_analytics_code',
				'type' => 'textarea',
				'title' => __('Footer Code', 'mythemeshop'), 
				'sub_desc' => __('Enter the codes which you need to place in your footer. <strong>(ex: Google Analytics, Clicky, STATCOUNTER, Woopra, Histats, etc.)</strong>.', 'mythemeshop')
			),
			array(
				'id' => 'mts_copyrights',
				'type' => 'textarea',
				'title' => __('Copyrights Text', 'mythemeshop'), 
				'sub_desc' => __('You can change or remove our link from footer and use your own custom text. (Link back is always appreciated)', 'mythemeshop'),
				'std' => 'Theme by <a href="http://mythemeshop.com/">MyThemeShop</a>'
			),
			array(
                'id' => 'mts_pagenavigation_type',
                'type' => 'radio',
                'title' => __('Pagination Type', 'mythemeshop'),
                'sub_desc' => __('Select pagination type.', 'mythemeshop'),
                'options' => array(
                	'0'=> __('Default (Next / Previous)','mythemeshop'),
                	'1' => __('Numbered (1 2 3 4...)','mythemeshop'),
                	'2' => 'AJAX (Load More Button)',
                	'3' => 'AJAX (Auto Infinite Scroll)'),
                'std' => '1'
            ),
            array(
                'id' => 'mts_ajax_search',
                'type' => 'button_set',
                'title' => __('AJAX Quick search', 'mythemeshop'), 
				'options' => array('0' => 'Off','1' => 'On'),
				'sub_desc' => __('Enable or disable search results appearing instantly below the search form', 'mythemeshop'),
				'std' => '0'
            ),
            
			array(
				'id' => 'mts_responsive',
				'type' => 'button_set',
				'title' => __('Responsiveness', 'mythemeshop'),
				'options' => array('0' => 'Off','1' => 'On'),
				'sub_desc' => __('MyThemeShop themes are responsive, which means they adapt to tablet and mobile devices, ensuring that your content is always displayed beautifully no matter what device visitors are using. Enable or disable responsiveness using this option.', 'mythemeshop'),
				'std' => '1'
			),
			array(
				'id' => 'mts_prefetching',
				'type' => 'button_set',
				'title' => __('Prefetching', 'mythemeshop'), 
				'options' => array('0' => 'Off','1' => 'On'),
				'sub_desc' => __('Enable or disable prefetching. If user is on homepage, then single page will load faster and if user is on single page, homepage will load faster in modern browsers.', 'mythemeshop'),
				'std' => '0'
			),
			array(
				'id' => 'mts_rtl',
				'type' => 'button_set',
				'title' => __('Right To Left Language Support', 'mythemeshop'), 
				'options' => array('0' => 'Off','1' => 'On'),
				'sub_desc' => __('Enable this option for right-to-left sites.', 'mythemeshop'),
				'std' => '0'
			),
			array(
				'id' => 'mts_jetpack_galleries',
				'type' => 'button_set',
				'title' => __('JetPack Galleries Support', 'mythemeshop'), 
				'options' => array('0' => 'Off','1' => 'On'),
				'sub_desc' => __('Enable this option if you experience issues with the Tiled Galleries module in the JetPack plugin. Do not enable it if you are not using JetPack or tiled galleries.', 'mythemeshop'),
				'std' => '0'
			),
		)
	);

	$sections[] = array(
		'icon' => 'fa fa-adjust',
		'title' => __('Styling Options', 'mythemeshop'),
		'desc' => __('<p class="description">Control the visual appearance of your theme, such as colors, layout and patterns, from here.</p>', 'mythemeshop'),
		'fields' => array(
			array(
				'id' => 'mts_color_scheme',
				'type' => 'color',
				'title' => __('Color Scheme', 'mythemeshop'), 
				'sub_desc' => __('The theme comes with unlimited color schemes for your theme\'s styling.', 'mythemeshop'),
				'std' => '#252525'
			),
			array(
				'id' => 'mts_header_bg_color',
				'type' => 'color',
				'title' => __('Header Background Color', 'mythemeshop') ,
				'sub_desc' => __('Pick a color for the Header background color.', 'mythemeshop'),
				'std' => '#ffffff'
			),
			array(
				'id' => 'mts_header_bg_pattern',
				'type' => 'radio_img',
				'title' => __('Header Background Pattern', 'mythemeshop') ,
				'sub_desc' => __('Choose from any of <strong>63</strong> awesome background patterns for your header\'s background.', 'mythemeshop') ,
				'options' => array(
					'nobg' => array('img' => NHP_OPTIONS_URL.'img/patterns/nobg.png'),
					'pattern0' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern0.png'),
					'pattern1' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern1.png'),
					'pattern2' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern2.png'),
					'pattern3' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern3.png'),
					'pattern4' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern4.png'),
					'pattern5' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern5.png'),
					'pattern6' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern6.png'),
					'pattern7' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern7.png'),
					'pattern8' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern8.png'),
					'pattern9' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern9.png'),
					'pattern10' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern10.png'),
					'pattern11' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern11.png'),
					'pattern12' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern12.png'),
					'pattern13' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern13.png'),
					'pattern14' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern14.png'),
					'pattern15' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern15.png'),
					'pattern16' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern16.png'),
					'pattern17' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern17.png'),
					'pattern18' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern18.png'),
					'pattern19' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern19.png'),
					'pattern20' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern20.png'),
					'pattern21' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern21.png'),
					'pattern22' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern22.png'),
					'pattern23' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern23.png'),
					'pattern24' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern24.png'),
					'pattern25' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern25.png'),
					'pattern26' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern26.png'),
					'pattern27' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern27.png'),
					'pattern28' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern28.png'),
					'pattern29' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern29.png'),
					'pattern30' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern30.png'),
					'pattern31' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern31.png'),
					'pattern32' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern32.png'),
					'pattern33' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern33.png'),
					'pattern34' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern34.png'),
					'pattern35' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern35.png'),
					'pattern36' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern36.png'),
					'pattern37' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern37.png'),
					'hbg' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg.png'),
					'hbg2' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg2.png'),
					'hbg3' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg3.png'),
					'hbg4' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg4.png'),
					'hbg5' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg5.png'),
					'hbg6' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg6.png'),
					'hbg7' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg7.png'),
					'hbg8' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg8.png'),
					'hbg9' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg9.png'),
					'hbg10' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg10.png'),
					'hbg11' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg11.png'),
					'hbg12' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg12.png'),
					'hbg13' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg13.png'),
					'hbg14' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg14.png'),
					'hbg15' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg15.png'),
					'hbg16' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg16.png'),
					'hbg17' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg17.png'),
					'hbg18' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg18.png'),
					'hbg19' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg19.png'),
					'hbg20' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg20.png'),
					'hbg21' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg21.png'),
					'hbg22' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg22.png'),
					'hbg23' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg23.png'),
					'hbg24' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg24.png'),
					'hbg25' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg25.png')
				),
				'std' => 'nobg'
			),
			array(
				'id' => 'mts_header_bg_pattern_upload',
				'type' => 'upload',//'type' => 'text',
				'title' => __('Custom Header Background Image', 'mythemeshop'),
				'sub_desc' => __('Upload your own custom background image or pattern for Header.', 'mythemeshop')
			),
			array(
				'id' => 'mts_custom_css',
				'type' => 'textarea',
				'title' => __('Custom CSS', 'mythemeshop'), 
				'sub_desc' => __('You can enter custom CSS code here to further customize your theme. This will override the default CSS used on your site.', 'mythemeshop')
			),
			array(
				'id' => 'mts_lightbox',
				'type' => 'button_set',
				'title' => __('Lightbox', 'mythemeshop'),
				'options' => array('0' => 'Off','1' => 'On'),
				'sub_desc' => __('A lightbox is a stylized pop-up that allows your visitors to view larger versions of images without leaving the current page. You can enable or disable the lightbox here.', 'mythemeshop'),
				'std' => '0'
			),																		
		)
	);

	$sections[] = array(
		'icon' => 'fa fa-credit-card',
		'title' => __('Header', 'mythemeshop'),
		'desc' => __('<p class="description">From here, you can control the elements of header section.</p>', 'mythemeshop'),
		'fields' => array(
			array(
				'id' => 'mts_sticky_header',
				'type' => 'button_set',
				'title' => __('Floating Header', 'mythemeshop'), 
				'options' => array('0' => 'Off','1' => 'On'),
				'sub_desc' => __('Use this button to enable <strong>Floating Header</strong>.', 'mythemeshop'),
				'std' => '0'
			),
			array(
				'id' => 'mts_header_section2',
				'type' => 'button_set',
				'title' => __('Show Logo', 'mythemeshop'), 
				'options' => array('0' => 'Off','1' => 'On'),
				'sub_desc' => __('Use this button to Show or Hide <strong>Logo</strong> completely.', 'mythemeshop'),
				'std' => '1'
			),
			array(
				'id' => 'mts_show_primary_nav',
				'type' => 'button_set_hide_below',
				'title' => __('Show Header Menu', 'mythemeshop'), 
				'options' => array('0' => 'Off','1' => 'On'),
				'sub_desc' => __('Use this button to enable <strong>Primary Navigation Menu</strong>.', 'mythemeshop'),
				'std' => '1',
				//'args' => array('hide' => 2)
			),
			array(
				'id' => 'mts_header_search_form',
				'type' => 'button_set',
				'title' => __('Header Menu Search Form', 'mythemeshop'), 
				'options' => array('0' => 'Off','1' => 'On'),
				'sub_desc' => __('Use this button to Show or Hide <strong>Search Form</strong> in Primary ( header ) menu .', 'mythemeshop'),
				'std' => '1'
			),
		)
	);
	/* ==========================================================================
	   Home Layout
	   ========================================================================== */
	$sections[] = array(
		'icon' => 'fa fa-bar-chart-o',
		'title' => __('Home Layout', 'mythemeshop'),
		'desc' => __('<p class="description">>From here, you can control the elements of the homepage.</p>', 'mythemeshop'),
		'fields' => array(
			array(
				'id'      => 'mts_homepage_layout',
				'type'    => 'layout',
				'title'   => 'Homepage Layout Manager',
				'sub_desc'    => 'Organize how you want the layout to appear on the homepage',
				'options' => array(
					'enabled'  => array(
					),
					'disabled' => array(
						'slider'       => 'Slider',
						'features'     => 'Features',
						'introduction' => 'Introduction',
						'services'     => 'Services',
						'counters'     => 'Counters',
						'clients'      => 'Clients',
						'twitter'      => 'Twitter',
						'team'         => 'Team',
						'quotes'       => 'Testimonials',
						'projects'     => 'Projects',
						'contact'      => 'Contact',
					)
				)
			),
		)
	);
	/* ==========================================================================
	   Slider
	   ========================================================================== */
	$sections[] = array(
		'icon' => 'fa-home',
		'title' => __('Slider', 'mythemeshop'),
		'desc' => __('<p class="description">From here, you can control the elements of the homepage.</p>', 'mythemeshop'),
		'fields' => array(
		  	array(
				'id'        => 'mts_custom_slider',
				'type'      => 'group',
				'title'     => __('Custom Slider', 'mythemeshop'), 
				'sub_desc'  => __('You can set up a slider with custom image and text.', 'mythemeshop'),
				'groupname' => __('Slider', 'mythemeshop'), // Group name
				'subfields' => array(
					array(
						'id' => 'mts_custom_slider_title',
						'type' => 'text',
						'title' => __('Title', 'mythemeshop'), 
						'sub_desc' => __('Title of the slide', 'mythemeshop'),
					),
					array(
						'id' => 'mts_custom_slider_image',
						'type' => 'upload',
						//'type' => 'text',
						'title' => __('Image', 'mythemeshop'), 
						'sub_desc' => __('ImgUrlUpload or select an image for this slide.', 'mythemeshop'),
					),
					array('id' => 'mts_custom_slider_button_label',
						'type' => 'text',
						'title' => __('Button Label', 'mythemeshop'), 
						'sub_desc' => __('Slide button text', 'mythemeshop'),
					), 
					array('id' => 'mts_custom_slider_button_link',
						'type' => 'text',
						'title' => __('Button Link', 'mythemeshop'), 
						'sub_desc' => __('Insert a link URL for the slide button', 'mythemeshop'),
						'std' => '#'
					),
				),
			),
			array(
                'id' => 'mts_homepage_slider_color_scheme',
                'type' => 'button_set',
                'title' => __('Section text colors', 'mythemeshop'), 
				'options' => array('dark' => 'Dark','light' => 'Light'),
				'std' => 'light',
                'class' => 'green'
            ),
			array(
				'id' => 'mts_homepage_slider_background_color',
				'type' => 'color',
				'title' => __( 'Background Color', 'mythemeshop' ),
				'sub_desc' => __( 'Edit the background color for the section', 'mythemeshop' ),
                'std' => '#888888'
			),
			array(
				'id' => 'mts_homepage_content_slider',
				'type' => 'button_set_hide_below',
				'options' => array('0' => 'Off','1' => 'On'),
				'std' => '0',
				'title' => __( 'Disable slider images?', 'mythemeshop' ),
				'sub_desc' => __( 'Turn this on to disable images and to apply the same background for each slide.', 'mythemeshop' ),
				'args' => array(
					'hide' => 3
				)
			),
            array(
				'id' => 'mts_homepage_slider_background_pattern',
				'type' => 'radio_img',
				'title' => __('Background Pattern', 'mythemeshop'), 
				'sub_desc' => __('Choose one from the <strong>63</strong> awesome background patterns.', 'mythemeshop'),
				'options' => array(
					'nobg' => array('img' => NHP_OPTIONS_URL.'img/patterns/nobg.png'),
					'pattern0' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern0.png'),
					'pattern1' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern1.png'),
					'pattern2' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern2.png'),
					'pattern3' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern3.png'),
					'pattern4' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern4.png'),
					'pattern5' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern5.png'),
					'pattern6' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern6.png'),
					'pattern7' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern7.png'),
					'pattern8' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern8.png'),
					'pattern9' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern9.png'),
					'pattern10' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern10.png'),
					'pattern11' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern11.png'),
					'pattern12' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern12.png'),
					'pattern13' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern13.png'),
					'pattern14' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern14.png'),
					'pattern15' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern15.png'),
					'pattern16' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern16.png'),
					'pattern17' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern17.png'),
					'pattern18' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern18.png'),
					'pattern19' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern19.png'),
					'pattern20' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern20.png'),
					'pattern21' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern21.png'),
					'pattern22' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern22.png'),
					'pattern23' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern23.png'),
					'pattern24' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern24.png'),
					'pattern25' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern25.png'),
					'pattern26' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern26.png'),
					'pattern27' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern27.png'),
					'pattern28' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern28.png'),
					'pattern29' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern29.png'),
					'pattern30' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern30.png'),
					'pattern31' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern31.png'),
					'pattern32' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern32.png'),
					'pattern33' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern33.png'),
					'pattern34' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern34.png'),
					'pattern35' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern35.png'),
					'pattern36' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern36.png'),
					'pattern37' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern37.png'),
					'hbg' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg.png'),
					'hbg2' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg2.png'),
					'hbg3' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg3.png'),
					'hbg4' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg4.png'),
					'hbg5' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg5.png'),
					'hbg6' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg6.png'),
					'hbg7' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg7.png'),
					'hbg8' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg8.png'),
					'hbg9' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg9.png'),
					'hbg10' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg10.png'),
					'hbg11' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg11.png'),
					'hbg12' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg12.png'),
					'hbg13' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg13.png'),
					'hbg14' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg14.png'),
					'hbg15' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg15.png'),
					'hbg16' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg16.png'),
					'hbg17' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg17.png'),
					'hbg18' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg18.png'),
					'hbg19' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg19.png'),
					'hbg20' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg20.png'),
					'hbg21' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg21.png'),
					'hbg22' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg22.png'),
					'hbg23' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg23.png'),
					'hbg24' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg24.png'),
					'hbg25' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg25.png')
				),
				'std' => 'nobg'
			),
			array(
				'id' => 'mts_homepage_slider_background_image',
				'type' => 'upload',
				//'type' => 'text',
				'title' => __( 'Background Image', 'mythemeshop' ),
				'sub_desc' => __( 'Edit the background image for the section.', 'mythemeshop' )
			),
			array(
				'id' => 'mts_homepage_slider_background_image_cover',
				'type' => 'button_set',
				'options' => array('0' => 'Off','1' => 'On'),
				'std' => '0',
				'title' => __( 'Cover the section with Background Image', 'mythemeshop' ),
				'sub_desc' => __( 'Scale the background image to be as large as possible so that the background area is completely covered by the background image. Some parts of the background image may not be in view within the background positioning area', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_slider_parallax',
				'type' => 'button_set',
				'options' => array('0' => 'Off','1' => 'On'),
				'std' => '0',
				'title' => __( 'Enable Parallax Background', 'mythemeshop' ),
				'sub_desc' => __('Controls whether the slider background image has parallax scrolling enabled.','mythemeshop' ),
			),
		)
	);
	/* ==========================================================================
	   Features
	   ========================================================================== */
	$sections[] = array(
		'icon' => 'fa-home',
		'title' => __('Features', 'mythemeshop'),
		'desc' => __('<p class="description">Choose what you would like to feature.</p>', 'mythemeshop'),
		'fields' => array(
			array(
				'id' => 'mts_homepage_features_title',
				'type' => 'text',
				'title' => __( 'Title', 'mythemeshop' ),
				'sub_desc' => __( 'Section Title', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_features_description',
				'type' => 'textarea',
				'title' => __( 'Description', 'mythemeshop' ),
				'sub_desc' => __( 'Section description', 'mythemeshop' ),
			),
			array(
                'id' => 'mts_homepage_features_color_scheme',
                'type' => 'button_set',
                'title' => __('Section text colors', 'mythemeshop'), 
				'options' => array('dark' => 'Dark','light' => 'Light'),
				'std' => 'dark',
                'class' => 'green'
            ),
			array(
				'id' => 'mts_homepage_features_background_color',
				'type' => 'color',
				'title' => __( 'Background Color', 'mythemeshop' ),
				'sub_desc' => __( 'Edit the background color for the section', 'mythemeshop' ),
                'std' => '#ffffff'
			),
            array(
				'id' => 'mts_homepage_features_background_pattern',
				'type' => 'radio_img',
				'title' => __('Background Pattern', 'mythemeshop'), 
				'sub_desc' => __('Choose one from the <strong>63</strong> awesome background patterns.', 'mythemeshop'),
				'options' => array(
					'nobg' => array('img' => NHP_OPTIONS_URL.'img/patterns/nobg.png'),
					'pattern0' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern0.png'),
					'pattern1' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern1.png'),
					'pattern2' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern2.png'),
					'pattern3' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern3.png'),
					'pattern4' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern4.png'),
					'pattern5' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern5.png'),
					'pattern6' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern6.png'),
					'pattern7' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern7.png'),
					'pattern8' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern8.png'),
					'pattern9' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern9.png'),
					'pattern10' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern10.png'),
					'pattern11' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern11.png'),
					'pattern12' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern12.png'),
					'pattern13' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern13.png'),
					'pattern14' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern14.png'),
					'pattern15' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern15.png'),
					'pattern16' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern16.png'),
					'pattern17' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern17.png'),
					'pattern18' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern18.png'),
					'pattern19' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern19.png'),
					'pattern20' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern20.png'),
					'pattern21' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern21.png'),
					'pattern22' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern22.png'),
					'pattern23' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern23.png'),
					'pattern24' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern24.png'),
					'pattern25' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern25.png'),
					'pattern26' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern26.png'),
					'pattern27' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern27.png'),
					'pattern28' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern28.png'),
					'pattern29' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern29.png'),
					'pattern30' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern30.png'),
					'pattern31' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern31.png'),
					'pattern32' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern32.png'),
					'pattern33' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern33.png'),
					'pattern34' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern34.png'),
					'pattern35' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern35.png'),
					'pattern36' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern36.png'),
					'pattern37' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern37.png'),
					'hbg' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg.png'),
					'hbg2' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg2.png'),
					'hbg3' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg3.png'),
					'hbg4' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg4.png'),
					'hbg5' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg5.png'),
					'hbg6' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg6.png'),
					'hbg7' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg7.png'),
					'hbg8' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg8.png'),
					'hbg9' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg9.png'),
					'hbg10' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg10.png'),
					'hbg11' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg11.png'),
					'hbg12' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg12.png'),
					'hbg13' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg13.png'),
					'hbg14' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg14.png'),
					'hbg15' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg15.png'),
					'hbg16' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg16.png'),
					'hbg17' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg17.png'),
					'hbg18' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg18.png'),
					'hbg19' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg19.png'),
					'hbg20' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg20.png'),
					'hbg21' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg21.png'),
					'hbg22' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg22.png'),
					'hbg23' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg23.png'),
					'hbg24' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg24.png'),
					'hbg25' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg25.png')
				),
				'std' => 'nobg'
			),
			array(
				'id' => 'mts_homepage_features_background_image',
				'type' => 'upload',
				//'type' => 'text',
				'title' => __( 'Background Image', 'mythemeshop' ),
				'sub_desc' => __( 'Edit the background image for the section', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_features_background_image_cover',
				'type' => 'button_set',
				'options' => array('0' => 'Off','1' => 'On'),
				'std' => '0',
				'title' => __( 'Cover the section with Background Image', 'mythemeshop' ),
				'sub_desc' => __( 'Scale the background image to be as large as possible so that the background area is completely covered by the background image. Some parts of the background image may not be in view within the background positioning area', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_features_parallax',
				'type' => 'button_set',
				'options' => array('0' => 'Off','1' => 'On'),
				'std' => '0',
				'title' => __( 'Enable Parallax Background', 'mythemeshop' ),
				'sub_desc' => __( 'Controls whether the background image has parallax scrolling enabled.', 'mythemeshop' ),
			),
			array(
             	'id' => 'mts_homepage_features',
             	'title' => 'Features',
             	'sub_desc' => __( 'Add "features" to your homepage to promote specifics of your company, service, brand, etc.', 'mythemeshop' ),
             	'type' => 'group',
             	'groupname' => __('Feature', 'mythemeshop'), // Group name
             	'subfields' => array(
                    array(
                        'id' => 'mts_homepage_feature_title',
						'type' => 'text',
						'title' => __('Title', 'mythemeshop'), 
					),
					array(
                        'id' => 'mts_homepage_feature_icon',
						'type' => 'icon_select',
						'title' => __('Icon', 'mythemeshop')
					),
                    array(
                        'id' => 'mts_homepage_feature_description',
						'type' => 'textarea',
						'title' => __('Description', 'mythemeshop'), 
					),
                ),
            )
		)
	);
	/* ==========================================================================
	   Introduction
	   ========================================================================== */
	$sections[] = array(
		'icon' => 'fa-home',
		'title' => __('Introduction', 'mythemeshop'),
		'desc' => __('<p class="description">Choose what you would like to feature.</p>', 'mythemeshop'),
		'fields' => array(
			array(
				'id' => 'mts_homepage_introduction_title',
				'type' => 'text',
				'title' => __( 'Title', 'mythemeshop' ),
				'sub_desc' => __( 'Section Title', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_introduction_description',
				'type' => 'textarea',
				'title' => __( 'Description', 'mythemeshop' ),
				'sub_desc' => __( 'Section description', 'mythemeshop' ),
			),
			array(
                'id' => 'mts_homepage_introduction_color_scheme',
                'type' => 'button_set',
                'title' => __('Section text colors', 'mythemeshop'), 
				'options' => array('dark' => 'Dark','light' => 'Light'),
				'std' => 'light',
                'class' => 'green'
            ),
			array(
				'id' => 'mts_homepage_introduction_background_color',
				'type' => 'color',
				'title' => __( 'Background Color', 'mythemeshop' ),
				'sub_desc' => __( 'Edit the background color for the section', 'mythemeshop' ),
                'std' => '#ffffff'
			),
            array(
				'id' => 'mts_homepage_introduction_background_pattern',
				'type' => 'radio_img',
				'title' => __('Background Pattern', 'mythemeshop'), 
				'sub_desc' => __('Choose one from the <strong>63</strong> awesome background patterns.', 'mythemeshop'),
				'options' => array(
					'nobg' => array('img' => NHP_OPTIONS_URL.'img/patterns/nobg.png'),
					'pattern0' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern0.png'),
					'pattern1' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern1.png'),
					'pattern2' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern2.png'),
					'pattern3' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern3.png'),
					'pattern4' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern4.png'),
					'pattern5' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern5.png'),
					'pattern6' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern6.png'),
					'pattern7' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern7.png'),
					'pattern8' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern8.png'),
					'pattern9' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern9.png'),
					'pattern10' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern10.png'),
					'pattern11' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern11.png'),
					'pattern12' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern12.png'),
					'pattern13' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern13.png'),
					'pattern14' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern14.png'),
					'pattern15' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern15.png'),
					'pattern16' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern16.png'),
					'pattern17' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern17.png'),
					'pattern18' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern18.png'),
					'pattern19' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern19.png'),
					'pattern20' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern20.png'),
					'pattern21' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern21.png'),
					'pattern22' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern22.png'),
					'pattern23' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern23.png'),
					'pattern24' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern24.png'),
					'pattern25' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern25.png'),
					'pattern26' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern26.png'),
					'pattern27' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern27.png'),
					'pattern28' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern28.png'),
					'pattern29' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern29.png'),
					'pattern30' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern30.png'),
					'pattern31' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern31.png'),
					'pattern32' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern32.png'),
					'pattern33' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern33.png'),
					'pattern34' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern34.png'),
					'pattern35' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern35.png'),
					'pattern36' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern36.png'),
					'pattern37' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern37.png'),
					'hbg' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg.png'),
					'hbg2' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg2.png'),
					'hbg3' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg3.png'),
					'hbg4' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg4.png'),
					'hbg5' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg5.png'),
					'hbg6' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg6.png'),
					'hbg7' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg7.png'),
					'hbg8' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg8.png'),
					'hbg9' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg9.png'),
					'hbg10' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg10.png'),
					'hbg11' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg11.png'),
					'hbg12' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg12.png'),
					'hbg13' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg13.png'),
					'hbg14' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg14.png'),
					'hbg15' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg15.png'),
					'hbg16' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg16.png'),
					'hbg17' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg17.png'),
					'hbg18' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg18.png'),
					'hbg19' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg19.png'),
					'hbg20' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg20.png'),
					'hbg21' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg21.png'),
					'hbg22' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg22.png'),
					'hbg23' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg23.png'),
					'hbg24' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg24.png'),
					'hbg25' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg25.png')
				),
				'std' => 'nobg'
			),
			array(
				'id' => 'mts_homepage_introduction_background_image',
				'type' => 'upload',
				//'type' => 'text',
				'title' => __( 'Background Image', 'mythemeshop' ),
				'sub_desc' => __( 'Edit the background image for the section', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_introduction_background_image_cover',
				'type' => 'button_set',
				'options' => array('0' => 'Off','1' => 'On'),
				'std' => '0',
				'title' => __( 'Cover the section with Background Image', 'mythemeshop' ),
				'sub_desc' => __( 'Scale the background image to be as large as possible so that the background area is completely covered by the background image. Some parts of the background image may not be in view within the background positioning area', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_introduction_parallax',
				'type' => 'button_set',
				'options' => array('0' => 'Off','1' => 'On'),
				'std' => '0',
				'title' => __( 'Enable Parallax Background', 'mythemeshop' ),
				'sub_desc' => __( 'Controls whether the background image has parallax scrolling enabled.', 'mythemeshop' ),
			),
			array(
                'id' => 'mts_homepage_introduction_image',
				'type' => 'upload',
				//'type' => 'text',
				'title' => __('Image', 'mythemeshop'), 
				'sub_desc' => __('Introduction Image.', 'mythemeshop'),
				'sub_desc' => __( 'Add Front image which will overlap Background image and move the text to the left.', 'mythemeshop' ),
			),
            array(
                'id' => 'mts_homepage_introduction_text',
				'type' => 'textarea',
				'title' => __('Introduction Text', 'mythemeshop'),
			),
		)
	);
	/* ==========================================================================
	   Services
	   ========================================================================== */
	$sections[] = array(
		'icon' => 'fa-home',
		'title' => __('Services', 'mythemeshop'),
		'desc' => __('<p class="description">Manage the content displayed on the carousel.</p>', 'mythemeshop'),
		'fields' => array(
			array(
				'id' => 'mts_homepage_services_title',
				'type' => 'text',
				'title' => __( 'Title', 'mythemeshop' ),
				'sub_desc' => __( 'Section Title', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_services_description',
				'type' => 'textarea',
				'title' => __( 'Description', 'mythemeshop' ),
				'sub_desc' => __( 'Section description', 'mythemeshop' ),
			),
			array(
                'id' => 'mts_homepage_services_color_scheme',
                'type' => 'button_set',
                'title' => __('Section text colors', 'mythemeshop'), 
				'options' => array('dark' => 'Dark','light' => 'Light'),
				'std' => 'dark',
                'class' => 'green'
            ),
			array(
				'id' => 'mts_homepage_services_background_color',
				'type' => 'color',
				'title' => __( 'Background Color', 'mythemeshop' ),
				'sub_desc' => __( 'Edit the background color for the section', 'mythemeshop' ),
                'std' => '#ffffff'
			),
            array(
				'id' => 'mts_homepage_services_background_pattern',
				'type' => 'radio_img',
				'title' => __('Background Pattern', 'mythemeshop'), 
				'sub_desc' => __('Choose one from the <strong>63</strong> awesome background patterns.', 'mythemeshop'),
				'options' => array(
					'nobg' => array('img' => NHP_OPTIONS_URL.'img/patterns/nobg.png'),
					'pattern0' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern0.png'),
					'pattern1' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern1.png'),
					'pattern2' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern2.png'),
					'pattern3' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern3.png'),
					'pattern4' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern4.png'),
					'pattern5' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern5.png'),
					'pattern6' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern6.png'),
					'pattern7' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern7.png'),
					'pattern8' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern8.png'),
					'pattern9' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern9.png'),
					'pattern10' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern10.png'),
					'pattern11' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern11.png'),
					'pattern12' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern12.png'),
					'pattern13' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern13.png'),
					'pattern14' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern14.png'),
					'pattern15' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern15.png'),
					'pattern16' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern16.png'),
					'pattern17' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern17.png'),
					'pattern18' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern18.png'),
					'pattern19' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern19.png'),
					'pattern20' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern20.png'),
					'pattern21' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern21.png'),
					'pattern22' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern22.png'),
					'pattern23' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern23.png'),
					'pattern24' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern24.png'),
					'pattern25' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern25.png'),
					'pattern26' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern26.png'),
					'pattern27' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern27.png'),
					'pattern28' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern28.png'),
					'pattern29' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern29.png'),
					'pattern30' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern30.png'),
					'pattern31' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern31.png'),
					'pattern32' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern32.png'),
					'pattern33' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern33.png'),
					'pattern34' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern34.png'),
					'pattern35' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern35.png'),
					'pattern36' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern36.png'),
					'pattern37' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern37.png'),
					'hbg' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg.png'),
					'hbg2' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg2.png'),
					'hbg3' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg3.png'),
					'hbg4' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg4.png'),
					'hbg5' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg5.png'),
					'hbg6' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg6.png'),
					'hbg7' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg7.png'),
					'hbg8' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg8.png'),
					'hbg9' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg9.png'),
					'hbg10' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg10.png'),
					'hbg11' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg11.png'),
					'hbg12' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg12.png'),
					'hbg13' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg13.png'),
					'hbg14' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg14.png'),
					'hbg15' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg15.png'),
					'hbg16' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg16.png'),
					'hbg17' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg17.png'),
					'hbg18' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg18.png'),
					'hbg19' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg19.png'),
					'hbg20' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg20.png'),
					'hbg21' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg21.png'),
					'hbg22' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg22.png'),
					'hbg23' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg23.png'),
					'hbg24' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg24.png'),
					'hbg25' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg25.png')
				),
				'std' => 'nobg'
			),
			array(
				'id' => 'mts_homepage_services_background_image',
				'type' => 'upload',
				//'type' => 'text',
				'title' => __( 'Background Image', 'mythemeshop' ),
				'sub_desc' => __( 'Edit the background image for the section', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_services_background_image_cover',
				'type' => 'button_set',
				'options' => array('0' => 'Off','1' => 'On'),
				'std' => '0',
				'title' => __( 'Cover the section with Background Image', 'mythemeshop' ),
				'sub_desc' => __( 'Scale the background image to be as large as possible so that the background area is completely covered by the background image. Some parts of the background image may not be in view within the background positioning area', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_services_parallax',
				'type' => 'button_set',
				'options' => array('0' => 'Off','1' => 'On'),
				'std' => '0',
				'title' => __( 'Enable Parallax Background', 'mythemeshop' ),
				'sub_desc' => __( 'Controls whether the background image has parallax scrolling enabled.', 'mythemeshop' ),
			),
			array(
			 	'id' => 'mts_homepage_service',
			 	'title' => 'Service Items',
			 	'sub_desc' => __( 'Manage service items.', 'mythemeshop' ),
			 	'type' => 'group',
			 	'groupname' => __('Service Item', 'mythemeshop'), // Group name
			 	'subfields' => array(
		            array(
		                'id' => 'mts_homepage_service_title',
						'type' => 'text',
						'title' => __('Title', 'mythemeshop'), 
					),
					array(
		                'id' => 'mts_homepage_service_image',
						'type' => 'upload',
						//'type' => 'text',
						'title' => __('Image', 'mythemeshop')
					),
		            array(
		                'id' => 'mts_homepage_service_description',
						'type' => 'textarea',
						'title' => __('Description', 'mythemeshop'), 
					)
			    ),
			),
		)
	);
	/* ==========================================================================
	   Counters
	   ========================================================================== */
	$sections[] = array(
		'icon' => 'fa-home',
		'title' => __('Counters', 'mythemeshop'),
		'desc' => __('<p class="description">Manage the counters section on the homepage.</p>', 'mythemeshop'),
		'fields' => array(
			array(
				'id' => 'mts_homepage_counters_title',
				'type' => 'text',
				'title' => __( 'Title', 'mythemeshop' ),
				'sub_desc' => __( 'Section Title', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_counters_description',
				'type' => 'textarea',
				'title' => __( 'Description', 'mythemeshop' ),
				'sub_desc' => __( 'Section description', 'mythemeshop' ),
			),
			array(
                'id' => 'mts_homepage_counters_color_scheme',
                'type' => 'button_set',
                'title' => __('Section text colors', 'mythemeshop'), 
				'options' => array('dark' => 'Dark','light' => 'Light'),
				'std' => 'light',
                'class' => 'green'
            ),
			array(
				'id' => 'mts_homepage_counters_background_color',
				'type' => 'color',
				'title' => __( 'Background Color', 'mythemeshop' ),
				'sub_desc' => __( 'Edit the background color for the section', 'mythemeshop' ),
                'std' => '#ffffff'
			),
            array(
				'id' => 'mts_homepage_counters_background_pattern',
				'type' => 'radio_img',
				'title' => __('Background Pattern', 'mythemeshop'), 
				'sub_desc' => __('Choose one from the <strong>63</strong> awesome background patterns.', 'mythemeshop'),
				'options' => array(
					'nobg' => array('img' => NHP_OPTIONS_URL.'img/patterns/nobg.png'),
					'pattern0' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern0.png'),
					'pattern1' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern1.png'),
					'pattern2' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern2.png'),
					'pattern3' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern3.png'),
					'pattern4' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern4.png'),
					'pattern5' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern5.png'),
					'pattern6' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern6.png'),
					'pattern7' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern7.png'),
					'pattern8' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern8.png'),
					'pattern9' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern9.png'),
					'pattern10' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern10.png'),
					'pattern11' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern11.png'),
					'pattern12' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern12.png'),
					'pattern13' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern13.png'),
					'pattern14' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern14.png'),
					'pattern15' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern15.png'),
					'pattern16' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern16.png'),
					'pattern17' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern17.png'),
					'pattern18' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern18.png'),
					'pattern19' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern19.png'),
					'pattern20' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern20.png'),
					'pattern21' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern21.png'),
					'pattern22' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern22.png'),
					'pattern23' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern23.png'),
					'pattern24' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern24.png'),
					'pattern25' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern25.png'),
					'pattern26' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern26.png'),
					'pattern27' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern27.png'),
					'pattern28' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern28.png'),
					'pattern29' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern29.png'),
					'pattern30' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern30.png'),
					'pattern31' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern31.png'),
					'pattern32' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern32.png'),
					'pattern33' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern33.png'),
					'pattern34' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern34.png'),
					'pattern35' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern35.png'),
					'pattern36' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern36.png'),
					'pattern37' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern37.png'),
					'hbg' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg.png'),
					'hbg2' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg2.png'),
					'hbg3' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg3.png'),
					'hbg4' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg4.png'),
					'hbg5' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg5.png'),
					'hbg6' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg6.png'),
					'hbg7' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg7.png'),
					'hbg8' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg8.png'),
					'hbg9' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg9.png'),
					'hbg10' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg10.png'),
					'hbg11' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg11.png'),
					'hbg12' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg12.png'),
					'hbg13' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg13.png'),
					'hbg14' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg14.png'),
					'hbg15' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg15.png'),
					'hbg16' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg16.png'),
					'hbg17' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg17.png'),
					'hbg18' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg18.png'),
					'hbg19' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg19.png'),
					'hbg20' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg20.png'),
					'hbg21' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg21.png'),
					'hbg22' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg22.png'),
					'hbg23' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg23.png'),
					'hbg24' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg24.png'),
					'hbg25' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg25.png')
				),
				'std' => 'nobg'
			),
			array(
				'id' => 'mts_homepage_counters_background_image',
				'type' => 'upload',
				//'type' => 'text',
				'title' => __( 'Background Image', 'mythemeshop' ),
				'sub_desc' => __( 'Edit the background image for the section', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_counters_background_image_cover',
				'type' => 'button_set',
				'options' => array('0' => 'Off','1' => 'On'),
				'std' => '0',
				'title' => __( 'Cover the section with Background Image', 'mythemeshop' ),
				'sub_desc' => __( 'Scale the background image to be as large as possible so that the background area is completely covered by the background image. Some parts of the background image may not be in view within the background positioning area', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_counters_parallax',
				'type' => 'button_set',
				'options' => array('0' => 'Off','1' => 'On'),
				'std' => '0',
				'title' => __( 'Enable Parallax Background', 'mythemeshop' ),
				'sub_desc' => __( 'Controls whether the background image has parallax scrolling enabled.', 'mythemeshop' ),
			),
			array(
             	'id' => 'mts_homepage_counter',
             	'title' => 'Counter',
             	'sub_desc' => __( 'Counter section to display statistics.', 'mythemeshop' ),
             	'type' => 'group',
             	'groupname' => __('Statistic', 'mythemeshop'), // Group name
             	'subfields' =>  array(
             		array(
                        'id' => 'mts_homepage_counter_title',
						'type' => 'text',
						'title' => __('Title', 'mythemeshop'),
					),
                	array(
                        'id' => 'mts_homepage_counter_number',
						'type' => 'text',
						'title' => __('Number', 'mythemeshop'), 
						'args' => array('type' => 'number')
					),
                    array(
                        'id' => 'mts_homepage_counter_icon',
						'type' => 'icon_select',
						'title' => __('Icon', 'mythemeshop')
					),
                ),
            )
		)
	);
	/* ==========================================================================
	   Clients
	   ========================================================================== */
	$sections[] = array(
		'icon' => 'fa-home',
		'title' => __('Clients', 'mythemeshop'),
		'desc' => __('<p class="description">Manage the content displayed on the client section.</p>', 'mythemeshop'),
		'fields' => array(
			array(
				'id' => 'mts_homepage_clients_title',
				'type' => 'text',
				'title' => __( 'Title', 'mythemeshop' ),
				'sub_desc' => __( 'Section Title', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_clients_description',
				'type' => 'textarea',
				'title' => __( 'Description', 'mythemeshop' ),
				'sub_desc' => __( 'Section description', 'mythemeshop' ),
			),
			array(
                'id' => 'mts_homepage_clients_color_scheme',
                'type' => 'button_set',
                'title' => __('Section text colors', 'mythemeshop'), 
				'options' => array('dark' => 'Dark','light' => 'Light'),
				'std' => 'dark',
                'class' => 'green'
            ),
			array(
				'id' => 'mts_homepage_clients_background_color',
				'type' => 'color',
				'title' => __( 'Background Color', 'mythemeshop' ),
				'sub_desc' => __( 'Edit the background color for the section', 'mythemeshop' ),
                'std' => '#ffffff'
			),
            array(
				'id' => 'mts_homepage_clients_background_pattern',
				'type' => 'radio_img',
				'title' => __('Background Pattern', 'mythemeshop'), 
				'sub_desc' => __('Choose one from the <strong>63</strong> awesome background patterns.', 'mythemeshop'),
				'options' => array(
					'nobg' => array('img' => NHP_OPTIONS_URL.'img/patterns/nobg.png'),
					'pattern0' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern0.png'),
					'pattern1' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern1.png'),
					'pattern2' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern2.png'),
					'pattern3' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern3.png'),
					'pattern4' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern4.png'),
					'pattern5' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern5.png'),
					'pattern6' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern6.png'),
					'pattern7' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern7.png'),
					'pattern8' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern8.png'),
					'pattern9' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern9.png'),
					'pattern10' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern10.png'),
					'pattern11' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern11.png'),
					'pattern12' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern12.png'),
					'pattern13' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern13.png'),
					'pattern14' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern14.png'),
					'pattern15' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern15.png'),
					'pattern16' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern16.png'),
					'pattern17' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern17.png'),
					'pattern18' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern18.png'),
					'pattern19' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern19.png'),
					'pattern20' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern20.png'),
					'pattern21' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern21.png'),
					'pattern22' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern22.png'),
					'pattern23' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern23.png'),
					'pattern24' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern24.png'),
					'pattern25' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern25.png'),
					'pattern26' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern26.png'),
					'pattern27' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern27.png'),
					'pattern28' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern28.png'),
					'pattern29' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern29.png'),
					'pattern30' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern30.png'),
					'pattern31' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern31.png'),
					'pattern32' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern32.png'),
					'pattern33' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern33.png'),
					'pattern34' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern34.png'),
					'pattern35' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern35.png'),
					'pattern36' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern36.png'),
					'pattern37' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern37.png'),
					'hbg' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg.png'),
					'hbg2' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg2.png'),
					'hbg3' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg3.png'),
					'hbg4' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg4.png'),
					'hbg5' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg5.png'),
					'hbg6' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg6.png'),
					'hbg7' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg7.png'),
					'hbg8' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg8.png'),
					'hbg9' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg9.png'),
					'hbg10' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg10.png'),
					'hbg11' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg11.png'),
					'hbg12' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg12.png'),
					'hbg13' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg13.png'),
					'hbg14' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg14.png'),
					'hbg15' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg15.png'),
					'hbg16' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg16.png'),
					'hbg17' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg17.png'),
					'hbg18' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg18.png'),
					'hbg19' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg19.png'),
					'hbg20' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg20.png'),
					'hbg21' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg21.png'),
					'hbg22' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg22.png'),
					'hbg23' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg23.png'),
					'hbg24' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg24.png'),
					'hbg25' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg25.png')
				),
				'std' => 'nobg'
			),
			array(
				'id' => 'mts_homepage_clients_background_image',
				'type' => 'upload',
				//'type' => 'text',
				'title' => __( 'Background Image', 'mythemeshop' ),
				'sub_desc' => __( 'Edit the background image for the section', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_clients_background_image_cover',
				'type' => 'button_set',
				'options' => array('0' => 'Off','1' => 'On'),
				'std' => '0',
				'title' => __( 'Cover the section with Background Image', 'mythemeshop' ),
				'sub_desc' => __( 'Scale the background image to be as large as possible so that the background area is completely covered by the background image. Some parts of the background image may not be in view within the background positioning area', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_clients_parallax',
				'type' => 'button_set',
				'options' => array('0' => 'Off','1' => 'On'),
				'std' => '0',
				'title' => __( 'Enable Parallax Background', 'mythemeshop' ),
				'sub_desc' => __( 'Controls whether the background image has parallax scrolling enabled.', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_clients_slide_items',
				'type' => 'button_set',
				'class' => 'green',
				'options' => array('3' => '3','6' => '6'),
				'std' => '3',
				'title' => __( 'Items per slide', 'mythemeshop' ),
			),
			array(
			 	'id' => 'mts_homepage_clients',
			 	'title' => 'Clients',
			 	'sub_desc' => __( 'Manage clients.', 'mythemeshop' ),
			 	'type' => 'group',
			 	'groupname' => __('Client', 'mythemeshop'), // Group name
			 	'subfields' => array(
			 		array(
		                'id' => 'mts_homepage_client_title',
						'title' => __('Name', 'mythemeshop'), 
						'type' => 'text',
					),
		            array(
		                'id' => 'mts_homepage_client_image',
						'title' => __('Logo', 'mythemeshop'),
						//'type' => 'text',
						'type' => 'upload',
					),	
		            array(
		                'id' => 'mts_homepage_client_url',
						'title' => __('Client url', 'mythemeshop'), 
						'type' => 'text',
					),
		        ),
		    ),
		)
	);
	/* ==========================================================================
	   Twitter
	   ========================================================================== */
	$sections[] = array(
		'icon' => 'fa-home',
		'title' => __('Twitter', 'mythemeshop'),
		'desc' => __('<p class="description">From here, you can control Latest Tweets section on Homepage. (Same settings will be used if you have enabled Tweets section on Single Posts.)', 'mythemeshop'),
		'fields' => array(
			array(
				'id' => 'homepage_twitter_username',
				'type' => 'text',
				'title' => __( 'Twitter Username', 'mythemeshop' )
			),
			array(
				'id' => 'homepage_twitter_tweet_count',
				'type' => 'text',
				'title' => __( 'Tweet Count', 'mythemeshop' ),
				'sub_desc' => __( 'How many tweets should be displayed.', 'mythemeshop'),
				'args' => array('type' => 'number'),
				'std' => '3',
				'class' => 'small-text'
			),
			array(
                'id' => 'mts_homepage_twitter_color_scheme',
                'type' => 'button_set',
                'title' => __('Section text colors', 'mythemeshop'), 
				'options' => array('dark' => 'Dark','light' => 'Light'),
				'std' => 'light',
                'class' => 'green'
            ),
			array(
				'id' => 'mts_homepage_twitter_background_color',
				'type' => 'color',
				'title' => __( 'Background Color', 'mythemeshop' ),
				'sub_desc' => __( 'Edit the background color for the section', 'mythemeshop' ),
                'std' => '#ffffff'
			),
            array(
				'id' => 'mts_homepage_twitter_background_pattern',
				'type' => 'radio_img',
				'title' => __('Background Pattern', 'mythemeshop'), 
				'sub_desc' => __('Choose one from the <strong>63</strong> awesome background patterns.', 'mythemeshop'),
				'options' => array(
					'nobg' => array('img' => NHP_OPTIONS_URL.'img/patterns/nobg.png'),
					'pattern0' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern0.png'),
					'pattern1' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern1.png'),
					'pattern2' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern2.png'),
					'pattern3' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern3.png'),
					'pattern4' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern4.png'),
					'pattern5' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern5.png'),
					'pattern6' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern6.png'),
					'pattern7' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern7.png'),
					'pattern8' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern8.png'),
					'pattern9' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern9.png'),
					'pattern10' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern10.png'),
					'pattern11' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern11.png'),
					'pattern12' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern12.png'),
					'pattern13' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern13.png'),
					'pattern14' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern14.png'),
					'pattern15' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern15.png'),
					'pattern16' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern16.png'),
					'pattern17' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern17.png'),
					'pattern18' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern18.png'),
					'pattern19' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern19.png'),
					'pattern20' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern20.png'),
					'pattern21' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern21.png'),
					'pattern22' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern22.png'),
					'pattern23' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern23.png'),
					'pattern24' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern24.png'),
					'pattern25' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern25.png'),
					'pattern26' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern26.png'),
					'pattern27' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern27.png'),
					'pattern28' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern28.png'),
					'pattern29' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern29.png'),
					'pattern30' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern30.png'),
					'pattern31' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern31.png'),
					'pattern32' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern32.png'),
					'pattern33' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern33.png'),
					'pattern34' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern34.png'),
					'pattern35' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern35.png'),
					'pattern36' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern36.png'),
					'pattern37' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern37.png'),
					'hbg' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg.png'),
					'hbg2' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg2.png'),
					'hbg3' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg3.png'),
					'hbg4' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg4.png'),
					'hbg5' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg5.png'),
					'hbg6' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg6.png'),
					'hbg7' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg7.png'),
					'hbg8' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg8.png'),
					'hbg9' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg9.png'),
					'hbg10' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg10.png'),
					'hbg11' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg11.png'),
					'hbg12' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg12.png'),
					'hbg13' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg13.png'),
					'hbg14' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg14.png'),
					'hbg15' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg15.png'),
					'hbg16' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg16.png'),
					'hbg17' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg17.png'),
					'hbg18' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg18.png'),
					'hbg19' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg19.png'),
					'hbg20' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg20.png'),
					'hbg21' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg21.png'),
					'hbg22' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg22.png'),
					'hbg23' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg23.png'),
					'hbg24' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg24.png'),
					'hbg25' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg25.png')
				),
				'std' => 'nobg'
			),
			array(
				'id' => 'mts_homepage_twitter_background_image',
				'type' => 'upload',
				//'type' => 'text',
				'title' => __( 'Background Image', 'mythemeshop' ),
				'sub_desc' => __( 'Edit the background image for the section', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_twitter_background_image_cover',
				'type' => 'button_set',
				'options' => array('0' => 'Off','1' => 'On'),
				'std' => '0',
				'title' => __( 'Cover the section with Background Image', 'mythemeshop' ),
				'sub_desc' => __( 'Scale the background image to be as large as possible so that the background area is completely covered by the background image. Some parts of the background image may not be in view within the background positioning area', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_twitter_parallax',
				'type' => 'button_set',
				'options' => array('0' => 'Off','1' => 'On'),
				'std' => '0',
				'title' => __( 'Enable Parallax Background', 'mythemeshop' ),
				'sub_desc' => __( 'Controls whether the background image has parallax scrolling enabled.', 'mythemeshop' ),
			),
			array(
				'id' => 'homepage_twitter_slider',
				'type' => 'button_set',
				'options' => array('0' => 'Off','1' => 'On'),
				'std' => '0',
				'title' => __( 'Auto rotation', 'mythemeshop' ),
				'sub_desc' => __( 'Checking this option will enable auto rotation of multiple tweets', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_twotter_info',
				'type' => 'info',
				'desc' => __('<p><strong>Note:</strong> Visit <a href="https://dev.twitter.com/apps/" target="_blank">this link</a> in a new tab, sign in with your account, click on Create a new application and create your own keys in case you don\'t have already</p>', 'mythemeshop')
			),
			array(
				'id' => 'homepage_twitter_api_key',
				'type' => 'text',
				'title' => __( 'API key', 'mythemeshop' ),
				'sub_desc' => __( 'This can be found in your Twitter Developer Application Management page.', 'mythemeshop')
			),
			array(
				'id' => 'homepage_twitter_api_secret',
				'type' => 'text',
				'title' => __( 'API secret', 'mythemeshop' ),
				'sub_desc' => __( 'This can be found in your Twitter Developer Application Management page.', 'mythemeshop')
			),
			array(
				'id' => 'homepage_twitter_access_token',
				'type' => 'text',
				'title' => __( 'Access token', 'mythemeshop' ),
				'sub_desc' => __( 'This can be found in your Twitter Developer Application Management page.', 'mythemeshop')
			),
			array(
				'id' => 'homepage_twitter_access_token_secret',
				'type' => 'text',
				'title' => __( 'Access token secret', 'mythemeshop' ),
				'sub_desc' => __( 'This can be found in your Twitter Developer Application Management page.', 'mythemeshop')
			),
		)
	);
	/* ==========================================================================
		Team
	   ========================================================================== */
	$sections[] = array(
		'icon' => 'fa-home',
		'title' => __('Team', 'mythemeshop'),
		'desc' => __('<p class="description">Manage your team members and their contact information.</p>', 'mythemeshop'),
		'fields' => array(
			array(
				'id' => 'mts_homepage_team_title',
				'type' => 'text',
				'title' => __( 'Title', 'mythemeshop' ),
				'sub_desc' => __( 'Section Title', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_team_description',
				'type' => 'textarea',
				'title' => __( 'Description', 'mythemeshop' ),
				'sub_desc' => __( 'Section description', 'mythemeshop' ),
			),
			array(
                'id' => 'mts_homepage_team_color_scheme',
                'type' => 'button_set',
                'title' => __('Section text colors', 'mythemeshop'), 
				'options' => array('dark' => 'Dark','light' => 'Light'),
				'std' => 'dark',
                'class' => 'green'
            ),
			array(
				'id' => 'mts_homepage_team_background_color',
				'type' => 'color',
				'title' => __( 'Background Color', 'mythemeshop' ),
				'sub_desc' => __( 'Edit the background color for the section', 'mythemeshop' ),
                'std' => '#ffffff'
			),
            array(
				'id' => 'mts_homepage_team_background_pattern',
				'type' => 'radio_img',
				'title' => __('Background Pattern', 'mythemeshop'), 
				'sub_desc' => __('Choose one from the <strong>63</strong> awesome background patterns.', 'mythemeshop'),
				'options' => array(
					'nobg' => array('img' => NHP_OPTIONS_URL.'img/patterns/nobg.png'),
					'pattern0' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern0.png'),
					'pattern1' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern1.png'),
					'pattern2' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern2.png'),
					'pattern3' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern3.png'),
					'pattern4' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern4.png'),
					'pattern5' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern5.png'),
					'pattern6' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern6.png'),
					'pattern7' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern7.png'),
					'pattern8' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern8.png'),
					'pattern9' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern9.png'),
					'pattern10' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern10.png'),
					'pattern11' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern11.png'),
					'pattern12' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern12.png'),
					'pattern13' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern13.png'),
					'pattern14' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern14.png'),
					'pattern15' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern15.png'),
					'pattern16' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern16.png'),
					'pattern17' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern17.png'),
					'pattern18' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern18.png'),
					'pattern19' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern19.png'),
					'pattern20' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern20.png'),
					'pattern21' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern21.png'),
					'pattern22' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern22.png'),
					'pattern23' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern23.png'),
					'pattern24' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern24.png'),
					'pattern25' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern25.png'),
					'pattern26' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern26.png'),
					'pattern27' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern27.png'),
					'pattern28' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern28.png'),
					'pattern29' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern29.png'),
					'pattern30' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern30.png'),
					'pattern31' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern31.png'),
					'pattern32' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern32.png'),
					'pattern33' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern33.png'),
					'pattern34' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern34.png'),
					'pattern35' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern35.png'),
					'pattern36' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern36.png'),
					'pattern37' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern37.png'),
					'hbg' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg.png'),
					'hbg2' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg2.png'),
					'hbg3' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg3.png'),
					'hbg4' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg4.png'),
					'hbg5' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg5.png'),
					'hbg6' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg6.png'),
					'hbg7' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg7.png'),
					'hbg8' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg8.png'),
					'hbg9' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg9.png'),
					'hbg10' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg10.png'),
					'hbg11' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg11.png'),
					'hbg12' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg12.png'),
					'hbg13' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg13.png'),
					'hbg14' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg14.png'),
					'hbg15' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg15.png'),
					'hbg16' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg16.png'),
					'hbg17' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg17.png'),
					'hbg18' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg18.png'),
					'hbg19' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg19.png'),
					'hbg20' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg20.png'),
					'hbg21' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg21.png'),
					'hbg22' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg22.png'),
					'hbg23' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg23.png'),
					'hbg24' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg24.png'),
					'hbg25' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg25.png')
				),
				'std' => 'nobg'
			),
			array(
				'id' => 'mts_homepage_team_background_image',
				'type' => 'upload',
				//'type' => 'text',
				'title' => __( 'Background Image', 'mythemeshop' ),
				'sub_desc' => __( 'Edit the background image for the section', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_team_background_image_cover',
				'type' => 'button_set',
				'options' => array('0' => 'Off','1' => 'On'),
				'std' => '0',
				'title' => __( 'Cover the section with Background Image', 'mythemeshop' ),
				'sub_desc' => __( 'Scale the background image to be as large as possible so that the background area is completely covered by the background image. Some parts of the background image may not be in view within the background positioning area', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_team_parallax',
				'type' => 'button_set',
				'options' => array('0' => 'Off','1' => 'On'),
				'std' => '0',
				'title' => __( 'Enable Parallax Background', 'mythemeshop' ),
				'sub_desc' => __( 'Controls whether the background image has parallax scrolling enabled.', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_team',
				'title' => 'Team',
				'sub_desc' => __( 'Add employees or team members for display on the homepage.', 'mythemeshop' ),
				'type' => 'group',
				'groupname' => __('Team Member', 'mythemeshop'), // Group name
				'subfields' => array(
					array(
						'id' => 'mts_homepage_team_name',
						'type' => 'text',
						'title' => __('Name', 'mythemeshop'), 
					),
					array(
						'id' => 'mts_homepage_team_image',
						'type' => 'upload',
						//'type' => 'text',
						'title' => __('Photo', 'mythemeshop'),
					),
					array(
						'id' => 'mts_homepage_team_info',
						'type' => 'textarea',
						'title' => __('Info', 'mythemeshop'), 
					),
					array(
						'id' => 'mts_homepage_team_facebook',
						'type' => 'text',
						'title' => __('Facebook', 'mythemeshop'), 
					),
					array(
						'id' => 'mts_homepage_team_twitter',
						'type' => 'text',
						'title' => __('Twitter', 'mythemeshop'), 
					),
					array(
						'id' => 'mts_homepage_team_google',
						'type' => 'text',
						'title' => __('Google Plus', 'mythemeshop'), 
					),
					array(
						'id' => 'mts_homepage_team_instagram',
						'type' => 'text',
						'title' => __('Instagram', 'mythemeshop'), 
					),
		        ),
		    ),
		)
	);
	/* ==========================================================================
	   Testimonials
	   ========================================================================== */
	$sections[] = array(
		'icon' => 'fa-home',
		'title' => __('Testimonials', 'mythemeshop'),
		'desc' => __('<p class="description">Manage the content displayed on the Testimonials section.</p>', 'mythemeshop'),
		'fields' => array(
			array(
                'id' => 'mts_homepage_quotes_color_scheme',
                'type' => 'button_set',
                'title' => __('Section text colors', 'mythemeshop'), 
				'options' => array('dark' => 'Dark','light' => 'Light'),
				'std' => 'light',
                'class' => 'green'
            ),
			array(
				'id' => 'mts_homepage_quotes_background_color',
				'type' => 'color',
				'title' => __( 'Background Color', 'mythemeshop' ),
				'sub_desc' => __( 'Edit the background color for the section', 'mythemeshop' ),
                'std' => '#ffffff'
			),
            array(
				'id' => 'mts_homepage_quotes_background_pattern',
				'type' => 'radio_img',
				'title' => __('Background Pattern', 'mythemeshop'), 
				'sub_desc' => __('Choose one from the <strong>63</strong> awesome background patterns.', 'mythemeshop'),
				'options' => array(
					'nobg' => array('img' => NHP_OPTIONS_URL.'img/patterns/nobg.png'),
					'pattern0' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern0.png'),
					'pattern1' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern1.png'),
					'pattern2' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern2.png'),
					'pattern3' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern3.png'),
					'pattern4' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern4.png'),
					'pattern5' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern5.png'),
					'pattern6' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern6.png'),
					'pattern7' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern7.png'),
					'pattern8' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern8.png'),
					'pattern9' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern9.png'),
					'pattern10' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern10.png'),
					'pattern11' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern11.png'),
					'pattern12' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern12.png'),
					'pattern13' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern13.png'),
					'pattern14' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern14.png'),
					'pattern15' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern15.png'),
					'pattern16' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern16.png'),
					'pattern17' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern17.png'),
					'pattern18' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern18.png'),
					'pattern19' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern19.png'),
					'pattern20' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern20.png'),
					'pattern21' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern21.png'),
					'pattern22' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern22.png'),
					'pattern23' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern23.png'),
					'pattern24' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern24.png'),
					'pattern25' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern25.png'),
					'pattern26' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern26.png'),
					'pattern27' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern27.png'),
					'pattern28' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern28.png'),
					'pattern29' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern29.png'),
					'pattern30' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern30.png'),
					'pattern31' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern31.png'),
					'pattern32' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern32.png'),
					'pattern33' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern33.png'),
					'pattern34' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern34.png'),
					'pattern35' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern35.png'),
					'pattern36' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern36.png'),
					'pattern37' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern37.png'),
					'hbg' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg.png'),
					'hbg2' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg2.png'),
					'hbg3' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg3.png'),
					'hbg4' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg4.png'),
					'hbg5' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg5.png'),
					'hbg6' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg6.png'),
					'hbg7' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg7.png'),
					'hbg8' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg8.png'),
					'hbg9' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg9.png'),
					'hbg10' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg10.png'),
					'hbg11' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg11.png'),
					'hbg12' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg12.png'),
					'hbg13' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg13.png'),
					'hbg14' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg14.png'),
					'hbg15' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg15.png'),
					'hbg16' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg16.png'),
					'hbg17' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg17.png'),
					'hbg18' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg18.png'),
					'hbg19' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg19.png'),
					'hbg20' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg20.png'),
					'hbg21' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg21.png'),
					'hbg22' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg22.png'),
					'hbg23' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg23.png'),
					'hbg24' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg24.png'),
					'hbg25' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg25.png')
				),
				'std' => 'nobg'
			),
			array(
				'id' => 'mts_homepage_quotes_background_image',
				'type' => 'upload',
				//'type' => 'text',
				'title' => __( 'Background Image', 'mythemeshop' ),
				'sub_desc' => __( 'Edit the background image for the section', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_quotes_background_image_cover',
				'type' => 'button_set',
				'options' => array('0' => 'Off','1' => 'On'),
				'std' => '0',
				'title' => __( 'Cover the section with Background Image', 'mythemeshop' ),
				'sub_desc' => __( 'Scale the background image to be as large as possible so that the background area is completely covered by the background image. Some parts of the background image may not be in view within the background positioning area', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_quotes_parallax',
				'type' => 'button_set',
				'options' => array('0' => 'Off','1' => 'On'),
				'std' => '0',
				'title' => __( 'Enable Parallax Background', 'mythemeshop' ),
				'sub_desc' => __( 'Controls whether the background image has parallax scrolling enabled.', 'mythemeshop' ),
			),
			array(
			 	'id' => 'mts_homepage_quotes',
			 	'title' => 'Testimonials',
			 	'sub_desc' => __( 'Manage Testimonials.', 'mythemeshop' ),
			 	'type' => 'group',
			 	'groupname' => __('Testimonial', 'mythemeshop'), // Group name
			 	'subfields' => array(
			 		array(
		            	'id' => 'mts_homepage_quote_title',
						'type' => 'text',
						'title' => __('Testimonial title', 'mythemeshop')
					),
		            array(
		                'id' => 'mts_homepage_quote_text',
						'type' => 'textarea',
						'title' => __('Testimonial text', 'mythemeshop'), 
					),
		            array(
						'id' => 'mts_homepage_quote_image',
						'type' => 'upload',//'type' => 'text',
						'title' => __('Image', 'mythemeshop'), 
						'sub_desc' => __('Upload or select an image for this slide.', 'mythemeshop'),
					),
		        ),
		    ),
		)
	);
	/* ==========================================================================
	   Projects
	   ========================================================================== */
	$sections[] = array(
		'icon' => 'fa-home',
		'title' => __('Projects', 'mythemeshop'),
		'desc' => __('<p class="description">Manage the content displayed on the Projects section. You can manage portfolio items in the <a target="_blank" href="'.admin_url("edit.php?post_type=portfolio").'">Projects</a> section of your WordPress dashboard.</p>', 'mythemeshop'),
		'fields' => array(
			array(
				'id' => 'mts_homepage_projects_title',
				'type' => 'text',
				'title' => __( 'Title', 'mythemeshop' ),
				'sub_desc' => __( 'Section Title', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_projects_description',
				'type' => 'textarea',
				'title' => __( 'Description', 'mythemeshop' ),
				'sub_desc' => __( 'Section description', 'mythemeshop' ),
			),
			array(
                'id' => 'mts_homepage_projects_color_scheme',
                'type' => 'button_set',
                'title' => __('Section text colors', 'mythemeshop'), 
				'options' => array('dark' => 'Dark','light' => 'Light'),
				'std' => 'dark',
                'class' => 'green'
            ),
			array(
				'id' => 'mts_homepage_projects_background_color',
				'type' => 'color',
				'title' => __( 'Background Color', 'mythemeshop' ),
				'sub_desc' => __( 'Edit the background color for the section', 'mythemeshop' ),
                'std' => '#ffffff'
			),
            array(
				'id' => 'mts_homepage_projects_background_pattern',
				'type' => 'radio_img',
				'title' => __('Background Pattern', 'mythemeshop'), 
				'sub_desc' => __('Choose one from the <strong>63</strong> awesome background patterns.', 'mythemeshop'),
				'options' => array(
					'nobg' => array('img' => NHP_OPTIONS_URL.'img/patterns/nobg.png'),
					'pattern0' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern0.png'),
					'pattern1' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern1.png'),
					'pattern2' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern2.png'),
					'pattern3' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern3.png'),
					'pattern4' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern4.png'),
					'pattern5' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern5.png'),
					'pattern6' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern6.png'),
					'pattern7' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern7.png'),
					'pattern8' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern8.png'),
					'pattern9' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern9.png'),
					'pattern10' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern10.png'),
					'pattern11' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern11.png'),
					'pattern12' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern12.png'),
					'pattern13' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern13.png'),
					'pattern14' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern14.png'),
					'pattern15' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern15.png'),
					'pattern16' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern16.png'),
					'pattern17' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern17.png'),
					'pattern18' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern18.png'),
					'pattern19' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern19.png'),
					'pattern20' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern20.png'),
					'pattern21' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern21.png'),
					'pattern22' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern22.png'),
					'pattern23' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern23.png'),
					'pattern24' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern24.png'),
					'pattern25' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern25.png'),
					'pattern26' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern26.png'),
					'pattern27' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern27.png'),
					'pattern28' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern28.png'),
					'pattern29' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern29.png'),
					'pattern30' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern30.png'),
					'pattern31' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern31.png'),
					'pattern32' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern32.png'),
					'pattern33' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern33.png'),
					'pattern34' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern34.png'),
					'pattern35' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern35.png'),
					'pattern36' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern36.png'),
					'pattern37' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern37.png'),
					'hbg' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg.png'),
					'hbg2' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg2.png'),
					'hbg3' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg3.png'),
					'hbg4' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg4.png'),
					'hbg5' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg5.png'),
					'hbg6' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg6.png'),
					'hbg7' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg7.png'),
					'hbg8' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg8.png'),
					'hbg9' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg9.png'),
					'hbg10' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg10.png'),
					'hbg11' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg11.png'),
					'hbg12' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg12.png'),
					'hbg13' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg13.png'),
					'hbg14' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg14.png'),
					'hbg15' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg15.png'),
					'hbg16' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg16.png'),
					'hbg17' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg17.png'),
					'hbg18' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg18.png'),
					'hbg19' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg19.png'),
					'hbg20' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg20.png'),
					'hbg21' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg21.png'),
					'hbg22' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg22.png'),
					'hbg23' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg23.png'),
					'hbg24' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg24.png'),
					'hbg25' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg25.png')
				),
				'std' => 'nobg'
			),
			array(
				'id' => 'mts_homepage_projects_background_image',
				'type' => 'upload',//'type' => 'text',
				'title' => __( 'Background Image', 'mythemeshop' ),
				'sub_desc' => __( 'Edit the background image for the section', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_projects_background_image_cover',
				'type' => 'button_set',
				'options' => array('0' => 'Off','1' => 'On'),
				'std' => '0',
				'title' => __( 'Cover the section with Background Image', 'mythemeshop' ),
				'sub_desc' => __( 'Scale the background image to be as large as possible so that the background area is completely covered by the background image. Some parts of the background image may not be in view within the background positioning area', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_projects_parallax',
				'type' => 'button_set',
				'options' => array('0' => 'Off','1' => 'On'),
				'std' => '0',
				'title' => __( 'Enable Parallax Background', 'mythemeshop' ),
				'sub_desc' => __( 'Controls whether the background image has parallax scrolling enabled.', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_projects_layout',
				'type' => 'radio_img',
				'title' => __('Layout', 'mythemeshop'),
				'sub_desc' => __('Choose the layout.', 'mythemeshop'),
				'options' => array(
					'1' => array('img' => NHP_OPTIONS_URL.'img/layouts/pgrid1.png'),
					'2' => array('img' => NHP_OPTIONS_URL.'img/layouts/pgrid2.png'),
					'3' => array('img' => NHP_OPTIONS_URL.'img/layouts/pgrid3.png')
				),
				'std' => '3'
			),
			array(
				'id' => 'mts_projects_count_home',
				'type' => 'text',
				'title' => __('No. of Projects - Homepage', 'mythemeshop'),
				'sub_desc' => __('Enter the total number of projects you want to show on homepage.', 'mythemeshop'),
				'validate' => 'numeric',
				'std' => '6',
				'class' => 'small-text'
			),
			array(
				'id' => 'mts_projects_count',
				'type' => 'text',
				'class' => 'small-text',
				'title' => __( 'No. of Projects - Projects page', 'mythemeshop' ),
				'sub_desc' => __( 'Enter the number of projects you want to show per page on Projects page', 'mythemeshop' ),
				'std' => '6',
				'args' => array('type' => 'number')
			),
		)
	);
	/* ==========================================================================
	   Contact
	   ========================================================================== */
	$sections[] = array(
		'icon' => 'fa-home',
		'title' => __('Contact', 'mythemeshop'),
		'desc' => __('<p class="description">Manage the content displayed on the contact section.</p>', 'mythemeshop'),
		'fields' => array(
			array(
				'id' => 'mts_homepage_contact_title',
				'type' => 'text',
				'title' => __( 'Title', 'mythemeshop' ),
				'sub_desc' => __( 'Section Title', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_contact_description',
				'type' => 'textarea',
				'title' => __( 'Description', 'mythemeshop' ),
				'sub_desc' => __( 'Section description', 'mythemeshop' ),
			),
			array(
                'id' => 'mts_homepage_contact_color_scheme',
                'type' => 'button_set',
                'title' => __('Section text colors', 'mythemeshop'),
				'options' => array('dark' => 'Dark','light' => 'Light'),
				'std' => 'dark',
                'class' => 'green'
            ),
			array(
				'id' => 'mts_homepage_contact_background_color',
				'type' => 'color',
				'title' => __( 'Background Color', 'mythemeshop' ),
				'sub_desc' => __( 'Edit the background color for the section', 'mythemeshop' ),
                'std' => '#ffffff'
			),
            array(
				'id' => 'mts_homepage_contact_background_pattern',
				'type' => 'radio_img',
				'title' => __('Background Pattern', 'mythemeshop'), 
				'sub_desc' => __('Choose one from the <strong>63</strong> awesome background patterns.', 'mythemeshop'),
				'options' => array(
					'nobg' => array('img' => NHP_OPTIONS_URL.'img/patterns/nobg.png'),
					'pattern0' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern0.png'),
					'pattern1' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern1.png'),
					'pattern2' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern2.png'),
					'pattern3' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern3.png'),
					'pattern4' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern4.png'),
					'pattern5' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern5.png'),
					'pattern6' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern6.png'),
					'pattern7' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern7.png'),
					'pattern8' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern8.png'),
					'pattern9' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern9.png'),
					'pattern10' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern10.png'),
					'pattern11' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern11.png'),
					'pattern12' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern12.png'),
					'pattern13' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern13.png'),
					'pattern14' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern14.png'),
					'pattern15' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern15.png'),
					'pattern16' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern16.png'),
					'pattern17' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern17.png'),
					'pattern18' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern18.png'),
					'pattern19' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern19.png'),
					'pattern20' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern20.png'),
					'pattern21' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern21.png'),
					'pattern22' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern22.png'),
					'pattern23' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern23.png'),
					'pattern24' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern24.png'),
					'pattern25' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern25.png'),
					'pattern26' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern26.png'),
					'pattern27' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern27.png'),
					'pattern28' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern28.png'),
					'pattern29' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern29.png'),
					'pattern30' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern30.png'),
					'pattern31' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern31.png'),
					'pattern32' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern32.png'),
					'pattern33' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern33.png'),
					'pattern34' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern34.png'),
					'pattern35' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern35.png'),
					'pattern36' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern36.png'),
					'pattern37' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern37.png'),
					'hbg' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg.png'),
					'hbg2' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg2.png'),
					'hbg3' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg3.png'),
					'hbg4' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg4.png'),
					'hbg5' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg5.png'),
					'hbg6' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg6.png'),
					'hbg7' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg7.png'),
					'hbg8' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg8.png'),
					'hbg9' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg9.png'),
					'hbg10' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg10.png'),
					'hbg11' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg11.png'),
					'hbg12' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg12.png'),
					'hbg13' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg13.png'),
					'hbg14' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg14.png'),
					'hbg15' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg15.png'),
					'hbg16' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg16.png'),
					'hbg17' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg17.png'),
					'hbg18' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg18.png'),
					'hbg19' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg19.png'),
					'hbg20' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg20.png'),
					'hbg21' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg21.png'),
					'hbg22' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg22.png'),
					'hbg23' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg23.png'),
					'hbg24' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg24.png'),
					'hbg25' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg25.png')
				),
				'std' => 'nobg'
			),
			array(
				'id' => 'mts_homepage_contact_background_image',
				'type' => 'upload',//'type' => 'text',
				'title' => __( 'Background Image', 'mythemeshop' ),
				'sub_desc' => __( 'Edit the background image for the section', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_contact_background_image_cover',
				'type' => 'button_set',
				'options' => array('0' => 'Off','1' => 'On'),
				'std' => '0',
				'title' => __( 'Cover the section with Background Image', 'mythemeshop' ),
				'sub_desc' => __( 'Scale the background image to be as large as possible so that the background area is completely covered by the background image. Some parts of the background image may not be in view within the background positioning area', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_contact_parallax',
				'type' => 'button_set',
				'options' => array('0' => 'Off','1' => 'On'),
				'std' => '0',
				'title' => __( 'Enable Parallax Background', 'mythemeshop' ),
				'sub_desc' => __( 'Controls whether the background image has parallax scrolling enabled.', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_contact_social_icons',
				'type' => 'button_set_hide_below',
				'options' => array('0' => 'Off','1' => 'On'),
				'std' => '0',
				'title' => __( 'Social icons', 'mythemeshop' ),
				'sub_desc' => __( 'Enable social icons.', 'mythemeshop' ),
				'args' => array(
					'hide' => 5
				)
			),
			array(
				'id' => 'mts_homepage_contact_facebook',
				'type' => 'text',
				'title' => __( 'Facebook URL', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_contact_twitter',
				'type' => 'text',
				'title' => __( 'Twitter URL', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_contact_googleplus',
				'type' => 'text',
				'title' => __( 'Google+ URL', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_contact_linkedin',
				'type' => 'text',
				'title' => __( 'LinkedIn URL', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_homepage_contact_email',
				'type' => 'text',
				'title' => __( 'Email Address', 'mythemeshop' ),
			),
			array(
				'id' => 'mts_map_coordinates',
				'type' => 'text',
				'title' => __('Map Coordinates', 'mythemeshop'),
				'sub_desc' => __('Enter the longitude and latitude or full address e.g. 47.6203394,-122.3491925', 'mythemeshop')
			),
		)
	);

	$sections[] = array(
				'icon' => 'fa fa-bar-chart-o',
				'title' => __('Blog Layout', 'mythemeshop'),
				'desc' => __('<p class="description">Control blog settings from here.</p>', 'mythemeshop'),
				'fields' => array(
			array(
				'id' => 'mts_layout',
				'type' => 'radio_img',
				'title' => __('Layout Style', 'mythemeshop'), 
				'sub_desc' => __('Choose the <strong>default sidebar position</strong> for your site. The position of the sidebar for individual posts can be set in the post editor.', 'mythemeshop'),
				'options' => array(
					'cslayout' => array('img' => NHP_OPTIONS_URL.'img/layouts/cs.png'),
					'sclayout' => array('img' => NHP_OPTIONS_URL.'img/layouts/sc.png')
				),
				'std' => 'cslayout'
			),
                    array(
                        'id' => 'mts_full_posts',
                        'type' => 'button_set',
                        'title' => __('Posts on blog pages', 'mythemeshop'), 
						'options' => array('0' => 'Excerpts','1' => 'Full posts'),
						'sub_desc' => __('Show post excerpts or full posts on the homepage and other archive pages.', 'mythemeshop'),
						'std' => '0',
                        'class' => 'green'
                        ),
					array(
						'id' => 'mts_bg_color',
						'type' => 'color',
						'title' => __('Background Color', 'mythemeshop'), 
						'sub_desc' => __('Pick a color for the site background color.', 'mythemeshop'),
						'std' => '#ffffff'
						),
					array(
						'id' => 'mts_bg_pattern',
						'type' => 'radio_img',
						'title' => __('Background Pattern', 'mythemeshop'), 
						'sub_desc' => __('Choose from any of <strong>63</strong> awesome background patterns for your site\'s background.', 'mythemeshop'),
						'options' => array(
					'nobg' => array('img' => NHP_OPTIONS_URL.'img/patterns/nobg.png'),
					'pattern0' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern0.png'),
					'pattern1' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern1.png'),
					'pattern2' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern2.png'),
					'pattern3' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern3.png'),
					'pattern4' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern4.png'),
					'pattern5' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern5.png'),
					'pattern6' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern6.png'),
					'pattern7' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern7.png'),
					'pattern8' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern8.png'),
					'pattern9' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern9.png'),
					'pattern10' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern10.png'),
					'pattern11' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern11.png'),
					'pattern12' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern12.png'),
					'pattern13' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern13.png'),
					'pattern14' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern14.png'),
					'pattern15' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern15.png'),
					'pattern16' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern16.png'),
					'pattern17' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern17.png'),
					'pattern18' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern18.png'),
					'pattern19' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern19.png'),
					'pattern20' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern20.png'),
					'pattern21' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern21.png'),
					'pattern22' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern22.png'),
					'pattern23' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern23.png'),
					'pattern24' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern24.png'),
					'pattern25' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern25.png'),
					'pattern26' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern26.png'),
					'pattern27' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern27.png'),
					'pattern28' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern28.png'),
					'pattern29' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern29.png'),
					'pattern30' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern30.png'),
					'pattern31' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern31.png'),
					'pattern32' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern32.png'),
					'pattern33' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern33.png'),
					'pattern34' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern34.png'),
					'pattern35' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern35.png'),
					'pattern36' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern36.png'),
					'pattern37' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern37.png'),
					'hbg' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg.png'),
					'hbg2' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg2.png'),
					'hbg3' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg3.png'),
					'hbg4' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg4.png'),
					'hbg5' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg5.png'),
					'hbg6' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg6.png'),
					'hbg7' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg7.png'),
					'hbg8' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg8.png'),
					'hbg9' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg9.png'),
					'hbg10' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg10.png'),
					'hbg11' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg11.png'),
					'hbg12' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg12.png'),
					'hbg13' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg13.png'),
					'hbg14' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg14.png'),
					'hbg15' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg15.png'),
					'hbg16' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg16.png'),
					'hbg17' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg17.png'),
					'hbg18' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg18.png'),
					'hbg19' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg19.png'),
					'hbg20' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg20.png'),
					'hbg21' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg21.png'),
					'hbg22' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg22.png'),
					'hbg23' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg23.png'),
					'hbg24' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg24.png'),
					'hbg25' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg25.png')
				),
						'std' => 'nobg'
						),
					array(
						'id' => 'mts_bg_pattern_upload',
					'type' => 'upload',//'type' => 'text',
						'title' => __('Custom Background Image', 'mythemeshop'), 
						'sub_desc' => __('Upload your own custom background image or pattern.', 'mythemeshop')
						),
					array(
						'id' => 'mts_home_headline_meta',
						'type' => 'button_set_hide_below',
						'title' => __('Blog Page Post Meta Info.', 'mythemeshop'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('Use this button to Show or Hide Post Meta Info on Blog Page. (<strong>Author name, Date etc.</strong>).', 'mythemeshop'),
						'std' => '1'
						),
					array(
            	'id' => 'mts_home_headline_meta_info',
            	'type' => 'multi_checkbox',
            	'title' => __('Meta Info to Show', 'mythemeshop'),
            	'sub_desc' => __('Choose What Meta Info to Show.', 'mythemeshop'),
            	'options' => array('author' => __('Author Name','mythemeshop'),'date' => __('Date','mythemeshop'),'category' => __('Categories','mythemeshop'),'comment' => __('Comment Count','mythemeshop')),
            	'std' => array('author' => '1', 'date' => '1', 'category' => '1', 'comment' => '1')
            ),
					)
				);

	$sections[] = array(
		'icon' => 'fa fa-file-text',
		'title' => __('Single Posts', 'mythemeshop'),
		'desc' => __('<p class="description">From here, you can control the appearance and functionality of your single posts page.</p>', 'mythemeshop'),
		'fields' => array(
			array(
				'id' => 'mts_single_headline_meta',
				'type' => 'button_set_hide_below',
				'title' => __('Post Meta Info.', 'mythemeshop'), 
				'options' => array('0' => 'Off','1' => 'On'),
				'sub_desc' => __('Use this button to Show or Hide Post Meta Info <strong>Author name and Categories</strong>.', 'mythemeshop'),
				'std' => '1'
			),
			array(
					'id' => 'mts_single_headline_meta_info',
					'type' => 'multi_checkbox',
					'title' => __('Meta Info to Show', 'mythemeshop'),
					'sub_desc' => __('Choose What Meta Info to Show.', 'mythemeshop'),
					'options' => array('author' => __('Author Name','mythemeshop'),'date' => __('Date','mythemeshop'),'category' => __('Categories','mythemeshop'),'comment' => __('Comment Count','mythemeshop')),
					'std' => array('author' => '1', 'date' => '1', 'category' => '1', 'comment' => '1')
				),
			array(
				'id' => 'mts_breadcrumb',
				'type' => 'button_set',
				'title' => __('Breadcrumbs', 'mythemeshop'), 
				'options' => array('0' => 'Off','1' => 'On'),
				'sub_desc' => __('Breadcrumbs are a great way to make your site more user-friendly. You can enable them by checking this box.', 'mythemeshop'),
				'std' => '0'
			),
			array(
				'id' => 'mts_author_comment',
				'type' => 'button_set',
				'title' => __('Highlight Author Comment', 'mythemeshop'), 
				'options' => array('0' => 'Off','1' => 'On'),
				'sub_desc' => __('Use this button to highlight author comments.', 'mythemeshop'),
				'std' => '1'
			),
			array(
				'id' => 'mts_tags',
				'type' => 'button_set',
				'title' => __('Tag Links', 'mythemeshop'), 
				'options' => array('0' => 'Off','1' => 'On'),
				'sub_desc' => __('Use this button if you want to show a tag cloud below the related posts.', 'mythemeshop'),
				'std' => '0'
			),
			array(
				'id' => 'mts_related_posts',
				'type' => 'button_set_hide_below',
				'title' => __('Related Posts', 'mythemeshop') ,
				'options' => array(
					'0' => 'Off',
					'1' => 'On'
				),
				'sub_desc' => __('Use this button to show related posts with thumbnails below the content area in a post.', 'mythemeshop') ,
				'std' => '1',
				'args' => array(
					'hide' => 2
				)
			),
			array(
				'id' => 'mts_related_posts_taxonomy',
				'type' => 'button_set',
				'title' => __('Related Posts Taxonomy', 'mythemeshop') ,
				'options' => array(
					'tags' => 'Tags',
					'categories' => 'Categories'
				),
				'class' => 'green',
				'sub_desc' => __('Related Posts based on tags or categories.', 'mythemeshop') ,
				'std' => 'categories'
			),
			array(
				'id' => 'mts_related_postsnum',
				'type' => 'text',
				'class' => 'small-text',
				'title' => __('Number of related posts', 'mythemeshop') ,
				'sub_desc' => __('Enter the number of posts to show in the related posts section.', 'mythemeshop') ,
				'std' => '4',
				'args' => array(
					'type' => 'number'
				)
			),
			array(
				'id' => 'mts_author_box',
				'type' => 'button_set',
				'title' => __('Author Box', 'mythemeshop'), 
				'options' => array('0' => 'Off','1' => 'On'),
				'sub_desc' => __('Use this button if you want to display author information below the article.', 'mythemeshop'),
				'std' => '1'
			),
			array(
				'id' => 'mts_comment_date',
				'type' => 'button_set',
				'title' => __('Date in Comments', 'mythemeshop'), 
				'options' => array('0' => 'Off','1' => 'On'),
				'sub_desc' => __('Use this button to show the date for comments.', 'mythemeshop'),
				'std' => '1'
			),
		)
	);

	$sections[] = array(
		'icon' => 'fa fa-group',
		'title' => __('Social Buttons', 'mythemeshop'),
		'desc' => __('<p class="description">Enable or disable social sharing buttons on single posts using these buttons.</p>', 'mythemeshop'),
		'fields' => array(
			array(
				'id' => 'mts_social_buttons',
				'type' => 'button_set_hide_below',
				'title' => __('Social Media Buttons', 'mythemeshop'), 
				'options' => array('0' => 'Off','1' => 'On'),
				'sub_desc' => __('Check this box to show social sharing buttons after an article\'s content text.', 'mythemeshop'),
				'std' => '1',
                'args' => array('hide' => 7)
			),
			array(
				'id' => 'mts_social_button_position',
				'type' => 'button_set',
				'title' => __('Social Sharing Buttons Position', 'mythemeshop'), 
				'options' => array('top' => __('Above Content','mythemeshop'), 'bottom' => __('Below Content','mythemeshop'), 'floating' => __('Floating','mythemeshop')),
				'sub_desc' => __('Choose position for Social Sharing Buttons.', 'mythemeshop'),
				'std' => 'floating',
				'class' => 'green'
			),
			array(
				'id' => 'mts_twitter',
				'type' => 'button_set',
				'title' => __('Twitter', 'mythemeshop'), 
				'options' => array('0' => 'Off','1' => 'On'),
				'std' => '1'
			),
			array(
				'id' => 'mts_gplus',
				'type' => 'button_set',
				'title' => __('Google Plus', 'mythemeshop'), 
				'options' => array('0' => 'Off','1' => 'On'),
				'std' => '1'
			),
			array(
				'id' => 'mts_facebook',
				'type' => 'button_set',
				'title' => __('Facebook Like', 'mythemeshop'), 
				'options' => array('0' => 'Off','1' => 'On'),
				'std' => '1'
			),
			array(
				'id' => 'mts_linkedin',
				'type' => 'button_set',
				'title' => __('LinkedIn', 'mythemeshop'), 
				'options' => array('0' => 'Off','1' => 'On'),
				'std' => '0'
			),
			array(
				'id' => 'mts_stumble',
				'type' => 'button_set',
				'title' => __('StumbleUpon', 'mythemeshop'), 
				'options' => array('0' => 'Off','1' => 'On'),
				'std' => '0'
			),
			array(
				'id' => 'mts_pinterest',
				'type' => 'button_set',
				'title' => __('Pinterest', 'mythemeshop'), 
				'options' => array('0' => 'Off','1' => 'On'),
				'std' => '1'
			),
		)
	);

	$sections[] = array(
		'icon' => 'fa fa-bar-chart-o',
		'title' => __('Ad Management', 'mythemeshop'),
		'desc' => __('<p class="description">Now, ad management is easy with our options panel. You can control everything from here, without using separate plugins.</p>', 'mythemeshop'),
		'fields' => array(
			array(
				'id' => 'mts_posttop_adcode',
				'type' => 'textarea',
				'title' => __('Below Post Title', 'mythemeshop'), 
				'sub_desc' => __('Paste your Adsense, BSA or other ad code here to show ads below your article title on single posts.', 'mythemeshop')
			),
			array(
				'id' => 'mts_posttop_adcode_time',
				'type' => 'text',
				'title' => __('Show After X Days', 'mythemeshop'), 
				'sub_desc' => __('Enter the number of days after which you want to show the Below Post Title Ad. Enter 0 to disable this feature.', 'mythemeshop'),
				'validate' => 'numeric',
				'std' => '0',
				'class' => 'small-text',
				'args' => array('type' => 'number')
			),
			array(
				'id' => 'mts_postend_adcode',
				'type' => 'textarea',
				'title' => __('Below Post Content', 'mythemeshop'), 
				'sub_desc' => __('Paste your Adsense, BSA or other ad code here to show ads below the post content on single posts.', 'mythemeshop')
			),
			array(
				'id' => 'mts_postend_adcode_time',
				'type' => 'text',
				'title' => __('Show After X Days', 'mythemeshop'), 
				'sub_desc' => __('Enter the number of days after which you want to show the Below Post Title Ad. Enter 0 to disable this feature.', 'mythemeshop'),
				'validate' => 'numeric',
				'std' => '0',
				'class' => 'small-text',
				'args' => array('type' => 'number')
			),
		)
	);

	$sections[] = array(
		'icon' => 'fa fa-columns',
		'title' => __('Sidebars', 'mythemeshop'),
		'desc' => __('<p class="description">Now you have full control over the sidebars. Here you can manage sidebars and select one for each section of your site, or select a custom sidebar on a per-post basis in the post editor.<br></p>', 'mythemeshop'),
        'fields' => array(
            array(
                'id'        => 'mts_custom_sidebars',
                'type'      => 'group', //doesn't need to be called for callback fields
                'title'     => __('Custom Sidebars', 'mythemeshop'), 
                'sub_desc'  => __('Add custom sidebars. <strong style="font-weight: 800;">You need to save the changes to use the sidebars in the dropdowns below.</strong><br />You can add content to the sidebars in Appearance &gt; Widgets.', 'mythemeshop'),
                'groupname' => __('Sidebar', 'mythemeshop'), // Group name
                'subfields' => 
                    array(
                        array(
                            'id' => 'mts_custom_sidebar_name',
    						'type' => 'text',
    						'title' => __('Name', 'mythemeshop'), 
    						'sub_desc' => __('Example: Homepage Sidebar', 'mythemeshop')
    					),	
                        array(
                            'id' => 'mts_custom_sidebar_id',
    						'type' => 'text',
    						'title' => __('ID', 'mythemeshop'), 
    						'sub_desc' => __('Enter a unique ID for the sidebar. Use only alphanumeric characters, underscores (_) and dashes (-), eg. "sidebar-home"', 'mythemeshop'),
    						'std' => 'sidebar-'
    					),
                    ),
            ),
            array(
				'id' => 'mts_sidebar_for_home',
				'type' => 'sidebars_select',
				'title' => __('Homepage', 'mythemeshop'), 
				'sub_desc' => __('Select a sidebar for the homepage.', 'mythemeshop'),
                'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-top', 'footer-top-2', 'footer-top-3', 'footer-top-4', 'footer-bottom', 'footer-bottom-2', 'footer-bottom-3', 'footer-bottom-4', 'widget-header')),
                'std' => ''
			),
            array(
				'id' => 'mts_sidebar_for_post',
				'type' => 'sidebars_select',
				'title' => __('Single Post', 'mythemeshop'), 
				'sub_desc' => __('Select a sidebar for the single posts. If a post has a custom sidebar set, it will override this.', 'mythemeshop'),
                'args' => array('exclude' => array('sidebar', 'footer-top', 'footer-top-2', 'footer-top-3', 'footer-top-4', 'footer-bottom', 'footer-bottom-2', 'footer-bottom-3', 'footer-bottom-4', 'widget-header')),
                'std' => ''
			),
            array(
				'id' => 'mts_sidebar_for_page',
				'type' => 'sidebars_select',
				'title' => __('Single Page', 'mythemeshop'), 
				'sub_desc' => __('Select a sidebar for the single pages. If a page has a custom sidebar set, it will override this.', 'mythemeshop'),
                'args' => array('exclude' => array('sidebar', 'footer-top', 'footer-top-2', 'footer-top-3', 'footer-top-4', 'footer-bottom', 'footer-bottom-2', 'footer-bottom-3', 'footer-bottom-4', 'widget-header')),
                'std' => ''
			),
            array(
				'id' => 'mts_sidebar_for_archive',
				'type' => 'sidebars_select',
				'title' => __('Archive', 'mythemeshop'), 
				'sub_desc' => __('Select a sidebar for the archives. Specific archive sidebars will override this setting (see below).', 'mythemeshop'),
                'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-top', 'footer-top-2', 'footer-top-3', 'footer-top-4', 'footer-bottom', 'footer-bottom-2', 'footer-bottom-3', 'footer-bottom-4', 'widget-header')),
                'std' => ''
			),
            array(
				'id' => 'mts_sidebar_for_category',
				'type' => 'sidebars_select',
				'title' => __('Category Archive', 'mythemeshop'), 
				'sub_desc' => __('Select a sidebar for the category archives.', 'mythemeshop'),
                'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-top', 'footer-top-2', 'footer-top-3', 'footer-top-4', 'footer-bottom', 'footer-bottom-2', 'footer-bottom-3', 'footer-bottom-4', 'widget-header')),
                'std' => ''
			),
            array(
				'id' => 'mts_sidebar_for_tag',
				'type' => 'sidebars_select',
				'title' => __('Tag Archive', 'mythemeshop'), 
				'sub_desc' => __('Select a sidebar for the tag archives.', 'mythemeshop'),
                'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-top', 'footer-top-2', 'footer-top-3', 'footer-top-4', 'footer-bottom', 'footer-bottom-2', 'footer-bottom-3', 'footer-bottom-4', 'widget-header')),
                'std' => ''
			),
            array(
				'id' => 'mts_sidebar_for_date',
				'type' => 'sidebars_select',
				'title' => __('Date Archive', 'mythemeshop'), 
				'sub_desc' => __('Select a sidebar for the date archives.', 'mythemeshop'),
                'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-top', 'footer-top-2', 'footer-top-3', 'footer-top-4', 'footer-bottom', 'footer-bottom-2', 'footer-bottom-3', 'footer-bottom-4', 'widget-header')),
                'std' => ''
			),
            array(
				'id' => 'mts_sidebar_for_author',
				'type' => 'sidebars_select',
				'title' => __('Author Archive', 'mythemeshop'), 
				'sub_desc' => __('Select a sidebar for the author archives.', 'mythemeshop'),
                'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-top', 'footer-top-2', 'footer-top-3', 'footer-top-4', 'footer-bottom', 'footer-bottom-2', 'footer-bottom-3', 'footer-bottom-4', 'widget-header')),
                'std' => ''
			),
            array(
				'id' => 'mts_sidebar_for_search',
				'type' => 'sidebars_select',
				'title' => __('Search', 'mythemeshop'), 
				'sub_desc' => __('Select a sidebar for the search results.', 'mythemeshop'),
                'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-top', 'footer-top-2', 'footer-top-3', 'footer-top-4', 'footer-bottom', 'footer-bottom-2', 'footer-bottom-3', 'footer-bottom-4', 'widget-header')),
                'std' => ''
			),
            array(
				'id' => 'mts_sidebar_for_notfound',
				'type' => 'sidebars_select',
				'title' => __('404 Error', 'mythemeshop'), 
				'sub_desc' => __('Select a sidebar for the 404 Not found pages.', 'mythemeshop'),
                'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-top', 'footer-top-2', 'footer-top-3', 'footer-top-4', 'footer-bottom', 'footer-bottom-2', 'footer-bottom-3', 'footer-bottom-4', 'widget-header')),
                'std' => ''
			),
		),
	);

	$sections[] = array(
		'icon' => 'fa fa-list-alt',
		'title' => __('Navigation', 'mythemeshop'),
		'desc' => __('<p class="description"><div class="controls">Navigation settings can now be modified from the <a href="nav-menus.php"><b>Menus Section</b></a>.<br></div></p>', 'mythemeshop')
	);
				
				
	$tabs = array();

	$args['presets'] = array();
	include('theme-presets.php');

	global $NHP_Options;
	$NHP_Options = new NHP_Options($sections, $args, $tabs);

}//function
add_action('init', 'setup_framework_options', 0);

/*
 * 
 * Custom function for the callback referenced above
 *
 */
function my_custom_field($field, $value){
	print_r($field);
	print_r($value);

}//function

/*
 * 
 * Custom function for the callback validation referenced above
 *
 */
function validate_callback_function($field, $value, $existing_value){
	
	$error = false;
	$value =  'just testing';
	/*
	do your validation
	
	if(something){
		$value = $value;
	}elseif(somthing else){
		$error = true;
		$value = $existing_value;
		$field['msg'] = 'your custom error message';
	}
	*/
	$return['value'] = $value;
	if($error == true){
		$return['error'] = $field;
	}
	return $return;
	
}//function

/*--------------------------------------------------------------------
 * 
 * Default Font Settings
 *
 --------------------------------------------------------------------*/
if(function_exists('register_typography')) { 
	register_typography(array(
		'navigation_font' => array(
			'preview_text' => 'Navigation Font',
			'preview_color' => 'light',
			'font_family' => 'Montserrat',
			'font_variant' => '700',
			'font_size' => '13px',
			'font_color' => '#a5a5a5',
			'css_selectors' => '#navigation ul.menu li'
		),
		'content_font' => array(
			'preview_text' => 'Content Font',
			'preview_color' => 'light',
			'font_family' => 'Ubuntu',
			'font_size' => '15px',
			'font_variant' => 'normal',
			'font_color' => '#888888',
			'css_selectors' => 'body'
		),
		'sidebar_font' => array(
			'preview_text' => 'Sidebar Font',
			'preview_color' => 'light',
			'font_family' => 'Ubuntu',
			'font_variant' => 'normal',
			'font_size' => '15px',
			'font_color' => '#888888',
			'css_selectors' => '#sidebars .widget'
		),
		'h1_headline' => array(
			'preview_text' => 'Content H1',
			'preview_color' => 'light',
			'font_family' => 'Montserrat',
			'font_variant' => '700',
			'font_size' => '28px',
			'font_color' => '#252525',
			'css_selectors' => 'h1'
		),
		'h2_headline' => array(
			'preview_text' => 'Content H2',
			'preview_color' => 'light',
			'font_family' => 'Montserrat',
			'font_variant' => '700',
			'font_size' => '24px',
			'font_color' => '#252525',
			'css_selectors' => 'h2'
		),
		'h3_headline' => array(
			'preview_text' => 'Content H3',
			'preview_color' => 'light',
			'font_family' => 'Montserrat',
			'font_variant' => '700',
			'font_size' => '22px',
			'font_color' => '#252525',
			'css_selectors' => 'h3'
		),
		'h4_headline' => array(
			'preview_text' => 'Content H4',
			'preview_color' => 'light',
			'font_family' => 'Montserrat',
			'font_variant' => '700',
			'font_size' => '20px',
			'font_color' => '#252525',
			'css_selectors' => 'h4'
		),
		'h5_headline' => array(
			'preview_text' => 'Content H5',
			'preview_color' => 'light',
			'font_family' => 'Montserrat',
			'font_variant' => '700',
			'font_size' => '18px',
			'font_color' => '#252525',
			'css_selectors' => 'h5'
		),
		'h6_headline' => array(
			'preview_text' => 'Content H6',
			'preview_color' => 'light',
			'font_family' => 'Montserrat',
			'font_variant' => '700',
			'font_size' => '16px',
			'font_color' => '#252525',
			'css_selectors' => 'h6'
		),
		'single_title_font' => array(
			'preview_text' => 'Article Title',
			'preview_color' => 'light',
			'font_family' => 'Montserrat',
			'font_size' => '30px',
			'font_variant' => '700',
			'font_color' => '#252525',
			'css_selectors' => '.front-view-title, .single-title'
		),
		'section_title_font' => array(
			'preview_text' => 'Section Title',
			'preview_color' => 'light',
			'font_family' => 'Montserrat',
			'font_size' => '30px',
			'font_variant' => '700',
			'font_color' => '#252525',
			'css_selectors' => '.front-view-title, .single-title'
		),
		'section_desc_font' => array(
			'preview_text' => 'Section Description',
			'preview_color' => 'light',
			'font_family' => 'Merriweather',
			'font_size' => '15px',
			'font_variant' => 'normal',
			'font_color' => '#888888',
			'css_selectors' => '.section-description, .project-client'
		),
		'quote_font' => array(
			'preview_text' => 'Quote',
			'preview_color' => 'light',
			'font_family' => 'Merriweather',
			'font_size' => '17px',
			'font_variant' => 'normal',
			'font_color' => '#888888',
			'css_selectors' => 'blockquote, .quote-text'
		),
	));
}

?>