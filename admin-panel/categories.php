<?php
	
	error_reporting(0);
	session_start();
	
	require"includes/connection.php";
	include('includes/images_class.php');
	
	$obj = new connection;
	
	date_default_timezone_set('Asia/Kolkata');

	
	
/*============================================
=         Add Contest code          =
=============================================*/

	if(isset($_POST['save']))
	{  
		$name1 = $_POST['name1'];
		$contest_name = $name1;
		$details = trim($_POST['details']);
		$details = $obj->mysqli->real_escape_string($details);
	
		if(!empty($_FILES["video_img"]['name'])) //single file
		{
			$file_name= str_replace(" ","-",$_FILES['video_img']['name']);
			$product_image=rand(0,99999)."_".$file_name;
		 	 
			$tpath1="uploads/images/".$product_image; 			 
			$video_img=compress_image($_FILES["video_img"]["tmp_name"], $tpath1, 80);		 
		} 

		$data = "INSERT INTO category (name,image,Description) VALUES('".$contest_name."','".$product_image."','".$details."')"; 
		
		$result = $obj->insert($data);
		
		
		if($result > 0)
		{      
			$_SESSION["msg"] = "Category Added Successfully !";
			
			$_SESSION['error'] = 'no';
		
			
		}
		
		else 
		{	 
			$_SESSION["msg"] = "Technical Error !";
			
			$_SESSION['error'] = 'yes';
			
		
		}
		
	}
	



/*============================================
=         Delete  Contest code          =
=============================================*/
if(!empty($_POST['contest_delete_id']))
{

	$id = trim($_POST['contest_delete_id']);
	
	$Qury = "SELECT * FROM category WHERE id='".$id."'";  
	$getData = $obj->select_assoc($Qury);
	@$imageToUnlink = $getData[0]['image'];

	 @unlink("uploads/images/".$imageToUnlink);

	 $data1 = "DELETE FROM category WHERE id ='".$id."'"; 
	 $obj->mysqli->autocommit(FALSE);

	if($resource1 = $obj->mysqli->query($data1))
	{ 
		
		$_SESSION["msg"] = "Delete Successfully !";
		$obj->mysqli->commit();	
		$_SESSION["error"] = "no";
			
	}
		
	else
	{
		$obj->mysqli->rollback();
		$_SESSION["msg"] = "Technical Error !";
		$_SESSION["error"] = "yes";

	}
	
	}
		
	
	include 'includes/top-bar.php';
	include 'includes/left-sidebar.php';
	

?>

	<section class="content">
        <div class="container-fluid">
            <div class="block-header">
             	<!-- Trigger the modal with a button -->
				<button type="button" class="btn bg-danger" data-toggle="modal" data-target="#myModal"><i class="material-icons">poll</i> Add New Category</button>
            </div>
            
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Categories Details
                            </h2>
							<div style="margin:20px">
							 <?php 
							if(isset($_SESSION['error'] ))
							{
							
							 if($_SESSION['error'] == 'yes') {  ?>
						
					  <div class="alert alert-danger alert-dismissible fade in" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
						</button>
						<?php 
							
							echo $_SESSION['msg'];
							
							unset($_SESSION['error'],$_SESSION['msg']);
							
							?>
					  </div>
				  
				  <?php }  ?>
				  
				  <?php if($_SESSION['error'] == 'no') {  ?>
				  
				  <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <?php 
						
						echo $_SESSION['msg'];
						
						unset($_SESSION['error'],$_SESSION['msg']);
						
						?>
                  </div>
				  
					<?php }}  ?>
                         </div>
						 
                        </div>
                        <div class="body">
                            <div class="table-responsive">
							<?php
							
									
									$get_query = "SELECT * FROM `category` ORDER BY id DESC";
									
									$data = $obj->select($get_query);
									$i=1;
									?>
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
											<th>#</th>
                                            <th>Name</th>
                                            
                                           <th>Image</th>
                                           
                                          
                                            <th>Action</th>
                                        </tr>
                                    </thead>
									
                                    <tbody>
                                        <?php 
										$i=1;
									foreach($data as $row)
									{	
									
										$calender_date = explode('-',$row['calender_date']);
									
										$date=date_create($calender_date[0]);
										
										$calender_date = date_format($date,"D d M").' - '.$calender_date[1];
										
									    $contestName = ucfirst(str_replace("&" , " " , $row['name']));
										?>
									
										<tr>
										<td ><?php echo $i;$i++; ?></td>
										<td ><?php echo $contestName ; ?></td>
										
								
										<td >
											<a href = "<?php echo 'uploads/images/'.$row['image']; ?>" target="_blank" >
													<img src="<?php if(!empty($row['image'])){
													echo 'uploads/images/'.$row['image'];}else {echo "https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/300px-No_image_available.svg.png";
													}?>"  class="img-thumbnail" style="height:55px; width:55px;" />
												</a>
										</td>
							
										<td>
											
											
											<button type="button"  id="<?php echo $row['id'];?>" data-toggle="modal" data-target="#myModalDelete"  onclick="delete_record(this.id)" style=" margin-bottom: 5px;">
												<i class="material-icons" style="color: red" data-toggle="tooltip" data-placement="top" title="Delete">delete_forever</i>
											</button> <br>
											
										<center>
										<!-- 	<div id="tags">
											  <span>#love</span>
											  <span>#envywear</span>
											  <span>jquery</span>
											  <input type="text" value="" placeholder="Add a tag" />
											</div>
											 -->
											
										</td>
										
										</tr>
									
										<?php
									}
									?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>
            <!-- #END# Exportable Table -->
        </div> 
	</section>
	
	

