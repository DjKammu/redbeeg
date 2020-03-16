<?php

	require"connection.php";
	
	$obj = new connection;
	
/*============================================
=         Contest Name Availability code          =
=============================================*/

	if(!empty($_GET['name']))
	{
		$data = array();
		
		$name = str_replace("-" , "" , $_GET['name']);
		$select_where = "SELECT count(*) as total FROM contest WHERE name = '".$name."'";
		
		$result = $obj->select_where($select_where);

        

		if($result[0]['total']==0)
		{

			$msg = "";

		}

		

		else if($result[0]['total']>0)

		{

			$msg = "Name Already Exists !";

		}

		

		$data['exists'] = $msg;

		echo json_encode($data);
		
		exit();
	}
	
	/*============================================
=         Edit contest_edit_image code          =
=============================================*/

	if(!empty($_GET['contest_edit_image']))
	{       
		$id = $_GET['contest_edit_image'];

		$select_where = "SELECT * FROM slider_image WHERE id = '".$id."'";

		$result = $obj->select_where($select_where);
		$result = $result[0];
		
      
		if(count(array_filter($result))>0)
		{
			
			
			?>
			<form class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">

				<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"> Edit information</h4>
				</div>
				<div class="loader"></div>
				
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel" style="height:auto !important;">
								<div class="x_content" >
								
									<div class="form-group">
										<label for="type">Contest:</label>
										<?php
											$get_query = "SELECT * FROM `contest` order by contest_id desc";
											$data = $obj->select_where($get_query);
											
										?>
											<select class="form-control show-tick" name="contest_id" required="">
												<option value="">-- Please select --</option>
												<?php foreach($data as $row)
													{
														if($result['contest_name']==$row['contest_id'])
														{
															$selected =  "selected";
														}
														else{
															$selected = " ";
														}
														?>
														<option value="<?php echo $row['contest_id'];?>" <?php echo $selected;?>><?php echo ucfirst(str_replace("&" , " " , $row['name'])).' ('.$row['calender_date'].')'; ?></option>
														
														<?php 	
													}
												?>
											</select>
									</div>
									
									<div class="form-group">
									     <label for="image1">Slider Image (W*H 500*250) :</label>
									   <input name="img1" type="file" id="img1" class="form-control" accept=".jpg, .jpeg, .png" >
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
						<button type="submit" name="update" class="btn btn-success waves-effect">
							<i class="material-icons">verified_user</i>
							<span>Update</span>
						</button>
						
						<button type="button" class="btn bg-red waves-effect" data-dismiss="modal">
							<i class="material-icons"> close</i>
							<span>Cancel</span>
						</button>
						
						<button type="reset" class="btn bg-pink waves-effect">
							<i class="material-icons">content_cut</i>
							<span>Reset</span>
						</button>
						<input type="hidden" name="contest_edit_image" value="<?php echo $id;?>" />
						<input type="hidden" name="prev_img" value="<?php echo $result['image'];?>" />
						
					</div>
				</div> 
			</div>
			</div>
		</form>
			
		
			<?php
		}
		
		
	}

	
	/*============================================
=         Edit Contest code          =
=============================================*/

	if(!empty($_GET['contest_edit_id']))
	{       
		$id = $_GET['contest_edit_id'];

		$select_where = "SELECT * FROM contest WHERE contest_id = '".$id."'";

		$result = $obj->select_where($select_where);
		$result = $result[0];
		
      
		if(count(array_filter($result))>0)
		{
			$array = explode("&" , $result['name']);
			
			?>
			<form class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">

				<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Update Contest</h4>
				</div>
				
				<div class="loader"></div>
				
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
								<div class="x_content">
									
									<div class="row">
										<div class="col-md-5" style="padding: 0;margin-left: 15px;">
										  <div class="form-group">
										   <label for="name"> Name :</label>
										   <input type="text" class="form-control" name="name1" value="<?php echo $array[0];?>" required id="name1">
										  </div>
										</div>
										
										<div class="col-md-1">
										  <p class="vs" style="font-weight: bold;margin-top: 30px;margin-left: 2px;">V/S</p>
										</div>
										
										<div class="col-md-5" style="padding: 0;margin-left: 14px;">
										  <div class="form-group">
										   <label for="name"> Name :</label>
										   <input type="text" class="form-control" name="name2" 
										   value="<?php echo $array[1]?>"  id="name2" required>
										  </div>
										</div>
									</div>
								  
								  
									<div class="alert alert-danger fade in alert-dismissable email_exists" style="display:none;margin-top:5px;text-shadow:none !important;">
										<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><strong>Danger!  </strong>Name Already Exists !
									</div>
									
									<div class="form-group">
									
										<label for="image2">Start Date:</label>
										
                                        
                                        <input type="text" name="m_date" class="datetimepicker form-control" placeholder="Please choose date & time..." value="<?php echo $result['calender_date'];?>" >
                                        
                                    </div>
									
									<div class="form-group">
												
										<label for="type">Contest Status:</label>
										
											<select class="form-control show-tick" name="contest-status" >
												<option value="">-- Change Contest Status --</option>
												
												<option <?php if($result['ending_status'] == 0)  echo "selected" ?> value="0">Start Contest</option>
												
												<option <?php if($result['ending_status'] == 2)  echo "selected" ?> value="2">Close Contest</option>
													
												
											</select>
										
									</div>
								  
								
			  
								  <div class="form-group">
								   <label for="image1">Image 1:</label>
								   <input name="img1" type="file" id="img1" class="form-control" accept=".jpg, .jpeg, .png" >
								  </div>
								  
								  <div class="form-group">
								   <label for="image2">Image 2:</label>
								   <input name="img2" type="file" id="img2" class="form-control" accept=".jpg, .jpeg, .png" >
								  </div>
								  
								  <div class="form-group">
								   <label for="name"> Video Name :</label>
								   <input type="text" class="form-control" name="video-name" value="<?php echo $result['video_name'];?>"required>
								  </div>
								  
								   <div class="form-group">
                                     <label for="name"> Video Time :</label>
                                            <input type="text" class="timepicker form-control" placeholder="Please choose a time..." name="video_time"   value="<?php echo $result['video_time'];?>">
                            
                                    </div>
									
									<div class="form-group">
									   <label for="image1">Screenshots of video:</label>
									   <input name="video_img" type="file" id="video_img" class="form-control" accept=".jpg, .jpeg, .png" >
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
						<button type="submit" name="update" class="btn btn-success waves-effect">
							<i class="material-icons">verified_user</i>
							<span>Update</span>
						</button>
						
						<button type="button" class="btn bg-red waves-effect" data-dismiss="modal">
							<i class="material-icons"> close</i>
							<span>Cancel</span>
						</button>
						
						<button type="reset" class="btn bg-pink waves-effect">
							<i class="material-icons">content_cut</i>
							<span>Reset</span>
						</button>
						
						<input type="hidden" name="contest_video" value="<?php echo $result['video'];?>" />
						<input type="hidden" name="contest_edit_id" value="<?php echo $id;?>" />
						<input type="hidden" name="img1" value="<?php echo $result['img1'];?>" />
						<input type="hidden" name="img2" value="<?php echo $result['img2'];?>" />
						<input type="hidden" name="video_img" value="<?php echo $result['video_img'];?>" />
					</div>
				</div> 
			</div>
			</div>
		</form>
			
		<form method='post' class="video-upload-edit" action='videoupload.php' enctype='multipart/form-data' >
			<div class="form-group focused" style="position: absolute; margin-top: -224px; padding: 6px 34px;    color: #777;">
				<label for="video">Video(MAXIMUM 8.3 MB):</label>
				<input name="video" type="file" id="video" class="form-control"  oninvalid="this.setCustomValidity('Please select file')">
				
				<div class="row" style="padding:20px;">
					<div class="col-md-7">
						<div class="bararea">
							<div class="bar"></div>
						</div>
					 <div class="percent"></div>
					 
					</div>
					
					<div class="col-md-3">
						<div class="status"></div>
					</div>
					
					<div class="col-md-2">
						<button class="btn btn-success waves-effect btn-xs upload_video">
							<i class="material-icons">verified_user</i>
							<span>Upload</span>
						</button>
					</div>
				</div>
				
			</div>
		</form>
			
			
			<?php
		}
		
		
	}
	
	
		
/*============================================
=         Edit Question code          =
=============================================*/

