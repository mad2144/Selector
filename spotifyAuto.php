<html>
  <head>
    <script src="js/prototype.js" type="text/javascript"></script>
    <style>
      #autocomplete {
        height: 30px;
        width: 400px;
        position: relative;
        background-color: blue;
      }
      .autocompleteItem {
        height: 30px;
        line-height: 30px;
        width: 400px;
        position: absolute;
        background-color: green;
        outline: 1px solid #333;
        color: white;    
      }
      #autocompleteInput {
        height: 30px;
        width: 400px;
      }
    </style>
  </head>
  <body>
  <div id="autocomplete">
    <input type="text" id="autocompleteInput" />
    <input type="hidden" id="autocompleteValue" />
  </div>
  </body>
</html>
<script> 
  function autocomplete(divs, autocompleter) {
   
    var that = this, container = $(divs.div), input = $(divs.input), value = $(divs.value);
    
    var autocompleter = autocompleter || {};
    
    function init() {
      container.observe("click", function() {
      });
     
      $(document.body).observe("click", function(e) {
        if(Event.element(e) == input) {
          drawResults([{display : "Hello", value : 1}]);
        } else if (Event.element(e).hasClassName("autocompleteItem")){
          input.value = Event.element(e).innerHTML;
          value.value = Event.element(e).getAttribute("data");
          $$('.autocompleteItem').invoke("remove");
        }else {
          $$('.autocompleteItem').invoke("remove");
        }       
      }); 
    }

    function drawResults(items) {
      for (var i = 0; i < items.length; i++) {
        var item = document.createElement("div");
        item.setAttribute("class", "autocompleteItem");
        item.setAttribute("style", "top:" + (i+1) * 30 + "px");
        item.setAttribute("data", items[i].value);
        item.innerHTML = '' + items[i].display;
        container.appendChild(item);
      }
    }
    
    autocompleter.init = init;

    return autocompleter;
  }

  var autocompleteTest;

  window.onload = function() {
    autocompleteTest = autocomplete({div : "autocomplete", input : "autocompleteInput", value : "autocompleteValue"});
    autocompleteTest.init();
  };
</script>
