<?php
$edit = get_query_var( 'edit', 0 );
?>
<?php get_header(); ?>
<div class="container">
	<?php if ( have_posts() ): ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'content', $edit?'edit-pelicula':'pelicula' ); ?>
	<?php endwhile; ?>
	<?php endif; ?>
</div> <!-- /.container -->

<?php get_footer(); ?>