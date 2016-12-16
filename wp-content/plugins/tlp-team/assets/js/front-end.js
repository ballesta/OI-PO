(function($){

	var $isotop = $('.tlp-team-isotope').imagesLoaded( function() {
	
	  $isotop.isotope({
	        getSortData: {
	            name: '.name',
	            designation: '.designation',
	        },
	        sortAscending : true,
	        itemSelector: '.tlp-member',
	        masonry: {
	            gutter: 20
	        }
	    });
	});

    
    $('.sort-by-button-group').on( 'click', 'button', function() {
        var sortByValue = $(this).attr('data-sort-by');
        $isotop.isotope({ sortBy: sortByValue });
        $(this).parent().find('.selected').removeClass('selected');
        $(this).addClass('selected'); 
    });
})(jQuery);