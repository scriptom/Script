jQuery(function($) {
	var textarea = $('textarea[name="propuesta-sinopsis"]'),
		ta_ph = textarea.attr('placeholder'),
		cbox_hab_edit = $(':checkbox[name="habilitar_edicion"]');

	cbox_hab_edit.change( ( event ) => {
		textarea.val(event.target.checked ? ta_ph : '');
	});

	$( ".js-btn-remove" ).click( ( event ) => {
        event.preventDefault();
        $($(event.delegateTarget).data('deletes')).parent().manageRows({
            row: $($(event.delegateTarget).data('deletes')),
            action: 'remove'
        });
	});
	$( ".js-add-new" ).click( ( event ) => {
        event.preventDefault();
        $(`#${$(event.delegateTarget).data('adds')}-container`).manageRows({action: 'append'});
	});

	$('.autocomplete-per').autocomplete({
		serviceUrl: ah.ajaxurl,
		params: {
			action: 'cvnzl_per_suggest'
		},
		minChars: 2,
		onSelect: selection => {
			$(this).val(selection.value);
			
		}
	});
});