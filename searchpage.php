<?php
/*
 * Template Name: Plantilla de Busqueda
 */
?>
<?php get_header(); ?>
<div class="container-fluid">
	<div class="card bg-dark border border-light my-5 w-75 mx-auto inner-shadow">
		<h3 class="card-header"><?php _e( 'Buscar en SCRIPT' ); ?></h3>
		<div class="card-body">
			<p>Introduzca abajo el t&eacute;rmino que desee buscar.
			Puede buscar
			<a href="<?php echo home_url().'/?s=&post_type=pelicula'?>">pel&iacute;culas</a> y
			<a href="<?php echo home_url().'/?s=&post_type=persona'?>">personas</a>
			</p>
		<?php get_search_form( true ); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
