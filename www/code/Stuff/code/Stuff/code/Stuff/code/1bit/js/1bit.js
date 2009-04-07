// 1bit Audio Player - 1bit.markwheeler.net
// Development Version: dsingleton.co.uk/code/1bit

function OneBit(pluginPath)
{
		// Object Vars
	
	// Relative to calling path
	this.pluginPath = pluginPath || '1bit.swf';	
	
	// Style Options
	this.defaultColor = '#111111';
	this.defaultBackground = 'transparent';
	this.defaultPlayerSize = false;
	
	// Semi Internal
	this.wrapperClass = 'onebit_mp3';
	this.playerClass = 'onebit_player';
	
	// Internal
	this.playerCount = 1;
	this.flashVersion = 6;

		// Methods
	
	// Run through each applicable link and add a player
	
	this.apply = function(selector, color, background, playerSize) 
	{
		// These will apply to the next running too - losing the defaults
		this.color = color || this.defaultColor;
		this.background = background || this.defaultBackground;
		this.playerSize = playerSize || this.defaultPlayerSize;
		
		var links = this.getElementsBySelector(selector);
		var ext = '';
		for(var i = 0; i < links.length; i++) {
			
			// Avoid applying the player twice to the same link
			if (this.hasClass(links[i].parentNode, this.wrapperClass)) {
				continue;
			}
			
			// Avoid non .mp3 links
			ext = links[i].href.substr(links[i].href.length - 4);
			if (ext != '.mp3') {
				continue;
			}
			
			this.insertPlayer(links[i]);
		}	
	};
	
	this.insertPlayer = function(elem)
	{
		
		if (!this.playerSize) {
			this.playerSize = Math.floor(elem.scrollHeight * 0.75);
		}

		// Make a span to encapsulate the link and flsh
		var playerWrapper = document.createElement('span');
		this.addClass(playerWrapper, this.wrapperClass);
				
		// Add an empty span to be replaced by the flash by it's ID
		var hook_id = 'oneBitInsert_' + this.playerCount;
		var span = document.createElement('span');
		span.setAttribute('id', hook_id);
		span.setAttribute('class', this.playerClass);

		// Add it in the wrapping span
		playerWrapper.appendChild(span);
		
		// Move the link inside the span we just made
		elem.parentNode.insertBefore(playerWrapper, elem);
		playerWrapper.appendChild(elem);		

		// Insert the flash
		var so = new SWFObject(
			this.pluginPath,
			hook_id,
			this.playerSize,
			this.playerSize,
			this.flashVersion,
			this.background
		);

		if(this.background == 'transparent') {
			so.addParam('wmode', 'transparent');
		}

		// Quick fix to the color hex code, as the flash doesn't expect a #
		so.addVariable('foreColor', this.color.substr(1));
		so.addVariable('filename', elem.href);

		so.write(hook_id);
		this.playerCount++;
	};
	
	// Get DOM elements based on the given CSS Selector - V 1.00.A Beta
	// http://www.openjs.com/scripts/dom/css_selector/
	this.getElementsBySelector = function (all_selectors) {
		var selected = new Array();
		if(!document.getElementsByTagName) return selected;
		all_selectors = all_selectors.replace(/\s*([^\w])\s*/g,"$1");//Remove the 'beutification' spaces
		var selectors = all_selectors.split(",");
		// Grab all of the tagName elements within current context	
		var getElements = function(context,tag) {
			if (!tag) tag = '*';
			// Get elements matching tag, filter them for class selector
			var found = new Array;
			for (var a=0,len=context.length; con=context[a],a<len; a++) {
				var eles;
				if (tag == '*') eles = con.all ? con.all : con.getElementsByTagName("*");
				else eles = con.getElementsByTagName(tag);

				for(var b=0,leng=eles.length;b<leng; b++) found.push(eles[b]);
			}
			return found;
		};

		COMMA:
		for(var i=0,len1=selectors.length; selector=selectors[i],i<len1; i++) {
			var context = new Array(document);
			var inheriters = selector.split(" ");

			SPACE:
			for(var j=0,len2=inheriters.length; element=inheriters[j],j<len2;j++) {
				//This part is to make sure that it is not part of a CSS3 Selector
				var left_bracket = element.indexOf("[");
				var right_bracket = element.indexOf("]");
				var pos = element.indexOf("#");//ID
				if(pos+1 && !(pos>left_bracket&&pos<right_bracket)) {
					var parts = element.split("#");
					var tag = parts[0];
					var id = parts[1];
					var ele = document.getElementById(id);
					if(!ele || (tag && ele.nodeName.toLowerCase() != tag)) { //Specified element not found
						continue COMMA;
					}
					context = new Array(ele);
					continue SPACE;
				}

				pos = element.indexOf(".");//Class
				if(pos+1 && !(pos>left_bracket&&pos<right_bracket)) {
					var parts = element.split('.');
					var tag = parts[0];
					var class_name = parts[1];

					var found = getElements(context,tag);
					context = new Array;
	 				for (var l=0,len=found.length; fnd=found[l],l<len; l++) {
	 					if(fnd.className && fnd.className.match(new RegExp('(^|\s)'+class_name+'(\s|$)'))) context.push(fnd);
	 				}
					continue SPACE;
				}

				if(element.indexOf('[')+1) {//If the char '[' appears, that means it needs CSS 3 parsing
					// Code to deal with attribute selectors
					if (element.match(/^(\w*)\[(\w+)([=~\|\^\$\*]?)=?['"]?([^\]'"]*)['"]?\]$/)) {
						var tag = RegExp.$1;
						var attr = RegExp.$2;
						var operator = RegExp.$3;
						var value = RegExp.$4;
					}
					var found = getElements(context,tag);
					context = new Array;
					for (var l=0,len=found.length; fnd=found[l],l<len; l++) {
	 					if(operator=='=' && fnd.getAttribute(attr) != value) continue;
						if(operator=='~' && !fnd.getAttribute(attr).match(new RegExp('(^|\\s)'+value+'(\\s|$)'))) continue;
						if(operator=='|' && !fnd.getAttribute(attr).match(new RegExp('^'+value+'-?'))) continue;
						if(operator=='^' && fnd.getAttribute(attr).indexOf(value)!=0) continue;
						if(operator=='$' && fnd.getAttribute(attr).lastIndexOf(value)!=(fnd.getAttribute(attr).length-value.length)) continue;
						if(operator=='*' && !(fnd.getAttribute(attr).indexOf(value)+1)) continue;
						else if(!fnd.getAttribute(attr)) continue;
						context.push(fnd);
	 				}

					continue SPACE;
				}

				//Tag selectors - no class or id specified.
				var found = getElements(context,element);
				context = found;
			}
			for (var o=0,len=context.length;o<len; o++) selected.push(context[o]);
		}
		return selected;
	};

	
		// Support Methods
	
	this.hasClass = function(elem, cls) {
		return elem.className.match(new RegExp('(\\s|^)' + cls + '(\\s|$)'));
	};
	
	this.addClass = function(elem, cls) {
		if (!this.hasClass(elem, cls)) elem.className += " " + cls;
	};
	
	this.removeClass = function(elem, cls) {
		if (hasClass(elem ,cls)) {
			var reg = new RegExp('(\\s|^)' + cls + '(\\s|$)');
			elem.className=ele.className.replace(reg ,' ')
		}
	};
	
		// Events
		
	this.ready = function(func) {
	  var oldonload = window.onload;
	  if (typeof window.onload != 'function') {
	    window.onload = func;
	  } else {
	    window.onload = function() {
	      if (oldonload) {
	        oldonload();
	      }
	      func();
	    }
	  }
	}
};