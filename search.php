<?php
add_action('wp_head', function(){
	global $wp_query;
	$wp_query->set( 'order', 'asc' );
	$wp_query->set( 'orderby', 'title' );
});
 ?>
<?php get_header();
	$search_page = get_page_by_path( 'busqueda' );
	$search_page_url = get_page_link( $search_page->ID );
?>
<div class="card bg-dark border-light m-4">
	<h4 class="card-header">Buscar m&aacute;s</h4>
	<div class="card-body">
	<?php  get_search_form( true );?>
	</div>
</div>

<div class="card bg-dark border border-light my-5">
<?php if ( have_posts() ) : ?>
	<h3 class="card-header"><?php printf( __( 'Resultados de la b&uacute;squeda para "%s"' ), get_search_query() ); ?></h3>
	<div class="card-body">
		<div class="row">
<?php while ( have_posts() ) : the_post(); ?>
			<div class="col-md-3 mb-5">
				<div class="card bg-secondary">
					<a href="<?php the_permalink(); ?>">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'img-fluid card-img-top' ) ); ?>
					<?php else: ?>
						<img src="https://placehold.it/250x250" alt="" class="img-fluid card-img-top">
					<?php endif; ?>
					</a>
					<div class="card-title text-center"><a class="text-white" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
				</div>
			</div>
<?php endwhile; ?>

		</div>
		<div class="card-footer">
			 <?php if (function_exists('fellowtuts_wpbs_pagination')) {
				 fellowtuts_wpbs_pagination();
			} ?>
			
		</div>
	</div>
<?php else: ?>
	<h3 class="card-header">No se encontraron resultados para "<?php echo get_search_query(); ?>"</h3>
	<div class="card-body">
		<p>Por qu&eacute; no vuelves a <a href="<?php echo $search_page_url; ?>">intentar</a>?</p>
	</div>
<?php endif; ?>
</div>
<?php get_footer(); ?>
