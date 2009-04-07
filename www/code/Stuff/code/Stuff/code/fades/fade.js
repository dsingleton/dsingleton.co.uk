//-----------------------------------------------
//  The (Not Just) Yellow Fade Technique
//-----------------------------------------------
//  Author: David@springdigital.co.uk
//  Last Modified: 17/12/05
//  Version: Working Prototype
//-----------------------------------------------
//  Intended to be used to highlight dynamoically
//  updated parts of a static page, to improve
//  usability when using DOM manipulations.
//-----------------------------------------------
//  To Do:
//  -   Look into replacing set timeout with set
//      interval
//  - Improve Hex To RGB to handle shorthand hex
//  - Iterate on RGB value or time?
//-----------------------------------------------


//-------------------------------------
//  Global Configuration for all Fades
//-------------------------------------

var fadeDefaultPause = 1000;       // Time to wait before fading
var fadeDefaultDuration = 3000;      // Period of time the fade takes
var fadeDefaultHighlightColor = '#FFD619';
var fades = new Array();


window.onload = function () {
    //highlight('body', '#0000ff', getTrueBackgroundColor('body'), 0, 1000);
    //highlight('new_content', '#dddd00', getTrueBackgroundColor('new_content'), 0, 1000);
}


function highlight( id, startHex, endHex, pause, duration ) {

    var elem = document.getElementById( id );

    if ( !endHex )      endHex = getTrueBackgroundColor( id );
    if ( !pause )       pause = fadeDefaultPause;
    if ( !duration )    duration = fadeDefaultDuration;

    if ( !startHex )    startHex = fadeDefaultHighlightColor;

    removeFade( elem );

    elem.style.backgroundColor = startHex;
    elem.fades[0] = setTimeout("fade('" + id + "', '" + startHex + "', '" + endHex + "', '" + duration +"');", pause);
}

function removeFade( elem ) {

    if ( hasFade( elem ) ) {

        for( var i = 0; i < elem.fades.length; i++ ) {
            clearTimeout(elem.fades[i]);
        }
        elem.fades = new Array();
    }
    else {
     elem.fades = new Array();
    }
}

function hasFade( elem ) {
    return ( elem.fades && elem.fades.length > 0 );
}

function fade( id, startHex, endHex, duration ) {

    if ( !startHex ) startHex = getTrueBackgroundColor( id );
    if ( !duration ) duration = fadeDefaultDuration;

    startRgb = hexToRgb(startHex);
    endRgb = hexToRgb(endHex);
    inc = new Array();

    current = startRgb;
    var iterations = 255;

    inc['r'] = ( endRgb['r'] - startRgb['r'] ) / 255;
    inc['g'] = ( endRgb['g'] - startRgb['g'] ) / 255;
    inc['b'] = ( endRgb['b'] - startRgb['b'] ) / 255;
    interval = ( duration / iterations );
    var elem = document.getElementById( id );

    // Only one fade at once!
    debugTrace("Fades: " + elem.fades);

    removeFade( elem );

    var i = 0;
    for ( var delay = interval; delay < duration; delay += interval ) {
        current['r'] += inc['r'];
        current['g'] += inc['g'];
        current['b'] += inc['b'];

        color = rgbToHex(current['r'], current['g'], current['b'] );
        elem.fades[i++] = setTimeout( "setBackgroundColor( '" + id + "', '" + color + "')", delay);
    }
    setTimeout( function () {
        debugTrace(startHex + "->" + endHex + " Complete ");
        debugTrace("-------------------------");
        elem.fades = new Array();
    }, delay);
}

function setBackgroundColor( id, color ) {
    e = document.getElementById( id );
    e.style.backgroundColor = color;
}

//-------------------------------------
//  Helper Functions
//-------------------------------------

function hexToRgb ( hex ) {

    var rgb = new Array;

    if ( hex.charAt(0) == '#' ) {
        hex = hex.substr(1);
    }
    rgb = new Array();

    rgb['r'] = parseInt(hex.substring( 0, 2 ), 16);
    rgb['g'] = parseInt(hex.substring( 2, 4 ), 16);
    rgb['b'] = parseInt(hex.substring( 4, 6 ), 16);
    return rgb;
}

function rgbToHex( r, g, b ) {

    r = Math.round(r).toString(16); if (r.length == 1) r = '0' + r;
    g = Math.round(g).toString(16); if (g.length == 1) g = '0' + g;
    b = Math.round(b).toString(16); if (b.length == 1) b = '0' + b;

    return "#" + r + g + b;
}

//-------------------------------------
//  Debug Functions
//-------------------------------------

function debugTrace( line ) {

    var debug = document.getElementById( 'debug-window' );

    if (!debug.lineNo) {
        debug.lineNo = 0;
    }
    debug.lineNo++;
    debug.value = debug.lineNo + ". " + line + "\n" + debug.value;
}

function clearDebug() {
    var debug = document.getElementById( 'debug-window' );
    debug.value  = '';
}

//-------------------------------------
//  Random Testng.
//-------------------------------------

//alert(getStyleProperty('new_content'));

// can this handle

function getTrueBackgroundColor( id )
{
    var o = document.getElementById(id);
    while(o)
    {
        var c;
        if (window.getComputedStyle) c = window.getComputedStyle(o,null).getPropertyValue("background-color");
        if (o.currentStyle) c = o.currentStyle.backgroundColor;
        if ((c != "" && c != "transparent") || o.tagName == "BODY") { break; }
        o = o.parentNode;
    }

    if (c == undefined || c == "" || c == "transparent") c = "#FFFFFF";
    var rgb = c.match(/rgb\s*\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*\)/);
    if (rgb) c = rgbToHex(parseInt(rgb[1]),parseInt(rgb[2]),parseInt(rgb[3]));

    return c;
}