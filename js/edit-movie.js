jQuery(function($) {
	var textarea = $('textarea[name="propuesta-sinopsis"]'),
		ta_ph = textarea.attr('placeholder'),
		cbox_hab_edit = $(':checkbox[name="habilitar_edicion"]');

	cbox_hab_edit.change( ( event ) => {
		textarea.val(event.target.checked ? ta_ph : '');
	});

	/**
	 * Quitar y agregar filas
	 *
	 */

	$( ".js-btn-remove" ).click( ( event ) => {
		event.preventDefault();
		var target = $( event.delegateTarget ),
			$delete = $( target.data( 'deletes' ) );

		rowMngmnt( $delete, 0 );
	});
	// Usemos una copia para crear mas, para que aunque se eliminen todas, se puedan crear nuevas
	$( ".js-add-new" ).click( ( event ) => {
		event.preventDefault();
		var target = $( event.delegateTarget ),
			rowtype = target.data('adds'),
			$row = $( `.${rowtype}.row` ).first().clone( true );
		rowMngmnt( $row.clone( true ), 1 );
	});	


	function rowMngmnt( row, wantAdd ) {
		var re = /\d+/;
		var rowTab = row.data('rowtab');
		var numRows = $( `[id|=${rowTab}-row]` ).size();
		var currentIndex = numRows + 1;
		var newID;

		if (wantAdd) {
			// Preparar la fila a agregar
			row.find( 'input' ).each( ( index, el ) => {
				newID = row.attr( 'id', (i, e) => e.replace( re, currentIndex ) ).attr( 'id' );
				$( el ).attr( 'id', (i, e) => e.replace( re, currentIndex ) );
				$( el ).val('');
			} );
			row.find('label').each( ( index, el ) => { $( el ).attr( 'for', (i, e) => e.replace( re, currentIndex ) ); } );
			row.find('select').each( (index, el) => $( el ).attr( 'id', (i, e) => e.replace( re, currentIndex ) ) );
			row.find( '.js-btn-remove' ).attr( 'data-deletes', `#${newID}` );
			row.appendTo( `#${rowTab}-container` );

		} else {
			// Quitar fila solo si no es la ultima
			if (numRows - 1) 
				row.remove();
			else return;
			// Reoordenar filas restantes
			$( `.${rowTab}.row` ).each( (index, el) => {
				ni = index + 1;
				newID = $( el ).attr( 'id', (i, e) => e.replace(re, ni) ).attr('id');
				$( el ).find( '[id]' ).attr( 'id', (i, e) => e.replace(re, ni) );
				$( el ).find( '[for]' ).attr( 'for', (i, e) => e.replace(re, ni) );
				$( el ).find( '.js-btn-remove' ).attr( 'data-deletes', `#${newID}` );	
			});
		}
	}