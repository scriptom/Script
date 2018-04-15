<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <div class="row">
    <div class="col-md-6">
      <div class="card bg-dark border border-light">
            <h4 class="card-header"><?php the_title(); ?></h4>
          <div class="card-body"><?php the_content(); ?></div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-12">
            <div class="card bg-dark border border-light">
                    <h4 class="card-header">Equipo CIC</h4>
                <div class="card-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea, eum?</div>
            </div>
          </div>
        </div>
      <div class="row">
        <div class="col-md-12">
        <div class="card bg-dark border border-light">
            <h4 class="card-header">D&oacute;nde estamos</h4>
            <div class="card-body">
              <iframe width="100%" height="268" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15693.84792777164!2d-66.9758!3d10.4642!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x43cb2d8100a63708!2sUniversidad+Cat%C3%B3lica+Andr%C3%A9s+Bello!5e0!3m2!1ses!2sve!4v1468088657141"
              frameborder="0" style="border:0" allowfullscreen>                
              </iframe>
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