 <?php
 global $dbid;
 global $fields;
$data_taquilla = array_filter($fields, function($key){
    return startsWith($key, 'pel_rec') || startsWith($key, 'pel_espec');
}, ARRAY_FILTER_USE_KEY);
error_log(print_r($data_taquilla, true));
$data_direccion = array_filter($fields, function($key){
    return startsWith($key, 'direccion') || startsWith($key, 'director');
}, ARRAY_FILTER_USE_KEY);

$data_produccion = array_filter($fields, function($key){
    return startsWith($key, 'produccion') || startsWith($key, 'productor');
}, ARRAY_FILTER_USE_KEY);

$data_efectos = array_filter($fields, function($key){
    return startsWith($key, 'efectos');
}, ARRAY_FILTER_USE_KEY);

$data_asistentes = array_filter($fields, function($key){
    return startsWith($key, 'asistente');
}, ARRAY_FILTER_USE_KEY);

$data_casas_prod = array_filter($fields, function($key){
    return $key === 'casas_productoras' || $key === 'financiamiento';
}, ARRAY_FILTER_USE_KEY);

$data_criticas = array_filter($fields , function($key){
	return $key === 'criticas';
}, ARRAY_FILTER_USE_KEY);

// Datos tecnicos de la pelicula (Titulo, sinopsis, recaudo, etc.)
// $pelicula = cvnzl_get_movie_main_data( $dbid );
$meta_pelicula = get_post_meta( get_the_ID() );

function mostrar_msj_inexistente() {
    $edit_url = add_query_arg('edit', 1);
    $edit_url = esc_url( $edit_url );
	$msj = "No hay informaci&oacute;n relacionada con esta categor&iacute;a!";
	if ( is_user_logged_in() && current_user_can( 'edit_posts' ) )
		$msj .= " Puedes aportar a nuestra comunidad <a href=\"{$edit_url}\">proporcionando informaci&oacute;n sobre este aspecto</a>";
	echo $msj;
}
?>
<div class="col-md-4 my-3">
    <div class="card inner-shadow bg-dark border border-light">
	    <h3 class="card-header">Ficha T&eacute;cnica</h3>
	    <div class="card-body">
	        <p class="card-text text-justify">En este campo se re&uacute;nen los aspectos b&aacute;sicos que describen una producci&oacute;n cinematogr&aacute;fica, as&iacute; como los nombres de las personas encargadas de cada uno tanto en los aspectos art&iacute;sticos como t&eacute;cnicos,
	            entre otros: director, productor, guionista, vestuarista, maquillador, etc. </p>
	        <!-- Acordeón perteneciente a Ficha Tecnica -->
	    </div> <!-- /.card-body -->
        <div id="accordion" role="tablist">
            <div class="card box-shadow bg-dark m-1 border border-light">
                <h5 class="card-header mb-0 cursor-pointer" data-toggle="collapse" data-parent="#accordion" data-target="#acordeonDirectores">Directores</h5>
                <div id="acordeonDirectores" class="collapse" role="tabpanel">
                    <div class="card-body">
                  	<?php if ( ! empty( $data_direccion ) ) : ?>
                        <?php foreach ( $data_direccion as $cargo => $data ) : ?>
                            <span><?php echo trim( $data['label'], " " ).": "; ?>
                            <?php if ( count( $data['value'] ) > 1 ): ?>
                            	<ul>
                            		<?php foreach ( $data['value'] as $encargado ): ?>
                            			<li><a href="<?php echo(get_permalink( $encargado->ID ) ); ?>" class="text-white"><?php echo trim( $encargado->post_title ); ?></a></li>
                            		<?php endforeach; ?>
                            	</ul>
                            <?php else: ?>
                                <a href="<?php echo get_permalink( $data['value'][0]->ID ); ?>" class="text-white" >
	                                <?php echo trim( $data['value'][0]->post_title ); ?>
	                            </a>
                          	<?php endif; ?>
                        	</span>
                            <br>
                        <?php endforeach; ?>
                    <?php else: mostrar_msj_inexistente(); endif; ?>
                    </div> <!-- /.card-body -->
                </div> <!-- /.collapse -->
            </div> <!-- /.card -->
            <div class="card box-shadow bg-dark m-1 border border-light">
                <h5 class="card-header mb-0 cursor-pointer" data-parent="#accordion" data-target="#acordeonAsistentes" data-toggle="collapse">Asistentes</h5>
                <div id="acordeonAsistentes" class="card-collapse collapse">
                	<div class="card-body">
                	<?php if ( ! empty( $data_asistentes ) ) : ?>
                        <?php foreach ( $data_asistentes as $cargo => $data ) : ?>
							<span><?php echo $data['label']; ?>:
                                <?php if ( count( $data['value'] ) > 1 ) : ?>
                                	<ul>
                                    <?php  foreach ( $data['value'] as $encargado ): ?>
                                    	<li>
                                      		<a class="text-white" href="<?php echo( get_permalink( $encargado->ID ) ); ?>">
                                      		<?php echo trim( $encargado->post_title ); ?>
                                      		</a>
                                    	</li>
                                    <?php endforeach; ?>
                                	</ul>
                                <?php else: ?>
                                    <a class="text-white" href="<?php echo( get_permalink( $data['value'][0]->ID ) ); ?>">
                                    	<?php echo trim( $data['value'][0]->post_title ); ?>
                                	</a>
                                <?php endif; ?>
                            </span>
                            <br>
                            <?php endforeach; ?>
                         <?php else: mostrar_msj_inexistente(); endif; ?>
                        <br/>
                    </div>
                </div>
            </div>
            <div class="card box-shadow bg-dark m-1 border border-light">
                <h5 class="card-header mb-0 cursor-pointer" data-toggle="collapse" data-parent="#accordion" data-target="#acordeonEfectos">Efectos</h5>
                <div id="acordeonEfectos" class="card-collapse collapse">
                    <div class="card-body">
                    	<?php if ( ! empty( $data_efectos ) ) : ?>
                        	<?php foreach ( $data_efectos as $cargo => $data ) : ?>
                            <span><?php echo $data['label'] ?>:
	                            <?php if ( count( $data['value'] ) > 1 ) : ?>
                                <ul>
                                	<?php foreach ( $data['value'] as $encargado ) : ?>
                                    <li>
                                    	<a href="<?php echo get_permalink($encargado->ID); ?>" class="text-white">
                                    		<?php echo trim( $encargado->post_title ); ?>
                                    	</a>
                                    </li>
                                  	<?php endforeach; ?>
                                </ul>
	                            <?php else: ?>
                                <a class="text-white" href="<?php echo( get_permalink( $data['value'][0]->ID ) ); ?>">
                                	<?php echo trim( $data['value'][0]->post_title); ?>
                            	</a>
	                            <?php endif; ?>
                            </span>
                          	<?php endforeach; ?>
                      	<?php else: mostrar_msj_inexistente(); endif ?>
                    </div> <!-- .card-body -->
                </div> <!-- .card-collapse -->
            </div> <!-- /.card -->
        </div>
    </div> <!-- /.card -->