<!-- Modal to add contest -->

<div id="myModal" class="modal fade" role="dialog">

	<div class="modal-dialog">  
		<form class="form-horizontal form-label-left" method="POST" id="add_customer_form" enctype="multipart/form-data" onSubmit="return videoValidation('myModal')">
		<!-- Modal content-->
			<div class="modal-content">
				<h4 class="card-header danger-color white-text text-center py-4">
		            ADD NEW CATEGORY
		          </h4>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
								<div class="x_content">
								<div class="form-group">
								   <label for="name"> Name :</label>
								   <input type="text" class="form-control" name="name1" required />
							    </div>
									<div class="form-group">
									   <label for="image1">Image <b class="blink_me">(W*H 600*300)</b> :</label>
									   <input name="video_img" type="file" id="video_img" class="form-control" accept=".jpg, .jpeg, .png" required>
									</div>
									
									<div class="form-group">
									   <label for="image1">Description :</label>
									   <textarea name="details" class="form-control"></textarea>
									</div>								  
								</div>
							</div>
						</div>
					</div>
				</div>
				
				
				<div class="modal-footer" >
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-12">
							<button type="submit" name="save" style="margin-bottom: 0" class="btn btn-success">
								<i class="material-icons">verified_user</i>
								<span>Save</span>
							</button>
							
							<button type="button" class="btn bg-red" data-dismiss="modal">
								<i class="material-icons"> close</i>
								<span>Cancel</span>
							</button>
							
							<button type="reset" class="btn bg-pink">
								<i class="material-icons">content_cut</i>
								<span>Reset</span>
							</button>
							
							<input type="hidden" name="contest_video" value="" />
						</div>
					</div> 
				</div>
			</div>
		</form> 
	</div>
	
</div>


<!-- Modal to Delete contest -->

<div id="myModalDelete" class="modal fade" role="dialog">

	<div class="modal-dialog">

		<form class="form-horizontal form-label-left" method="POST" id="add_customer_form" enctype="multipart/form-data">

				<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-danger">Confirmation</h4>
				</div>
				
				<div class="modal-body">
					<div class="row">
						  <div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
						   
							  <div class="x_content">

							
									<div class="form-group show_send_msg_tech text-center">
									
										<div class="demo-google-material-icon"> 
											<i class="material-icons text-danger" style="font-size: 50px;">warning</i> 
										</div>
										<br>
									<label for="text" class="text-danger pwd_send_succ_mail" style="font-size:20px;margin-top:10px">
									<span class="text-danger">Are You Sure You Want To Delete This Record ?</span>
									</label>
								</div>
								
							  </div>
							</div>
						  </div>
						</div>
				</div>
				
				
				<div class="modal-footer" >
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-12">
							<button type="submit" name="delete" class="btn btn-success waves-effect">
								<i class="material-icons">verified_user</i>
								<span>Delete</span>
							</button>
							
							<button type="button" class="btn bg-red waves-effect" data-dismiss="modal">
								<i class="material-icons"> close</i>
								<span>Cancel</span>
							</button>
							<input type="hidden" name="contest_delete_id" value="" />
						</div>
					</div>
				</div>
			</div>
		</form>
			
	</div>
	
