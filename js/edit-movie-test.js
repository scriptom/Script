jQuery(function($) {
	var textarea = $('#propuesta-sinopsis'),
		ta_ph = textarea.attr('placeholder'),
		cbox_hab_edit = $(':checkbox#cb_hedit');

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
        $(`#${$(event.delegateTarget).data('adds')}-container`).manageRows({
					action: 'append',
					callback: function($newRow, index) {
						if (!$newRow.find('input[name$="tipo_rep"]')) {
							return;
						}
						let $radios = $('input[name$="tipo_rep"]');
						$radios.on('change', toggleGroups);
						// $radios.change();
					}

				});
	});

	let $radios = $('input[name$="[tipo_rep]"]');
	$radios.on('change', toggleGroups);
	function toggleGroups(event){
		let value = event.target.value;
		let $row = $(event.target).parents('.rep');
		$row.find(`.${value}-group`).toggle(true).siblings(`[class$=group]:not('.${value}-group')`).toggle(false);
	}
	// $radios.change();

	$('[class*=autocomplete]').each(function(index, element){
		let classes = element.className.split(/\s+/g);
		let the_class;
		for (var i = 0; i < classes.length; i++) {
			if (classes[i].startsWith('autocomplete')) {
				the_class = classes[i];
				break;
			}
		}
		let the_type = the_class.substring(the_class.indexOf('-') + 1, the_class.length);
		$(element).autocomplete({
			source: ah.ajaxurl + '?action=cvnzl_'+the_type+'_suggest',
			minLength: 2,
			select: function(event, ui) {
				event.preventDefault();
				$(this).val(ui.item.label);
			}
		});
	})
});
