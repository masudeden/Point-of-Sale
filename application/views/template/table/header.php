<!DOCTYPE html>
<html>


<head>
<title>POSNIC</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

   <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>template/data_table/css/bootstrap.min.css">
               

        <script src="<?php echo base_url() ?>template/data_table/js/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>template/data_table/js/jquery.dataTables.min.js" type="text/javascript"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url() ?>template/data_table/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url() ?>template/data_table/js/jquery.dataTables.js"></script>
			<script type="text/javascript" charset="utf-8">
			$(document).ready( function () {
           $('#example1').dataTable({
                                      "bProcessing": true,
				      "bServerSide": true,
                                      "sAjaxSource": "<?php echo base_url() ?>index.php/users/users_data_table",
                                       aoColumns: [  
                                    
         { "bVisible": false} , {	"sName": "ID",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                   							return "<input type=checkbox >";
								},
								
								
							},
        
        null, null, null, null, null, 

 							{	"sName": "ID",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                   							if(oObj.aData[8]==0){
                                                                            return "<p>Active</p>";
                                                                        }else{
                                                                            return "<p>Deactive</p>";
                                                                        }
								},
								
								
							},
 							{	"sName": "ID1",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                   							return "<a href='edit/" + oObj.aData[0] + "'><i class='icon-edit'></i></a><a href='edit/" + oObj.aData[0] + "'><i class=' icon-remove-circle'></i> </a>";
								},
								
								
							},

 							

 						]
		}
						
						
                                    
                                    );
			} );
                        console.log();
		</script>
                <script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo base_url() ?>template/data_table/js/DT_bootstrap.js"></script>
</head>
<body>