</div>


<!-- modal  modal for Edit Contest  -->
<div id="myModalEdit" class="modal fade" role="dialog"> 
  <div class="modal-dialog">

    <!-- Modal content-->
	<div class="data">
    <div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Update Contest</h4>
		</div>
		<div class="loader"></div>
		
    </div>
	</div>				
  </div>
</div>
<!-- modal for Edit Contest ends-->

<!-- script to progress bar for video upload -->

	<script>
 
		$(function() 
		{     
			$(document).ready(function()
			{
				
				$(document).on('click', '#myModal button[type="reset"]', function() 
				{
					
					$('.video-upload')[0].reset();
					
				});
				
				
				var bar = $('#myModal .video-upload .bar');
				var percent = $('#myModal .video-upload .percent');
				var status = $('#myModal .video-upload .status');
				
			   /*  $(document).on('change', '#myModal input[name="video"]', function() 
				{
				
					var iSize = ($("#myModal #video")[0].files[0].size / 1024);
					
					if(iSize > 8465)
					{   
						$('#myModal .upload_video').attr("disabled" , "disabled");
						return false; 
					} 
					
					else
					{
						$('#myModal .upload_video').removeAttr("disabled" , "");
					}
					
					
				}); */
				
				
				$('#myModal .video-upload').ajaxForm({  
				   
					beforeSend: function()
					{  
					
						status.empty();
						var percentVal = '0%';
						bar.width(percentVal);
						percent.html(percentVal);
					},
					
					uploadProgress: function(event, position, total, percentComplete)
					{  
					   
						
						var percentVal = percentComplete + '%';
						percent.html(percentVal);
						bar.width(percentVal);
					},
					
					complete: function(xhr) 
					{
						
						
						status.html(xhr.responseText);
						$("#myModal input[name='contest_video']").val($('#myModal .video_name').html());
						
					}
				
				});
			});
		});
		
		
		
		
		 
		<!-- script to progress bar for video upload ends-->	
			
			
		<!-- Automatic Dissmiss Alert starts -->
		 
			$(document).ready(function()
			{
				setTimeout(function(){ $('.alert').slideUp();}, 3000);
			});	
			
		<!-- Automatic Dissmiss Alert ends -->
		
		
		
	
	
		
		
		<!-- Delete contest Code   -->
		
			function delete_record(id)
			{
				  
				$("input[name='contest_delete_id']").empty();
			
				$("input[name='contest_delete_id']").val(id);
				
			
			}
	   
		<!-- Delete contest Code  Ends  -->
		
		function videoValidation(modalId)
		{
			return true;
		}
			

		
			
	</script>
	<style>
	textarea.form-control {
    height: 130px !important;
}
#tags{
  float:left;
  border:1px solid #ccc;
  padding:5px;
  font-family:Arial;
}
#tags > span{
  cursor:pointer;
  display:block;
  float:left;
  color:#fff;
  background:#789;
  padding:5px;
  padding-right:25px;
  margin:4px;
}
#tags > span:hover{
  opacity:0.7;
}
#tags > span:after{
 position:absolute;
 content:"×";
 border:1px solid;
 padding:2px 5px;
 margin-left:3px;
 font-size:11px;
}
#tags > input{
  background:#eee;
  border:0;
  margin:4px;
  padding:7px;
  width:auto;
}
.py-4{    padding: 1.5rem 0!important;}
.card-header {
    padding: .75rem 1.25rem;
    margin-bottom: 0;
    background-color: rgba(0,0,0,.03);
    border-bottom: 1px solid rgba(0,0,0,.125);
}
	</style>

	<script>
		$(function(){ // DOM ready

  // ::: TAGS BOX

  $("#tags input").on({
    focusout : function() {
      var txt = this.value.replace(/[^a-z0-9\+\-\.\#]/ig,'');
      if(txt) $("<span/>", {text:txt.toLowerCase(), insertBefore:this});
      this.value = "";
    },
    keyup : function(ev) {
      if(/(188|13)/.test(ev.which)) $(this).focusout(); 
    }
  });
  $('#tags').on('click', 'span', function() {
    if(confirm("Remove "+ $(this).text() +"?")) $(this).remove(); 
  });

});
	</script>
	


	<?php
		include 'includes/footer.php';
	?>