if(!empty($_GET['question_edit_id']))
{       
	$id = $_GET['question_edit_id'];
	
	$contestId = $_GET['contestId'];
	
	$questionNumber = $_GET['questionNumber'];

	$select_where = "SELECT * FROM questions WHERE question_id = '".$id."'";

	$result = $obj->select_where($select_where);
	
	$result = $result[0];
	
	$select_contest = "SELECT calender_date,name FROM contest WHERE contest_id = '".$contestId."'";

	$result_contest = $obj->select_where($select_contest);
	
	$contestName = ucfirst(str_replace("&" , " " , $result_contest[0]['name']))."\n"."(" . $result_contest[0]['calender_date']. ")";

	if(count(array_filter($result))>0)
	{
		?>

		<div class="x_content">
					
			<div class="row" style="border:1px solid #E6E9ED; padding:10px 5px; margin-top:8px;box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);">
                <div class="text-center" style='padding:10px; border-bottom: 2px solid #eee; margin-bottom: 10px;"'><b> Contest Name: </b> <?php echo $contestName; ?></div>
				<div class="col-md-6">
					<div class="form-group" style="padding-right:5px">
						<label for="qus"> Question (<?php echo $questionNumber ; ?>) :</label>
						<textarea name="qus" class="form-control" style="width: 100%;"><?php echo trim($result['question']);?>
						</textarea>
					</div>
				</div>		

				<div class="col-md-6">				
					<div class="form-group" style="padding-left:5px">
						<label for="point"> Points :</label>
						<input type="number" class="form-control" name="points" value="<?php echo trim($result['points']);?>" min="0" required="" type="any">
					</div>
				</div>
				
				
				<div class="col-md-6">
					<div class="form-group" style="padding-right:5px">
						<label for="option"> Option (1) :</label>
						<textarea name="option1" class="form-control" style="width: 100%;"><?php echo trim($result['option1']);?>
						</textarea>
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="form-group" style="padding-left:5px">
						<label for="option"> Option (2) :</label>
						<textarea name="option2" class="form-control" style="width: 100%;"><?php echo trim($result['option2']);?>
						</textarea>
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="form-group" style="padding-right:5px">
						<label for="option"> Option (3) :</label>
						<textarea name="option3" class="form-control" style="width: 100%;"><?php echo trim($result['option3']);?>
						</textarea>
					</div>
				</div> 
				
				<div class="col-md-6">
					<div class="form-group" style="padding-left:5px">
						<label for="option"> Option (4) :</label>
						<textarea name="option4" class="form-control" style="width: 100%;"><?php echo trim($result['option4']);?>
						</textarea>
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="form-group" style="padding-right:5px">
						<label for="type">Answer:</label>
			
						<select class="form-control show-tick" name="question_answer" class="answer" required="">
							<option value="">-- Please select --</option>
						
							<option value="option1" <?php if($result['question_ans']=='option1'){echo "selected"; } ?>>Option1</option>
							<option value="option2" <?php if($result['question_ans']=='option2'){echo "selected"; } ?>>Option2</option>
							<option value="option3" <?php if($result['question_ans']=='option3'){echo "selected"; } ?>>Option3</option>
							<option value="option4" <?php if($result['question_ans']=='option4'){echo "selected"; } ?>>Option4</option>
						
						</select>
			
					</div>
				</div>
				
				
				<div class="col-md-6">
					<div class="form-group" style="padding-left:5px">
						<label for="type">Type:</label>
							<select class="form-control show-tick" name="type" required="">
								<option value="">-- Please select --</option>
								<option value="king"  <?php if($result['type']=='king'){echo "selected"; } ?> >King</option>
								<option value="queen"  <?php if($result['type']=='queen'){echo "selected"; } ?> >Queen</option>
								<option value="normal"  <?php if($result['type']=='normal'){echo "selected"; } ?> >Normal</option>
							</select>
					</div>
				</div>	
			
			</div>
			
			<input type="hidden" name="question_edit_id" value="<?php echo $id;?>" />
			<input type="hidden" name="contestId" value="<?php echo $contestId;?>" />
		</div>
		

		
		
				
		<?php
	}
}

	
/*============================================
=         Edit TEAM code          =
=============================================*/

	if(!empty($_GET['team_edit_id']))
	{       
		$id = $_GET['team_edit_id'];

		$select_where = "SELECT * FROM team WHERE team_id = '".$id."'";

		$result = $obj->select_where($select_where);
		
		$result = $result[0];
		
		$name_team = explode("(" , $result['name']);
		
		$name = $name_team[0];
		echo 'hi'.$team = str_replace(")" , "" ,$name_team[1]);
		
		$state_city = explode("_" , $result['state_city']);
		$state = $state_city[0];
		$city =  $state_city[1];
		
      
		if(count(array_filter($result))>0)
		{
			$array = explode("&" , $result['name']);
			
			?>
			<form class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">

				<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Team Edit</h4>
				</div>
				<div class="loader"></div>
				
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel" style="height:auto !important">
								<div class="x_content">
								
									<div class="form-group">
										<label for="name">Name:</label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter Name..." value="<?php echo $name;?>" required>
                                    </div>
									
									<div class="form-group">
									
										<label for="state">Sequence:</label>
										
											<select class="form-control show-tick" name="sequence" required="">
												<option value="">-- Please select --</option>
												<option value="T1" <?php if($team == 'T1') echo "selected"; ?> >T1</option>
												<option value="T2" <?php if($team == 'T2') echo "selected"; ?> >T2</option>
												<option value="T3" <?php if($team == 'T3') echo "selected"; ?> >T3</option>
												<option value="T4" <?php if($team == 'T4') echo "selected"; ?> >T4</option>
												<option value="T5" <?php if($team == 'T5') echo "selected"; ?> >T5</option>
												<option value="T6" <?php if($team == 'T6') echo "selected"; ?> >T6</option>
												
											</select>
									</div>
									
									<div class="form-group">
										<label for="state">State:</label>
										<?php
											$get_query = "SELECT * FROM `states` WHERE country_id = '101' AND id != 4 AND id != 29 AND id != 36 ORDER BY name ASC";
											$data = $obj->select($get_query);
										?>
											<select class="form-control show-tick" name="state_id" required="">
												<option value="">-- Please select --</option>
												<?php foreach($data as $row)
												{   
												   if($row['id']==$state){$selected = "selected";}else{$selected = "";}
													?>
													<option value="<?php echo $row['id'];?>" <?php echo $selected;?>><?php echo ucfirst( $row['name']); ?></option>
													
													<?php 	
												}
												?>
											</select>
									</div>
									
									<div class="form-group">
									   <label for="gstin">City :</label>
									   <input type="text" class="form-control" name="city_id"   required="" value="<?php echo $city;?>">
									</div>
								  
								  <div class="form-group">
								   <label for="gstin">King :</label>
								   <input type="number" class="form-control" name="king" min="0" required="" type="any" value="<?php echo $result['king'];?>">
								  </div>
								  
								  <div class="form-group">
								   <label for="gstin">Queen :</label>
								   <input type="number" class="form-control" name="queen" min="0" required="" type="any" value="<?php echo $result['queen'];?>">
								  </div>
								  
								  <div class="form-group focused">
								   <label for="image">Image :</label>
								   <input name="image" type="file" class="form-control" accept=".jpg, .jpeg, .png" >
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
						<button type="submit" name="update" class="btn btn-success waves-effect">
							<i class="material-icons">verified_user</i>
							<span>Update</span>
						</button>
						
						<button type="button" class="btn bg-red waves-effect" data-dismiss="modal">
							<i class="material-icons"> close</i>
							<span>Cancel</span>
						</button>
						
						<button type="reset" class="btn bg-pink waves-effect">
							<i class="material-icons">content_cut</i>
							<span>Reset</span>
						</button>
						
						<input type="hidden" name="team_edit_id" value="<?php echo $id;?>" />
						<input type="hidden" name="prev_image" value="<?php echo $result['team_image'];?>" />
						
					</div>
				</div> 
			</div>
			</div>
		</form>
	
			
			
			<?php
		}
		
		
	}
	
