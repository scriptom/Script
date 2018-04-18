<?php

	// Si no es minimo contributor, no tiene acceso a esta pagina. Mostremos mensaje
	if ( !current_user_can( 'edit_posts' ) ) :
		wp_die( 'No tiene acceso a esta pagina.', 'Error al cargar la página' );
	endif;

	$dbid = get_post_meta( get_the_ID(), '_per_database_id', true );
	$data_persona = cvnzl_get_personas_data(
		array(
			'per_primer_nombre',
			'per_segundo_nombre',
			'per_primer_apellido',
			'per_segundo_apellido',
			'per_alias',
			'per_sexo',
			'per_fecha_nac',
			'per_fecha_falle',
			'per_biografia'
		),
		$dbid
	)[0];
	$partes_nombre = array_filter($data_persona, function($k){
		return endsWith($k, 'nombre') || endsWith($k, 'apellido') || 'per_alias' === $k;
	}, ARRAY_FILTER_USE_KEY);

	$sexo = $data_persona['per_sexo'];
	$bio = $data_persona['per_biografia'];
?>
<?php the_title( '<h1 class="text-center pel-titulo">Editando: <a class="text-white" href="'.get_the_permalink().'">', '</a></h1>', true ); ?>
		<div class="row">
			<div class="col-md-3">
				<?php if ( has_post_thumbnail() ): ?>
					<img src="<?php the_post_thumbnail_url( 'full' ); ?>" title="<?php the_title_attribute(); ?>" alt="Poster: <?php the_title_attribute(); ?>" class="img-fluid poster rounded">
				<?php else: ?>
					<img src="holder.js/350x200" title="<?php the_title_attribute(); ?>" alt="placeholder" class="img-fluid poster rounded">
				<?php endif; ?>
			</div>
			<div class="col-md-9">
				<div class="card inner-shadow bg-dark border border-light">
					<div class="card-header">
						<ul class="nav nav-pills nav-fill" role="tablist" id="cambios-tabs">
							<li class="nav-item">
								<a class="nav-link active" href="#did" id="did-tab" role="tab" data-toggle="pill" aria-selected="true">Datos Identificaci&oacute;n</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#dbio" id="dbio-tab" role="tab" data-toggle="pill" aria-controls="dbio" aria-selected="false">Datos Biogr&aacute;ficos</a>
							</li>
						</ul> <!-- /#cambios-tabs -->
					</div>
					<div class="card-body">
						<form id="editar-per-form">
							<input type="hidden" name="dbid" value="<?php echo esc_attr($dbid); ?>">
							<div class="tab-content">
								<div class="tab-pane fade show active" id="did" aria-labelledby="did-tab" role="tabpanel">
									<h2 class="text-center">Datos de Identificaci&oacute;n</h2>
									<small class="form-text text-warning text-center">(Los campos llenos solo pueden ser alterados por un administrador)</small>
									<div class="form-row">
										<div class="col-md-6">
											<label for="per_primer_nombre" class="h6">Primer Nombre</label>
											<input type="text" class="form-control" id="per_primer_nombre" name="per_nombre[primer_nombre]" value="<?php echo $partes_nombre['per_primer_nombre']; ?>" placeholder="<?php echo $partes_nombre['per_primer_nombre']; ?>" <?php if ( !current_user_can( 'manage_options' ) ) echo "disabled" ?>>
										</div>
										<div class="col-md-6">
											<label for="per_segundo_nombre" class="h6">Segundo Nombre</label>
											<input type="text" class="form-control" id="per_segundo_nombre" name="per_nombre[segundo_nombre]" value="<?php echo $partes_nombre['per_segundo_nombre']; ?>" placeholder="<?php echo $partes_nombre['per_segundo_nombre']; ?>" <?php if ( !current_user_can( 'manage_options' ) ) echo "disabled" ?>>
										</div>
										<div class="col-md-6">
											<label for="per_primer_apellido" class="h6">Primer Apellido</label>
											<input type="text" class="form-control" id="per_primer_apellido" name="per_nombre[primer_apellido]" value="<?php echo $partes_nombre['per_primer_apellido']; ?>" placeholder="<?php echo $partes_nombre['per_primer_apellido']; ?>" <?php if ( !current_user_can( 'manage_options' ) ) echo "disabled" ?>>
										</div>
										<div class="col-md-6">
											<label for="per_segundo_apellido" class="h6">Segundo Apellido</label>
											<input type="text" class="form-control" id="per_segundo_apellido" name="per_nombre[segundo_apellido]" value="<?php echo $partes_nombre['per_segundo_apellido']; ?>" placeholder="<?php echo $partes_nombre['per_segundo_apellido']; ?>" <?php if ( !current_user_can( 'manage_options' ) ) echo "disabled" ?>>
										</div>
										<div class="col-md-6">
											<label for="per_alias" class="h6">Alias</label>
											<input type="text" class="form-control" id="per_alias" name="per_nombre[alias]" value="<?php echo $partes_nombre['per_alias']; ?>" placeholder="<?php echo $partes_nombre['per_alias']; ?>">
										</div>
										<div class="col-md-6">
											<label for="per_identificacion" class="h6">Identificaci&oacute;n</label>
											<input type="text" class="form-control disabled" id="per_identificacion" name="per_nombre[identificacion]" disabled>
										</div>
									</div>
									<div class="form-group form-row" id="sexo-radio-group">
									<label class="h6 col-auto">Sexo:</label>
										<div class="form-check form-check-inline col-auto">
											<input type="radio" class="form-check-input" name="per_sexo" id="per_sexo_m" <?php if($sexo==='M')echo 'checked'; ?>>
											<label for="per_sexo_m" class="form-check-label">Masculino</label>
										</div>
										<div class="form-check form-check-inline col-auto">
											<input type="radio" class="form-check-input" name="per_sexo" id="per_sexo_f" <?php if($sexo==='F')echo 'checked'; ?>>
											<label for="per_sexo_f" class="form-check-label">Femenino</label>
										</div>
									</div>
								</div> <!-- /.tab-pane -->
								<div class="tab-pane fade" id="dbio" aria-labelledby="dbio-tab" role="tabpanel">
									<div class="form-row">
										<div class="col-md-8">
											<label for="ta-bio" class="h5">Biograf&iacute;a</label>
											<textarea name="per_bio[bio]" id="ta-bio" cols="30" rows="10" class="form-control" style="resize:none" placeholder="<?php echo $bio; ?>"></textarea>
											<div class="form-check">
												<input type="checkbox" name="hedit" class="form-check-input" id="cb_hedit">
												<label for="cb_hedit" class="form-check-label">Editar biograf&iacute;a actual</label>
											</div>
										</div>
										<div class="col-md-4">
											<label for="fechas">Fechas</label>
											<div class="form-group">
												<label for="fecha_nac">Fecha nacimiento</label>
												<input type="date" name="per_bio[fecha_nac]" id="fecha_nac" class="form-control">
											</div>
											<div class="form-group">
												<label for="fecha_falle">Fecha fallecimiento</label>
												<input type="date" name="per_bio[fecha_falle]" id="fecha_nac" class="form-control">
											</div>
										</div>
									</div>
								</div>
							</div> <!-- /.tab-content -->
						</div> <!-- /.card-body -->
						<div class="card-footer text-center">
							<button class="btn btn-light mx-auto cursor-pointer" name="sub_props" type="submit">Enviar propuestas</button>
						</div>
					</form> <!-- #editar-peli-form -->
				</div> <!-- /.card -->
			</div> <!-- /.col-md-12 -->
		</div> <!-- /.row -->
