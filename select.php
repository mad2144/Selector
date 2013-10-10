<html>
<head>
	<script src="js/prototype.js" type="text/javascript"></script>
	<style>
		.selected {
			background-color : #FF00FF;
		}
	</style>
</head>
<body>
<div id ="test">
</div>
</body>
</html>
<script>

	var ts;
	var sp;

	window.onload = function(){
		// ts = new TextSelector("test", "The quick brown fox jumped over the hill.");
		// ts.init();
		// console.log(ts);
		sp = {silence : function() {alert("");}};
		ts = test("a", "b", sp);

	};

	var test = function (div, text, my) {
		
		//private
		var that, div, text;
		var speakLoud = function () {
			alert("HELLO");
		}

		// augment shared object
		my = my || {};
		my.speak = function() {
			alert("Hello");
		}

		// return public items
		that = {};
		that.speak = function() {
			alert("Goodbye");
		}

		return that;
	}

	function TextSelector(div, text) {
		
		//Attributes
		this.text = text;
		this.div = document.getElementById(div);
		this.start;
		this.end;
		this.highlights = [];

		//Functions
		this.init = init;
		this.printText = printText;
		this.insert = insert;
		this.highlight = highlight;
		this.setStart = setStart;
		this.setEnd = setEnd;
		this.clearSelection = clearSelection;
		this.clear = clear;

		function init() {
			this.insert();
			var slider = this;
			$(div).select(".char").invoke("observe", "mousedown", function(e) {	
				var element = Event.element(e);
				
				slider.setStart(element.getAttribute("index"));
				
				$(div).select(".char").invoke("observe", "mouseup", function(e) {
					var element = Event.element(e);
					slider.setEnd(element.getAttribute("index"));
					slider.highlight(slider.start, slider.end);
					slider.clearSelection();
					$(div).select(".char").invoke("stopObserving", "mouseup");
					slider.clear();
				});	
			});
		}

		function printText() {
			console.log(this.text);
		};

		function insert() {
			for(var i = 0; i < this.text.length; i++) {
				var item = document.createElement("span");
				item.innerHTML = text.charAt(i);
				item.setAttribute("class", "char");
				item.setAttribute("index", "" + i);
				this.div.appendChild(item); 
			}
		}

		function highlight(start, end) {
			this.start = start;
			this.end = end;
			for(var i = start; i <= end; i++) {
				$$(".char")[i].addClassName('selected');
			}
			console.log("Highlighted from " + this.start + " to " + this.end);
			this.highlights.push({'start' : start, 'end' : end});
			console.log(this.highlights);
		}

		function setStart(start) {
			this.start = start;
		}

		function setEnd(end) {
			this.end = end;
		}

		function clear() {
			this.start = null;
			this.end = null;
		}

		function clearSelection() {
    		if (window.getSelection) {
       			window.getSelection().removeAllRanges();
    		} else if (document.selection) {
        		document.selection.empty();
    	}
	}

	}
</script>