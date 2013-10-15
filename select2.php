,w<html>
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
<script>

	var ts;

	window.onload = function() { 
		ts = Selectors.TextSelector.init("test", "Welcome to the Animal House");
	}
	
	var Selectors = window.Selectors || {
		TextSelector: {
				//Attributes
				text : null,
				div : null,
				start : null,
				end : null,
				highlights : [],

				//Functions
				setStart : function setStart(start) {
								this.start = start;
							},
				setEnd : function setEnd(end) {
							this.end = end;
						},
				getStart : function getStart(start) {
								return this.start;
							},
				getEnd : function getEnd(end) {
							return this.end;
						},

				printText : function printText() {
								console.log(text);
							},
				insert : function insert() {
							for(var i = 0; i < this.text.length; i++) {
								var item = document.createElement("span");
								item.innerHTML = this.text.charAt(i);
								item.setAttribute("class", "char");
								item.setAttribute("index", "" + i);
								this.div.appendChild(item); 
							}
						},
				init : function init(div, text) {
						
						var slider = this;

						this.div = document.getElementById(div);
						
						this.text = text;

						this.insert();

						$(div).select(".char").invoke("observe", "mousedown", function(e) {	
							var element = Event.element(e);
							
							slider.setStart(element.getAttribute("index"));
							
							$(div).select(".char").invoke("observe", "mouseup", function(e) {
								var element = Event.element(e);
								slider.setEnd(element.getAttribute("index"));
								slider.highlight(slider.getStart(), slider.getEnd());
								slider.clearSelection();
								$(div).select(".char").invoke("stopObserving", "mouseup");
								slider.clear();
							});	
						});	

						return slider;
					},
				highlight : function highlight(start, end) {
								for(var i = start; i <= end; i++) {
									$$(".char")[i].addClassName('selected');
								}
								console.log("Highlighted from " + start + " to " + end);
								this.highlights.push({'start' : this.start, 'end' : this.end});
							
							},
				clearSelection : function clearSelection() {
					    		    if (window.getSelection) {
					       	    		    window.getSelection().removeAllRanges();
					    		    } else if (document.selection) {
					        	    	document.selection.empty();
					    		  	}
								},
				clear : function clear() {
							this.start = null;
							this.end = null;
						}
				}
			};

		

</script>
</body>
</html>
