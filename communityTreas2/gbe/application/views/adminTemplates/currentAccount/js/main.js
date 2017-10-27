

$(document).on('click', function(e) {
    var elem = $(e.target).closest('.login-manu'),
        box  = $(e.target).closest('.login-manu-sub');

    if ( elem.length ) {          // the anchor was clicked
        e.preventDefault();       // prevent the default action
        $('.login-manu-sub').toggle(); // toggle visibility
		$('.login-manu').toggleClass("active");
    }else if (!box.length){       // the document, but not the anchor or the div
        $('.login-manu-sub').hide();   // was clicked, hide it !
		$('.login-manu').removeClass("active");
    }
});

