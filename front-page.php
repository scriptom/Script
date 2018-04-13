<?php
  get_header();
  $args = array(
    'numposts' => 12,
    'orderby' => 'post_date',
    'post_type' => 'pelicula',
 );

 $recent_movies = wp_get_recent_posts( $args );
 $has_active = false;
?>
<?php if ( !empty( $recent_movies ) ): ?>
  
  <div id="carousel-pelis" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner" role="listbox">
	  <?php for ( $counter = 0; $counter <= 12; ): // $counter es un controlador de iteraciones. Se usa 12 por ser el número de posts que traemos de WordPress ?>
      <?php foreach ( $recent_movies as $movie ) : // Iterar en los posts recientes ?>
      <?php if ( $counter % 4 === 0 ): // Comprobar si el valor actual del contador es múltiplo de 4* ?>
            <div class="carousel-item <?php if ( ! $has_active ) { echo "active"; $has_active = true; /*Agregar "active" 1 vez y ya*/}  ?>">
              <div class="container">
                <div class="row justify-content-between">
                <?php endif; ?>
                <div class="col-md-3 d-md-block <?php if ($counter % 4 !== 0) echo 'd-none' ?>">
                  <a href="<?php echo get_the_permalink( $movie['ID'] ); ?>" title="<?php echo get_the_title( $movie['ID'] ); ?>">
                    <?php if ( has_post_thumbnail() ) :?>
                      <img src="<?php echo get_the_post_thumbnail( $movie['ID'], 'thumbnail' ) ?>" title="<?php echo get_the_title( $movie['ID'] ); ?>" alt="<?php echo get_the_title( $movie['ID'] ); ?>"></a>
                    <?php else: ?>
                      <img src="https://placehold.it/150x250" alt="DummyImg"></a>
                    <?php endif; $counter++; ?>
                </div>
          <?php if ( $counter % 4 === 0 ): // Hacer el mismo check de múltiplos de 4 para cerrar las filas ?>
              </div>
            </div>
          </div>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php endfor;
	// *Se usa múltiplos de 4 porque las columnas con col-md-3. Por ende, la suma de ellas  debe ser 12.?>
    </div> <!-- /.carousel-inner -->
    <a class="carousel-control-prev" href="#carousel-pelis" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-pelis" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
<?php endif; // empty( $recent_movies ) ?>
<div class="container">
  <div class="row">
      <div class="col-md-6">
        <div class="card bg-dark border border-light">
          <?php dynamic_sidebar('front-page-card'); ?>
        </div>
      </div>
      <div class="col-md-6">
        <a class="twitter-timeline" data-lang="es" data-width="555" data-height="423" data-theme="dark" data-link-color="#2B7BB9" href="https://twitter.com/cic_ucab">
          Tweets by cic_ucab</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
      </div>
  </div>
</div>
<?php
  get_footer();
 ?>