/*============================================
=         Edit Joined TEAM code          =
=============================================*/

	if(!empty($_GET['team_joined_edit_id']))
	{       
		$team_joined_edit_id = $_GET['team_joined_edit_id'];
		
		$result = $obj->select_where_with_param('user_joining_contest' , 'id = '.$team_joined_edit_id.' ');
	
		$result = $result[0];
		
		$contest = $obj->select_where_with_param('sub_contests' , 'sub_id = '.$result['sub_contest_id'].' ');
	
		$contest = $contest[0];
		
		//print_r($result);die();
			
			?>
			<form class="form-horizontal form-label-left" method="POST" id="add_customer_form" enctype="multipart/form-data">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Join Contest</h4>
					</div>	
						<div class="modal-body">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="x_panel" style="height:auto !important">
									
										<div class="x_content">		
												
											<div class="form-group">
												<label for="type">Team:</label>
												<?php
													$get_team = "SELECT * FROM `team` where user_id=0 ORDER BY team_id DESC";
													$data_team = $obj->select($get_team);
													?>
													
													
													<select class="form-control show-tick "  name="team_id[]" required="">
														<option value="">-- Select Team --</option>
														<?php foreach($data_team as $row)
														{
															?>
															<option <?php if($result['team_id'] == $row['team_id']) echo "selected";?>  value="<?php echo $row['team_id'].'__'.$row['name'];?>"><?php echo ucfirst(str_replace("&" , " " , $row['name'])); ?></option>
															
															<?php 	
														}
														?>
													</select>
												
											</div>
												
											<div class="form-group">
												<label for="type">Contest:</label>
													<?php
													$get_query = "SELECT * FROM `contest` ORDER BY contest_id DESC";
													$data = $obj->select($get_query);
													?>
													<select class="form-control show-tick contest_id" name="contest_id" required="">
														<option value="">-- Select Contest --</option>
														<?php foreach($data as $row)
														{
															?>
															<option <?php if($contest['contest_id'] == $row['contest_id']) echo "selected";?> value="<?php echo $row['contest_id'];?>"><?php echo ucfirst(str_replace("&" , " " , $row['name'])); ?></option>
															
															<?php 	
														}
														?>
													</select>
											</div>
											
											<div class="form-group">
												<label for="type">sub Contest:</label>
												
												<div class="sub_contest_container">
												
													<select class="form-control sub_contest_id" name="sub_contest_id" required="">
													
														<?php 
														
															$sub_contest = $obj->select_where_with_param('sub_contests' , 'contest_id = '.$contest['contest_id'].' ');
	
															
														//echo 'hi111'."<pre>";print_r($sub_contest);die();
														?>
												
														<option value="">-- Select Sub Contest Id --</option>
														
														<?php foreach($sub_contest as $row)
														{
															?>
															<option <?php if($result['sub_contest_id'] == $row['sub_id']) echo "selected";?> value="<?php echo $row['sub_id'];?>"><?php echo $row['total_winnings'].'(total winnings) and '.$row['entry_fee'].'(entry_fee)'; ?></option>
															
															<?php 	
														}
														?>
													
													</select>
												
												<div>
												
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
											<button type="submit" name="edit_join_contest_submit" class="btn btn-success waves-effect">
												<i class="material-icons">verified_user</i>
												<span>Save</span>
											</button>
											
											<button type="button" class="btn bg-red waves-effect" data-dismiss="modal">
												<i class="material-icons"> close</i>
												<span>Cancel</span>
											</button>
											
											<button type="reset" class="btn bg-pink waves-effect">
												<i class="material-icons">content_cut</i>
												<span>Reset</span>
											</button>
											
											<input type="hidden" name="team_joined_edit_id" value="<?php echo $team_joined_edit_id;?>" />
											
										</div>
									</div> 
								</div>
							</div>
						</form>
	
			
			
			<?php
		
	}
	

	
/*============================================
=         Edit Joined TEAM code          =
=============================================*/

	if(!empty($_GET['admin_team_joined_edit_id']))
	{       
		$team_joined_edit_id = $_GET['admin_team_joined_edit_id'];
		
		$result = $obj->select_where_with_param('user_joining_contest' , 'id = '.$team_joined_edit_id.' ');
	
		$result = $result[0];
		
		$contest = $obj->select_where_with_param('sub_contests' , 'sub_id = '.$result['sub_contest_id'].' ');
	
		$contest = $contest[0];
		
		//print_r($result);die();
			
			?>
			<form class="form-horizontal form-label-left" method="POST" id="add_customer_form" enctype="multipart/form-data">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Update Admin Joined Team</h4>
					</div>	
					
					<div class="loader"></div>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="x_panel" style="height:auto !important">
									
										<div class="x_content">		
												
											<div class="form-group">
												<label for="type">Team:</label>
												<?php
													$get_team = "SELECT * FROM `team` where user_id=0 ORDER BY team_id DESC";
													$data_team = $obj->select($get_team);
													?>
													
													
													<select class="form-control show-tick "  name="team_id[]" required="">
														<option value="">-- Select Team --</option>
														<?php foreach($data_team as $row)
														{
															?>
															<option <?php if($result['team_id'] == $row['team_id']) echo "selected";?>  value="<?php echo $row['team_id'].'__'.$row['name'];?>"><?php echo ucfirst(str_replace("&" , " " , $row['name'])); ?></option>
															
															<?php 	
														}
														?>
													</select>
												
											</div>
												
											<div class="form-group">
												<label for="type">Contest:</label>
													<?php
													$get_query = "SELECT name,calender_date,contest_id FROM `contest` ORDER BY contest_id DESC";
													$data = $obj->select($get_query);
													?>
													<select class="form-control show-tick contest_id" name="contest_id" required="">
														<option value="">-- Select Contest --</option>
														<?php foreach($data as $row)
														{
															?>
															<option <?php if($contest['contest_id'] == $row['contest_id']) echo "selected";?> value="<?php echo $row['contest_id'];?>"><?php echo ucfirst(str_replace("&" , " " , $row['name']))."(" . $row['calender_date']. ")"; ?></option>
															
															<?php 	
														}
														?>
													</select>
											</div>
											
											<div class="form-group">
												<label for="type">sub Contest:</label>
												
												<div class="sub_contest_container">
												
													<select class="form-control sub_contest_id" name="sub_contest_id" required="">
													
														<?php 
														
															$sub_contest = $obj->select_where_with_param('sub_contests' , 'contest_id = '.$contest['contest_id'].' ');
	
															
														//echo 'hi111'."<pre>";print_r($sub_contest);die();
														?>
												
														<option value="">-- Select Sub Contest Id --</option>
														
														<?php foreach($sub_contest as $row)
														{
															if($result['sub_contest_id'] == $row['sub_id']){
																
																$selected = "selected";
																
															} else {
																
																$selected = "";
															}
															
															$fPrize = json_decode($row['ranks'], true);
															
															echo '<option value="'.$row['sub_id'].'" '.$selected.'>'.$row['entry_fee'].'(E.F.)'.$row['user_limit'].'(T.)'.$row['winners'].'(W.)'.$fPrize[0]['prize'].'(F. P.)'.$row['total_winnings'].'(T. W.)'.$type.'(Type) </option>';
															
															/* ?>
															<option <?php if($result['sub_contest_id'] == $row['sub_id']) echo "selected";?> value="<?php echo $row['sub_id'];?>"><?php echo $row['total_winnings'].'(total winnings) and '.$row['entry_fee'].'(entry_fee)'; ?></option>
															
															<?php  */	
														}
														?>
													
													</select>
												
									
												</div>
												
											</div>
											<div class="form-group">
									
												<label for="state">Status:</label>
												
													<select class="form-control show-tick" name="status" required="">
														
														<option value="1" <?php if($result['status'] == 1) echo "selected"?>>Join</option>
														<option value="0" <?php if($result['status'] == 0) echo "selected"?>>Unjoin</option>
														
													</select>
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
											<button type="submit" name="edit_join_contest_submit" class="btn btn-success waves-effect">
												<i class="material-icons">verified_user</i>
												<span>Save</span>
											</button>
											
											<button type="button" class="btn bg-red waves-effect" data-dismiss="modal">
												<i class="material-icons"> close</i>
												<span>Cancel</span>
											</button>
											
											<button type="reset" class="btn bg-pink waves-effect">
												<i class="material-icons">content_cut</i>
												<span>Reset</span>
											</button>
											
											<input type="hidden" name="admin_team_joined_edit_id" value="<?php echo $team_joined_edit_id;?>" />
											
										</div>
									</div> 
								</div>
							</div>
						</form>
	
			
			
			<?php
		
	}
	


/*============================================
=         Question Type  code          =
=============================================*/

	if(isset($_GET['question_types']))
	{
		$data = array();
		
		$question_types = $_GET['question_types'];
		
		$question_types = explode("," , $question_types);
		
		$count = array_count_values($question_types);
		
		$king = $count['king'];
		
		$queen = $count['queen'];
		
		if($king>1)
		{   
			$data['error'] = "YES";
			$data['msg'] ='<span class="font-bold col-pink">Please Select King Once ! </span>';
		}

		else if($queen>1)
		{
			$data['error'] = "YES";
			$data['msg'] ='<span class="col-pink font-bold">Please Select Queen Once ! </span>';
		}
		
		
		else if($queen>1 && $king>1)
		{
			$data['error'] = "YES";
			$data['msg'] ='<span class="col-pink font-bold">Please Select King Once ! </span><br><span class="col-pink font-bold">Please Select Queen Once ! </span>';
		}
		
		else
		{
				$data['error'] = "NO";
		}
		
		
		
		echo json_encode($data);
		
	}
	
		
	
/*============================================
=         Edit Rank Number         =
=============================================*/

