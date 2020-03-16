<!DOCTYPE html>
<head></head>
<body>
<p><a href="#" id="videolink1">Change video</a></p>
<video id="videoclip" controls="controls" poster="images/cover.jpg" title="Video title">
  <source id="mp4video" src="media/video1.mp4" type="video/mp4"  />
 </video>
</body>

<script type="text/javascript">
var videocontainer = document.getElementById('videoclip');
var videosource = document.getElementById('mp4video');
var newmp4 = 'videos/agartuhota.mp4';
var newposter = 'images/video-cover.jpg';
var videobutton = document.getElementById("videolink1");
 
videobutton.addEventListener("click", function(event) {
    videocontainer.pause();
    videosource.setAttribute('src', newmp4);
    videocontainer.load();
    videocontainer.setAttribute('poster', newposter); //Changes video poster image
    videocontainer.play();
}, false);
 

</script>

<!--<script type="text/javascript">
$(document).ready(function() {
  var videoID = 'videoclip';
  var sourceID = 'mp4video';
  var newmp4 = 'media/video2.mp4';
  var newposter = 'media/video-poster2.jpg';
 
  $('#videolink1').click(function(event) {
    $('#'+videoID).get(0).pause();
    $('#'+sourceID).attr('src', newmp4);
    $('#'+videoID).get(0).load();
     //$('#'+videoID).attr('poster', newposter); //Change video poster
    $('#'+videoID).get(0).play();
  });
});

if (navigator.userAgent.indexOf("Opera") > 0 ) {
   videosource.setAttribute('src', 'path-to-webm-or-ogg-file');
} else {
   videosource.setAttribute('src', 'path-to-mp4-file');
}
</script>-->


</html>