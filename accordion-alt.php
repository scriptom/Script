<?php
global $wpdb;

$sql  = "SELECT personas.per_primer_nombre, personas.per_segundo_nombre, personas.per_primer_apellido, personas.per_segundo_apellido, guiones.tip_car_nombre"
    . " FROM fichas_tecnicas"
    . " JOIN personas ON (fichas_tecnicas.persona_id = personas.id)"
    . " JOIN guiones ON (fichas_tecnicas.tipo_cargo_id = guiones.id)"
    . " JOIN peliculas ON (fichas_tecnicas.pelicula_id = peliculas.id)"
    . ' WHERE peliculas.pel_titulo = "'. get_the_title() . '"';


$this_post_meta = get_post_custom();

$resultsft = $wpdb->get_results($sql, ARRAY_A);

$wpdb->flush();

$sql2  = 'SELECT personas.per_primer_nombre, personas.per_segundo_nombre, personas.per_primer_apellido, repartos.rep_personaje'
    . " FROM `repartos`"
    . " JOIN personas ON (repartos.persona_id = personas.id)"
    . " JOIN peliculas ON (repartos.pelicula_id = peliculas.id)"
    . ' WHERE peliculas.pel_titulo = "'. get_the_title() .'"';

$resultsrep = $wpdb->get_results($sql2, ARRAY_A);
?>


<div class="col-md-4">
    <div class="card">
            <h3 class="card-header">Proceso de Creaci&oacute;n</h3>
            <p class="card-text"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; En este campo se reúnen los aspectos básicos que describen una producción cinematográfica, así como los nombres de las personas encargadas de cada uno tanto en los aspectos artísticos como técnicos,
                entre otros: director, productor, guionista, vestuarista, maquillador, etc. </p>

            <!-- Acordeon perteneciente a proceso de creación -->
            <div id="accordion" role="tablist">
                <div class="card">

                        <h5 class="card-title mb-0">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Pre-Producción</a>
                              </h5>

                    <div id="collapse1" class="collapse" role="tabpanel">
                          <div class="card-body">
                            <?php foreach ($resultsft as $persona) :
                                    $cargo_persona = $persona["tip_car_nombre"];
                                    if (startsWith($cargo_persona, "Direcci")) : ?>
                                <a href="#" data-toggle="modal" data-target="#gridSystemModalDir" >
                                  <?php
                                    $nombre_persona = $persona["per_primer_nombre"] . " " . $persona["per_segundo_nombre"] . " " . $persona["per_primer_apellido"];
                                    unset($persona);
                                    echo $nombre_persona;
                                  ?>
                                </a> <?php echo " - " . $cargo_persona; ?>
                                <br>
                            <?php endif;
                            endforeach;?>
                          </div>
                    </div>
                </div>
                <div class="card card-default">

                        <h5 class="card-title mb-0">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Producción</a>
                        </h5>

                    <div id="collapse2" class="card-collapse collapse">
                      <div class="card-body">
                            <?php foreach ($resultsft as $persona) :
                                    if (true) : ?>
                            <a href="#" data-toggle="modal" data-target="#gridSystemModalDir">Aqui van los asistentes 1</a>
                            <br/>
                          <?php endif;
                        endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="card card-default">

                        <h5 class="card-title mb-0">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Post-Producción</a>
                              </h5>

                    <div id="collapse3" class="card-collapse collapse">
                        <div class="card-body">
                            <a href="#" data-toggle="modal" data-target="#gridSystemModalDir">Fulano</a>
                            <br/>
                            <a href="#" data-toggle="modal" data-target="#gridSystemModalDir">Mengano</a>
                            <br/>
                            <a href="#" data-toggle="modal" data-target="#gridSystemModalDir">Sutano</a>
                            <br/>
                            <a href="#" data-toggle="modal" data-target="#gridSystemModalDir">Perengano</a>
                            <br/>
                            <a href="#" data-toggle="modal" data-target="#gridSystemModalDir">Perensejo</a>
                            <br/>
                        </div>
                    </div>
                </div>
            </div>
    </div>

</div>

