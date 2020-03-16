<?php 
				if(isset($_POST['downloadtext']))
				{
					 echo  $doc_name = $_POST['doc-name'];
					 echo $doc_content = strip_tags($_POST['editor1']); 
					 header("Content-type: application/vnd.ms-word");
					 header("Content-Disposition: attachment;Filename=".$doc_name.".doc");
                     readfile($doc_content);
				}
			?>