<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<script src="js/jquery-1.9.1.js"></script>
	<script src="js/jquery.ui.core.js"></script>
	<script src="js/jquery.ui.position.js"></script>
                  <script src="js/jquery.ui.widget.js"></script>
	<script src="js/jquery.ui.menu.js"></script>
	<script src="js/jquery.ui.autocomplete.js"></script>
	<link rel="stylesheet" href="css/demos.css">
    <link rel="stylesheet" href="css/jquery.ui.base.css" >
    <link rel="stylesheet" href="css/jquery.ui.theme.css" >
    <script>
$(function() {
    var projects = [
        {
            value: "jquery",
            label: "jQuery",
            desc: "the write less, do more, JavaScript library",
            other: "9834275 9847598023 753425828975340 82974598823"
        },
        {
            value: "jquery-ui",
            label: "jQuery UI",
            desc: "the official user interface library for jQuery",
            other: "98 83475 9358 949078 8 40287089754 345 2345"
        },
        {
            value: "sizzlejs",
            label: "Sizzle JS",
            desc: "a pure-JavaScript CSS selector engine",
            other: "49857 2389442 573489057 89024375 928037890"
        }
    ];
    
    function lightwell(request, response) {
        function hasMatch(s) {
            return s.toLowerCase().indexOf(request.term.toLowerCase())!==-1;
        }
        var i, l, obj, matches = [];

        if (request.term==="") {
		    response([]);
            return;
        }
           
        for  (i = 0, l = projects.length; i<l; i++) {
            obj = projects[i];
            if (hasMatch(obj.label) || hasMatch(obj.desc)) {
                matches.push(obj);
				
            }
        }
        response(matches);
    }
    
    $( "#project" ).autocomplete({
        minLength: 0,
        source:'server.php',
        focus: function( event, ui ) {
            $( "#project" ).val( ui.item.label );
            return false;
        },
        select: function( event, ui ) {
            $( "#project" ).val( ui.item.label );
          
          
            
            return false;
        }
    })
    
    .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
        return $( "<li>" )
            .append( "<a>" + item.label + 
                "<span >" + item.desc + "</span></a>" )
                //"<span style='font-size: 60%;'>Other: " + item.other + "</span></a>" )
            .appendTo( ul );
    };
});
	</script>
</head>
<body><div class="ui-widget">
<input id="project" />
<input type="hidden" id="project-id" />
<p id="project-title"></p><p id="project-description"></p><p id="project-other"></p>
</div>


</body>
</html>
