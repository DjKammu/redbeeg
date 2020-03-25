
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
	<script type="text/javascript" src="<?php echo $base_url;?>lib/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $base_url;?>dist/jplayer/jquery.jplayer.min.js"></script>
  </body>

<script>

$(document).ready(function(){
	var latestVideo = '<?php echo $latestVideo; ?>';
    var parseJson = JSON.parse(latestVideo);
	var videoLink = parseJson.video;
	var video_img = parseJson.video_img;
	var videoTitle = parseJson.name;
	$("#jquery_jplayer_1").jPlayer({
		ready: function () {
			$(this).jPlayer("setMedia", {
				title: videoTitle,
				m4v:'admin-panel/uploads/videos/'+videoLink,
				ogv:'admin-panel/uploads/videos/'+videoLink,
				webmv:'admin-panel/uploads/videos/'+videoLink,
				wmv:'admin-panel/uploads/videos/'+videoLink,
				poster:'admin-panel/uploads/images/'+video_img
			});
		},
		swfPath: "dist/jplayer",
		supplied: "webmv, ogv, m4v",
		size: {
			width: "auto",
			height: "auto",
			cssClass: "jp-video-360p"
		},
		useStateClassSkin: true,
		autoBlur: false,
		smoothPlayBar: true,
		keyEnabled: true,
		remainingDuration: true,
		toggleDuration: true
	});

});






$('.videolink1').click(function(event){


	//$(".new").addClass('loader');
	$(".jp-video-play-icon").hide();
	$(".play_show").css('display' , 'flex');
	$("#jp_video_0").attr('src' , '');
	$("#jp_video_0").hide();
	$("#jp_poster_0").attr('src','<?php echo $base_url;?>img/load.jpg');
	// // $("<div class='ytp-spinner'><div class='ytp-spinner-container'><div class='ytp-spinner-rotator'><div class='ytp-spinner-left'><div class='ytp-spinner-circle'></div></div><div class='ytp-spinner-right'><div class='ytp-spinner-circle'></div></div></div></div></div>").insertAfter("#jp_video_0");

	// $("#jp_poster_0").attr('src' , '' ); 
    var id = $(this).attr('id');
	var Numericid = id.match(/\d+/);
	var newmp4 = $(this).attr('value');
	var name = $("#p"+Numericid).text();
	var title = $("#p"+Numericid).text();
	var clean_title = $.trim(title)
	var name  = name.trim().substr(0,20)+'...';
	var details = $("#d"+Numericid).text();
	var tags = $("#t"+Numericid).html();

	setTimeout(function(){
		$("#jp_video_0").show();
		$("#jp_video_0").attr('src' , newmp4);
		$("#jp_video_0").attr('title' , clean_title);
		$(".jp-details .jp-title").text(title);
		//$(".card-header").text(name);
		$(".card-header").html('<img src="https://wrappixel.com/demos/admin-templates/monstrous-admin/assets/images/users/4.jpg" class="rounded-circle" style="height:auto; width:40px; margin-right:20px;">'+name);
		//$(".card-header").text(name);
		$(".card-text").text(details);
		$(".card-footer").html(tags);
		$(".jp-play").trigger('click');
				 
	},200);
	 
	
 });	

	$("#jquery_jplayer_1").click(function(){
    $(".jp-play").trigger("click");
   
    if ($(".video_play").length > 0){
    	$(".video_play").css('display','block');
    	$src = $(".video_play").attr('src');
    
    	if($src=='img/play.png'){
    		
    		$src = "img/pause.png";
    	}
    	else{
    		
    		$src = "img/play.png";
    	}
    	$('.video_play').attr('src' , $src);
    }
    else{
    	$src = "img/pause.png";
    	$('<img class="video_play" src='+$src+' />').insertAfter('#jp_video_0');
    }
    setTimeout(function(){ $(".video_play").css('display','none');},500);
 	});	

$(document).ready(function(){
  $("a").on('click', function(event) {
    if (this.hash !== "") {
      event.preventDefault();
      var hash = this.hash;
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
        window.location.hash = hash;
      });
    } // End if
  });
});

setInterval(function(){ 

 var t = 	$('#jp_container_1').hasClass('jp-state-seeking'); 
 if(t==true){
 	 if ($(".ytp-spinner").length > 0){
 	
	}
	else{
		$("<div class='ytp-spinner'><div class='ytp-spinner-container'><div class='ytp-spinner-rotator'><div class='ytp-spinner-left'><div class='ytp-spinner-circle'></div></div><div class='ytp-spinner-right'><div class='ytp-spinner-circle'></div></div></div></div></div>").insertAfter("#jp_video_0");
	}
 }
 else if(t==false){
 	$('.ytp-spinner').remove();
 }


}, 200);

$('.videolink1').click(function(event){
	setInterval(function(){
	//alert($("#jp_container_1").innerHeight());
	$(".card").height($("#jp_container_1").innerHeight()- 2);
},200);
});




</script>
<style>
#jp_container_1{box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12)}
</style>

</html>