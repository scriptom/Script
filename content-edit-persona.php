<?php
	// include_once ABSPATH .'wp-admin/includes/plugin.php';
	// if (is_plugin_active( 'cvnzl-admin/cvnzl-admin.php' )) {
	// 	$action = plugins_url( 'cvnzl-admin' ).'/process.php';
	// } else {
	// 	wp_die( 'Se requiere el plugin de Cine Venezolano para acceder a esta pagina', 'No se encontro el plugin de Cine Venezolano' );
	// }
	
	// error_log($action);
	// Si no es minimo contributor, no tiene acceso a esta pagina. Mostremos mensaje
	if ( !current_user_can( 'edit_posts' ) ) :
		wp_die( 'No tiene acceso a esta pagina. Probablemente no este registrado o no haya iniciado sesion', 'Error al cargar la página' );
	endif;

	$dbid = get_post_meta( get_the_ID(), '_database_id', true );
	$args2 = array(
		'numberposts' => -1,
		'post_type'   => 'persona',
		'meta_key' 	  => '_per_database_id',
		'orderby'     => 'title'
	);
	
	$query2 = get_posts( $args2 );

	$cargos = cvnzl_get_guiones();

	// $pelicula = cvnzl_get_movie_main_data( $dbid );
	// error_log($pelicula);
	// extract($pelicula);
