<?php
require"../includes/connection.php";
$obj = new connection;
$get_query = "SELECT * FROM `contest` ORDER BY contest_id DESC";
$data = $obj->select($get_query);

function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- font link -->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i" rel="stylesheet">
    <!-- icon cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="https://cdn1.iconfinder.com/data/icons/mobile-device/512/drop-ink-color-printer-blue-round-512.png" />
    <title>Beeg.</title>
  </head>
  <body>
 <body class="expansion-alids-init" style="">
 	<header class="navbar-dark fixed-top bg-dark">
 		<div class="">
 			 <nav class="navbar navbar-expand-md  container">
		      <a class="navbar-brand" href="#">Beeg.</a>
		      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
		        <span class="navbar-toggler-icon"></span>
		      </button>
		      <div class="collapse navbar-collapse" id="navbarCollapse">
		        <ul class="navbar-nav mr-auto">
		          <li class="nav-item active">
		            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
		          </li>
		          <li class="nav-item">
		            <a class="nav-link" href="#">Tags</a>
		          </li>
		          <li class="nav-item">
		            <a class="nav-link" href="#">People</a>
		          </li>
		          <li class="nav-item">
		            <a class="nav-link" href="#">Channels</a>
		          </li>
		          <li class="nav-item">
		            <a class="nav-link" href="#">Cams</a>
		          </li>
		        </ul>
		        <div id="wrap">
				  <form action="" autocomplete="on">
				  <input id="search" name="search" type="text" placeholder="What're we looking for ?">
				
				  <i class="fa fa-search" aria-hidden="true"  id="search_submit" value="Rechercher" type="submit"></i>
				  </form>
				</div>
		      </div>
		    </nav>

 		</div>
 	</header>
 	<div style="height: 60px;"></div>
    <main role="main" class="container">
      <div class="row pdTB20">
	  <?php
		foreach($data AS $row){
			?>
			<div class="col-md-4">
				<div class="box">
					
					<?php
						if(!empty($row['video']))
						{
							preg_match("/\b(\.mpeg|\.x-mpeg|\.mp3|\.mp3|\.mpeg3|\.x-mpeg3|\.mpg|\.x-mpg|\x-mpegaudio)\b/", $row['video'], $output_array);
							$format = count(array_filter($output_array));
							
						   if($format>0)
						   {  
							   ?>
							   <audio  controls >
								  <source src="../uploads/videos/<?php echo $row['video']; ?>"  type="audio/ogg">
								  <source src="../uploads/videos/<?php echo $row['video']; ?>"" type="audio/mpeg">
								Your browser does not support the audio element.
								</audio>

								<?php
							}

							
						   else
						   {
							  ?>
							<video  height="200"  width="350" style="" controls >
							  
							  <source src="../uploads/videos/<?php echo $row['video']; ?>" type="video/mp4"> 
							  
							   <source src="../uploads/videos/<?php echo $row['video']; ?>" type="video/ogg">
							   
							   <source src="../uploads/videos/<?php echo $row['video']; ?>" type='video/webm'>
							   
							   <source src="../uploads/videos/<?php echo $row['video']; ?>" type='video/3gp'>
							   
								Your browser does not support the video tag.
								
							</video>
						
							<?php 
							
						   }
						}
						?>
				<a href="../uploads/videos/<?php echo $row['video']; ?>" target="_blank">
				<p class="pdLR10">
					<?php 
					$contestName = ucfirst(str_replace("&" , " " , $row['name']));
					$kbs = filesize("../uploads/videos/".$row['video'].""); 
					$size = formatSizeUnits($kbs);
					echo $contestName.' ('.$size.')'; 
					?>
				</p>
					<p class="text-right">
					<?php 
						
					?>
					
					</p>				
					</a>
				</div>
				
				
			</div>
			
			<?php
			
		
		}
	  ?>
      	
      	
      </div>
    

    </main>
    


    <footer class="navbar-light bg-light pdTB20">
    	<div class="container">
    		<div class="row">
    			<div class="col-md-6">
    				<p>All Right Reserved 2018</p>
    			</div>
    			<div class="col-md-6 text-right footerli">
    				<a href="">Disclaimer</a>
    				<a href="">Upload</a>
    				<a href="">Contact Us</a>
    			</div>
    		</div>
    	</div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
  <style>
	.pdLR10{padding:0 10px; text-align:center;font-size: 18px;color: #343a40; font-weight: bold; border-top: 1px solid #343a40;border-bottom: 1px solid #343a40;}
	.pdLR10:hover , .box a{text-decoration:none; }
	
	video{padding:10px;}
	.pdTB20 .col-md-4{margin-top:10px;}
  </style>
</html>