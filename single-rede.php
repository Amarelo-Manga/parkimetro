<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<article id="single-rede" class="container">
	<?php
		$endereco = get_post_meta( $post->ID, 'endereco', true );
	?>
	<div class="row">
		<section id="mapa" class="col-6"></section>
		<section id="endereco" class="col-6">
			<p><?php echo $endereco; ?></p>
		</section>
	</div>
</article>

<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('mapa'), {
          zoom: 18,
          center: {lat: -23.5527523, lng: -46.6511055}
        });
        var geocoder = new google.maps.Geocoder();

        geocodeAddress(geocoder, map);
    }
  	function geocodeAddress(geocoder, resultsMap) {
    	var address = '<?php echo $endereco; ?>';
    	geocoder.geocode({'address': address}, function(results, status) {
          	if (status === 'OK') {
            	resultsMap.setCenter(results[0].geometry.location);
            	var marker = new google.maps.Marker({
              		map: resultsMap,
              		position: results[0].geometry.location
           		});
          	} else {
            	alert('Geocode was not successful for the following reason: ' + status);
          	}
    	});
  	}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqkjNZ5LJMM0W55FQOF8Vzb_0m58cE01Y&callback=initMap">
</script>

<?php get_footer();
