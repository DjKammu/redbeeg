<?php 

	if($_SERVER['REQUEST_METHOD']=='POST')
	{   
		$file = $_FILES['video']['tmp_name'];
		
		$output_dir = "uploads/videos/";
		
		$RandomNum   = time();
		
		$ImageName      = str_replace(' ','-',strtolower($_FILES['video']['name']));
		$ImageType      = $_FILES['video']['type']; //"image/png", image/jpeg etc.
	 
		$ImageExt = substr($ImageName, strrpos($ImageName, '.'));
		$ImageExt       = str_replace('.','',$ImageExt);
		$ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
		$NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;

		move_uploaded_file($_FILES["video"]["tmp_name"],$output_dir. $NewImageName);
	
		 
		$uploaded_image = $NewImageName;
		
		
		if(!empty($uploaded_image))
		{
			echo '<span class="label bg-light-blue">Successfully Uploaded </span><p class="video_name" style="display:none;">'.$uploaded_image.'</p>';
		}
		
		else	
		{
			echo '<span class="label bg-red">ERROR WHILE UPLOADING !</span>';
		}
		
		
	}
	
	?>
	

		
			