?>
<?php the_title( '<h1 class="text-center pel-titulo">Editando: ', '</h1>', true ); ?>
		<div class="row justify-content-center">
			<div class="col-md-4">
				<?php if ( has_post_thumbnail() ): ?>
					<img src="<?php the_post_thumbnail_url( 'full' ); ?>" title="<?php the_title_attribute(); ?>" alt="Poster: <?php the_title_attribute(); ?>" class="img-fluid poster rounded">
				<?php else: ?>
					<img src="https://placehold.it/350x200" title="<?php the_title_attribute(); ?>" alt="placeholder" class="img-fluid poster rounded">
				<?php endif; ?>
			</div> <!-- /.col-md-4 -->
		</div> <!-- /.row -->
		<div class="row">
			<div class="col-md-12">
				<div class="card bg-dark border border-light">
					<div class="card-header">
						<nav class="nav nav-pills" role="tablist" id="cambios-tabs">
							<a href="#dgenerales" class="nav-item nav-link active" id="dgenerales-tab" role="tab" data-toggle="tab" aria-selected="true">Datos Generales</a>
							<a href="#dficha-tecnica" class="nav-item nav-link" id="dficha-tecnica-tab" role="tab" data-toggle="tab" aria-selected="false">Ficha Técnica</a>
							<a href="#dgadapt" class="nav-item nav-link" id="dgadapt-tab" role="tab" data-toggle="tab" aria-controls="dgadapt" aria-selected="false">Guiones adaptados</a>
							<a href="#dcritica" class="nav-item nav-link" id="dcritica-tab" role="tab" data-toggle="tab" aria-selected="false">Cr&iacute;tica</a>
							<a href="#dgentem" class="nav-item nav-link" id="dgentem-tab" role="tab" data-toggle="tab" aria-selected="false">Género y Temática</a>
							<a href="#dlugares" class="nav-item nav-link" id="dlugares-tab" role="tab" data-toggle="tab" aria-controls="dlugares" aria-selected="false">Locaciones</a>
							<a href="#dcasas" class="nav-item nav-link" id="dcasas-tab" role="tab" data-toggle="tab" aria-controls="dcasas" aria-selected="false">Casas Productoras</a>
							<a href="#dreparto" class="nav-item nav-link" id="dreparto-tab" role="tab" data-toggle="tab" aria-controls="dreparto" aria-selected="false">Reparto</a>

						</nav> <!-- /#cambios-tabs --> 
					</div>
					<div class="card-body">
						<form id="editar-peli-form">
							<input type="hidden" name="dbid" value="<?php echo $dbid; ?>">
							<div class="tab-content">
									<div class="tab-pane fade show active" id="dgenerales" aria-labelledby="dgenerales-tab" role="tabpanel">
										<h2 class="text-center">Datos Generales</h2>
										<div class="row">
											<div class="col-md-6">
												<h3 class="text-center">T&iacute;tulo</h3>
											</div> <!-- /.col-md-6 -->
											<div class="col-md-6">
												<input type="text" name="pel_titulo" value="<?php echo get_the_title(); ?>" disabled class="form-control disabled">
											</div> <!-- /.col-md-6 -->
											<div class="col-md-6 align-self-center">
												<h3 class="text-center">Proponer Sin&oacute;psis</h3>
											</div> <!-- /.col-md-6 -->
											<div class="col-md-6">
												<textarea style="resize:none" name="propuesta_sinopsis" id="propuesta-sinopsis" cols="30" rows="10" class="form-control" placeholder="<?php echo get_the_content(); ?>"></textarea> <!-- /.textarea -->
												<div class="form-check form-check-inline">
												 	<label class="form-check-label" for="cb_hedit">
														<input type="checkbox" name="habilitar_edicion" class="form-check-input" id="cb_hedit">
														Editar sin&oacute;psis actual
													</label>
												</div> <!-- /.form-check -->
											</div> <!-- /.col-md-6 -->
										</div> <!-- /.row -->
									</div> <!-- /.tab-pane -->
									<div class="tab-pane fade" id="dficha-tecnica" aria-labelledby="dficha-tecnica-tab" role="tabpanel">
										<h2 class="text-center mb-3">Ficha T&eacute;cnica</h2>
										<div class="form-row align-items-start">
											<div class="col-md-6">
												<fieldset class="fieldset">
													<legend class="h5">Cargos Personales
														<small class="icon-wrap">
															<a href="#" class="js-add-new text-secondary" data-adds='ft' id="ft-btn-add" title="A&ntilde;adir nuevo">
																<span class="fa-stack fa-sm">
																	<i class="fa fa-circle-thin fa-stack-2x"></i>
																	<i class="fa fa-plus fa-stack-1x"></i>
																</span>
															</a>
														</small>
													</legend>
													<div id="ft-container">
														<div class="ft form-row" data-rowtab="ft" id="ft-row-parent-1">
															<div class="col-xs-5 col-md-5">
																<div class="form-group">
																	<label for="ft-input-resp-1">La persona</label>
																	<input type="text" class="form-control js-search-per" list="ft-cargos" id="ft-input-resp-1" name="ft-entries[0][nombre]">

																	<!-- <datalist id="ft-cargos" class="js-datalist">
																			<?php// foreach ($query2 as $post) :?>
																			<?php //$database_id = get_post_meta( $post->ID, '_per_database_id', true ); ?>
																				<option value="<?php //echo $post->post_title ?>"><?php //echo $database_id; ?></option>
																			<?php //endforeach; ?>
																			<?php //reset_postdata(); ?>
																	</datalist> -->
																</div> <!-- .form-group -->
															</div>
															<div class="col-xs-5 col-md-6">
																<div class="form-group">
																	<label for="ft-select-puesto-1">Tuvo el cargo de</label>
																	<select name="ft-entries[0][cargo]" id="ft-select-puesto-1" class="form-control select-puesto">
																		<option value="0">Seleccione un campo</option>
																		<?php foreach ($cargos as $cargo): ?>
																		<option value="<?php echo $cargo['id']; ?>"><?php echo $cargo["tip_car_nombre"]; ?></option>
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
												</div>
												</fieldset>
											<div class="col-md-6">
												<fieldset class="fieldset">
													<legend class="h5">
													Empresariales
														<small class="icon-wrap">
															<a href="#" class="js-add-new text-secondary" data-adds='cp' id="cp-btn-add" title="A&ntilde;adir nuevo">
																<span class="fa-stack fa-sm">
																	<i class="fa fa-circle-thin fa-stack-2x"></i>
																	<i class="fa fa-plus fa-stack-1x"></i>
																</span>
															</a>
														</small>
													</legend>
													<div id="cp-container">
														<div class="cp form-row" data-rowtab="cp" id="cp-row-parent-1">
															<div class="col-xs-5 col-md-5">
																<div class="form-group">
																	<label for="cp-input-resp-1">La compa&ntilde;&iacute;a</label>
																	<input type="text" class="form-control js-search-per" list="cp-cargos" id="cp-input-resp-1" name="cp-entries[0][nombre]">

																	<!-- <datalist id="cp-cargos" class="js-datalist">
																			<?php// foreach ($query2 as $post) :?>
																			<?php //$database_id = get_post_meta( $post->ID, '_per_database_id', true ); ?>
																				<option value="<?php //echo $post->post_title ?>"><?php //echo $database_id; ?></option>
																			<?php //endforeach; ?>
																			<?php //reset_postdata(); ?>
																	</datalist> -->
																</div> <!-- .form-group -->
															</div>
															<div class="col-xs-5 col-md-6">
																<div class="form-group">
																	<label for="cp-select-puesto-1">Particip&oacute; como</label>
																	<select name="cp-entries[0][cargo]" id="cp-select-puesto-1" class="form-control select-puesto">
																		<option value="0">Seleccione un campo</option>
																		<?php foreach ($cargos as $cargo): ?>
																		<option value="<?php echo $cargo['id']; ?>"><?php echo $cargo["tip_car_nombre"]; ?></option>
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
													</div> <!-- .col-md-12 -->
												</div>
											</fieldset>
										</div>
									</div> <!-- /.tab-pane -->
									<div class="tab-pane fade" id="dcritica" aria-labelledby="dcritica-tab" role="tabpanel">
										<h2 class="text-center">Cr&iacute;tica</h2>
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
														<div class="col-3">
															<div class="form-check">
																<label class="form-check-label">
																	<input type="checkbox" name="generos[]" class="form-check-input" value="<?php echo $gen_nombre; ?>" <?php if( $has_genre ) echo "checked"; ?>>
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
													<div class="col-3">	
														<div class="form-check">
															<label class="form-check-label">
																<input type="checkbox" value="<?php echo $tem_nombre; ?>" name="tematicas[]" class="form-check-input" <?php if( $has_tem ) echo "checked"; ?>>
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
										<h5>Nueva locaci&oacute;n
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
											<div class="lug form-row" data-rowtab='lug' id="lug-row-parent-1">
												<div class="col-md-3">
													<div class="form-group">
														<label for="lug-input-edf-1">Lugar f&iacute;sico</label>
														<input type="text" class="form-control" id="lug-input-edf-1" name="lug-entries[0][edf]">
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label for="lug-input-ciudad-1">Ciudad</label>
														<input type="text" class="form-control" id="lug-input-ciudad-1" name="lug-entries[0][ciudad]">
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label for="lug-input-estado-1">Estado</label>
														<input type="text" class="form-control" id="lug-input-estado-1" name="lug-entries[0][estado]">
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label for="lug-input-pais-1">Pa&iacute;s</label>
														<input type="text" class="form-control" id="lug-input-pais-1" name="lug-entries[0][pais]">
													</div>
												</div>
												<div class="col-md-1 align-self-end">
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
									<div class="tab-pane fade" id="dcasas" aria-labelledby="dcasas-tab" role="tabpanel">
										<h2 class="text-center">Casas Productoras</h2>
										<h5>A&ntilde;adir Nuevo
											<small class="icon-wrap">
												<a href="#" class="js-add-new text-secondary" data-adds="cp" id="cp-btn-add" title="A&ntilde;adir nuevo">
													<span class="fa-stack fa-sm">
														<i class="fa fa-circle-thin fa-stack-2x"></i>
														<i class="fa fa-plus fa-stack-1x"></i>
													</span>
												</a>
											</small>
										</h5>
										<div class="col-md-12" id="cp-container">
											<div class="cp form-row" data-rowtab="cp" id="cp-row-parent-1">
												<div class="col-md-5">
													<div class="form-group">
														<label for="cp-input-name-1">Nombre de la Casa</label>
														<input type="text" class="form-control" id="cp-input-name-1" name="cp-entries[0][cp_nom]">
													</div>
												</div>
											</div>
										</div>
									</div> <!-- #dcasas -->
									<div class="tab-pane fade" id="dreparto" aria-labelledby="dreparto-tab" role="tabpanel">
										<h2 class="text-center">Reparto</h2>
									</div> <!-- #dreparto -->
									<div class="tab-pane fade" id="dgadapt" aria-labelledby="dgadapt-tab" role="tabpanel">
										<h2 class="text-center">Guiones Adaptados</h2>
									</div> <!-- #dgadapt -->
							</div> <!-- /.tab-content -->						
						</div> <!-- /.card-body -->
						<div class="card-footer">
							<button class="btn btn-light mx-auto cursor-pointer" name="sub_props" type="submit">Enviar propuestas</button>
						</div>
					</form> <!-- #editar-peli-form -->
				</div> <!-- /.card -->
			</div> <!-- /.col-md-12 -->
		</div> <!-- /.row -->
