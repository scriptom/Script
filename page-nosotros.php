<?php get_header();
$map = get_field( 'mapa_nosotros' );
add_action( 'wp_footer', function() use ($map){
      ?>
      <script type="text/javascript">
        function myMap(){
          var mapCanvas = document.getElementById('map');
          var mapOptions = {
            center: new google.maps.LatLng(<?php echo $map['lat'] ?>, <?php echo $map['lng'] ?>),
            zoom: 16
          };
          var map = new google.maps.Map(mapCanvas, mapOptions);
          var marker = new google.maps.Marker({
            position: mapOptions.center,
            animation: google.maps.Animation.BOUNCE
          });
          var infoWindow = new google.maps.InfoWindow({
            content: '<?php echo $map['address'] ?>'
          });
          infoWindow.setMap(map);
          marker.setMap(map);
          marker.addListener('click', function(){
            infoWindow.open(map, marker);
          });
        }
      </script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9M2yMye_X2PwmmlWFZCV1yMXfUZ3so3Q&callback=myMap"></script>
<?php
} ); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <div class="row">
    <div class="col-md-6">
      <div class="card bg-dark border border-light inner-shadow">
            <h4 class="card-header"><?php the_title(); ?></h4>
          <div class="card-body"><?php the_content(); ?></div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-12">
            <div class="card bg-dark border border-light inner-shadow">
                    <h4 class="card-header">Equipo CIC</h4>
                <div class="card-body">
                  <?php the_field( 'texto_equipo_cic' ) ?>
                </div>
            </div>
          </div>
        </div>
      <div class="row">
        <div class="col-md-12">
        <div class="card bg-dark border border-light inner-shadow">
            <h4 class="card-header">D&oacute;nde estamos</h4>
            <div class="card-body text-dark">
              <div id="map" style="height:300px">
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  </div>
<?php endwhile; ?>
  <!-- post navigation -->
<?php else: ?>
  <!-- no posts found -->
<?php endif; ?>
<?php get_footer(); ?>
