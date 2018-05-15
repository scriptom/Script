<?php
require_once( 'class-wp-bootstrap-navwalker.php' );
require_once( 'utils-functs.php' );
//include_once('updater.php');
// Inicializar updater
// if (is_admin()) {
// 		$config = array(
// 			'slug' => 'cvnzl', // this is the slug of your plugin
// 			'proper_folder_name' => 'Script', // this is the name of the folder your plugin lives in
// 			'api_url' => 'https://api.github.com/repos/scriptom/Script', // the GitHub API url of your GitHub repo
// 			'raw_url' => 'https://raw.github.com/scriptom/Script/master', // the GitHub raw url of your GitHub repo
// 			'github_url' => 'https://github.com/scriptom/Script', // the GitHub url of your GitHub repo
// 			'zip_url' => 'https://github.com/scriptom/Script/zipball/master', // the zip url of the GitHub repo
// 			'sslverify' => false, // whether WP should check the validity of the SSL cert when getting an update, see https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/2 and https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/4 for details
// 			'requires' => '4.7', // which version of WordPress does your plugin require?
// 			'tested' => '4.7.2', // which version of WordPress is your plugin tested up to?
// 			'readme' => 'README.md', // which file to use as the readme for the version number
// 		);
// 		new WP_GitHub_Updater($config);
// 	}
if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
	'key' => 'group_5ab3e7920cc28',
	'title' => 'Guiones adaptados',
	'fields' => array(
		array(
			'key' => 'field_es_adaptado',
			'label' => 'Es adaptación?',
			'name' => 'es_adaptado',
			'type' => 'true_false',
			'instructions' => 'Indique si esta película es adaptada',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 1,
			'ui_on_text' => 'Sí',
			'ui_off_text' => 'No',
		),
		array(
			'key' => 'field_autor_de_obra_original',
			'label' => 'Autor de Obra Original',
			'name' => 'autor_de_obra_original',
			'type' => 'post_object',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_es_adaptado',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array(
				0 => 'persona',
			),
			'taxonomy' => array(
			),
			'allow_null' => 0,
			'multiple' => 0,
			'return_format' => 'object',
			'ui' => 1,
		),
		array(
			'key' => 'field_obra_original',
			'label' => 'Obra Original',
			'name' => 'obra_original',
			'type' => 'text',
			'instructions' => 'Ingrese el nombre de la obra original de la que fue adaptada esta película',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_es_adaptado',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'pelicula',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5ad4cb5d13449',
	'title' => 'Nosotros Data',
	'fields' => array(
		array(
			'key' => 'field_texto_equipo_cic',
			'label' => 'Texto Equipo CIC',
			'name' => 'texto_equipo_cic',
			'type' => 'wysiwyg',
			'instructions' => 'Texto que describe al Centro',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
			'delay' => 0,
		),
		array(
			'key' => 'field_mapa_nosotros',
			'label' => 'Mapa Nosotros',
			'name' => 'mapa_nosotros',
			'type' => 'google_map',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'center_lat' => '10.4642',
			'center_lng' => '-66.9779887',
			'zoom' => '',
			'height' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'page',
				'operator' => '==',
				'value' => '689',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5ab3b3cca2aef',
	'title' => 'Otro contenido de interés',
	'fields' => array(
		array(
			'key' => 'field_enlaces_de_interes',
			'label' => 'Enlaces de interés',
			'name' => 'enlaces_de_interes',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => 'field_enlace_interes',
			'min' => 0,
			'max' => 0,
			'layout' => 'table',
			'button_label' => 'Añadir enlace',
			'sub_fields' => array(
				array(
					'key' => 'field_enlace_interes',
					'label' => 'Enlace',
					'name' => 'enlace_interes',
					'type' => 'text',
					'instructions' => 'Dirección del enlace. Por favor compruebe que el enlace sea válido',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
			),
		),
		array(
			'key' => 'field_ruta_captura',
			'label' => 'Fotos de la película',
			'name' => 'ruta_captura',
			'type' => 'gallery',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'min' => '',
			'max' => '',
			'insert' => 'append',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => 'jpg,jpeg,png,bmp,',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'pelicula',
			),
		),
	),
	'menu_order' => 1,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5ab170f93ee51',
	'title' => 'Datos Personas',
	'fields' => array(
		array(
			'key' => 'field_per_fecha_nac',
			'label' => 'Fecha Nacimiento',
			'name' => 'per_fecha_nacimiento',
			'type' => 'date_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'first_day' => 1,
			'return_format' => 'd/m/Y',
			'display_format' => 'd/m/Y',
			'save_format' => 'yyyymmdd',
		),
		array(
			'key' => 'field_per_fecha_falle',
			'label' => 'Fecha Fallecimiento',
			'name' => 'per_fecha_fallecimiento',
			'type' => 'date_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'first_day' => 1,
			'return_format' => 'd/m/Y',
			'display_format' => 'd/m/Y',
			'save_format' => 'yyyymmdd',
		),
		array(
			'key' => 'field_per_sexo',
			'label' => 'Sexo',
			'name' => 'per_sexo',
			'type' => 'radio',
			'instructions' => 'Especifica el sexo de la persona',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'M' => 'Masculino',
				'F' => 'Femenino',
			),
			'allow_null' => 0,
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => '',
			'layout' => 'horizontal',
			'return_format' => 'value',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'persona',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'side',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5ab1710b1ec5b',
	'title' => 'Películas',
	'fields' => array(
		array(
			'key' => 'field_ficha_tecnica',
			'label' => 'Data Ficha Técnica',
			'name' => 'data_ficha_tecnica',
			'type' => 'repeater',
			'instructions' => 'Agrega filas de la ficha técnica',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => 'field_per_responsable',
			'min' => 0,
			'max' => 0,
			'layout' => 'block',
			'button_label' => 'Agregar Registro',
			'sub_fields' => array(
				array(
					'key' => 'field_tipo_responsable',
					'label' => 'Tipo responsable',
					'name' => 'tipo_responsable',
					'type' => 'radio',
					'instructions' => 'Especifique si el responsable de este cargo fue una persona o una casa productora (u organización)',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'persona' => 'Persona',
						'casa_productora' => 'Casa Productora',
					),
					'allow_null' => 0,
					'other_choice' => 0,
					'save_other_choice' => 0,
					'default_value' => '',
					'layout' => 'horizontal',
					'return_format' => 'value',
				),
				array(
					'key' => 'field_cargo_part',
					'label' => 'Cargo',
					'name' => 'cargo',
					'type' => 'select',
					'instructions' => 'Cargo de participación de la persona',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'administracion' => 'Administración',
						'ambientacion' => 'Ambientación',
						'animacion' => 'Animación',
						'arte' => 'Arte',
						'asesor_tecnico' => 'Asesor Técnico',
						'asistente_de_camara' => 'Asistente de cámara',
						'asistente_de_direccion' => 'Asistente de dirección',
						'asistente_de_fotografia' => 'Asistente de Fotografía',
						'asistente_de_jefe_de_electricos' => 'Asistende de Jefe de Eléctricos',
						'asistente_de_produccion' => 'Asistente de Producción',
						'asistente_de_sonido' => 'Asistente de Sonido',
						'audio' => 'Audio',
						'autor_de_obra_original' => 'Autor de Obra Original',
						'banda_sonora' => 'Banda sonora',
						'camara' => 'Cámara',
						'carpinteria' => 'Carpintería',
						'casa_productora' => 'Casa Productora',
						'casting' => 'Casting',
						'catalogador' => 'Catalogador',
						'cinematografia' => 'Cinematografía',
						'color' => 'Color',
						'compania_de_distribucion' => 'Compañía de distribución',
						'compositor_y_productor_musical' => 'Compositor y Productor Musical',
						'coordinador_de_casting' => 'Coordinador de Casting',
						'co-produccion' => 'Co-producción',
						'coproductor: Coproductor' => 'coproductor: Coproductor',
						'departamento_de_arte' => 'Departamento de Arte',
						'departamento_de_musica' => 'Departamento de Música',
						'departamento_editorial' => 'Departamento Editorial',
						'direccion' => 'Dirección',
						'direccion_de_arte' => 'Dirección de Arte',
						'direccion_de_casting' => 'Dirección de Casting',
						'direccion_de_efectos_visuales' => 'Dirección de Efectos Visuales',
						'direccion_de_fotografia' => 'Dirección de Fotografía',
						'direccion_de_laboratorio' => 'Dirección de Laboratorio',
						'direccion_de_post_produccion' => 'Dirección de Post Producción',
						'direccion_de_produccion' => 'Dirección de producción',
						'direccion_de_sonido' => 'Dirección de Sonido',
						'direccion_musical' => 'Dirección Musical',
						'disenador_de_vestuario' => 'Diseñador de Vestuario',
						'diseno_de_banda_sonora' => 'Diseño de banda sonora',
						'diseno_de_direccion_de_arte' => 'Diseño de dirección de arte',
						'diseno_de_produccion' => 'Diseño de Producción',
						'diseno_de_sonido' => 'Diseño de Sonido',
						'diseno_de_titulos' => 'Diseño de Títulos',
						'diseno_de_vestuario' => 'Diseño de Vestuario',
						'diseno_de_vestuario_gala' => 'Diseño de vestuario gala',
						'diseno_grafico' => 'Diseño gráfico',
						'diseno_sonoro' => 'Diseño Sonoro',
						'diseno_y_mezcla_de_sonido' => 'Diseño y Mezcla de Sonido',
						'distribucion' => 'Distribución',
						'edicion' => 'Edición',
						'edicion_de_sonido' => 'Edición de Sonido',
						'efectos' => 'Efectos',
						'efectos_de_post-produccion' => 'Efectos de Post-producción',
						'efectos_de_sonido _ Efectos de sonido' => 'efectos_de_sonido _ Efectos de sonido',
						'efectos_digitales' => 'Efectos Digitales',
						'efectos_especiales' => 'Efectos Especiales',
						'efectos_visuales' => 'Efectos Visuales',
						'electricista' => 'Eléctricista',
						'escenografia' => 'Escenografía',
						'estilista' => 'Estilista',
						'foquista' => 'Foquista',
						'foto_fija' => 'Foto Fija',
						'fotografia_adicional' => 'Fotografía Adicional',
						'gaffer' => 'Gaffer',
						'gerente_general' => 'Gerente General',
						'gestion_de_produccion' => 'Gestión de producción',
						'grabaciones _originales' => 'Grabaciones originales',
						'iluminacion' => 'Iluminación',
						'interpretacion_vocal' => 'Interpretación vocal',
						'jefatura_de_produccion' => 'Jefatura de Producción',
						'jefe_de_casting' => 'Jefe de Casting',
						'jefe_de_maquina' => 'Jefe de máquina',
						'jefe_electrico' => 'Jefe Eléctrico',
						'laboratorio' => 'Laboratorio',
						'locucion' => 'Locución',
						'maquillaje' => 'Maquillaje',
						'metraje' => 'Metraje',
						'mezcla_de_sonido' => 'Mezcla de Sonido',
						'microfonista' => 'Microfonista',
						'montaje' => 'Montaje',
						'musica' => 'Música',
						'musica_original' => 'Música original',
						'musicalizacion' => 'Musicalización',
						'musico_invitado' => 'Músico Invitado',
						'narracion' => 'Narración',
						'produccion' => 'Producción',
						'produccion_asignada' => 'Producción asignada',
						'produccion_asociada' => 'Producción asociada',
						'producción_de_arte' => 'Producción de Arte',
						'produccion_de_campo' => 'Producción de campo',
						'produccion_ejecutiva' => 'Producción Ejecutiva',
						'produccion_en_linea' => 'Producción en línea',
						'produccion_general' => 'Producción General',
						'productor_asociado' => 'Productor asociado',
						'productor_de_campo' => 'Productor de Campo',
						'productor_delegado' => 'Productor Delegado',
						'productor_ejecutivo' => 'Productor ejecutivo',
						'productor_musical' => 'Productor Musical',
						'realizacion_de_arte' => 'Realización de arte',
						'reproducciones_de_objetos' => 'Reproducciones de Objetos',
						'reproducciones_pictoricas' => 'Reproducciones Pictóricas',
						'script' => 'Script',
						'secretaria_de_rodaje' => 'Secretaria de Rodaje',
						'segundo_asistente_de_direccion' => 'Segundo asistente de dirección',
						'set_de_decoracion' => 'set de decoración',
						'sonidista' => 'Sonidista',
						'sonido_ce_campo' => 'Sonido de campo',
						'sonido_directo' => 'Sonido Directo',
						'soprano_solista' => 'Soprano Solista',
						'supervision_de_efectos_especiales' => 'Supervisión de Efectos Especiales',
						'supervisor_de_postproduccion' => 'Supervisor de Postproducción',
						'supervisor_musical' => 'Supervisor Musical',
						'tema_musical' => 'Tema musical',
						'titulos' => 'Títulos',
						'transporte' => 'Transporte',
						'utileria' => 'Utilería',
						'vestuario' => 'Vestuario',
						'vocalizacion' => 'Vocalización',
						'voces_de_la_radio' => 'Voces de la Radio',
						'voz_que_relata' => 'Voz que relata',
						'patrocinio' => 'Patrocinio',
						'marketing' => 'Marketing',
						'asistente_de_maquina' => 'Asistente de Máquina',
						'asistente_de_maquillaje' => 'Asistente de Maquillaje',
						'guion_adaptado' => 'Guión Adaptado',
					),
					'default_value' => array(
					),
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 1,
					'ajax' => 0,
					'return_format' => 'array',
					'placeholder' => '',
				),
				array(
					'key' => 'field_per_responsable',
					'label' => 'Persona Responsable',
					'name' => 'persona_responsable',
					'type' => 'post_object',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_tipo_responsable',
								'operator' => '==',
								'value' => 'persona',
							),
						),
					),
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'post_type' => array(
						0 => 'persona',
					),
					'taxonomy' => array(
					),
					'allow_null' => 0,
					'multiple' => 1,
					'return_format' => 'object',
					'ui' => 1,
				),
				array(
					'key' => 'field_casa_productora_responsable',
					'label' => 'Casa Productora Responsable',
					'name' => 'casa_productora_responsable',
					'type' => 'post_object',
					'instructions' => 'Especifique la casa productora que realizó este cargo en la película',
					'required' => 0,
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_tipo_responsable',
								'operator' => '==',
								'value' => 'casa_productora',
							),
						),
					),
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'post_type' => array(
						0 => 'casa_productora',
					),
					'taxonomy' => array(
					),
					'allow_null' => 0,
					'multiple' => 1,
					'return_format' => 'object',
					'ui' => 1,
				),
			),
		),
		array(
			'key' => 'field_reparto',
			'label' => 'Data Reparto',
			'name' => 'data_reparto',
			'type' => 'repeater',
			'instructions' => 'Aquí se llena la sección de Repartos',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => 'field_toggle_persona_grupo',
			'min' => 0,
			'max' => 0,
			'layout' => 'block',
			'button_label' => 'Agregar Registro',
			'sub_fields' => array(
				array(
					'key' => 'field_toggle_persona_grupo',
					'label' => 'Cambio: persona	o grupo',
					'name' => 'toggle_persona_grupo',
					'type' => 'radio',
					'instructions' => 'Indique si el participante es una persona (Ej: Fulano Pérez) o un grupo de personas que experimentaron algo (Útil para los documentales)',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'persona' => 'Persona',
						'grupo' => 'Grupo',
					),
					'allow_null' => 0,
					'other_choice' => 0,
					'save_other_choice' => 0,
					'default_value' => 'persona',
					'layout' => 'vertical',
					'return_format' => 'value',
				),
				array(
					'key' => 'field_group_desc',
					'label' => 'Grupo',
					'name' => 'grupo',
					'type' => 'text',
					'instructions' => 'Si es un documental, indique el grupo que vivió las experiencias narradas',
					'required' => 0,
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_toggle_persona_grupo',
								'operator' => '==',
								'value' => 'grupo',
							),
						),
					),
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_persona_actor',
					'label' => 'Persona',
					'name' => 'reparto_persona',
					'type' => 'post_object',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_toggle_persona_grupo',
								'operator' => '==',
								'value' => 'persona',
							),
						),
					),
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'post_type' => array(
						0 => 'persona',
					),
					'taxonomy' => array(
					),
					'allow_null' => 0,
					'multiple' => 0,
					'return_format' => 'object',
					'ui' => 1,
				),
				array(
					'key' => 'field_personaje_nombre',
					'label' => 'Personaje',
					'name' => 'personaje',
					'type' => 'text',
					'instructions' => 'Indique el nombre del personaje que representa',
					'required' => 0,
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_toggle_persona_grupo',
								'operator' => '==',
								'value' => 'persona',
							),
						),
					),
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'pelicula',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5ab170f974d6d',
	'title' => 'Taquilla',
	'fields' => array(
		array(
			'key' => 'field_pel_recaudo_estreno',
			'label' => 'Recaudo Estreno',
			'name' => 'pel_recaudo_estreno',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => 'Bs.',
			'min' => '',
			'max' => '',
			'step' => '',
		),
		array(
			'key' => 'field_pel_recaudo_acumulado',
			'label' => 'Recaudo Acumulado',
			'name' => 'pel_recaudo_acumulado',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => 'Bs.',
			'min' => '',
			'max' => '',
			'step' => '',
		),
		array(
			'key' => 'field_pel_espectadores_estreno',
			'label' => 'Espectadores Estreno',
			'name' => 'pel_espectadores_estreno',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => 'personas',
			'min' => '',
			'max' => '',
			'step' => 1,
		),
		array(
			'key' => 'field_pel_espectadores_acumulado',
			'label' => 'Espectadores Acumulado',
			'name' => 'pel_espectadores_acumulado',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => 'personas',
			'min' => '',
			'max' => '',
			'step' => 1,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'pelicula',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'side',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array(
	),
	'active' => 1,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5ab3adbfb8e74',
	'title' => 'Data',
	'fields' => array(
		array(
			'key' => 'field_pel_ano',
			'label' => 'Año estreno',
			'name' => 'pel_ano',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => ''
			),
			'default_value' => '',
			'placeholder' => 'Ej. '.date('Y'),
			'prepend' => '',
			'append' => '',
			'min' => '1897',
			'max' => date('Y')+5,
			'step' => 1,
		),
		array(
			'key' => 'field_criticas',
			'label' => 'Críticas',
			'name' => 'criticas',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => 0,
			'max' => 0,
			'layout' => 'table',
			'button_label' => 'Añadir crítica',
			'sub_fields' => array(
				array(
					'key' => 'field_cri_contenido',
					'label' => 'Contenido',
					'name' => 'contenido',
					'type' => 'textarea',
					'instructions' => 'Aquí se plasma el contenido de la crítica',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => 'Introduzca aquí la crítica',
					'maxlength' => '',
					'rows' => '',
					'new_lines' => 'wpautop',
				),
				array(
					'key' => 'field_cri_fuente',
					'label' => 'Fuente',
					'name' => 'fuente',
					'type' => 'text',
					'instructions' => 'Aquí se coloca de dónde se sacó la crítica (sea enlace, sea persona)',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => 'El nombre o enlace aquí',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
			),
		),
		array(
			'key' => 'field_locaciones',
			'label' => 'Locaciones',
			'name' => 'locaciones',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => 0,
			'max' => 0,
			'layout' => 'table',
			'button_label' => 'Añadir locación',
			'sub_fields' => array(
				array(
					'key' => 'field_lug_fisico',
					'label' => 'Lugar físico',
					'name' => 'lug_edf',
					'type' => 'text',
					'instructions' => 'El lugar físico (Edificio, museo, casa, etc.) relevante a esta película',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_lug_ciudad',
					'label' => 'Ciudad',
					'name' => 'lug_ciudad',
					'type' => 'text',
					'instructions' => 'Ciudad relevante para la producción de esta película',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_lug_estado',
					'label' => 'Estado',
					'name' => 'lug_estado',
					'type' => 'text',
					'instructions' => 'Estado relevante en la producción de la película',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_lug_pais',
					'label' => 'País',
					'name' => 'lug_pais',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'pelicula',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;
define( 'CVNZL_STYLE_DIRECTORY', get_stylesheet_directory_uri() );
function cnvzl_theme_setup() {
	// Soporte para thumbnails
	add_theme_support( 'post-thumbnails' );

	// Soporte para imágenes de fondo
	add_theme_support( 'custom-background' );

	// Soporte para el banner
	add_theme_support( 'custom-header' );

	// Soporte para el título de cada página
	add_theme_support( 'title-tag' );

	// Habilitar menús
	register_nav_menus( array(
		'primary' => __( 'Navegacion', 'cvnzl' ),
		'accounts' => __( 'Cuentas', 'cvnzl' )
	));

}
add_action( 'after_setup_theme', 'cnvzl_theme_setup' );

function cvnzl_register_scripts() {
	wp_enqueue_style( 'font-awesome', CVNZL_STYLE_DIRECTORY . '/css/font-awesome.css' );
	wp_enqueue_style( 'bootstrap', "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" );
	wp_enqueue_style( 'site-styles', CVNZL_STYLE_DIRECTORY. '/style.css', array( 'bootstrap' ) );
	wp_enqueue_style( 'jquery-ui', CVNZL_STYLE_DIRECTORY. '/css/jquery-ui.min.css' );
	wp_enqueue_style( 'jquery-ui-theme-ui-darkness', CVNZL_STYLE_DIRECTORY. '/css/theme.css', array( 'jquery-ui' ) );

	wp_enqueue_script( 'popper-js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', array( 'jquery' ), '1.11.0', true );
	wp_enqueue_script( 'bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array( 'jquery', 'popper-js' ), '4.0.0', true );
	// wp_enqueue_script( 'window-resize-js', CVNZL_STYLE_DIRECTORY. '/js/window-resize.js', array( 'jquery' ), '1.0' );
	wp_enqueue_script( 'holder', CVNZL_STYLE_DIRECTORY. '/js/holder.min.js' );
	if ( is_page( 'busqueda' ) )
		wp_enqueue_script( 'search-form-js', CVNZL_STYLE_DIRECTORY. '/js/search-form.js', array( 'jquery', 'window-resize-js' ), '1.0' );
	if ( is_edit_page() ) {
		wp_enqueue_script( 'rowmanager', CVNZL_STYLE_DIRECTORY. '/js/managerows.js', array( 'jquery' ), '1.0' );
		wp_enqueue_script( 'edit-movie-test-js', CVNZL_STYLE_DIRECTORY. '/js/edit-movie-test.js', array( 'jquery', 'rowmanager', 'jquery-ui-autocomplete' ), '1.0' );
		wp_enqueue_script( 'jquery-ui-autocomplete' );
		// wp_enqueue_script( 'edit-movie-js', get_stylesheet_directory_uri(). '/js/edit-movie.js', array( 'jquery' ), '1.0' );
		wp_localize_script('edit-movie-test-js', 'ah', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' )
		));
	}
}
add_action( 'wp_enqueue_scripts', 'cvnzl_register_scripts' );

function cnvzl_register_widgets()
{
	register_sidebar( array(
		'name' => 'Barra Lateral',
		'id' => 'sidebar-1',
		'description' => 'Contenidos de la barra lateral',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => "</li>",
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => "</h2>"
	));

	register_sidebar( array(
		'name' => 'Footer 1',
		'id' => 'footer-1',
		'description' => __('Contenido que va en la sección 1 del footer'),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => "</li>",
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => "</h2>"
	));

	register_sidebar( array(
		'name' => 'Footer 2',
		'id' => 'footer-2',
		'description' => __('Contenido que va en la sección 2 del footer'),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => "</li>",
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => "</h2>"
	));

	register_sidebar( array(
		'name' => 'Footer 3',
		'id' => 'footer-3',
		'description' => __('Contenido que va en la sección 3 del footer'),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => "</li>",
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => "</h2>"
	));

	register_sidebar( array(
		'name' => 'Footer 4',
		'id' => 'footer-4',
		'description' => __('Contenido que va en la sección 4 del footer'),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => "</li>",
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => "</h2>"
	));

	register_sidebar( array(
		'name' => 'Carta Front Page',
		'id' => 'front-page-card',
		'description' => 'Contenido de la presentada en el front page del sitio',
		'before_widget' => '<div id="%1$s" class="widget %2$s card-body">',
		'after_widget' => "</div>",
		'before_title' => '<h4 class="widgettitle text-white card-header">',
		'after_title' => "</h4>"
	));



}add_action( 'widgets_init', 'cnvzl_register_widgets' );

if ( !function_exists( 'get_movie_poster_url' ) ) {
	function get_movie_poster_url( $title = '' ) {
		if ( empty( $title ) ) return;

		global $wpdb;
			$ruta_img = $wpdb->get_var( $wpdb->prepare( "SELECT pel_ruta_ima_poster FROM peliculas WHERE pel_titulo = %s", $title ) );
			$ruta_img = trim( html_entity_decode( $ruta_img ), " \t\n\r\0\x0B\xC2\xA0" );
		return ( empty( $ruta_img ) ? false : $ruta_img );
	}
}

// *** OBSOLETA *** //
if ( !function_exists( 'get_movie_syno' ) ) {
	function get_movie_syno( $title = '' ) {
		if ( empty( $title ) ) return;

		global $wpdb;
			$sinopsis = $wpdb->get_var( $wpdb->prepare( "SELECT pel_sinopsis FROM peliculas WHERE pel_titulo = %s", $title ) );
			$sinopsis = trim( html_entity_decode( $sinopsis ), " \t\n\r\0\x0B\xC2\xA0" );
		return ( empty( $sinopsis ) ? false : $sinopsis );
	}
}

function cvnzl_alter_nav_menu( $items, $args )
{
	if( ( is_user_logged_in() ) and ( $args->theme_location == 'accounts') ) {
		$current_user = wp_get_current_user();
		$username = $current_user->user_login;

		$items = str_replace( 'Usuario', $username, $items );
	}
	return $items;
}
add_filter( 'wp_nav_menu', 'cvnzl_alter_nav_menu', 10, 2 );

function cvnzl_add_query_vars($vars) {
	$vars[] = "edit";
	return $vars;
}
add_action( 'query_vars', 'cvnzl_add_query_vars' );


function cvnzl_custom_title( $title_parts ) {
	if ( is_edit_page() ) {
		$title_parts['title'] = "Editando: ".$title_parts['title'];
	}
	return $title_parts;
}
add_filter( 'document_title_parts', 'cvnzl_custom_title', 10, 2 );
add_action('wp_ajax_cvnzl_per_suggest', 'cvnzl_return_per_suggest');
add_action('wp_ajax_nopriv_cvnzl_per_suggest', 'cvnzl_return_per_suggest');
function cvnzl_return_per_suggest() {
	$term = isset($_GET['term']) ? $_GET['term'] : '';
	if ($term) {
		global $wpdb;
		$sql = "SELECT post_title AS nombre, ID FROM $wpdb->posts WHERE post_title LIKE '%s' AND post_type = %s";
		$term = '%'.$term.'%';
		$stmt = $wpdb->prepare($sql, $term, 'persona');
		$suggestions = $wpdb->get_results($stmt, ARRAY_A);
		$response_obj = array();
		if ( ! empty( $suggestions ) ) {
			foreach ( $suggestions as $suggestion ) {
				$per_id = get_post_meta($suggestion['ID'], '_per_database_id', true);
				$response_obj[] = array(
					'label' => $suggestion['nombre'],
					'value' => $suggestion['nombre']
				);
			}
		}
		echo json_encode($response_obj);
	}
	wp_die();
}
add_action('wp_ajax_cvnzl_cp_suggest', 'cvnzl_return_cp_suggest');
add_action('wp_ajax_nopriv_cvnzl_cp_suggest', 'cvnzl_return_cp_suggest');
function cvnzl_return_cp_suggest() {
	$term = isset($_GET['term']) ? $_GET['term'] : '';
	if ($term) {
		global $wpdb;
		$sql = "SELECT post_title AS nombre, ID FROM $wpdb->posts WHERE post_title LIKE '%s' AND post_type = %s";
		$term = '%'.$term.'%';
		$stmt = $wpdb->prepare($sql, $term, 'casa_productora');
		$suggestions = $wpdb->get_results($stmt, ARRAY_A);
		$response_obj = array();
		if ( ! empty( $suggestions ) ) {
			foreach ( $suggestions as $suggestion ) {
				$cp_id = get_post_meta($suggestion['ID'], '_cp_database_id', true);
				$response_obj[] = array(
					'label' => $suggestion['nombre'],
					'value' => $suggestion['nombre']
				);
			}
		}
		echo json_encode($response_obj);
	}
	wp_die();
}
add_action( 'acf/init', 'cvnzl_google_api_key' );
function cvnzl_google_api_key() {
	if ( function_exists( 'acf_update_setting' ) )
		acf_update_setting( 'google_api_key', 'AIzaSyB9M2yMye_X2PwmmlWFZCV1yMXfUZ3so3Q' );
}
