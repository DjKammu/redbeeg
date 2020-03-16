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
					<h4 class="modal-title">Information</h4>
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
										   value="<?php echo $array[1]?>"  id="name2">
										  </div>
										</div>
									</div>
								  
								  
									<div class="alert alert-danger fade in alert-dismissable email_exists" style="display:none;margin-top:5px;text-shadow:none !important;">
										<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><strong>Danger!  </strong>Name Already Exists !
									</div>
									
									<div class="form-group">
									
										<label for="image2">Start Date:</label>
										
                                        
                                        <input type="text" name="m_date" class="datetimepicker form-control" placeholder="Please choose date & time..." value="<?php echo $result['calender_date'];?>">
                                        
                                    </div>
								  
								  <div class="form-group">
								   <label for="gstin">Joining Points :</label>
								   <input type="number" class="form-control" name="points"  min="0" required="" type="any" value="<?php echo $result['joining_points'];?>">
								  </div>
								  
								  <div class="form-group">
								   <label for="gstin">Winning Points :</label>
								   <input type="number" class="form-control" name="winning_points" min="0" required="" type="any" value="<?php echo $result['winning_points'];?>">
								  </div>
			  
								  <div class="form-group">
								   <label for="image1">Image 1:</label>
								   <input name="img1" type="file" id="img1" class="form-control" accept=".jpg, .jpeg, .png">
								  </div>
								  
								  <div class="form-group">
								   <label for="image2">Image 2:</label>
								   <input name="img2" type="file" id="img2" class="form-control" accept=".jpg, .jpeg, .png">
								  </div>
								  
								  <div class="form-group">
								   <label for="name"> Video Name :</label>
								   <input type="text" class="form-control" name="video-name" value="<?php echo $result['video_name'];?>"required>
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
					</div>
				</div> 
			</div>
			</div>
		</form>
			
		<form method='post' class="video-upload-edit" action='videoupload.php' enctype='multipart/form-data' >
			<div class="form-group focused" style="position: absolute; margin-top: -226px; padding: 6px 34px;    color: #777;">
				<label for="video">Video:</label>
				<input name="video" type="file" id="video" class="form-control" required oninvalid="this.setCustomValidity('Please select file')">
				
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

	$select_where = "SELECT * FROM questions WHERE question_id = '".$id."'";

	$result = $obj->select_where($select_where);
	
	$result = $result[0];
	
		
      
	if(count(array_filter($result))>0)
	{
		?>

		<div class="x_content">
			
			
								
			<div class="row" style="border:1px solid #E6E9ED; padding:10px 5px; margin-top:8px;box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);">

				<div class="col-md-6">
					<div class="form-group" style="padding-right:5px">
						<label for="qus"> Question<?php echo $i; ?> :</label>
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
						<label for="option"> Option1 :</label>
						<textarea name="option1" class="form-control" style="width: 100%;"><?php echo trim($result['option1']);?>
						</textarea>
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="form-group" style="padding-left:5px">
						<label for="option"> Option2 :</label>
						<textarea name="option2" class="form-control" style="width: 100%;"><?php echo trim($result['option2']);?>
						</textarea>
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="form-group" style="padding-right:5px">
						<label for="option"> Option3 :</label>
						<textarea name="option3" class="form-control" style="width: 100%;"><?php echo trim($result['option3']);?>
						</textarea>
					</div>
				</div> 
				
				<div class="col-md-6">
					<div class="form-group" style="padding-left:5px">
						<label for="option"> Option4 :</label>
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
		</div>
		

		
		
				
		<?php
	}
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
		<?php
	}
}


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
				<label for="type">Contest:</label>
				<?php
					$get_query = "SELECT * FROM `contest` ORDER BY contest_id DESC";
					$data = $obj->select($get_query);
				?>
					<select class="form-control show-tick" name="contest_id" required="">
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
							<option value="<?php echo $row['contest_id'];?>" <?php echo $selected;?>><?php echo ucfirst(str_replace("&" , " " , $row['name'])); ?></option>
							
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
			   <label for="gstin">Users Limit :</label>
			   <input type="number" class="form-control" name="user_limit" value="<?php echo $result['user_limit']; ?>" min="0" required="" type="any">
			</div>
			
			<div class="form-group">
			   <label for="gstin">Winners :</label>
			   <input type="number" class="form-control" name="winners" value="<?php echo $result['winners']; ?>" min="0" required="" type="any">
			</div>
			
			<div class="form-group">
				<label for="type">Ranks :</label>
				
					<select class="form-control show-tick" name="ranks_no" required="">
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
					</select>
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
			
			<input type="hidden" name="subcontest_edit_id" value="<?php echo $id;?>" />
		</div>
				
		<?php
	}
}