<div class="col-md-4">
    <div class="card">
        <h3 class="card-header">Casting</h3>
            <p class="card-text"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; En este campo se contempla o bien el elenco de actores que encarnan los personajes de un guión de ficción, o las personas cuyos testimonios narran o explican los aspectos de una historia narrada
                en un documental.</p>

            <!-- Arcordeon perteneciente a casting -->
              <div id="accordion2" role="tablist">
                <div class="card card-default">

                        <h5 class="card-title mb-0">
                            <a data-toggle="collapse" data-parent="#accordion2" href="#collapse4">Personajes</a>
                        </h5>

                    <div id="collapse4" class="card-collapse collapse">
                        <div class="card-body">
                            <?php
                                    foreach($resultsrep as $row): ?>
                                    <a href="#" data-toggle="modal" data-target="#gridSystemModalDir">
                                        <?php
                                        $nombre_actor = $row['per_primer_nombre'] . " "
                                                  . $row['per_segundo_nombre'] . " "
                                                  . $row['per_primer_apellido'];
                                        echo $nombre_actor;
                                        ?>
                                    </a>
                                <?php if($row['rep_personaje'] <> ""): ?>
                                    <span style="color:#fff"> - <em><?php echo $row['rep_personaje']; ?></em></span>
                                <?php endif; ?>
                                <br>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="card card-default">

                        <h5 class="card-title mb-0">
                                <a data-toggle="collapse" data-parent="#accordion2" href="#collapse5" >Extras</a>
                              </h5>

                    <div id="collapse5" class="card-collapse collapse">
                      <div class="card-body">
                          <a href="#" data-toggle="modal" data-target="#gridSystemModalDir">Fulano</a>
                          <br/>
                          <a href="#" data-toggle="modal" data-target="#gridSystemModalDir">Mengano</a>
                          <br/>
                          <a href="#" data-toggle="modal" data-target="#gridSystemModalDir">Sutano</a>
                          <br/>
                          <a href="#" data-toggle="modal" data-target="#gridSystemModalDir">Perengano</a>
                          <br/>
                          <a href="#" data-toggle="modal" data-target="#gridSystemModalDir">Perensejo</a>
                          <br/>
                      </div>
                    </div>
                </div>
            </div>
    </div>


</div>
<div class="col-md-4">
    <div class="card">
            <h3 class="card-header">DATA</h3>
            <p class="card-text"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; En este campo hay recopilada información relevante sobre la película, tanto desde el punto de vista de su factura (póster, foto fija, locaciones empleadas), como de su desempeño socio-económico
                (monto de inversión, cantidad de espectadores, recaudación en taquilla) o de su apreciación cinematográfica (crítica).</p>

            <!-- Arcordeon perteneciente a ficha tecnica -->
            <div id="accordion3" role="tablist">
                <div class="card card-default">
                        <h5 class="card-title mb-0">
                                <a data-toggle="collapse" data-parent="#accordion3" href="#collapse7">Critica</a>
                              </h5>
                    <div id="collapse7" class="card-collapse collapse">
                        <div class="card-body">
                            <a href="#" data-toggle="modal" data-target="#gridSystemModalDir">"La locura de pelicula del año"</a>
                            <br/>
                        </div>
                    </div>
                </div>
                <div class="card card-default">

                        <h5 class="card-title mb-0">
                                <a data-toggle="collapse" data-parent="#accordion3" href="#collapse8" >Locaciones</a>
                              </h5>

                    <div id="collapse8" class="card-collapse collapse">
                        <div class="card-body">
                            <a href="#" data-toggle="modal" data-target="#gridSystemModalDir">Res. San souci / Chacaito / Caracas / dtto Capital / Vnzla</a>
                            <br/>
                        </div>
                    </div>
                </div>
                <div class="card card-default">

                        <h5 class="card-title mb-0">
                                <a data-toggle="collapse" data-parent="#accordion3" href="#collapse9" >Recaudación</a>
                              </h5>

                    <div id="collapse9" class="card-collapse collapse">
                        <div class="card-body">
                            <a href="#" data-toggle="modal" data-target="#gridSystemModalDir">182993.47 Dolares</a>
                            <br/>
                        </div>
                    </div>
                </div>
            </div>

    </div>

</div>
