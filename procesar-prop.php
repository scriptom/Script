 <?php
 echo "<pre>";	var_dump($_POST); echo "</pre>";
 // foreach ($_POST['ft_campopart'] as $id => $value)
 // 	$newArr[$value] = $_POST['ft_nombreresp'][$id];

 // echo "<pre>"; var_dump($newArr); echo "</pre>";
if ( isset( $_POST['PROP'] ) ) {
  global $drfdb;
  // Si existe la llave, guardemos el array $PROP
  $PROP = $_POST['PROP'];
  // Cada llave de $PROP es una tabla de las abiertas a propuestas. Cada valor es un array de propuestas de esa tabla
  foreach ($PROP as $tabla => $propuestas) {
    // No recorramos las propuestas si no existen
    if ( !empty( $propuestas ) ) {
      // En caso de que existan, vamos a recorrer cada propesta
      foreach ($propuestas as $i => $propuesta) {
        // Las propuestas se encuentran ordenadas en pares Columna => valor, por lo que estan listas para ser insertadas usando wpdb::insert()
        // Otra vez, comprobemos que haya informacion en esta propuesta
        if ( !empty( $propuesta ) ) {
          // Hay informacion en esta propuesta, asi que recorreremos cada columna de la propuesta
          foreach ($propuesta as $columna => $valor) {
            // Las columnas que tienen el sufijo '_id' hacen referencia a una tabla con una fk.
            // No obstante, estas tablas vienen del HTML con valores escritos (El valor referenciado) en vez del id.
            // Por tanto, hay que comprobar que tengan un contenido valido (numerico y que exista)
            if ( endsWith( '_id', $columna ) && !is_numeric( $valor ) ) {
              // Creamos un array de las posibles tablas de donde pueda venir la referencia (y las columnas que se usan para referenciar)
              $posibles = array(
                'personas' => 'persona_nombre',
                'casas_productoras' => 'casa_productora_nombre',
                'generos' => 'genero_nombre',
                'tematicas' => 'tematica_nombre',
              );
              // Antes del ciclo, guardemos un auxiliar con el valor original de valor, porque despues de la primera iteracion cambiara
              $valor_original = $valor;
              foreach ($posibles as $posible_tabla => $posible_columna) {
                // Recorremos el array de $posibles para ver de que tabla pudo salir esa referencia
                $valor = cvnzl_get_record_id( $posible_tabla, $posible_columna, $valor_original );
                if ( !is_null( $valor ) && ( is_numeric( $valor ) ) ) {
                  $es_nuevo = false;
                  $tabla_origen = $posible_tabla;
                  break;
                } //endif (!is_null($valor) && is_numeric($valor))
              } //endforeach ($posibles)
              // Si nunca dejo de ser null, entonces es un valor nuevo en la base de datos. Hay que ponerle una flag de nuevo
              if ( is_null( $valor ) ) {
                $es_nuevo = true;
                //La tabla origen es el nombre de la columna sin el sufijo '_id'
                $tabla_origen = cvnzl_pluralize( str_replace( '_id', '', $columna ) );
                $nombre_columna = str_replace( 'id', 'nombre', $columna );
                // Comprobamos si el valor existe antes de añadirlo a la base de datos
                if ( is_null( $drfdb->get_var( $drfdb->prepare( "SELECT id FROM {$tabla_origen} WHERE {$nombre_columna} = %s" ), $valor_original ) ) ) {
                  // En caso de que no exista, añadimos a la base de datos drafts, en la tabla origen de datos (NO a la que llama dichos datos) el valor original del nuevo valor. Luego se tiene que hacer una referencia al nuevo valor)
                  $drfdb->insert( $tabla_origen, array( $nombre_columna => $valor_original ) );
                }
              } //endif is_null($valor)
            }
          }
        }
      }
    }
  }
} //endif isset( $_POST['PROP'] )



?>