if(!empty($_GET['ranks_no']))
{       
	$no = $_GET['ranks_no'];
	
	for($i=1;$i<=$no;$i++)
	{

		?>
		<div class="row rank_row">
			<div class="col-md-4">
				<div class="form-group" style="padding-right:5px">
					<label for="qus">From Rank :</label>
					<input type="number" class="form-control" name="from[]" value="" min="0" required="" type="any">
				</div>
			</div>		

			<div class="col-md-4">				
				<div class="form-group" style="padding-left:5px">
					<label for="point"> To Rank :</label>
					<input type="number" class="form-control" name="to[]" value="0" min="0" type="any">
				</div>
			</div>
						
						
			<div class="col-md-4">
				<div class="form-group" style="padding-left:5px">
					<label for="option"> Prize :</label>
					<input type="number" class="form-control" name="prize[]" value="" min="0" required="" type="any">
				</div>
			</div>
			
			
			
			
			
		</div>	
	<?php } ?>
	
	<div class="prize_row "></div>
			
			<div class="">
				<div class="form-group ">
					<label for="gstin">Refferal Amount :</label>
					<input type="number" class="form-control refferal_amount" name="refferal_amount" value="" min="0" required>
				</div>
			</div>
<?php }


/*============================================
=         Edit Sub Contest code          =
=============================================*/

if(!empty($_GET['subcontest_edit_id']))
{       
	$id = $_GET['subcontest_edit_id'];

	$select_where = "SELECT * FROM sub_contests WHERE sub_id = '".$id."'";

	$result = $obj->select_where($select_where);
	
	$result = $result[0];
	
		
      
	if(count(array_filter($result))>0)
	{
		$ranks = json_decode($result['ranks']);
		$ranks_count = count($ranks);
		
		?>

		<div class="x_content" >
		
			<div class="form-group">
				<label for="type">Action:</label>
				
					<select class="form-control show-tick load_drop_down" name="record_action" required="">
					
						<option value="update_record" selected>Update</option>
						<option value="copy_record" >Copy</option>
						
					</select>
			</div>
								
			<div class="form-group">
				<label for="type">Contest:</label>
				<?php
					$cruent_time = date('Y-m-d');
											
					$get_query = "SELECT DISTINCT contest.* from contest INNER JOIN sub_contests on contest.contest_id = sub_contests.contest_id INNER JOIN questions on  contest.contest_id = questions.contest_id where ('".$cruent_time."' = CONVERT(DATE_FORMAT(DATE_ADD(start_date, INTERVAL 0 MINUTE) ,'%Y-%m-%d'),DATETIME))  order by contest.contest_id asc";
					$data = $obj->select($get_query);
				?>
					<select class="form-control show-tick load_drop_down" name="contest_id" required="">
						<option value="">-- Please select --</option>
						<?php foreach($data as $row)
						{
							if($result['contest_id']==$row['contest_id'])
							{
								$selected =  "selected";
							}
							else{
								$selected = " ";
							}
							?>
							<option value="<?php echo $row['contest_id'];?>" <?php echo $selected;?>><?php echo ucfirst(str_replace("&" , " " , $row['name'])).' ('.$row['calender_date'].')'; ?></option>
							
							<?php 	
						}
						?>
					</select>
			</div>
			
			<div class="form-group">
			   <label for="gstin">Entry Fee :</label>
			   <input type="number" class="form-control" name="entry_fee" value="<?php echo $result['entry_fee']; ?>" min="0" required="" type="any">
			</div>
			
			<div class="form-group">
				<label for="type">Type:</label>
				
					<select class="form-control show-tick load_drop_down" name="play_type" required="">
						<option value="">-- Please select --</option>
							<option value="play_for_free" <?php if($result['play_type']=='play_for_free'){echo 'selected';}?>>Play For Free</option>
							<option value="play_for_cash" <?php if($result['play_type']=='play_for_cash'){echo 'selected';}?>>Play For Cash</option>
							<option value="super_duper" <?php if($result['play_type']=='super_duper'){echo 'selected';}?>>Super Duper</option>
							
					</select>
			</div>

			<div class="form-group">
			   <label for="gstin">Users Limit :</label>
			   <input type="number" class="form-control" name="user_limit" value="<?php echo $result['user_limit']; ?>" min="0" required="" type="any">
			</div>
			
			<div class="form-group">
			   <label for="gstin">Winners :</label>
			   <input type="number" class="form-control" name="winners" value="<?php echo $result['winners']; ?>" min="0" required="" type="any">
			</div>
			
			<div class="form-group">
				<label for="type">Ranks :</label>
				
					<input type="number" class="form-control" name="ranks_no" value="<?php echo $ranks_count; ?>" min="1" required="" >
				
					<!--<select class="form-control show-tick" name="ranks_no" required="">
						<option value="">-- Please select --</option>
						
						<?php 
						
							for($i=1;$i<=20;$i++)
							{
								if($i==$ranks_count)
								{
									$selected =  "selected";
								}
								
								else
								{
									$selected = " ";
								}
								
								?>
								<option value="<?php echo $i;?>" <?php echo $selected; ?>><?php echo $i;?></option>
								
								<?php 	
							}
							
							?>
					</select>-->
			</div>
			
			
			
			<div class="rank_data">
			
			
				<?php 
				
				foreach($ranks as $rdata)
				{

					?>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group" style="padding-right:5px">
								<label for="qus">From Rank :</label>
								<input type="number" class="form-control" name="from[]" value="<?php echo $rdata->from;?>" min="0" required="" type="any">
							</div>
						</div>		

						<div class="col-md-4">				
							<div class="form-group" style="padding-left:5px">
								<label for="point"> To Rank :</label>
								<input type="number" class="form-control" name="to[]" value="<?php echo $rdata->to;?>" min="0" type="any">
							</div>
						</div>
									
									
						<div class="col-md-4">
							<div class="form-group" style="padding-left:5px">
								<label for="option"> Prize :</label>
								<input type="number" class="form-control" name="prize[]" value="<?php echo $rdata->prize;?>" min="0" required="" type="any">
							</div>
						</div>
					</div>	
					<?php
				}
				?>
			</div>
			
			<div class="prize_row">
			
				<div class="form-group "><label for="gstin">Total Winning Prize :</label><input type="number" class="form-control" name="total_winnings" value="<?php echo $result['total_winnings'];?>" min="0" readonly></div>
				
				
			</div>
			 
			<div class="refferal_amount_hide">
				<div class="form-group ">
					<label for="gstin">Refferal Amount :</label><input type="number" class="form-control" name="refferal_amount" value="<?php echo $result['refferal_amount'];?>" min="0" required>
				</div>
			</div>
			
			
			
			<input type="hidden" name="subcontest_edit_id" value="<?php echo $id;?>" />
		</div>
				
		<?php
	}
}



if(!empty($_GET['contest_id']) && $_GET['type'] == 'get_sub_list'){
	
	$contest_id = $_GET['contest_id'];
	
	$sub_contests = $obj->select_where_with_fields('sub_contests' , 'contest_id ='.$contest_id.' order by sub_id desc', '*');
	
	echo  '<select class="form-control sub_contest_id" name="sub_contest_id" required=""><option value="">-- Select sub contest --</option>';
	
	if(count($sub_contests) > 0){
								
		foreach($sub_contests as $sub_contest){ 
		
			$user_join = "SELECT COUNT(*) AS total FROM `user_joining_contest` WHERE sub_contest_id='".$sub_contest['sub_id']."' AND status = 1";
												
			$user_join_query = $obj->select_where($user_join);
			
			$user_count_join = $user_join_query[0];
			
			if($sub_contest['user_limit'] > $user_count_join['total'] ){
				
				if($sub_contest['play_type']=="play_for_cash")
				{
					$type = 'Cash';
				}
					
				elseif($sub_contest['play_type']=="play_for_free")
				{
					$type = 'Free';
				}
				elseif($sub_contest['play_type']=="super_duper"){
					
					$type = 'Super';
				}
				
				else{
					
					$type = 'N/A';
				}
			
				$fPrize = json_decode($sub_contest['ranks'], true);
			
				echo '<option value="'.$sub_contest['sub_id'].'">'.$sub_contest['entry_fee'].'(E.F.)'.$sub_contest['user_limit'].'(T.)'.$sub_contest['winners'].'(W.)'.$fPrize[0]['prize'].'(F. P.)'.$sub_contest['total_winnings'].'(T. W.)'.$type.'(Type) </option>';
				
			}
		
			
		
		}  
		
	} 
	
	echo "</select>";
}



if(!empty($_GET['contest_id']) && $_GET['type'] == 'get_sub_list_on_submit'){
	
	$contest_id = $_GET['contest_id'];
	
	$sub_contests = $obj->select_where_with_fields('sub_contests' , 'contest_id ='.$contest_id.' order by sub_id desc', '*');
	
	echo  '<select class="form-control sub_contest_id" name="sub_contest_id" required=""   onChange="this.form.submit()"><option value="">-- Select sub contest --</option>';
	
	if(count($sub_contests) > 0){
								
		foreach($sub_contests as $sub_contest){ 
		
		
			$user_join = "SELECT COUNT(*) AS total FROM `user_joining_contest` WHERE sub_contest_id='".$sub_contest['sub_id']."' AND status = 1";
												
			$user_join_query = $obj->select_where($user_join);
			
			$user_count_join = $user_join_query[0];
			
			if($sub_contest['user_limit'] > $user_count_join['total'] ){
		
				if($sub_contest['play_type']=="play_for_cash")
				{
					$type = 'Cash';
				}
					
				elseif($sub_contest['play_type']=="play_for_free")
				{
					$type = 'Free';
				}
				elseif($sub_contest['play_type']=="super_duper"){
					
					$type = 'Super';
				}
				
				else{
					
					$type = 'N/A';
				}
			
				$fPrize = json_decode($sub_contest['ranks'], true);
			
				echo '<option value="'.$sub_contest['sub_id'].'">'.$sub_contest['entry_fee'].'(E.F.)'.$sub_contest['user_limit'].'(T.)'.$sub_contest['winners'].'(W.)'.$fPrize[0]['prize'].'(F. P.)'.$sub_contest['total_winnings'].'(T. W.)'.$type.'(Type) </option>';
			
			}
		
		}  
		
	}
	
	echo "</select>";
}


