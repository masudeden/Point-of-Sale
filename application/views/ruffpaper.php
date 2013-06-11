<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Vasplus Programming Blog - Upload and Resize Image Files using Ajax, Jquery and PHP</title>



<!-- Required header files -->

<script type="text/javascript" src="<?php echo base_url() ?>js/jquery_1.5.2.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/file_uploads.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/vpb_script.js"></script>


jgjgj


</head>
<body>














<!-- Code Begins -->
<div >  
 
<!-- Upload Form -->

<div  >

<form id="vpb_file_attachment_form" method="post" enctype="multipart/form-data" action="javascript:void(0);" autocomplete="off">
<span class="vpb_browse_file_box"><input type="file" name="browsed_file" id="browsed_file" class="vpb_file_browsing_field"></span>
<a href="javascript:void(0);" class="vpb_general_button" onclick="vpb_upload_and_resize();">Submit</a>  
</form>

</div>

<div   id="vpb_upload_status"></div>




</div>
<!-- Code End -->



</body>
</html>