if(!empty($_GET['contest_id']) && $_GET['type'] == 'get_sub_list'){
	
	$contest_id = $_GET['contest_id'];
	
	
	$sub_contests = $obj->select_where_with_fields('sub_contests' , 'contest_id ='.$contest_id.' order by sub_id desc', 'sub_id');
	
	if(count($sub_contests) > 0){ ?>
		
		
		
		<?php
		
		foreach($sub_contests as $sub_contest){ ?>
			
			<button type="button" class="btn dropdown-toggle btn-default" data-toggle="dropdown" title="-- Select Sub Contest Id --" aria-expanded="false"><span class="filter-option pull-left">-- Select Sub Contest Id --</span>&nbsp;<span class="bs-caret"><span class="caret"></span></span></button><div class="dropdown-menu open" style="max-height: 240px; overflow: hidden; min-height: 0px;"></div><select class="form-control show-tick sub_contest_id" name="sub_contest_id" required="" tabindex="-98">
								
									<option value="">-- Select Sub Contest Id --</option>
									
																			<option value="5">5</option>
										
																				<option value="6">6</option>
										
																			
								</select>
	<?php	}
		
		
		
	} else {
		
		echo '<option value="">-- Select Sub Contest Id --</option>';
	}
}


/*============================================
=         Answer  code          =
=============================================*/

if(!empty($_GET['contest_response']))
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
			   
			   	echo '<div class="row" style="border-bottom:1px solid #E6E9ED; padding:1px 5px; margin-top:1px;">
			<div class="col-md-3">
					<div class="form-group" style="padding-left:5px">
					<label for="qus"> Question:</label>
						
					</div>
				</div>		
					<div class="col-md-3">
					<div class="form-group" style="padding-left:5px">
					<label for="qus"> Point:</label>
						
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group" style="padding-left:5px">
					<label for="qus"> Time(in sec.) :</label>
						
					</div>
				</div>		
				<div class="col-md-3">
					<div class="form-group" style="padding-left:5px">
					<label for="qus"> Total:</label>
						
					</div>
				</div>
			</div>';
				
		    }
		
		?>
		
		
			
			<div class="row" style="border-bottom:1px solid #E6E9ED; padding:1px 5px; margin-top:1px;">

				<div class="col-md-3">
					<div class="form-group" style="padding-left:5px">
					<label for="qus"> Q<?php echo $i; ?>:</label>
						
					</div>
				</div>		

				<div class="col-md-3">
					<div class="form-group" style="padding-left:5px">
						
						<span style="font-size:16px;">
						
						<?php 
						
							if($row['type'] != 'normal'){
								
								$points = $row['points'].'('.$row['type'].')';
								
							} else {
								
								$points = $row['points'];
								
							}
						
							echo $points;
						
						?>
						
						</span>
	
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="form-group focused" style="padding-left:5px">
						
						<input name="time[]" class="form-control claculate_points time_ans<?php echo  $i ;?>" style="width: 100%;" type="number" max=30 min=0 required />
						
						<?php if($row['type'] == 'king') { ?>
						
							<input name="multiply_by_ans<?php echo  $i ;?>" class="form-control multiply_by_ans<?php echo  $i ;?>" style="width: 100%;" type="hidden" value="3" />
						
						<?php } else if($row['type'] == 'queen') { ?>
						
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
				
				<div class="col-md-3">
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

				<div class="col-md-3">
					<div class="form-group" style="padding-left:5px">
					<label for="qus">PT:</label>
						
					</div>
				</div>		

				<div class="col-md-3">
					<div class="form-group" style="padding-left:5px">
						
						<span style="font-size:16px;"></span>
	
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="form-group focused" style="padding-left:5px">
						
						<input name="pt" class="form-control pt_points" style="width: 100%;" type="number" maxlength=30 min=0 value="0" />
						
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="form-group" style="padding-left:5px">
						
						<span style="font-size:16px;"  class="pt_points_show"></span>
	
					</div>
				</div>
			
		</div>	
		
		<div class="row" style="border-bottom:1px solid #E6E9ED; padding:1px 5px; margin-top:1px;">

				<div class="col-md-3">
					<div class="form-group" style="padding-left:5px">
					
						
					</div>
				</div>		

				<div class="col-md-3">
					<div class="form-group" style="padding-left:5px">
						
						<span style="font-size:16px;"></span>
	
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="form-group focused" style="padding-left:5px">
						<label for="qus"> Total Points:</label>
						
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="form-group" style="padding-left:5px">
						
						<span style="font-size:16px;" class="sum_of_points"></span>
	
					</div>
				</div>
			
		</div>	
	
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
	
	
}

if(!empty($_GET['contest_id']) && $_GET['type'] == 'get_team_list'){
	
	$contest_id = $_GET['contest_id'];
	
?>	

	<label for="type"  class="count_team_show">Team:</label>
		<?php
		$get_team = "SELECT DISTINCT (`team`.team_id) as unique_team_id,`team`.*,sum(`user_question_ans`.credit_points) as total_points FROM `team` INNER JOIN `user_question_ans` ON `team`.team_id = `user_question_ans`.team_id where `team`.user_id=0 AND `user_question_ans`.contest_id = ".$contest_id." AND `user_question_ans`.sub_contest_id= '0' group by `user_question_ans`.team_id ORDER BY team_id DESC";
		$data_team = $obj->select($get_team);
		?>
		
		
		<select class="form-control show-tick count_team" multiple name="team_id[]" required="">
			<option value="">-- Select Team --</option>
			<?php foreach($data_team as $row)
			{
				?>
				<option value="<?php echo $row['team_id'].'__'.$row['name'];?>"><?php echo ucfirst(str_replace("&" , " " , $row['name'])).'('.round($row['total_points'],2).')'; ?></option>
				
				<?php 	
			}
			?>
		</select>
	
<?php }

?>