if(!empty($_GET['sub_contest_id']) && $_GET['type'] == 'get_team_by_rank')
{
	
	$sub_contest_id = $_GET['sub_contest_id'];
	$contestName = $_GET['contestName'];
	$subContestname = $_GET['subContestname'];
	
	
	$contest = "SELECT * FROM `sub_contests` WHERE sub_id=".$sub_contest_id."";
	
	$contest_data = $obj->select_where($contest);
	
	$contest_data = $contest_data[0];
	
	$decoded_array  = json_decode($contest_data['ranks']);
		
	$limit = $contest_data['winners'];
	
	$data = "SELECT ROUND(SUM(credit_points)) AS points,user_id,team_id FROM `user_question_ans` WHERE sub_contest_id=".$sub_contest_id." GROUP BY team_id ORDER BY SUM(credit_points) DESC LIMIT $limit";
	
	$result = $obj->select_where($data); 

	$count = count(array_filter($result));
	
	if($count>0)
	{ 
		$d=1;
		
		foreach($decoded_array as $array)
		{    
			if($array->to !=0)
			{
				$from = $array->from;
				$to = $array->to;
				$diff = $to-$from+1;
			
			}

			else
			{
				$diff = 1;	
			}
		
			$i=0;
			
			foreach($result as $row)
			{ 
				if($i<$diff)
				{  
					$team_ids[] = $row['team_id'];
					$user_points[] = $row['points'];
					unset($result[$i]);
				}
				
				$i++;
			}
			
		
			foreach($team_ids as $team_id)
			{
				$data_points = "SELECT  SUM(credit_points) AS points FROM `user_question_ans` WHERE sub_contest_id=".$sub_contest_id." AND team_id=".$team_id."";
	
				$result_points = $obj->select_where($data_points);
				
				$result_points = $result_points[0];
				
				$get_userid_by_teamid = $obj->select_where_with_fields('team' , 'team_id = '.$team_id.'', 'user_id');
				
				if($get_userid_by_teamid[0]['user_id'] =='0' || $get_userid_by_teamid[0]['user_id'] =="")
				{   
					$user = "SELECT `name`,`state_city` FROM `team` WHERE team_id=".$team_id."";
					
					$user_data = $obj->select_where($user);
					$user_data = $user_data[0];
					
					$state_city = explode("_" , $user_data['state_city']);
					$state = $state_city[0];
					$city =  $state_city[1]; 
					$numeric = is_numeric($city);
					if($numeric > 0)
					{
						$get_city = $obj->select_where_with_fields('cities' , 'state_id='.$state.' AND id='.$city.'', 'name');
						$get_city = $get_city[0]['name'];
					}
					else{
						$get_city = $city;
					}
					
					$get_state = $obj->select_where_with_fields('states' , 'id='.$state.'', 'name');
					$get_state = $get_state[0]['name'];
					
					$user_data['team'] = $user_data['name']."( ".$get_city.") ( ".$get_state." )";
				}
				
				
				else
				{
					$user = "SELECT users.city, users.state,users.playername, team.* FROM team INNER JOIN users ON team.user_id = users.user_id WHERE team.team_id=".$team_id."";
					$user_data = $obj->select_where($user);
					$user_data = $user_data[0];
					$user_data['team'] = $user_data['playername']." (" . $user_data['name']." ) ( ".$user_data['city'].") ( ".$user_data['state']." )";
				}
				
				
				
				$update_result = TRUE;
		
				$user_data['rank'] = $d;
			
				$user_data['points'] = round($result_points['points'],3);
				
				$list[] = $user_data;
				$d++;
				
				
			}
			
		
			$result = array_values($result);
			
			unset($team_ids);
			
		}
		
	
		
		?>
		
		 <table class="table table-bordered table-striped table-hover dataTable js-exportable">
			<thead>
				<tr>
				    <th>Contest</th>
				    <th>Sub Contest</th>
					<th>Teams</th>
					<th>Points</th>
					<th>Rank</th>
				</tr>
			</thead>
			
			<tbody>
				<?php 
				
			foreach($list as $lst)
			{
			  
				?>
			 
				<tr>
					<td><?php echo $contestName; ?></td>
					<td><?php echo $subContestname ; ?></td>
					<td><?php echo $lst['team']; ?></td>
					<td><?php echo $lst['points']; ?></td>
					<td><?php echo $lst['rank']; ?></td>
				</tr>
			
				<?php
			}
			?>
			</tbody>
		</table>
		
		<?php
	
	}
	
	else
	{	

	?>
		
		<table class="table table-bordered table-striped table-hover dataTable js-exportable">
			<thead>
				<tr>
					<th>Rank</th>
					<th>Name</th>
					<th>Points</th>
				</tr>
			</thead>
			
			
		</table>

	<?php 
	
	}
}


/*============================================
=         Answer  code          =
=============================================*/

/* if(!empty($_GET['contest_response']))
{       
	$id = $_GET['contest_response'];

	$select_where = "SELECT * FROM `questions` WHERE contest_id = '".$id."'";

	$result = $obj->select_where($select_where);
	
	$select_sub = "SELECT * FROM `sub_contests` WHERE contest_id = '".$id."'";

	$result_sub = $obj->select_where($select_sub);
	
	if(count(array_filter($result)) > 0 && count(array_filter($result_sub)) > 0)
	{  
		$i=1;
		
        foreach($result as $row)
	    {
		   if($i==1)
		   { 
				echo '<div class="form-group" style="padding-left:5px">
						<label for="type">Sub Contest:</label>
			
						<select class="form-control show-tick" name="sub_contest" class="answer" required="">
							<option value="">-- Please select --</option>';
							
				foreach($result_sub as  $sub)
				{
				   ?>
					<option value="<?php echo $sub['sub_id'];?>"><?php echo $sub['total_winnings'].'(total winnings) and '.$sub['entry_fee'].'(entry fee)';?></option>
					<?php 
			   }
			   
			   echo '</select></div>';
				
		    }
		
		?>
				
			<div class="row" style="border:1px solid #E6E9ED; padding:10px 5px; margin-top:8px;">

				<div class="col-md-12">
					<div class="form-group" style="padding-left:5px">
					<label for="qus"> Question <?php echo $i; $i++ ; ?>:</label>
						<span style="font-size:16px;"><?php echo $row['question'].' (Points : '.$row['points'].')' ; ?></span>
					</div>
				</div>		

				<div class="col-md-6">
					<div class="form-group" style="padding-left:5px">
						<label for="type">Answer:</label>
			
						<select class="form-control" name="question_answer[]" class="answer" required="">
							<option value="">-- Please select --</option>
						
							<option value="option1" <?php if($row['question_ans'] == 'option1') echo "selected" ?>>Option1</option>
							<option value="option2" <?php if($row['question_ans'] == 'option2') echo "selected" ?>>Option2</option>
							<option value="option3" <?php if($row['question_ans'] == 'option3') echo "selected" ?>>Option3</option>
							<option value="option4" <?php if($row['question_ans'] == 'option4') echo "selected" ?>>Option4</option>
						
						</select>
			
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="form-group focused" style="padding-left:5px">
						<label for="qus"> Time(in sec.) :</label>
						<input name="time[]" class="form-control" style="width: 100%;" type="number" maxlength=30 min=0 />
					</div>
				</div>
			
			</div>
			<input type="hidden" name="question_id[]" value="<?php echo $row['question_id'] ;?>" />
			<input type="hidden" name="question_point[]" value="<?php echo $row['points'] ;?>" />
		<?php	
		
	   }
	    ?>	   
			
	
		<?php
	}
	
	else
	{
		?>
		<div class="row alert alert-info alert-dismissable">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Info!</strong> Sorry No Record Found !
</div>
		<?php
		
	}
} */