</div> <!-- /.col-md-4 -->
<div class="col-md-4 my-3">
	<div class="card inner-shadow bg-dark border border-light">
		<h3 class="card-header">Reparto</h3>
		<div class="card-body">
			<p class="card-text text-justify">En este campo se contempla o bien el elenco de actores que encarnan los personajes de un gui&oacute;n de ficci&oacute;n, o las personas cuyos testimonios narran o explican los aspectos de una historia narrada
			en un documental.</p>
		</div>
		<!-- Arcordeon perteneciente a reparto -->
		<div id="accordion2" role="tablist">
			<div class="card box-shadow bg-dark m-1 border border-light">
				<h5 class="card-header mb-0 cursor-pointer" data-toggle="collapse" data-parent="#accordion2" data-target="#acordeonPersonajes">Personajes</h5>
				<div id="acordeonPersonajes" class="card-collapse collapse">
					<div class="card-body">
					<?php if ( ! empty( $fields['data_reparto'] ) ): ?>
						<?php foreach ( $fields['data_reparto'] as $personaje ) : ?>
						<span>
                            <?php if (!is_null($personaje['reparto_persona']) && $personaje['reparto_persona'] instanceof WP_Post): ?>
                                
                            <a class="text-white" href="<?php echo( get_search_link( $personaje['reparto_persona']->post_title ) ); ?>">
                                <?php echo trim( $personaje['reparto_persona']->post_title ); ?>
                            </a> 
                                <?php if ($personaje['personaje']): ?>
                                -
                                <i><?php echo trim( $personaje['personaje'] ); ?></i>
                                    
                                <?php endif ?>
                            <?php endif ?>
						</span>
						<br>
						<?php endforeach; ?>
					<?php else: mostrar_msj_inexistente(); endif; ?>
					</div> <!-- /.card-body -->
				</div> <!-- /.card-collapse -->
			</div>
            <div class="card box-shadow bg-dark m-1 border border-light">
                <h5 class="card-header mb-0 cursor-pointer" data-toggle="collapse" data-parent="#accordion2" data-target="#acordeonOtros">Otros</h5>
                <div id="acordeonOtros" class="card-collapse collapse">
                    <div class="card-body">
                    <?php if ( ! empty( $fields['data_reparto'] ) ): ?>
                        <?php foreach ( $fields['data_reparto'] as $personaje ) : ?>
                            <?php if (!($personaje['reparto_persona'])): ?>
                        <span class="text-white">
                            <?php echo trim( $personaje['grupo'] ); ?>
                        </span>
                        <br>
                            <?php endif ?>
                        <?php endforeach; ?>
                    <?php else: mostrar_msj_inexistente(); endif; ?>
                    </div> <!-- /.card-body -->
                </div> <!-- /.card-collapse -->
            </div>
		</div> <!-- /#accordion2 -->
	</div> <!-- /.card -->
