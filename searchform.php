
<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

	<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<div class="row justify-content-between">
			<input type="search" id="<?php echo $unique_id; ?>" class="search-input form-control col-sm-8" placeholder="<?php esc_attr_e( 'Buscar en SCRIPT' ); ?>" value="<?php echo get_search_query(); ?>" name="s">
			<select name="post_type" class="form-control col-sm-2" id="post-type">
				<option value="any">Todos</option>
				<option value="pelicula">Pel&iacute;culas</option>
				<option value="persona">Personas</option>
				<option value="post">Noticias</option>
			</select>
			<button type="submit" class="search-submit form-control btn btn-secondary cursor-pointer col-sm-1">Buscar</button>
		</div>
	</form>
