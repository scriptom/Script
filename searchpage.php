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
			<a href="#">pel&iacute;culas</a>,
			<a href="#">personas</a> y
			<a href="#">noticias</a>
			</p>
		<?php get_search_form( true ); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
