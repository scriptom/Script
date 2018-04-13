<?php
	global $fields;

	$post_meta = get_post_meta( get_the_ID() );
	$is_editor = is_user_logged_in() && current_user_can( 'edit_posts' );
	if ( $is_editor ): 
		$edit_url = add_query_arg('edit', 1);
		$edit_url = esc_url( $edit_url );
		$edit_btn =	"<small><a href=\"{$edit_url}\" title=\"Editar ".get_the_title()."\"><i class=\"fa fa-edit text-secondary\"></i></a></small>";
	endif;

	$generos = wp_get_post_terms( get_the_ID(), 'genero' );
	$tematicas = wp_get_post_terms( get_the_ID(), 'tematica' );
	error_log(print_r($generos, true));
	error_log(print_r($tematicas, true));
	$fields = get_field_objects();

	// error_log(print_r($fields, true));
?>	 
<?php the_title( '<h1 class="text-center pel-titulo">', ($is_editor?"  ".$edit_btn:'').'</h1>', true ); ?>
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
				<h3 class="card-header text-center">Sin&oacute;psis</h3>
				<div class="card-body text-justify">
					<?php the_content(); ?>
				</div> <!-- /.card-body -->
				<?php if (!empty($generos) || !empty($tematicas)): ?>
				<div class="card-footer">
					<?php if (!empty($generos)) {
						echo "G&eacute;neros: <span class='font-italic'>";				
						foreach ($generos as $genero) {
							if (!isset($gtxt)) $gtxt = array();

							$gtxt[] = $genero->name; 
						}
						echo implode(", ", $gtxt);
						echo "</span><br>";
					}
					if (!empty($tematicas)) {
					 	echo "Tem&aacute;ticas: <span class='font-italic'>";
					 	foreach ($tematicas as $tematica) {
					 		if(!isset($ttxt)) $ttxt = array();

					 		$ttxt[] = $tematica->name;
					 	}
					 	echo implode(", ", $ttxt);
					 	echo "</span>";
					 } 

					?>
				</div>
				<?php endif ?>
			</div> <!-- /.card -->
		</div> <!-- /.col -->
	</div> <!-- /.row -->
	<div class="row">
		<?php get_template_part( 'accordion' ); ?>
	</div> <!--row -->
	<div class="row">
		<!-- <?php get_template_part('extra-info'); ?> -->
	</div> <!--row -->	
