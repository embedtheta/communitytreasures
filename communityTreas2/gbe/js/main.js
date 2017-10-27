

$(document).on('click', function(e) {
    var elem = $(e.target).closest('.login-manu'),
        box  = $(e.target).closest('.login-manu-sub');
	var elem1 = $(e.target).closest('.forget-manu'),
        box1  = $(e.target).closest('.forget-manu-sub');

    if ( elem.length ) {          // the anchor was clicked
        e.preventDefault();       // prevent the default action
        $('.login-manu-sub').toggle(); // toggle visibility
		$('.login-manu').toggleClass("active");
    }else if (!box.length){       // the document, but not the anchor or the div
        $('.login-manu-sub').hide();   // was clicked, hide it !
		$('.login-manu').removeClass("active");
    }
	
	

    if ( elem1.length ) {          // the anchor was clicked
        e.preventDefault();       // prevent the default action
        $('.forget-manu-sub').toggle(); // toggle visibility
		$('.forget-manu').toggleClass("active");
    }else if (!box1.length){       // the document, but not the anchor or the div
        $('.forget-manu-sub').hide();   // was clicked, hide it !
		$('.forget-manu').removeClass("active");
    }
});

