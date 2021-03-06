<?php

	// Si no es minimo contributor, no tiene acceso a esta pagina. Mostremos mensaje
	if ( !current_user_can( 'edit_posts' ) ) :
		wp_die( 'No tiene acceso a esta pagina. Probablemente no este registrado o no haya iniciado sesion', 'Error al cargar la página' );
	endif;

error_log(print_r(get_defined_constants(true), true));
	// Si el plugin no esta cargado, no hagamos nada
	include_once( ABSPATH . 'wp-admin/includes/plugin.php');
	if ( !is_plugin_active('cvnzl-admin/cvnzl-admin.php') ) {
		wp_die( 'Ha ocurrido un error inesperado. Por favor pongase en contacto con el administrador del sitio' );
	}

	$dbid = get_post_meta( get_the_ID(), '_database_id', true );
	$args2 = array(
		'numberposts' => -1,
		'post_type'   => 'persona',
		'meta_key' 	  => '_per_database_id',
		'orderby'     => 'title'
	);

	$query2 = get_posts( $args2 );

	$cargos = cvnzl_get_guiones();

?>
<?php the_title( '<h1 class="text-center pel-titulo">Editando: <a class="text-white" href="'.get_the_permalink().'">', '</a></h1>', true ); ?>
		<div class="row justify-content-center">
			<div class="col-md-4">
				<?php if ( has_post_thumbnail() ): ?>
					<img src="<?php the_post_thumbnail_url( 'full' ); ?>" title="<?php the_title_attribute(); ?>" alt="Poster: <?php the_title_attribute(); ?>" class="img-fluid poster rounded">
				<?php else: ?>
					<img src="holder.js/350x200" title="<?php the_title_attribute(); ?>" alt="placeholder" class="img-fluid poster rounded">
				<?php endif; ?>
			</div> <!-- /.col-md-4 -->
		</div> <!-- /.row -->
		<div class="row">
			<div class="col-md-12">
				<div class="card inner-shadow bg-dark border border-light">
					<div class="card-header">
						<ul class="nav nav-pills nav-fill" role="tablist" id="cambios-tabs">
							<li class="nav-item">
								<a href="#dgenerales" class="nav-link active" id="dgenerales-tab" role="tab" data-toggle="pill" aria-selected="true">Datos Generales</a>
							</li>
							<li class="nav-item dropdown">
								<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true">Ficha Técnica</a>
								<div class="dropdown-menu">
									<a class="dropdown-item" href="#dft-personas" id="dft-personas-tab" role="tab" data-toggle="pill" aria-controls="dft-personas" aria-selected="false">Personas</a>
									<a class="dropdown-item" href="#dft-casas" id="dft-casas-tab" role="tab" aria-controls="dft-casas" aria-selected="false" data-toggle="pill">Organizaciones</a>
									<a class="dropdown-item" href="#dft-gadapt" id="dft-gadapt-tab" role="tab" data-toggle="pill" aria-controls="dft-dgadapt" aria-selected="false">Guiones adaptados</a>
								</div>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#dcritica" id="dcritica-tab" role="tab" data-toggle="pill" aria-controls="dcritica" aria-selected="false">Cr&iacute;tica</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#dgentem" id="dgentem-tab" role="tab" data-toggle="pill" aria-controls="dgentem" aria-selected="false">Género y Temática</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#dlugares" id="dlugares-tab" role="tab" data-toggle="pill" aria-controls="dlugares" aria-selected="false">Locaciones</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#dreparto" id="dreparto-tab" role="tab" data-toggle="pill" aria-controls="dreparto" aria-selected="false">Reparto</a>
							</li>
						</ul> <!-- /#cambios-tabs -->
					</div>
					<div class="card-body">
						<form id="editar-peli-form" action="<?php echo plugins_url().'/cvnzl-admin/procesar-prop.php' ?>" method="post">
							<input type="hidden" name="dbid" value="<?php echo esc_attr($dbid); ?>">
							<div class="tab-content">
									<div class="tab-pane fade show active" id="dgenerales" aria-labelledby="dgenerales-tab" role="tabpanel">
										<h2 class="text-center">Datos Generales</h2>
										<div class="row">
											<div class="col-md-6">
												<label class="h3 text-center" for='pel_titulo'>T&iacute;tulo</label>
												<input type="text" name="pel_titulo" id="pel_titulo" value="<?php echo esc_attr(get_the_title()); ?>" disabled class="form-control disabled">
												<label for="pel_ano">A&ntilde;o estreno</label>
												<input type="number" length="4" class="form-control col-md-2" name="PROP[<?php echo esc_attr( TABLA_PELICULAS ) ?>][0][pel_ano]" min="1897" max="<?php echo date("Y")+5; ?>" id="pel_ano">
											</div> <!-- /.col-md-6 -->
											<div class="col-md-6 align-self-center">
												<label class="text-center h3">Proponer Sin&oacute;psis</label>
												<textarea style="resize:none" name="PROP[<?php echo esc_attr( TABLA_PELICULAS ) ?>][0][pel_sinopsis]" id="propuesta-sinopsis" cols="30" rows="10" class="form-control" placeholder="<?php echo get_the_content(); ?>"></textarea> <!-- /.textarea -->
												<div class="form-check form-check-inline">
												 	<label class="form-check-label" for="cb_hedit">
														<input type="checkbox" class="form-check-input" id="cb_hedit">
														Editar sin&oacute;psis actual
													</label>
												</div> <!-- /.form-check -->
											</div> <!-- /.col-md-6 -->
											<div class="col-md-6">
											</div> <!-- /.col-md-6 -->
										</div> <!-- /.row -->
									</div> <!-- /.tab-pane -->
									<div class="tab-pane fade" id="dft-casas" aria-labelledby="dft-casas" role="tabpanel">
										<h2 class="text-center mb-3">Ficha T&eacute;cnica: Organizaciones</h2>
										<h5 class="d-block">
										Nueva entrada
											<small class="icon-wrap">
												<a href="#" class="js-add-new text-secondary" data-adds='cp' id="cp-btn-add" title="A&ntilde;adir nuevo">
													<span class="fa-stack fa-sm">
														<i class="fa fa-circle-thin fa-stack-2x"></i>
														<i class="fa fa-plus fa-stack-1x"></i>
													</span>
												</a>
											</small>
										</h5>
										<div id="cp-container">
											<div class="cp form-row" data-rowtab="cp" id="cp-row-parent-1">
												<div class="col-xs-5 col-md-5">
													<div class="form-group">
														<label for="cp-input-resp-1">La compa&ntilde;&iacute;a</label>
														<input type="text" data-type='casa_productora' class="form-control autocomplete-cp" id="cp-input-resp-1" name="PROP[<?php echo esc_attr( TABLA_FICHAS_TECNICAS ) ?>][0][casa_productora_id]">
													</div> <!-- .form-group -->
												</div>
												<div class="col-xs-5 col-md-6">
													<div class="form-group">
														<label for="cp-select-puesto-1">Particip&oacute; como</label>
														<select name="PROP[<?php echo esc_attr( TABLA_FICHAS_TECNICAS ) ?>][0][cargo_id]" id="cp-select-puesto-1" class="form-control form-control-chosen no-shadow text-dark" data-placeholder='Seleccione un cargo'>
															<option value=""></option>
															<?php foreach ($cargos as $cargo): ?>
															<option value="<?php echo $cargo['id']; ?>"><?php echo $cargo["cargo"]; ?></option>
															<?php endforeach ?>
														</select>
													</div>
												</div>
												<div class="col-xs-2 col-md-1 align-self-end">
													<div class="form-group">
														<a href="#" class="text-secondary js-btn-remove" data-deletes="#cp-row-parent-1" title="Quitar propuesta">
															<span class="fa-stack fa-sm">
																<i class="fa fa-circle-thin fa-stack-2x"></i>
																<i class="fa fa-minus fa-stack-1x"></i>
															</span>
														</a>
													</div> <!-- .form-group -->
												</div> <!-- .col-md-1 -->
											</div> <!-- .row -->
										</div>
									</div>
									<div class="tab-pane fade" id="dft-gadapt" aria-labelledby="dft-gadapt-tab" role="tabpanel">
										<h2 class="text-center">Ficha T&eacute;cnica: Guiones Adaptados</h2>
										<div class="row justify-content-center">
											<div class="col-md-auto"><label for="obra-orig">Esta pel&iacute;cula fue adaptada de la obra </label></div>
											<div class="col-md-3"><input type="text" class="form-control" id="obra-orig" name="PROP[<?php echo esc_attr( TABLA_GUIONES_ADAPTADOS ) ?>][0][obra_original]"></div>
											<div class="col-md-auto"><label for="autor-orig"> del autor </label></div>
											<div class="col-md-3"><input type="text" class="form-control autocomplete-per" data-type='persona' name="PROP[<?php echo esc_attr( TABLA_GUIONES_ADAPTADOS ) ?>][0][persona_id]" id="autor-orig"></div>
										</div>
									</div> <!-- #dgadapt -->
									<div class="tab-pane fade" id="dft-personas" aria-labelledby="dft-personas" role="tabpanel">
										<h2 class="text-center mb-3">Ficha T&eacute;cnica: Personas</h2>
										<h5 class="d-block">
										Nueva entrada
											<small class="icon-wrap">
												<a href="#" class="js-add-new text-secondary" data-adds='ft' id="ft-btn-add" title="A&ntilde;adir nuevo">
													<span class="fa-stack fa-sm">
														<i class="fa fa-circle-thin fa-stack-2x"></i>
														<i class="fa fa-plus fa-stack-1x"></i>
													</span>
												</a>
											</small>
										</h5>
										<div id="ft-container">
											<div class="ft form-row" data-rowtab="ft" id="ft-row-parent-1">
												<div class="col-xs-5 col-md-5">
													<div class="form-group">
														<label for="ft-input-resp-1">La persona</label>
														<input type="text" data-type='persona' data-dbid='' class="form-control autocomplete-per" list="ft-cargos" id="ft-input-resp-1" name="PROP[<?php echo esc_attr( TABLA_FICHAS_TECNICAS ) ?>][0][persona_id]">
													</div> <!-- .form-group -->
												</div>
												<div class="col-xs-5 col-md-6">
													<div class="form-group">
														<label for="ft-select-puesto-1">Tuvo el cargo de</label>
														<select name="PROP[<?php echo esc_attr( TABLA_FICHAS_TECNICAS ) ?>][0][cargo_id]" id="ft-select-puesto-1" class="form-control form-control-chosen no-shadow text-dark" data-placeholder='Seleccione un cargo'>
															<option value=""></option>
															<?php foreach ($cargos as $cargo): ?>
															<option value="<?php echo $cargo['id']; ?>"><?php echo $cargo["cargo"]; ?></option>
															<?php endforeach ?>
														</select>
													</div>
												</div>
												<div class="col-xs-2 col-md-1 align-self-end">
													<div class="form-group">
														<a href="#" class="text-secondary js-btn-remove" data-deletes="#ft-row-parent-1" title="Quitar propuesta">
															<span class="fa-stack fa-sm">
																<i class="fa fa-circle-thin fa-stack-2x"></i>
																<i class="fa fa-minus fa-stack-1x"></i>
															</span>
														</a>
													</div>
												</div>
											</div>
										</div>

									</div> <!-- /.tab-pane -->
									<div class="tab-pane fade" id="dcritica" aria-labelledby="dcritica-tab" role="tabpanel">
										<h2 class="text-center">Cr&iacute;tica</h2>
										<div class="col-12">
											<div class="form-group">
												<label for="critica_source_input">Fuente de la crítica</label>
												<input type="text" name="PROP[<?php echo esc_attr( TABLA_CRITICAS ) ?>][0][cri_fuente]" id="critica_source_input" class="form-control" placeholder="Página web, comentario, etc.">
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label for="critica_content">Contenido de la crítica</label>
												<textarea name="PROP[<?php echo esc_attr( TABLA_CRITICAS ) ?>][0][cri_contenido]" id="critica_content" cols="30" rows="10" class="form-control" placeholder="Contenido extraído de la fuente anteriormente mencionada"></textarea>
											</div>
										</div>
									</div> <!-- /.tab-pane -->
									<div class="tab-pane fade" id="dgentem" aria-labelledby="dgentem-tab" role="tabpanel">
										<div class="row">
											<div class="col-md-3 align-self-center">
												<h3 class="text-center">Géneros</h3>
											</div> <!-- /.col-md-6 -->
											<div class="col-md-9">
												<div class="form-group" id="lista-generos">
													<div class="form-row">
													<?php
														$generos = cvnzl_get_movie_genres();
														$generos_peli = cvnzl_get_movie_genres( get_post_meta( get_the_ID(), '_database_id', true ) );

														foreach ( $generos as $genero ) :
															$gen_nombre = $genero;
															$has_genre = in_array( $genero, $generos_peli );
														?>
														<div class="col-md-3">
															<div class="form-check">
																<label class="form-check-label">
																	<input type="checkbox" name="PROP[<?php echo esc_attr( TABLA_GENEROS_APLICADOS ) ?>][][genero_id]" class="form-check-input" value="<?php echo $gen_nombre; ?>" <?php if( $has_genre ) echo "checked"; ?>>
																	<?php echo $gen_nombre; ?>
																</label>
															</div> <!-- /.form-check -->
														</div>
														<?php endforeach; ?>
													</div>
												</div> <!-- /#lista-generos -->
											</div> <!-- /.col-md-6 -->
										</div>	<!-- /.row -->
										<hr>
										<div class="row">
											<div class="col-md-3 align-self-center">
												<h3 class="text-center">Temáticas</h3>
											</div>
											<div class="col-md-9">
												<div class="form-group" id="lista-tematicas">
													<div class="form-row">
													<?php
													$tematicas = cvnzl_get_movie_themes();
													$tematicas_peli = cvnzl_get_movie_themes( get_post_meta( get_the_ID(), '_database_id', true ) );

													$cols = 0;
													foreach ( $tematicas as $tematica ):
														$tem_nombre = $tematica;
														$has_tem = in_array( $tematica, $tematicas_peli );
													 ?>
													<div class="col-md-3">
														<div class="form-check">
															<label class="form-check-label">
																<input type="checkbox" value="<?php echo $tem_nombre; ?>" name="PROP[<?php echo esc_attr( TABLA_TEMATICAS_APLICADAS ) ?>][][tematica_id]" class="form-check-input" <?php if( $has_tem ) echo "checked"; ?>>
																<?php echo $tem_nombre; ?>
															</label>
														</div> <!-- /.form-check -->
													</div>
													<?php endforeach; ?>
													</div>
												</div> <!-- /#lista-tematicas -->
											</div> <!-- /.col-md-6 -->
										</div> <!-- /.row -->
									</div> <!-- /.tab-pane -->
									<div class="tab-pane fade" id="dlugares" aria-labelledby="dlugares-tab" role="tabpanel">
										<h2 class="text-center">Locaciones</h2>
										<h5>Nueva entrada
											<small class="icon-wrap">
												<a href="#" class="js-add-new text-secondary" data-adds="lug" id="lug-btn-add" title="A&ntilde;adir nuevo">
													<span class="fa-stack fa-sm">
														<i class="fa fa-circle-thin fa-stack-2x"></i>
														<i class="fa fa-plus fa-stack-1x"></i>
													</span>
												</a>
											</small>
										</h5>
										<div class="col-md-12" id="lug-container">
											<div class="lug form-row justify-content-between" data-rowtab='lug' id="lug-row-parent-1">
												<div class="col-md">
													<div class="form-group">
														<label for="lug-input-edf-1">Lugar f&iacute;sico</label>
														<input type="text" class="form-control" id="lug-input-edf-1" name="PROP[<?php echo esc_attr( TABLA_LOCACIONES ) ?>][0][lugar_fisico]">
													</div>
												</div>
												<div class="col-md">
													<div class="form-group">
														<label for="lug-input-ciudad-1">Ciudad</label>
														<input type="text" class="form-control" id="lug-input-ciudad-1" name="PROP[<?php echo esc_attr( TABLA_LOCACIONES ) ?>][0][lugar_ciudad]">
													</div>
												</div>
												<div class="col-md">
													<div class="form-group">
														<label for="lug-input-estado-1">Estado</label>
														<input type="text" class="form-control" id="lug-input-estado-1" name="PROP[<?php echo esc_attr( TABLA_LOCACIONES ) ?>][0][lugar_estado]">
													</div>
												</div>
												<div class="col-md">
													<div class="form-group">
														<label for="lug-input-pais-1">Pa&iacute;s</label>
														<input type="text" class="form-control" id="lug-input-pais-1" name="PROP[<?php echo esc_attr( TABLA_LOCACIONES ) ?>][0][lugar_pais]">
													</div>
												</div>
												<div class="col-1 align-self-end">
													<div class="form-group">
														<a href="#" class="text-secondary js-btn-remove" data-deletes="#lug-row-parent-1" title="Quitar propuesta">
															<span class="fa-stack fa-sm">
																<i class="fa fa-circle-thin fa-stack-2x"></i>
																<i class="fa fa-minus fa-stack-1x"></i>
															</span>
														</a>
													</div> <!-- .form-group -->
												</div> <!-- .col-md-1 -->
											</div>
										</div>
									</div> <!-- #dlugares -->
									<div class="tab-pane fade" id="dreparto" aria-labelledby="dreparto-tab" role="tabpanel">
										<h2 class="text-center">Reparto</h2>
										<h5>Nueva entrada
											<small class="icon-wrap">
												<a href="#" class="js-add-new text-secondary" data-adds="rep" id="rep-btn-add" title="A&ntilde;adir nuevo">
													<span class="fa-stack fa-sm">
														<i class="fa fa-circle-thin fa-stack-2x"></i>
														<i class="fa fa-plus fa-stack-1x"></i>
													</span>
												</a>
											</small>
										</h5>
										<div class="col-md-12" id="rep-container">
											<div class="rep form-row justify-content-between" data-rowtab='rep' id="rep-row-parent-1">
												<div class="col-md-3">
													<div class="form-group">
														<div class="form-check">
															<input type="radio" checked value="persona" id="rep-tipo-persona-1" name="rep-entries[0][tipo_rep]" class="form-check-input">
															<label for="rep-tipo-persona-1" class="form-check-label">Personaje Ficticio</label>
														</div>
														<div class="form-check">
															<input type="radio" value="grupo" class="form-check-input" id="rep-tipo-grupo-1" name="rep-entries[0][tipo_rep]">
															<label for="rep-tipo-grupo-1" class="form-check-label">Grupo de personas</label>
														</div>
													</div>
												</div>
												<div class="col-md persona-group">
													<div class="form-group">
														<label for="rep-input-personaje-1">Personaje</label>
														<input type="text" class="form-control" id="rep-input-personaje-1" name="PROP[<?php echo esc_attr( TABLA_REPARTOS ) ?>][0][personaje]">
													</div>
												</div>
												<div class="col-md persona-group">
													<div class="form-group">
														<label for="rep-input-actor-1">Actor</label>
														<input type="text" class="form-control autocomplete-per" id="rep-input-actor-1" name="PROP[<?php echo esc_attr( TABLA_REPARTOS ) ?>][0][persona_id]">
													</div>
												</div>
												<div class="col-md grupo-group" style="display:none">
													<div class="form-group">
														<label for="rep-input-grupo-1">Nombre del grupo</label>
														<input type="text" class="form-control" id="rep-input-grupo-1" name="PROP[<?php echo esc_attr( TABLA_REPARTOS ) ?>][0][personaje]">
													</div>
												</div>
												<div class="col-1 align-self-end">
													<div class="form-group">
														<a href="#" class="text-secondary js-btn-remove" data-deletes="#rep-row-parent-1" title="Quitar propuesta">
															<span class="fa-stack fa-sm">
																<i class="fa fa-circle-thin fa-stack-2x"></i>
																<i class="fa fa-minus fa-stack-1x"></i>
															</span>
														</a>
													</div> <!-- .form-group -->
												</div> <!-- .col-md-1 -->
											</div>
										</div>
									</div> <!-- #dreparto -->
								</div> <!-- /.tab-content -->
							</form> <!-- #editar-peli-form -->
							</div> <!-- /.card-body -->
							<div class="card-footer text-center">
								<button class="btn btn-light mx-auto cursor-pointer" form="editar-peli-form" name="sub_props" type="submit">Enviar propuestas</button>
							</div>
				</div> <!-- /.card -->
			</div> <!-- /.col-md-12 -->
		</div> <!-- /.row -->
	<?php add_action( 'wp_footer', function(){
		?>
		<script type="text/javascript">
			$('#editar-peli-form').on('submit', function(event){
				let fts = document.querySelectorAll('[name^="PROP[<?php echo TABLA_FICHAS_TECNICAS ?>]"]');
				for (var i = 0; i < fts.length; i++) {
					fts[i].name = fts[i].name.replace(/\d+/, i);
				}
			})
		</script>
	<?php
	}); ?>
