<html>
<head>
<title> Dynamically create input fields- jQuery </title>
<script  src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>        // Calling jQuery Library hosted on Google's CDN
<script type="text/javascript">
$(function() {
var addDiv = $('#addinput');
var i = $('#addinput p').size() + 1;

$('#addNew').live('click', function() {
$('<p><input type="text" id="p_new" size="40" name="p_new1" value="" placeholder="I am New" /><a href="#" id="remNew">Remove</a> </p>').appendTo(addDiv);
i++;

return false;
});

$('#remNew').live('click', function() {
if( i > 2 ) {
$(this).parents('p').remove();
i--;
}
return false;
});
});

</script>

</head>
<body>
<h2>Dynammically Add Another Input Box</h2>

<div id="addinput">
<p>
        <form action="<?php echo base_url() ?>index.php/suppliers_x_items/save_items" method="post"   >
      
<input type="text" id="p_new" size="20" name="p_new[]" value="" placeholder="Input Value" /><a href="#" id="addNew">Add</a>
<?php echo form_submit('save','save') ?>
<from>
</p>
</div>

</body>
</html>