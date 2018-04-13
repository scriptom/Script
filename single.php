<?php get_header(); ?>
<div class="container">
	<?php if ( have_posts() ): ?>
	<?php while ( have_posts() ) : the_post(); ?>
	<?php $category = get_the_category();
	switch ($category[0]->slug) {
		case 'pelicula':
			get_template_part( 'content', 'pelicula' );
			break;
		case 'persona':
			get_template_part( 'content', 'persona' );
			break;
		
		default:
			# code...
			break;
	}
	 ?>
	<?php endwhile; ?>
	<?php endif; ?>
</div> <!-- /.container -->

<?php get_footer(); ?>