if(!empty($_GET['contest_response']))
{       
	$id = $_GET['contest_response'];
	
	$team = $_GET['team'];
	
	$select_where_team = "SELECT king,queen FROM `team` WHERE team_id = '".$team."'";

	$result_team = $obj->select_where($select_where_team);
	
	$result_team = $result_team[0];
	
	$select_where = "SELECT * FROM `questions` WHERE contest_id = '".$id."'";

	$result = $obj->select_where($select_where);
	
	$select_sub = "SELECT * FROM `sub_contests` WHERE contest_id = '".$id."'";

	$result_sub = $obj->select_where($select_sub);
	
	$check_join = "SELECT `user_joining_contest`.sub_contest_id FROM `sub_contests` INNER JOIN `user_joining_contest` on `sub_contests`.sub_id =  `user_joining_contest`.sub_contest_id WHERE `sub_contests`.contest_id = '".$id."' AND `user_joining_contest`.team_id='".$team."'";

	$result_check_join = $obj->select_where($check_join);
	
	if(count(array_filter($result)) > 0 && count(array_filter($result_sub)) > 0)
	{  

		if(count(array_filter($result_check_join)) > 0){
		
		//echo "<pre>";print_r($result_check_join);die();
			$i=1;
			
			foreach($result as $row)
			{
			   if($i==1)
			   { 
					/* echo '<div class="form-group" style="padding-left:5px">
							<label for="type">Sub Contest:</label>
				
							<select class="form-control show-tick" name="sub_contest" class="answer" required="">
								<option value="">-- Please select --</option>';
								
					foreach($result_sub as  $sub)
					{
					   ?>
						<option value="<?php echo $sub['sub_id'];?>"><?php echo $sub['total_winnings'].'(total winnings) and '.$sub['entry_fee'].'(entry fee)';?></option>
						<?php 
				   }
				   
				   echo '</select></div>'; */
				   
					echo '<div class="row" style="border-bottom:1px solid #E6E9ED; padding:1px 5px; margin-top:1px;">
					
					<div class="col-md-2 col-sm-2 col-xs-2">
						<div class="form-group" style="padding-left:5px">
						<label for="qus"> Question:</label>
							
						</div>
					</div>		
					<div class="col-md-2 col-sm-2 col-xs-2">
						<div class="form-group" style="padding-left:5px">
						<label for="qus"> Point:</label>
							
						</div>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-3">
						<div class="form-group" style="padding-left:5px">
						<label for="qus"> Time(in sec.) :</label>
							
						</div>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-3">
						<div class="form-group" style="padding-left:5px">
						<label for="qus"> Answer :</label>
							 
						</div>
					</div>		
					<div class="col-md-2 col-sm-2 col-xs-2">
						<div class="form-group" style="padding-left:5px">
						<label for="qus"> Total:</label>
							
						</div>
					</div>
				</div>';
					
				}
			
			?>
			
			
				
				<div class="row" style="border-bottom:1px solid #E6E9ED; padding:1px 5px; margin-top:1px;">

					<div class="col-md-2 col-sm-2 col-xs-2">
						<div class="form-group" style="padding-left:5px">
						<label for="qus"> Q<?php echo $i; ?>:</label>
							
						</div>
					</div>		

					<div class="col-md-2 col-sm-2 col-xs-2">
						<div class="form-group" style="padding-left:5px">
							
							<span style="font-size:16px;">
							
							<?php 
							
								if($result_team['king'] == $i){
									
									$points = $row['points'].'(King)';
									
								} else if($result_team['queen'] == $i){
									
									$points = $row['points'].'(Queen)';
									
								}else{
									
									$points = $row['points'];
									
								}
							
								echo $points;
							
							?>
							
							</span>
		
						</div>
					</div>
					
					<div class="col-md-3 col-sm-3 col-xs-3">
						<div class="form-group focused" style="padding-left:5px">
							
							<input name="time[]" class="form-control  time_ans<?php echo  $i ;?>" style="width: 100%;" type="number" max=30 min=0 required />
							
							<?php if($result_team['king'] == $i) { ?>
							
								<input name="multiply_by_ans<?php echo  $i ;?>" class="form-control multiply_by_ans<?php echo  $i ;?>" style="width: 100%;" type="hidden" value="3" />
							
							<?php } else if($result_team['queen'] == $i) { ?>
							
								<input name="multiply_by_ans<?php echo  $i ;?>" class="form-control multiply_by_ans<?php echo  $i ;?>" style="width: 100%;" type="hidden"  value="2" />
							 
							<?php } else  { ?>
							
								<input name="multiply_by_ans<?php echo  $i ;?>" class="form-control multiply_by_ans<?php echo  $i ;?>" style="width: 100%;" type="hidden"  value="1" />
							
							<?php }  ?>
							
							<input name="points_ans<?php echo  $i ;?>" class="form-control points_ans<?php echo  $i ;?>" style="width: 100%;" type="hidden" value="<?php echo $row['points']; ?>" />
							
							<input name="total_points_ans[]" class="form-control total_points_ans<?php echo  $i ;?>" style="width: 100%;" type="hidden" value="0" />
							
							<input name="multiply_by_ans_pt" class="form-control multiply_by_ans_pt" style="width: 100%;" type="hidden"  value="1.5" />
							
							<input name="total_pt_points" class="form-control total_pt_points" style="width: 100%;" type="hidden"  value="0" />
							
						</div>
					</div>
					
					<div class="col-md-3 col-sm-3 col-xs-3">
						<div class="form-group" style="padding-left:5px">
							
							<select class="form-control claculate_points show-tick ans_status<?php echo  $i ;?>" name="ans_status<?php echo  $i ;?>" required="">
								<option value="">-- Please select --</option>
								<option value="yes">Yes</option>
								<option value="no">No</option>
								
							</select>
		
						</div>
					</div>
					
					<div class="col-md-2 col-sm-2 col-xs-2">
						<div class="form-group" style="padding-left:5px">
							
							<span style="font-size:16px;" class="total_points_show_ans<?php echo  $i ;?>"></span>
		
						</div>
					</div>
				
				</div>
				<input type="hidden" name="question_id[]" value="<?php echo $row['question_id'] ;?>" />
				<input type="hidden" name="question_point[]" value="<?php echo $row['points'] ;?>" />
			<?php	
			 $i++ ;
		   }
			?>	   
			<div class="row" style="border-bottom:1px solid #E6E9ED; padding:1px 5px; margin-top:1px;">

					<div class="col-md-2 col-sm-2 col-xs-2">
						<div class="form-group" style="padding-left:5px">
						<label for="qus">PT:</label>
							
						</div>
					</div>		

					<div class="col-md-2 col-sm-2 col-xs-2">
						<div class="form-group" style="padding-left:5px">
							
							<span style="font-size:16px;"></span>
		
						</div>
					</div>
					
					<div class="col-md-3 col-sm-3 col-xs-3">
						<div class="form-group" style="padding-left:5px">
							
							<span style="font-size:16px;"></span>
		
						</div>
					</div>
					
					<div class="col-md-3 col-sm-3 col-xs-3">
						<div class="form-group focused" style="padding-left:5px">
							
							<input name="pt" class="form-control pt_points" style="width: 100%;" type="number" maxlength=900 min=0 value="0" />
							
						</div>
					</div>
					
					<div class="col-md-2 col-sm-2 col-xs-2">
						<div class="form-group" style="padding-left:5px">
							
							<span style="font-size:16px;"  class="pt_points_show"></span>
		
						</div>
					</div>
				
			</div>	
			
			<div class="row" style="border-bottom:1px solid #E6E9ED; padding:1px 5px; margin-top:1px;">

					<div class="col-md-2 col-sm-2 col-xs-2">
						<div class="form-group" style="padding-left:5px">
						
							
						</div>
					</div>		

					<div class="col-md-2 col-sm-2 col-xs-2">
						<div class="form-group" style="padding-left:5px">
							
							<span style="font-size:16px;"></span>
		
						</div>
					</div>
					
					<div class="col-md-3 col-sm-3 col-xs-3">
						<div class="form-group " style="padding-left:5px">
							<span style="font-size:16px;"></span>
							
						</div>
					</div>
					
					<div class="col-md-3 col-sm-3 col-xs-3">
						<div class="form-group focused" style="padding-left:5px">
							<label for="qus"> Total Points:</label>
							
						</div>
					</div>
					
					<div class="col-md-2 col-sm-2 col-xs-2">
						<div class="form-group" style="padding-left:5px">
							
							<span style="font-size:16px;" class="sum_of_points"></span>
		
						</div>
					</div>
				
			</div>	
	
		<?php
		
		} else { ?>
			
			<div class="row alert alert-info alert-dismissable">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Info!</strong> Please join this contest with this team
			</div>
			
		<?php }
	}
	
	else
	{
		?>
			<div class="row alert alert-info alert-dismissable">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Info!</strong> Sorry No Record Found !
			</div>
		<?php
		
	}
	
	
}

/*============================================
=         State City  code          =
=============================================*/

