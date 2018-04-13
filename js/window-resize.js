jQuery(document).ready(function($) {
	$window = $(window);
	cvnzl = {
		nav_menu: {
			nav_links: $('#nav-menu .nav-link'),
			nav_links_label: [],
			nav_links_icons: [],
			fillLabelArray: function( labelText ) {
				this.nav_links_label.push( labelText );
			},
			fillIconsArray: function( iconHTML ) {
				this.nav_links_icons.push( iconHTML );
			}
		},
		search_page: {
			srch_defined: function() {
				return ( ( typeof this.search_input !== 'undefined' ) && ( typeof this.submit_btn !== 'undefined' ) ? true : false );
			},
			search_input: undefined,
			submit_btn: undefined
		},
		frontPage: {
			frontPageDefined: () => {
				return typeof this.carousel !== undefined;
			},
			carousel: undefined
		},
		resizeComponents: function( width ) {
			if ( width < 768 ) {  // RESOLUCION MOVIL
				// Comprobar que existan las variables del formulario de busqueda
				if ( this.search_page.srch_defined() ) {
					var search_input = this.search_page.search_input;
					var submit_btn = this.search_page.submit_btn;
					if (search_input.hasClass('w-50')) {
						search_input.removeClass('w-50');
						search_input.addClass('w-100');
					} //endif
					submit_btn.addClass('mx-auto');
				} //endif

				this.nav_menu.nav_links.each(function(index, el) {
					if (!cvnzl.nav_menu.nav_links_icons[index].hasClass('fa-2x')) 
						cvnzl.nav_menu.nav_links_icons[index].toggleClass('fa-2x');
					$(el).html(cvnzl.nav_menu.nav_links_icons[index]);
				});
			}//endif
			else { // RESOLUCIONES TABLET, DESKTOP ETC
				if ( this.search_page.srch_defined() ) {
					var search_input = this.search_page.search_input;
					var submit_btn = this.search_page.submit_btn;
					if (search_input.hasClass('w-100')) {
						search_input.removeClass('w-100');
						search_input.addClass('w-50');
					}//endif
					submit_btn.removeClass('mx-auto');
				}//endif
				this.nav_menu.nav_links.each(function(index, el) {
					if ( typeof $(el).get(0).childNodes[1] === 'undefined' )
						$(el).append(cvnzl.nav_menu.nav_links_label[index]);
					if (cvnzl.nav_menu.nav_links_icons[index].hasClass('fa-2x'))
						cvnzl.nav_menu.nav_links_icons[index].toggleClass('fa-2x');
				});

			}//endelse	
		}
	};// cvnzl obj
	$navbar = cvnzl.nav_menu;
	$navbar.nav_links.each( function( index, el ) {
		$navbar.fillLabelArray( $(el)[0].innerText );
		$navbar.fillIconsArray( $(el).children('i') );
	});

	$window.on( 'resize', function() {
		cvnzl.resizeComponents($window.innerWidth());
	});

	 $window.trigger('resize');
});