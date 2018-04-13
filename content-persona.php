<?php 
	$post_meta = get_post_meta( get_the_ID() );
	$is_editor = is_user_logged_in() && current_user_can( 'edit_posts' );
	if ( $is_editor ): 
		$edit_url = add_query_arg('edit', 1);
		$edit_url = esc_url( $edit_url );
		$edit_btn =	"<small><a href=\"{$edit_url}\" title=\"Editar ".get_the_title()."\"><i class=\"fa fa-edit text-secondary\"></i></a></small>";
	endif;
	$fields = get_field_objects();
	error_log(print_r($fields, true));
	error_log(print_r($post_meta, true));
?>	 
<?php the_title( '<h1 class="text-center pel-titulo">  ', ($is_editor?"  ".$edit_btn:'').'</h1>', true ); ?>
	<div class="row">
		<div class="col-md-4">
			<?php if ( has_post_thumbnail() ) :
					the_post_thumbnail( 'post-thumbnail', array( 'class' => 'img-fluid poster rounded' ) );
			 	  else: ?>
			<img src="https://placehold.it/350x200" alt="placeholder" class="img-fluid poster rounded">
			<?php endif; ?>
		</div>
		<div class="col-md-6 ml-md-5">
			<div class="card bg-dark border border-light">
				<h3 class="card-header text-center">Biograf&iacute;a</h3>
				<div class="card-body text-justify">
					<?php the_content(); ?>
				</div> <!-- /.card-body -->
				<div class="card-footer">
					
				</div>
			</div> <!-- /.card -->
		</div> <!-- /.col -->
	</div> <!-- /.row -->
	<div class="row">
		<!-- <?php //get_template_part( 'accordion' ); ?> -->
	</div> <!--row -->
	<div class="row">
		<!-- <?php get_template_part('extra-info'); ?> -->
	</div> <!--row -->	