if(!empty($_GET['state_id']) && $_GET['country_id'] == '101'){
	
	$state_id = $_GET['state_id'];
	$country_id = $_GET['country_id'];
	
	$sub_contests = $obj->select_where_with_fields('cities' , 'state_id ='.$state_id.' order by name ASC', 'name,id');
	
	echo  '<label for="state">City:</label><select class="form-control show-tick city_id_class" name="city_id" required=""><option value="">-- Please select --</option>';
	
	if(count($sub_contests) > 0){
								
		foreach($sub_contests as $sub_contest){ 
		
			echo '<option value="'.$sub_contest['id'].'">'.$sub_contest['name'].'</option>';
		
		}  
		
	} else {
		
		echo '<option value="">-- Select State --</option>';
	}
	
	echo "</select>";
}

	
/* ============================================
             Balance Info  code         
============================================== */

	if((!empty($_GET['contest_id']) || !empty($_GET['sub_contest_id'])) && ($_GET['type']=="balance_info"))
	{
		$id = $_GET['contest_id'];
		$sub_contest_id = $_GET['sub_contest_id'];
		
		if(!empty($id) && empty($sub_contest_id)){
			
			$get_query = "SELECT GROUP_CONCAT(balance_type SEPARATOR ',') AS bType , GROUP_CONCAT(amount SEPARATOR ',') AS amountType, sum(amount), Count(DISTINCT sub_contests.sub_id) AS userCout ,sub_contests.* , contest.name  , contest.calender_date ,contest.ending_status, transaction.balance_type,transaction.amount FROM `contest` INNER JOIN  sub_contests ON contest.contest_id = sub_contests.contest_id INNER JOIN user_joining_contest ON user_joining_contest.sub_contest_id = sub_contests.sub_id INNER JOIN transaction ON transaction.row_id = user_joining_contest.id WHERE contest.contest_id='".$id."' AND table_name='user_joining_contest' GROUP BY sub_id  ORDER BY sum(amount) DESC";
			
		} else if(!empty($sub_contest_id)) {
			
			$get_query = "SELECT GROUP_CONCAT(balance_type SEPARATOR ',') AS bType , GROUP_CONCAT(amount SEPARATOR ',') AS amountType, sum(amount), Count(DISTINCT sub_contests.sub_id) AS userCout ,sub_contests.* , contest.name  , contest.calender_date ,contest.ending_status, transaction.balance_type,transaction.amount FROM `contest` INNER JOIN  sub_contests ON contest.contest_id = sub_contests.contest_id INNER JOIN user_joining_contest ON user_joining_contest.sub_contest_id = sub_contests.sub_id INNER JOIN transaction ON transaction.row_id = user_joining_contest.id WHERE sub_contests.sub_id='".$sub_contest_id."' AND table_name='user_joining_contest' GROUP BY sub_id  ORDER BY sum(amount) DESC";
		}
		
		 
		
		
		$data = $obj->select_assoc($get_query); 
		
		
		$i=1;
		
		?>    
		
		<div class="table-responsive">
		
			<table class="table table-bordered table-striped table-hover dataTable js-exportable" >
                                    <thead>
                                        <tr>
											<th>#</th>
                                            <th>ID</th>
											<th>Contest</th>
                                            <th>Subcontest</th>
                                            <th>Bonus</th>
											<th>Winning</th>
											<th>Earning</th>
                                            <th>Add Cash</th>
                                            <th>Sum</th>
                                            <th>User Count</th>
                                            <th>Dummy Count</th>
                                            <th>Status</th>
                                         
                                        </tr>
                                    </thead>
                                    <tbody>
									
                                      <?php 
									  
									$i=1;
									
									foreach($data as $row)
									{ 
										$getDummyUser ="SELECT COUNT(*) AS DummyCount FROM `user_joining_contest` WHERE user_id=0 AND sub_contest_id = ".$row['sub_id'].""; 
										
										$dummyCount= $obj->select_assoc($getDummyUser); 
										
										$bTypearray = explode("," , $row['bType']);
										$balanceArray = explode("," , $row['amountType']);
										$bonus = array_keys($bTypearray, "bonus");
										
										$contestName = ucfirst(str_replace("&" , " " , $row['name']))."\n"."(" . $row['calender_date']. ")";
										
										
										foreach($bonus as $key)
										{	
											$bonusArray[] = $balanceArray[$key];
										}
										$addcash = array_keys($bTypearray, "addcash");
										
										foreach($addcash as $key)
										{
											$addcashArray[] = $balanceArray[$key];
										}
									 
										$refferal = array_keys($bTypearray, "refferal");
										
										foreach($refferal as $key)
										{
											$refferalArray[] = $balanceArray[$key];
										}
										$earning = array_keys($bTypearray, "earning");
										
										foreach($earning as $key)
										{
											$earningArray[] = $balanceArray[$key];
										}
										
										$only_addcash = array_keys($bTypearray, "only_addcash");
										
										foreach($only_addcash as $key)
										{
											$only_addcashArray[] = $balanceArray[$key];
										}
										
										$bonuSum =   array_sum($bonusArray);
										$cashSum = array_sum($addcashArray) + array_sum($only_addcashArray);
										$referralSum = array_sum($refferalArray);
										$earningSum = array_sum($earningArray); 
										$only_addcashSum = array_sum($only_addcashArray); 
								  
										?> 
										
										<tr>
											<td><?php echo $i;$i++; ?></td>
											<td><?php echo $row['sub_id']; ?></td>
											<td><?php echo $contestName; ?></td>
											<td>
										
											   <p>
													<span>
													<b>Entry Fee:</b>
														<i class="fa fa-inr" aria-hidden="true"></i>
														<?php
															echo $row['entry_fee'];
														?>
													</span>
													
													<span class="label bg-light-blue read_more pull-right" aria-hidden="true" id="read_more<?php echo $i ; ?>" data-toggle="tooltip" data-placement="top" title="More Information" style="margin-left:10px; cursor:pointer;">
														<i class="material-icons" style="    font-size: 13px !important;">keyboard_arrow_down</i>
													</span>
												</p>
												
												<div class="more_info" id="more_info<?php echo $i; ?>"style="display:none">

													
													<p>
														<b>Teams:</b>
														<?php
															echo $row['user_limit'];
														?>
													</p>
													
													<p>
														<b>Winners:</b>
														<?php
															echo $row['winners'];
														?>
													</p>
													
													<p>
														<b>First Prize:</b>
														<?php
															$fPrize = json_decode($row['ranks'], true);
															
															if(!empty($fPrize[0]['prize'])){echo '<i class="fa fa-inr" aria-hidden="true"></i> '.$fPrize[0]['prize'];} else{echo '<span class="label bg-orange">N/A</span>';}
															
														?>
													</p>
													
													<p>
														<b>total winnings:</b>
													
														<?php  if(!empty($row['total_winnings'])){echo '<i class="fa fa-inr" aria-hidden="true"></i> '.$row['total_winnings'];} else{echo '<span class="label bg-orange">N/A</span>';} ?>
											
													</p>
													
													<p>
														<b>Type:</b>
													
														<?php 
														
														if($row['play_type']=="play_for_cash")
														{
															echo'<span class="badge bg-pink">Cash</span>';
														}
															
														elseif($row['play_type']=="play_for_free")
														{
															echo'<span class="badge bg-cyan">Free</span>';
														}
														elseif($row['play_type']=="super_duper"){
															
															echo '<span class="label bg-teal">Super</span>';
														}
														
														else{
															
															echo '<span class="label bg-orange">N/A</span>';
														}

														?>
											
													</p>
													
													
												</div>
											
											</td>
											
										
											<td><?php  if(!empty($bonuSum)){echo '<i class="fa fa-inr" aria-hidden="true"></i>'.$bonuSum;} else{echo '<span class="label bg-orange">N/A</span>';} ?></td>
											<td><?php  if(!empty($cashSum)){echo '<i class="fa fa-inr" aria-hidden="true"></i>'.$cashSum;} else{echo '<span class="label bg-orange">N/A</span>';} ?></td>
											<td><?php  if(!empty($referralSum)){echo '<i class="fa fa-inr" aria-hidden="true"></i>'.$referralSum;} else{echo '<span class="label bg-orange">N/A</span>';} ?></td>
											<td><?php  if(!empty($earningSum)){echo '<i class="fa fa-inr" aria-hidden="true"></i>'.$earningSum;} else{echo '<span class="label bg-orange">N/A</span>';} ?></td>
										   <td><?php  if(!empty($row['sum(amount)']))
												{  echo '<i class="fa fa-inr" aria-hidden="true"></i> '.$row['sum(amount)'];}else{
													echo '<span class="label bg-orange">N/A</span>';
												}
												?>
											  
										  <td><?php echo $row['userCout']+$dummyCount[0]['DummyCount']; ?></td>
										  <td>0</td>
										   
											<td>
											
												<?php 
												
													if($row['ending_status'] == 0)
													{
												
														echo '<span class="label bg-light-green">Open</span>';
														
													} else if($row['ending_status'] == 1){
														
														echo '<span class="label bg-blue">Progress</span>';
														
													} else if($row['ending_status'] == 2){
														
														echo '<span class="label bg-red">Closed</span>';
														
													}
												?>
											
											</td>
										 
											
										</tr>
										<?php
									   	unset($earningArray);
										unset($refferalArray);
										unset($addcashArray);
										unset($bonusArray);
										unset($only_addcashArray);
										$SubIds[] = $row['sub_id']; 
									}
									
									if(count($SubIds) > 0){
										
										$notids = implode("," , $SubIds);
										
									} else {
										
										$notids = 0;
										
									}
									
									if(!empty($id) && empty($sub_contest_id)){
			
										$getSub = "SELECT * FROM `sub_contests` INNER JOIN `contest` ON sub_contests.contest_id = contest.contest_id where sub_id not IN(".$notids.")  AND contest.contest_id=".$id."";
										
									} else if(!empty($sub_contest_id)) {
										
										$getSub = "SELECT * FROM `sub_contests` INNER JOIN `contest` ON sub_contests.contest_id = contest.contest_id where sub_id not IN(".$notids.")  AND sub_contests.sub_id=".$sub_contest_id."";
									}
									
									
									
									$dummygetSubs = $obj->select_assoc($getSub); 
									
									foreach($dummygetSubs as $row)
									{     
									      $contest_name = $obj->select_where_with_fields('contest' , 'contest_id='.$row['contest_id'].'' , 'name,calender_date');

										  
										 $getDummyUser ="SELECT COUNT(*) AS DummyCount FROM `user_joining_contest` WHERE  sub_contest_id = ".$row['sub_id'].""; 
										
										$dummyCount= $obj->select_assoc($getDummyUser); 
										
										$bTypearray = explode("," , $row['bType']);
										$balanceArray = explode("," , $row['amountType']);
										$bonus = array_keys($bTypearray, "bonus");
										
										$contestName = ucfirst(str_replace("&" , " " , $contest_name[0]['name']))."\n"."(" . $contest_name[0]['calender_date']. ")";
										
										
										foreach($bonus as $key)
										{	
											$bonusArray[] = $balanceArray[$key];
										}
										$addcash = array_keys($bTypearray, "addcash");
										
										foreach($addcash as $key)
										{
											$addcashArray[] = $balanceArray[$key];
										}
									 
										$refferal = array_keys($bTypearray, "refferal");
										
										foreach($refferal as $key)
										{
											$refferalArray[] = $balanceArray[$key];
										}
										$earning = array_keys($bTypearray, "earning");
										
										foreach($earning as $key)
										{
											$earningArray[] = $balanceArray[$key];
										}
										
										$only_addcash = array_keys($bTypearray, "only_addcash");
										
										foreach($only_addcash as $key)
										{
											$only_addcashArray[] = $balanceArray[$key];
										}
										
										$bonuSum =   array_sum($bonusArray);
										$cashSum = array_sum($addcashArray) + array_sum($only_addcashArray);
										$referralSum = array_sum($refferalArray);
										$earningSum = array_sum($earningArray); 
										$only_addcashSum = array_sum($only_addcashArray); 
										?>  
										<tr>
											<td><?php echo $i;$i++; ?></td>
											<td><?php echo $row['sub_id']; ?></td>
											<td><?php echo $contestName; ?></td>
											<td>
										
											   <p>
													<span>
													<b>Entry Fee:</b>
														<i class="fa fa-inr" aria-hidden="true"></i>
														<?php
															echo $row['entry_fee'];
														?>
													</span>
													
													<span class="label bg-light-blue read_more pull-right" aria-hidden="true" id="read_more<?php echo $i ; ?>" data-toggle="tooltip" data-placement="top" title="More Information" style="margin-left:10px; cursor:pointer;">
														<i class="material-icons" style="    font-size: 13px !important;">keyboard_arrow_down</i>
													</span>
												</p>
												
												<div class="more_info" id="more_info<?php echo $i; ?>"style="display:none">
													
													
													<p>
														<b>Teams:</b>
														<?php
															echo $row['user_limit'];
														?>
													</p>
													
													<p>
														<b>Winners:</b>
														<?php
															echo $row['winners'];
														?>
													</p>
													
													<p>
														<b>First Prize:</b>
														<?php
															$fPrize = json_decode($row['ranks'], true);
															
															if(!empty($fPrize[0]['prize'])){echo '<i class="fa fa-inr" aria-hidden="true"></i> '.$fPrize[0]['prize'];} else{echo '<span class="label bg-orange">N/A</span>';}
															
														?>
													</p>
													
													<p>
														<b>total winnings:</b>
													
														<?php  if(!empty($row['total_winnings'])){echo '<i class="fa fa-inr" aria-hidden="true"></i> '.$row['total_winnings'];} else{echo '<span class="label bg-orange">N/A</span>';} ?>
											
													</p>
													
													<p>
														<b>Type:</b>
													
														<?php 
														
														if($row['play_type']=="play_for_cash")
														{
															echo'<span class="badge bg-pink">Cash</span>';
														}
															
														elseif($row['play_type']=="play_for_free")
														{
															echo'<span class="badge bg-cyan">Free</span>';
														}
														elseif($row['play_type']=="super_duper"){
															
															echo '<span class="label bg-teal">Super</span>';
														}
														
														else{
															
															echo '<span class="label bg-orange">N/A</span>';
														}

														?>
											
													</p>
													
													
												</div>
											
											</td>
											
										
											<td><?php  if(!empty($bonuSum)){echo '<i class="fa fa-inr" aria-hidden="true"></i>'.$bonuSum;} else{echo '<span class="label bg-orange">N/A</span>';} ?></td>
											<td><?php  if(!empty($cashSum)){echo '<i class="fa fa-inr" aria-hidden="true"></i>'.$cashSum;} else{echo '<span class="label bg-orange">N/A</span>';} ?></td>
											<td><?php  if(!empty($referralSum)){echo '<i class="fa fa-inr" aria-hidden="true"></i>'.$referralSum;} else{echo '<span class="label bg-orange">N/A</span>';} ?></td>
											<td><?php  if(!empty($earningSum)){echo '<i class="fa fa-inr" aria-hidden="true"></i>'.$earningSum;} else{echo '<span class="label bg-orange">N/A</span>';} ?></td>
										    <td><?php  if(!empty($row['sum(amount)']))
												{  echo '<i class="fa fa-inr" aria-hidden="true"></i> '.$row['sum(amount)'];}else{
													echo '<span class="label bg-orange">N/A</span>';
												}
											  
										    ?></td>
										   <td>0</td>
										  <td><?php echo $row['userCout']+$dummyCount[0]['DummyCount']; ?></td>
										  
										   
											<td>
											
												<?php 
												
													if($row['ending_status'] == 0)
													{
												
														echo '<span class="label bg-light-green">Open</span>';
														
													} else if($row['ending_status'] == 1){
														
														echo '<span class="label bg-blue">Progress</span>';
														
													} else if($row['ending_status'] == 2){
														
														echo '<span class="label bg-red">Closed</span>';
														
													}
												?>
											
											</td>
										 
											
										</tr>
										<?php
										
									}
									
									?>
                                    </tbody>
                                </table>
		</div>
        <?php
	}
	
