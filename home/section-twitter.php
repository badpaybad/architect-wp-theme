<?php
$mts_options = get_option(MTS_THEME_NAME);

$bg_cover_class     = ( $mts_options['mts_homepage_twitter_background_image_cover'] == '1' && $mts_options['mts_homepage_twitter_background_image'] != '' ) ? ' cover-bg' : '';
$parallax_class     = ( $mts_options['mts_homepage_twitter_parallax'] == '1' ) ? ' parallax-bg' : '';
$color_scheme_class = ( $mts_options['mts_homepage_twitter_color_scheme'] == 'dark' ) ? ' dark-colors' : ' light-colors';
?>
<div id="twitter" class="section clearfix<?php echo $bg_cover_class . $parallax_class . $color_scheme_class; ?>">
	<div class="container">
		<div class="section-header"><i class="fa fa-twitter"></i></div>
		<?php
        if(empty($mts_options['homepage_twitter_api_key']) || empty($mts_options['homepage_twitter_api_secret']) || empty($mts_options['homepage_twitter_access_token']) || empty($mts_options['homepage_twitter_access_token_secret']) || empty($mts_options['homepage_twitter_username'])){
            echo '<strong>'.__('The section is not configured correctly', 'mythemeshop').'</strong>';  }
        //check if cache needs update
        $mts_twitter_plugin_last_cache_time = get_option('mts_twitter_plugin_last_cache_time');
        $diff = time() - $mts_twitter_plugin_last_cache_time;
        $crt =0 * 3600;						
        if($diff >= $crt || empty($mts_twitter_plugin_last_cache_time)){							
        if(!require_once(dirname(__FILE__).'/../functions/twitteroauth.php')){ echo '<strong>Couldn\'t find twitteroauth.php!</strong>';  }														

        $connection = mts_getConnectionWithhomepage_twitter_access_token($mts_options['homepage_twitter_api_key'], $mts_options['homepage_twitter_api_secret'], $mts_options['homepage_twitter_access_token'], $mts_options['homepage_twitter_access_token_secret']);
        $tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$mts_options['homepage_twitter_username']."&count=".$mts_options['homepage_twitter_tweet_count']) or die('Couldn\'t retrieve tweets! Wrong username?');
        if(!empty($tweets->errors)){
            if($tweets->errors[0]->message == 'Invalid or expired token'){
                echo '<strong>'.$tweets->errors[0]->message.'!</strong><br />You\'ll need to regenerate it <a href="https://dev.twitter.com/apps" target="_blank">here</a>!';
            }else{ echo '<strong>'.$tweets->errors[0]->message.'</strong>'; }
        }
		if(is_array($tweets)){
			for($i = 0;$i <= count($tweets); $i++){
				if(!empty($tweets[$i])){
					$tweets_array[$i]['created_at'] = $tweets[$i]->created_at;
					$tweets_array[$i]['text'] = $tweets[$i]->text;			
					$tweets_array[$i]['status_id'] = $tweets[$i]->id_str;			
				}
			}			
			
			//save tweets to wp option 		
			update_option('mts_twitter_plugin_tweets',serialize($tweets_array));							
			update_option('mts_twitter_plugin_last_cache_time',time());		
			echo '<!-- twitter cache has been updated! -->';
			}
			//convert links to clickable format
		}    
        $mts_twitter_plugin_tweets = maybe_unserialize(get_option('mts_twitter_plugin_tweets'));
        if(!empty($mts_twitter_plugin_tweets)){
            print '<div class="mts_recent_tweets tweets section-content">';
                $fctr = '1';
                foreach($mts_twitter_plugin_tweets as $tweet){
                    if ($mts_options['homepage_twitter_slider'] == '0' && $fctr > 1) continue;
                    
                    print '<div><span>'.mts_convert_links($tweet['text']).'</span></div>';
                    $fctr++;
                }
            print '</div>
            
            <a class="twitter_username button" href="http://twitter.com/'.$mts_options['homepage_twitter_username'].'">'.__('Follow us on Twitter', 'mythemeshop').'&nbsp;&nbsp;&#8594;</a>';
        }
    ?>
	</div>
</div>