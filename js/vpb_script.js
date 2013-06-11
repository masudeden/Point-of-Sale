/**************************************************************
* This script is brought to you by Vasplus Programming Blog
* Website: www.vasplus.info
* Email: info@vasplus.info
****************************************************************/


//This is the Upload Function
function vpb_upload_and_resize() 
{
	//alert('COOL');
	$("#vpb_file_attachment_form").vPB({
		url: 'vpb_uploader.php',
		beforeSubmit: function() 
		{
			$("#vpb_upload_status").html('<div style="font-family: Verdana, Geneva, sans-serif; font-size:12px; color:black;" >Please wait <img src="images/loadings.gif" align="absmiddle" title="Upload...."/></div><br clear="all">');
		},
		success: function(response) 
		{
			$("#vpb_upload_status").hide().fadeIn('slow').html(response);
		}
	}).submit(); 
}