</div> <!-- /.col-md-4 -->
<div class="col-md-4 my-3">
    <div class="card inner-shadow bg-dark border border-light">
            <h3 class="card-header">Data</h3>
            <div class="card-body">
	            <p class="card-text text-justify">En este campo hay recopilada informaci&oacute;n relevante sobre la pel&iacute;cula, tanto desde el punto de vista de su factura (p&oacute;ster, foto fija, locaciones empleadas), como de su desempeño socio-econ&oacute;mico (monto de inversi&oacute;n, cantidad de espectadores, recaudaci&oacute;n en taquilla) o de su apreciaci&oacute;n cinematográfica (cr&iacute;tica).</p>
            </div>
            <!-- Arcordeon perteneciente a Data -->
            <div id="accordion3" role="tablist">
                <div class="card bg-dark m-1 border border-light">
                    <h5 class="card-header mb-0 cursor-pointer" data-toggle="collapse" data-parent="#accordion3" data-target="#acordeonCritica">Cr&iacute;tica</h5>
                    <div id="acordeonCritica" class="card-collapse collapse">
                        <div class="card-body">
                            <?php if (array_key_exists('criticas', $fields)): ?>
                                <?php foreach ($criticas as $critica): ?>
                                    <?php if ($critica['contenido'] != ''): ?>
                                <blockquote class="blockquote" cite="<?php echo $critica['fuente'] ?>"><p class="mb-0"><?php echo $critica['contenido'] ?></p></blockquote>
                                <?php if ($critica['fuente'] != ''): ?>
                                    
                                <footer class="text-white blockquote-footer">Fuente: <cite title="Fuente">
                                    <?php if (filter_var($critica['fuente'], FILTER_VALIDATE_URL)): ?>
                                        <a href="<?php echo $critica['fuente'] ?>">enlace externo</a>
                                    <?php else: ?>
                                        <?php echo $critica['fuente'] ?>
                                    <?php endif; ?>
                                </cite></footer>
                                <?php endif ?>
                                <br/>
                                    <?php endforeach ?>
                                        
                                    <?php endif ?>
                            <?php else: mostrar_msj_inexistente(); endif;?>
                        </div>
                    </div>
                </div>
                <div class="card box-shadow bg-dark m-1 border border-light">
                    <h5 class="card-header mb-0 cursor-pointer" data-toggle="collapse" data-parent="#accordion3" data-target="#acordeonLocaciones">Locaciones</h5>
                    <div id="acordeonLocaciones" class="card-collapse collapse">
                        <div class="card-body">
                            <?php if (1===0): ?>
                            <a class="text-white" href="<?php echo( get_search_link( $query ) ); ?>">Res. San souci / Chacaito / Caracas / dtto Capital / Vnzla</a>
                            <br/>
                            <?php else: mostrar_msj_inexistente(); endif; ?>
                        </div>
                    </div>
                </div>
                <div class="card box-shadow bg-dark m-1 border border-light">
                    <h5 class="card-header mb-0 cursor-pointer" data-toggle="collapse" data-parent="#accordion3" data-target="#acordeonTaquilla">Taquilla</h5>
                    <div id="acordeonTaquilla" class="card-collapse collapse">
                        <div class="card-body">
                            <?php
                            if ( ! empty( $data_taquilla ) ):
                                $empties = 0;
                            foreach ( $data_taquilla as $field_name => $field_data ) :
                                if ($field_data) :
                                    $fname = str_replace("pel_", '', $field_name);
                                    $fname = ucfirst( str_replace( "_", ' ', $fname ) );
                                    echo $fname.": ". $field_data."&nbsp;".$field_data["append"];
                                    echo "<br>";
                                else:
                                    $empties++;
                                endif;
                            endforeach;
                            if ($empties === 4) : mostrar_msj_inexistente(); endif;
                            else: mostrar_msj_inexistente();
                            endif; ?>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
