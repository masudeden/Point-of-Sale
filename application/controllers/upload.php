 <?php class Upload extends CI_Controller
 
  {
 
    function __construct()
 
    {
 
        parent::__construct();
 
        $this->load->helper('form');
 
        $this->load->helper('url');
 
    }  
 
    function index()
 
    {
 
        $this->load->view('ruffpaper');
 
    }
 
    //Upload Image function
 
    function uploadImage()
 
    {
 
       $config['upload_path']   =   "uploads/";
 
       $config['allowed_types'] =   "gif|jpg|jpeg|png";
 
       $config['max_size']      =   "5000";
 
       $config['max_width']     =   "1907";
 
       $config['max_height']    =   "1280";
 
       $this->load->library('upload',$config);
 
       if(!$this->upload->do_upload())
 
       {
 
           echo $this->upload->display_error();
 
       }
 
       else
 
       {
 
           $finfo=$this->upload->data();
 
           $this->_createThumbnail($finfo['file_name']);
 
           $data['uploadInfo'] = $finfo;
 
           $data['thumbnail_name'] = $finfo['raw_name']. '_thumb' .$finfo['file_ext'];
 
           $this->load->view('upload_success',$data);
 
           // You can view content of the $finfo with the code block below
 
           /*echo '<pre>';
 
           print_r($finfo);
 
           echo '</pre>';*/
 
       }
 
    }
 
    //Create Thumbnail function
 
    function _createThumbnail($filename)
 
    {
 
        $config['image_library']    = "gd2";      
 
        $config['source_image']     = "uploads/" .$filename;      
 
        $config['create_thumb']     = TRUE;      
 
        $config['maintain_ratio']   = TRUE;      
 
        $config['width'] = "80";      
 
        $config['height'] = "80";
 
        $this->load->library('image_lib',$config);
 
        if(!$this->image_lib->resize())
 
        {
 
            echo $this->image_lib->display_errors();
 
        }      
 
    }
    function upload_user_image(){
        $vpb_upload_image_directory = "http://localhost/PointOfSale/uploads/";
	
	$vpb_with_of_first_image_file = 300;      
	$vpb_with_of_second_image_file = 200;    
	
	$vpb_image_filename = $_FILES["browsed_file"]["name"];
	$vpb_image_tmp_name = $_FILES['browsed_file']['tmp_name'];
	$vpb_file_size = filesize($_FILES['browsed_file']['tmp_name']);
	$vpb_file_extensions = pathinfo($vpb_image_filename, PATHINFO_EXTENSION);
	
	
	
	$vpb_maximum_allowed_file_size = 1024*1024;
	$vpb_additional_file_size = $vpb_file_size - $vpb_maximum_allowed_file_size;
	
  	if($vpb_image_filename == "") 
  	{
		echo '<div class="info">Please browse for the file that you wish to upload and resize to proceed. Thanks.</div>';
	}
	else
	{
	
        if ($vpb_file_extensions != "gif" && $vpb_file_extensions != "jpg" && $vpb_file_extensions != "jpeg" && $vpb_file_extensions != "png") 
  		{
			echo '<div class="info">Sorry, the file type you attempted to upload is invalid. <br>This system only accepts gif, jpg, jpeg or png image files whereas you attached <b>'.$vpb_file_extensions.'</b> file format. Thanks.</div>';
  		}
		elseif ($vpb_file_size > $vpb_maximum_allowed_file_size) 
		{
			echo "<div class='info'>Sorry, you have exceeded this system's maximum upload file size limit of <b>".$vpb_maximum_allowed_file_size."</b> by <b>".$vpb_additional_file_size."</b><br>Please reduce your file size to proceed. Thanks.</div>";
		}
 		else
		{
			
			if($vpb_file_extensions == "gif")
			{
				$vpb_image_src = imagecreatefromgif($vpb_image_tmp_name); 
			}
			elseif($vpb_file_extensions == "jpg" || $vpb_file_extensions == "jpeg")
			{
				$vpb_image_src = imagecreatefromjpeg($vpb_image_tmp_name); 
			}
			else if($vpb_file_extensions=="png")
			{
				$vpb_image_src = imagecreatefrompng($vpb_image_tmp_name); 
			}
			else
			{
				$vpb_image_src = "invalid_file_type_realized";
			}
			
			
			if($vpb_image_src == "invalid_file_type_realized")
			{
				echo '<div class="info">Sorry, the file type you attempted to upload is invalid. <br>This system only accepts gif, jpg, jpeg or png image files whereas you attached <b>'.$vpb_file_extensions.'</b> file format. Thanks.</div>';
			}
			else
			{
				
				list($vpb_image_width,$vpb_image_height) = getimagesize($vpb_image_tmp_name);		
				
				$vpb_first_image_new_width = $vpb_with_of_first_image_file; 
				$vpb_first_image_new_height = ($vpb_image_height/$vpb_image_width)*$vpb_first_image_new_width;
				$vpb_first_image_tmp = imagecreatetruecolor($vpb_first_image_new_width,$vpb_first_image_new_height);
				
				$vpb_second_image_new_width = $vpb_with_of_second_image_file; 
				$vpb_second_image_new_height = ($vpb_image_height/$vpb_image_width)*$vpb_second_image_new_width;
				$vpb_second_image_tmp = imagecreatetruecolor($vpb_second_image_new_width,$vpb_second_image_new_height);
				
			
				imagecopyresampled($vpb_first_image_tmp,$vpb_image_src,0,0,0,0,$vpb_first_image_new_width,$vpb_first_image_new_height,$vpb_image_width,$vpb_image_height); 
				
				imagecopyresampled($vpb_second_image_tmp,$vpb_image_src,0,0,0,0,$vpb_second_image_new_width,$vpb_second_image_new_height, $vpb_image_width,$vpb_image_height);
				
				$vpb_uploaded_file_movement_one = $vpb_upload_image_directory."jibi".$vpb_image_filename;
				
				$vpb_uploaded_file_movement_two = $vpb_upload_image_directory."jibi".$vpb_image_filename;
				
				imagejpeg($vpb_first_image_tmp,$vpb_uploaded_file_movement_one,100);
			        imagejpeg($vpb_second_image_tmp,$vpb_uploaded_file_movement_two,100);
	
				imagedestroy($vpb_image_src);
				imagedestroy($vpb_first_image_tmp);
				imagedestroy($vpb_second_image_tmp);
				
				echo '<img src="'.$vpb_uploaded_file_movement_one.'" style=width:100px; height=100px"></span><br clear="all" /><span class="vpb_image_style">';
				echo "<input type=text value=".$vpb_image_filename." >";
			}
			
		}
	}
    }
 
  }
 
?>