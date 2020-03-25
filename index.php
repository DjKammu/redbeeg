<?php include 'header.php';?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>

var settings = {
	"async": true,
	"crossDomain": true,
	"url": "https://steppschuh-json-porn-v1.p.rapidapi.com/porn/?count=5&offset=0&pornId=5073292679446528&producerId=4554967436230656&actorId=5681034041491456&genreId=5245132710346752&pornType=4",
	"method": "GET",
	"headers": {
		"x-rapidapi-host": "steppschuh-json-porn-v1.p.rapidapi.com",
		"x-rapidapi-key": "a4601bbaf0mshcbde5683548eec9p17fe7fjsn34866dbb09b3"
	}
}

$.ajax(settings).done(function (response) {
	console.log(response);
});
// $.ajax(settings).done(function (response) {
// 	var url = response.content[0].downloads[1].url;
// 	var dis = response.content[0].description
// 	console.log(url);
// 	$("#video").attr('src',url); 
// 	$("#dis").html(dis);
// 	console.log(response);
// });
</script>
   <div  id="move"></div>
   <div style="height: 70px;"></div>
    <main role="main" class="container">
        <div class="row play_show " style="display: none;">
			<div class="col9 pd0">

				<div id="jp_container_1" class="jp-video jp-video-360p" role="application" aria-label="media hight200_pcplayer">
					<div class="jp-type-single">
						<div id="jquery_jplayer_1" class="jp-jplayer"></div>
					</div>
						<div class="jp-gui">
							<div class="jp-video-play">
								<button class="jp-video-play-icon" role="button" tabindex="0">play</button>
							</div>
							<div class="jp-interface">
								<div class="jp-progress">
									<div class="jp-seek-bar">
										<div class="jp-play-bar"></div>
									</div>
								</div>
								<!-- 
								<div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div> -->
								<div class="jp-controls-holder">
									<div class="jp-controls">
										<button class="jp-play" role="button" tabindex="0">play</button>
										<button class="jp-stop" role="button" tabindex="0">stop</button>
									</div>
									<div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
									<div class="jp-volume-controls">
										<button class="jp-mute" role="button" tabindex="0">mute</button>
										<button class="jp-volume-max" role="button" tabindex="0">max volume</button>
										<div class="jp-volume-bar">
											<div class="jp-volume-bar-value"></div>
										</div>
									</div>
									<div class="jp-toggles">
										<button class="jp-repeat" role="button" tabindex="0">repeat</button>
										<button class="jp-full-screen" role="button" tabindex="0">full screen</button>
									</div>
								</div>
								<div class="jp-details">
									<!-- <div class="jp-title" aria-label="title">&nbsp;</div> -->
								</div>
							</div>
						</div>
						<div class="jp-no-solution">
							<span>Update Required</span>
							To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
						</div>
					</div>
				</div>
			
			<div class="col3 pd0 d-none d-md-block">
				<div class="card bg-light mb-3">
				  <div class="card-header">
				  	<img src="https://wrappixel.com/demos/admin-templates/monstrous-admin/assets/images/users/4.jpg" class="rounded-circle" style="height:auto; width:40px; margin-right:20px;">
				  	<?php echo substr($latestVid['name'],0,20).'..';?>  </div>
				  <div class="card-body">
					<!--<h5 class="card-title">Light card title</h5>-->
					<p class="text-justify small"><?php echo $latestVid['details'];?></p>
				  </div>
					<div class="card-footer bg-transparent small"><?php echo $latestVid['tags'];?>  </div>
				</div>
			</div>
		
        </div>
		
	<div class="row pdTB20 playerDetails">
	  <?php


	  	$page = ! empty( $_GET['page'] ) ? (int) $_GET['page'] : 1;
	  	$total = count( $data_main ); //total items in array    
		$limit = 9; //per page    
		$totalPages = ceil( $total/ $limit ); //calculate total pages
		$page = max($page, 1); //get 1 page when $_GET['page'] <= 0
		$page = min($page, $totalPages); //get last page when $_GET['page'] > $totalPages
		$offset = ($page - 1) * $limit;
		if( $offset < 0 ) $offset = 0;


		foreach(array_slice($data_main, $offset, $limit) AS $row){
			?>
			<div class="col-md-4 col-sm-12 col-xs-12">
				<a class="videolink1" href="#move" value="admin-panel/uploads/videos/<?php echo $row['video']; ?>" id="video<?php echo $row['contest_id']; ?>">
				<div class="box hight200_pc">
				<?php if(!empty($row['video_img'])){
					$img = 'admin-panel/uploads/images/'.$row['video_img'];
				}
				else{
					$img = "img/default.jpg";
				}				
			  ?>
				<img alt="<?php echo $row['name'];?>" title="<?php echo $row['name'];?> " src="<?php echo $img; ?>" class="img-responsive hight200_pc"  />	
				
					<p style="display: none;" class="pdLR10 text-danger" id="p<?php echo $row['contest_id']; ?>">
						<?php 
						$contestName = ucfirst(str_replace("&" , " " , $row['name']));
						$kbs = filesize("admin-panel/uploads/videos/".$row['video'].""); 
						$size = formatSizeUnits($kbs);
						echo $contestName;
						?>
					</p>				
				</a>
				
				<!-- <div class="col-md-6 col-sm-6 col-xs-6">
					<p class="text-left text-danger">	
						<i class="fa fa-calendar" aria-hidden="true"></i>
						<?php 
							$date=date_create($row['inserted_at']);
							echo $calender_date = date_format($date,"D d F Y"); 
						 ?>
					</p>
				</div>
				
				<div class="col-md-6 col-sm-6 col-xs-6">
					<p class="text-right text-danger">	
						<i class="fa fa-folder-open"  aria-hidden="true"></i> 
							<?php echo $size; ?>
					</p>
				</div>
				
				<div class="col-md-12">
					<div id="d<?php echo $row['contest_id']; ?>" class="None">
						<?php echo $row['details']; ?>
					</div>
				</div>
				-->
				<div class="col-md-12">
					<div id="t<?php echo $row['contest_id']; ?>" class="None">
						<?php 
                        $tags = ($row['tags']) ? 
                               explode(' ',str_replace(array('#',','),' ', $row['tags'])) : [];
                           
                         $tagHtml = '';  
                        foreach (array_filter($tags) as $key => $tag) {
                            $url = 	$base_url.'tag/'.$tag;
                            $tagHtml .= "<a href='$url'> #$tag </a>";
                        }
                        echo $tagHtml; ?>
					</div>
				</div> 
				</div>
			</div>

					
	<?php

		}
	  ?>
  	
      </div>
      <?php $link = '?page=%d';
		$pagerContainer = '<div style="width: 300px;">';   
		if( $totalPages != 0 ) 
		{
		  if( $page == 1 ) 
		  { 
		    $pagerContainer .= ''; 
		  } 
		  else 
		  { 
		    $pagerContainer .= sprintf( '<a href="' . $link . '" style="color: #c00"> &#171; prev page</a>', $page - 1 ); 
		  }
		  $pagerContainer .= ' <span> page <strong>' . $page . '</strong> from ' . $totalPages . '</span>'; 
		  if( $page == $totalPages ) 
		  { 
		    $pagerContainer .= ''; 
		  }
		  else 
		  { 
		    $pagerContainer .= sprintf( '<a href="' . $link . '" style="color: #c00"> next page &#187; </a>', $page + 1 ); 
		  }           
		}                   
		$pagerContainer .= '</div>';

		echo $pagerContainer; ?>
    
    </main>
    <footer class="navbar-dark text-white bg-dark pa20">
    	<div class="container">
    		<div class="row">
    			<div class="col-md-6 text-xs-center">
    				<p style="margin-bottom: 0;">All Right Reserved 2018</p>
    			</div>
    			<div class="col-md-6 text-right  text-xs-center footerli">
    				<a href="">Disclaimer</a>
    				<a href="">Upload</a>
    				<a href="">Contact Us</a>
    			</div>
    		</div>
    	</div>
   </footer>
   <?php include'footer.php';  ?>
  
