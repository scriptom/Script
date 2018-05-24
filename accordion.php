 <?php
 global $dbid;
 global $fields;
$data_taquilla = array_filter($fields, function($key){
    return startsWith($key, 'pel_rec') || startsWith($key, 'pel_espec');
}, ARRAY_FILTER_USE_KEY);

if (array_key_exists('criticas', $fields)) 
    $criticas = $fields['criticas'];

if (array_key_exists('locaciones', $fields)) 
    $locaciones = $fields['locaciones'];

if (array_key_exists('data_ficha_tecnica', $fields)) {
    $data_ficha_tecnica = $fields['data_ficha_tecnica'];
    $casas_productoras = array();
    $directores = array();
    $productores = array();
    $asistentes = array();
    $efectos = array();
    $disenadores = array();
    $sonidos = array();
    foreach ($data_ficha_tecnica as $responsable) {
        switch ($responsable['tipo_responsable']) {
            case 'casa_productora':
                $casas_productoras[] = $responsable;
                break;
            case 'persona':
                if (startsWith($responsable['cargo']['value'], 'direccion') || startsWith($responsable['cargo']['value'], 'director')) 
                    $directores[] = $responsable;
                else if (startsWith($responsable['cargo']['value'], 'produccion') || startsWith($responsable['cargo']['value'], 'productor'))
                    $productores[] = $responsable;
                else if (startsWith($responsable['cargo']['value'], 'efectos'))
                    $efectos[] = $responsable;
                else if (startsWith($responsable['cargo']['value'], 'asistente') || startsWith($responsable['cargo']['value'], 'asesor'))
                    $asistentes[] = $responsable;
                else if (startsWith($responsable['cargo']['value'], 'disen') || startsWith($responsable['cargo']['value'], 'arte') || startsWith($responsable['cargo']['value'], 'animacion'))
                    $disenadores[] = $responsable;
                else if (startsWith($responsable['cargo']['value'], 'sonid') || endsWith($responsable['cargo']['value'], 'sonid') || endsWith($responsable['cargo']['value'], 'musica') || endsWith($responsable['cargo']['value'], 'musical') ||  startsWith($responsable['cargo']['value'], 'musica'))
                    $sonidos[] = $responsable;
                break;
        }
    }
}
if (array_key_exists('data_reparto', $fields)) {
    $data_reparto = $fields['data_reparto'];
    $otros = array();
    $personajes = array();
    foreach ($data_reparto as $reparto) {
        switch ($reparto['toggle_persona_grupo']) {
            case 'persona':
                $personajes[] = $reparto;
                break;
            
            case 'grupo':
                $otros[] = $reparto;
                break;
        }
    }
}
error_log(print_r($otros, true));
error_log(print_r($personajes, true));
// $meta_pelicula = get_post_meta( get_the_ID() );

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
                  	<?php if ( ! is_null( $directores )  || ! is_null( $productores ) ): ?>
                        <?php if ( (! is_null( $directores )) && (! empty( $directores )) ) : ?>
                            <?php foreach ( $directores as $director ) : ?>
                                <?php $tipo_responsable = $director['tipo_responsable']; ?>
                                <span><?php echo trim( $director['cargo']['label'] ).": "; ?>
                                <?php if ( count( $director["{$tipo_responsable}_responsable"] ) > 1 ): ?>
                                	<ul>
                                		<?php foreach ( $director["{$tipo_responsable}_responsable"] as $responable ): ?>
                                			<li><a href="<?php echo(get_permalink( $responsable->ID ) ); ?>" class="text-white"><?php echo trim( $responsable->post_title ); ?></a></li>
                                		<?php endforeach; ?>
                                	</ul>
                                <?php else: ?>
                                    <a href="<?php echo get_permalink( $director["{$tipo_responsable}_responsable"][0]->ID ); ?>" class="text-white" >
    	                                <?php echo trim( $director["{$tipo_responsable}_responsable"][0]->post_title ); ?>
    	                            </a>
                              	<?php endif; ?>
                            	</span>
                                <br>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php if ( (!is_null($productores)) && (! empty( $productores )) ) : ?>
                            <?php foreach ( $productores as $productor ) : ?>
                                <?php $tipo_responsable = $productor['tipo_responsable']; ?>
                                <span><?php echo trim( $productor['cargo']['label'] ).": "; ?>
                                <?php if ( count( $productor["{$tipo_responsable}_responsable"] ) > 1 ): ?>
                                    <ul>
                                        <?php foreach ( $productor["{$tipo_responsable}_responsable"] as $responable ): ?>
                                            <li><a href="<?php echo(get_permalink( $responsable->ID ) ); ?>" class="text-white"><?php echo trim( $responsable->post_title ); ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <a href="<?php echo get_permalink( $productor["{$tipo_responsable}_responsable"][0]->ID ); ?>" class="text-white" >
                                        <?php echo trim( $productor["{$tipo_responsable}_responsable"][0]->post_title ); ?>
                                    </a>
                                <?php endif; ?>
                                </span>
                                <br>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php else: mostrar_msj_inexistente(); endif; ?>
                    </div> <!-- /.card-body -->
                </div> <!-- /.collapse -->
            </div> <!-- /.card -->
            <div class="card box-shadow bg-dark m-1 border border-light">
                <h5 class="card-header mb-0 cursor-pointer" data-parent="#accordion" data-target="#acordeonAsistentes" data-toggle="collapse">Asistentes</h5>
                <div id="acordeonAsistentes" class="card-collapse collapse">
                	<div class="card-body">
                	<?php if ( (! is_null($asistentes)) && (! empty( $asistentes )) ) : ?>
                        <?php foreach ( $asistentes as $asistente ) : ?>
                            <?php $tipo_responsable = $asistente['tipo_responsable']; ?>
							<span><?php echo trim($asistente['cargo']['label']).": "; ?>
                                <?php if ( count( $asistente["{$tipo_responsable}_responsable"] ) > 1 ) : ?>
                                	<ul>
                                    <?php  foreach ( $asistente["{$tipo_responsable}_responsable"] as $responsable ): ?>
                                    	<li>
                                      		<a class="text-white" href="<?php echo( get_permalink( $responsable->ID ) ); ?>">
                                      		<?php echo trim( $responsable->post_title ); ?>
                                      		</a>
                                    	</li>
                                    <?php endforeach; ?>
                                	</ul>
                                <?php else: ?>
                                    <a class="text-white" href="<?php echo( get_permalink( $asistente["{$tipo_responsable}_responsable"][0]->ID ) ); ?>">
                                    	<?php echo trim( $asistente["{$tipo_responsable}_responsable"][0]->post_title ); ?>
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
                <h5 class="card-header mb-0 cursor-pointer" data-toggle="collapse" data-parent="#accordion" data-target="#acordeonEfectos">Efectos y dise&ntilde;o</h5>
                <div id="acordeonEfectos" class="card-collapse collapse">
                    <div class="card-body">
                    	<?php if (  ! is_null($efectos)  || ! is_null($disenadores) ) : ?>
                            <?php if (! empty( $efectos ) ): ?>
                                <?php foreach ( $efectos as $enc_efecto ) : ?>
                                    <?php $tipo_responsable = $enc_efecto['tipo_responsable']; ?>
                                <span><?php echo trim($enc_efecto['cargo']['label']).": " ?>
                                    <?php if ( count( $enc_efecto["{$tipo_responsable}_responsable"] ) > 1 ) : ?>
                                    <ul>
                                        <?php foreach ( $enc_efecto["{$tipo_responsable}_responsable"] as $responsable ) : ?>
                                        <li>
                                            <a href="<?php echo get_permalink($responsable->ID); ?>" class="text-white">
                                                <?php echo trim( $responsable->post_title ); ?>
                                            </a>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <?php else: ?>
                                    <a class="text-white" href="<?php echo( get_permalink( $enc_efecto["{$tipo_responsable}_responsable"][0]->ID ) ); ?>">
                                        <?php echo trim( $enc_efecto["{$tipo_responsable}_responsable"][0]->post_title); ?>
                                    </a>
                                    <?php endif; ?>
                                </span>
                                <?php endforeach; ?>
                            <?php endif ?>
                            <?php if ( ( ! is_null($disenadores)) && (! empty( $disenadores )) ): ?>
                                <?php foreach ( $disenadores as $disenador ) : ?>
                                    <?php $tipo_responsable = $disenador['tipo_responsable']; ?>
                                <span><?php echo trim($disenador['cargo']['label']).": " ?>
                                    <?php if ( count( $disenador["{$tipo_responsable}_responsable"] ) > 1 ) : ?>
                                    <ul>
                                        <?php foreach ( $disenador["{$tipo_responsable}_responsable"] as $responsable ) : ?>
                                        <li>
                                            <a href="<?php echo get_permalink($responsable->ID); ?>" class="text-white">
                                                <?php echo trim( $responsable->post_title ); ?>
                                            </a>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <?php else: ?>
                                    <a class="text-white" href="<?php echo( get_permalink( $disenador["{$tipo_responsable}_responsable"][0]->ID ) ); ?>">
                                        <?php echo trim( $disenador["{$tipo_responsable}_responsable"][0]->post_title); ?>
                                    </a>
                                    <?php endif; ?>
                                </span>
                                <?php endforeach; ?>
                            <?php endif ?>
                      	<?php else: mostrar_msj_inexistente(); endif ?>
                    </div> <!-- .card-body -->
                </div> <!-- .card-collapse -->
            </div> <!-- /.card -->
            <div class="card box-shadow bg-dark m-1 border border-light">
                <h5 class="card-header mb-0 cursor-pointer" data-toggle="collapse" data-parent="#accordion" data-target="#acordeonMusica">M&uacute;sica y Sonido</h5>
                <div id="acordeonMusica" class="card-collapse collapse">
                    <div class="card-body">
                        <?php if ( (! is_null($sonidos)) && (! empty( $sonidos )) ) : ?>
                            <?php foreach ( $sonidos as $sonido ) : ?>
                                <?php $tipo_responsable = $sonido['tipo_responsable']; ?>
                            <span><?php echo trim($sonido['cargo']['label']).": " ?>
                                <?php if ( count( $sonido["{$tipo_responsable}_responsable"] ) > 1 ) : ?>
                                <ul>
                                    <?php foreach ( $sonido["{$tipo_responsable}_responsable"] as $responsable ) : ?>
                                    <li>
                                        <a href="<?php echo get_permalink($responsable->ID); ?>" class="text-white">
                                            <?php echo trim( $responsable->post_title ); ?>
                                        </a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php else: ?>
                                <a class="text-white" href="<?php echo( get_permalink( $sonido["{$tipo_responsable}_responsable"][0]->ID ) ); ?>">
                                    <?php echo trim( $sonido["{$tipo_responsable}_responsable"][0]->post_title); ?>
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
					<?php if ( !is_null( $personajes ) && (! empty( $personajes )) ): ?>
						<?php foreach ( $personajes as $personaje ) : ?>
                            <?php if ( ! is_null( $personaje['reparto_persona'] ) && $personaje['reparto_persona'] instanceof WP_Post): ?>
						<span>
                                
                            <a class="text-white" href="<?php echo( get_permalink( $personaje['reparto_persona'] ) ); ?>">
                                <?php echo trim( $personaje['reparto_persona']->post_title ); ?>
                            </a> 
                                <?php if ($personaje['personaje'] !== ''): ?>
                                -
                                <i><?php echo trim( $personaje['personaje'] ); ?></i>
                                    
                                <?php endif ?>
						</span>
						<br>
                            <?php endif ?>
						<?php endforeach; ?>
					<?php else: mostrar_msj_inexistente(); endif; ?>
					</div> <!-- /.card-body -->
				</div> <!-- /.card-collapse -->
			</div>
            <div class="card box-shadow bg-dark m-1 border border-light">
                <h5 class="card-header mb-0 cursor-pointer" data-toggle="collapse" data-parent="#accordion2" data-target="#acordeonOtros">Otros</h5>
                <div id="acordeonOtros" class="card-collapse collapse">
                    <div class="card-body">
                    <?php if ( ( ! is_null($otros) ) && ( ! empty( $otros ) ) ): ?>
                        <ol>
                        <?php foreach ( $otros as $otro ) : ?>
                                <?php echo "<li>".$otro['grupo']."</li>"; ?>
                        <?php endforeach; ?>
                        </ol>
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
                            <?php if (!is_null($criticas)): ?>
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
                                    <?php endif; ?>
                                <br/>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else: mostrar_msj_inexistente(); endif;?>
                        </div>
                    </div>
                </div>
                <div class="card box-shadow bg-dark m-1 border border-light">
                    <h5 class="card-header mb-0 cursor-pointer" data-toggle="collapse" data-parent="#accordion3" data-target="#acordeonLocaciones">Locaciones</h5>
                    <div id="acordeonLocaciones" class="card-collapse collapse">
                        <div class="card-body">
                            <?php if (!is_null($locaciones)): ?>
                                <?php foreach ($locaciones as $locacion): ?>
                                    <?php $echo = ''; ?>
                                    <p>
                                        <?php foreach ($locacion as $tipo => $lugar): 
                                            if ($lugar !== '') {
                                                $urlencode = urlencode($lugar);
                                                $echo .= "<a href=\"https://google.com/search?q=$urlencode\">$lugar</a>, ";
                                            }
                                        endforeach;
                                        echo trim($echo, ", "); 
                                        ?>
                                    </p>
                                <?php endforeach ?>
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
                                    echo $fname.": ". $field_data."&nbsp;". ((strpos($field_name, 'recaudo') !== false) ? 'Bs.' : 'personas');
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
