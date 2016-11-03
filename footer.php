<?php 
    $mts_options = get_option(MTS_THEME_NAME); 
    if(is_array($mts_options['mts_homepage_layout'])){
        $homepage_layout = $mts_options['mts_homepage_layout']['enabled'];
    }else if(empty($homepage_layout)) {
        $homepage_layout = array();
    }
?>
    </div><!--#page-->
    <footer class="main-footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
        <div id="footer" class="clearfix">
            <div class="container">
                <div class="copyrights">
                    <?php mts_copyrights_credit(); ?>
                </div>
            </div><!--.container-->
        </div>
    </footer><!--footer-->
</div><!--.main-container-->
<?php mts_footer(); ?>
<?php wp_footer(); ?>
<?php if($mts_options['mts_map_coordinates'] != '' && array_key_exists('contact',$homepage_layout) && is_front_page()): ?>
<script type="text/javascript">
      var mapLoaded = false;
      function initialize() {
        mapLoaded = true;
        
        var geocoder = new google.maps.Geocoder();
        var lat='';
        var lng=''
        geocoder.geocode( { 'address': '<?php echo addslashes($mts_options['mts_map_coordinates']); ?>'}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
           lat = results[0].geometry.location.lat(); //getting the lat
           lng = results[0].geometry.location.lng(); //getting the lng
           map.setCenter(results[0].geometry.location);
           var marker = new google.maps.Marker({
               map: map,
               position: results[0].geometry.location
           });
         }
         });
         var latlng = new google.maps.LatLng(lat, lng);
        
        var mapOptions = {
            zoom: 18,
            center: latlng,
            scrollwheel: false,
            navigationControl: false,
            scaleControl: false,
            streetViewControl: false,
            draggable: true,
            panControl: false,
            mapTypeControl: false,
            zoomControl: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            // How you would like to style the map.
            // This is where you would paste any style found on Snazzy Maps.
            styles: [{"featureType":"water","stylers":[{"visibility":"on"},{"color":"#acbcc9"}]},{"featureType":"landscape","stylers":[{"color":"#f2e5d4"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#c5c6c6"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#e4d7c6"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#fbfaf7"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#c5dac6"}]},{"featureType":"administrative","stylers":[{"visibility":"on"},{"lightness":33}]},{"featureType":"road"},{"featureType":"poi.park","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":20}]},{},{"featureType":"road","stylers":[{"lightness":20}]}]
        };

        var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
      }
      //google.maps.event.addDomListener(window, 'load', initialize);
      jQuery(window).load(function() {
        jQuery(window).scroll(function() {
          if (jQuery('.contact_map').isOnScreen() && !mapLoaded) {
            mapLoaded = true;
            jQuery('body').append('<script src="https://maps.googleapis.com/maps/api/js?sensor=false&v=3&callback=initialize&key=AIzaSyDiyeois-9ChTjvQX5nHcRwcroZcaZUdEg"></'+'script>');
          }
        });
      });
</script>
<?php endif ?>
</body>
</html>