/* ============================================
              Refferal Code Information      
============================================== */

if(!empty($_GET['refferal_code']))
{
		$code = $_GET['refferal_code'];
		
		$get_query = "SELECT user_id FROM `users` WHERE refferal_code='".$code."'";
		
		$data = $obj->select_assoc($get_query); 
		
	if($data[0]['user_id']!="")
	{
			
		$get_Count= "SELECT COUNT(*) AS TOTAL FROM `users` WHERE refferal_id ='".$data[0]['user_id']."'"; 
		
		$countData = $obj->select_assoc($get_Count); 
		
		
		$get_transaction= "SELECT SUM(amount) AS SUM FROM `transaction` WHERE user_id ='".$data[0]['user_id']."' AND encoded_fields='refferal_amount_from_user'"; 
		
		$sumData = $obj->select_assoc($get_transaction); 
		
		$i=1;
		
		
		
		?>  
		<table class="table table-bordered">
			<thead>
				  <tr class="active">
					<th>User Count</th>
					<th>Total Earning Amount</th> 
				  </tr>
			</thead>
			<tbody>
				<tr>
					<td><?php if($countData[0]['TOTAL'] > 0 ){echo $countData[0]['TOTAL'];}else{echo '<span class="label bg-orange">N/A</span>';}?></td>
					<td>  <?php if($sumData[0]['SUM'] > 0 ){echo '<i class="fa fa-inr" aria-hidden="true"></i> ' . $sumData[0]['SUM'];}else{echo '<span class="label bg-orange">N/A</span>';}?></td>
					
				</tr>      
			  
			</tbody>
		</table>
		
			
									
            <?php
	}
	else
	{
		echo '<div class="alert alert-danger fade in alert-dismissable email_exists" style="display: block; margin-top: 5px; text-shadow:none !important;"><strong>Danger!  </strong>Sorry No Record Found !</div>';
	}
}
	
?>
