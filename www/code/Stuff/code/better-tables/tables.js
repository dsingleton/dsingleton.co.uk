

addLoadEvent( prepareRowHighlight);

addLoadEvent( zebraStripe );

addLoadEvent( applyTableRowHovers );



        // dom compatability checking



        // check element exists



    // move lib to root


function applyTableRowHovers() {
	
	var t = document.getElementsByTagName("tr");
	for(var i=0;i<t.length;i++) {
		var ocn = t[i].className;
		t[i].onmouseover = function() { addClass(this, 'hover'); };
		t[i].onmouseout = function() { removeClass(this, 'hover');  };
	}	
}


function zebraStripe() {

    elem = document.getElementById( 'compilation' );
    lnks = elem.getElementsByTagName('tr');

    for ( var i = 1; i < rows.length; i += 2 ) {

        addClass(rows[i], 'zebra');
    }
}



function prepareRowHighlight() {



    elem = document.getElementById( 'compilation' );

    rows = elem.getElementsByTagName('tr');



    for ( var i = 1; i < rows.length; i++ ) {

        rows[i].onclick = function () {

            highlight(this);

       }

    }



}


function highlight(elem) {



    if ( hasClass(elem, 'highlight') ) {

        removeClass(elem, 'highlight');

    }

    else {

        addClass(elem, 'highlight');

    }

}

function addLoadEvent(func) {

  var oldonload = window.onload;

  if (typeof window.onload != 'function') {

    window.onload = func;

  } else {

    window.onload = function() {

      oldonload();

      func();

    }

  }

}