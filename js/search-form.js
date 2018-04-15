jQuery(document).ready(function() {
	if ( typeof cvnzl !== 'undefined' ) {
		var thispage = cvnzl.search_page;
		thispage.search_form = jQuery('.search-form');
		thispage.submit_btn = thispage.search_form.find('.search-submit');		
		thispage.search_input = thispage.search_form.find('.search-input');
	}
	var search_input = cvnzl.search_page.search_input;
	search_input.on( 'input', function(event) {
		var text = event.target.value;
		if ( text.length ) submit_btn.prop('disabled', false);
		else submit_btn.prop('disabled', true);
	});
});
