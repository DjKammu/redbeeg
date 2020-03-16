<?php
	
	
	session_start();
	
	require"includes/connection.php";
	
	$obj = new connection;
	
	date_default_timezone_set('Asia/Kolkata');
	
/*============================================
=                      Update  code          =
=============================================*/

if(isset($_POST['admin-setting']))
{ 
	
	$govt_tax_value = $_POST['govt_tax_value'];
	
	$update = "UPDATE admin_setting SET value='".$govt_tax_value."' WHERE field_name='govt_tax_value' ";
	
	
	$result = $obj->update_where($update);
	
	if($result == 1)
	{   
		$_SESSION["msg"] = "Setting Updated Successfully !";
		
		$_SESSION['error'] = 'no';
		
		header('location:setting.php');exit();
	}
	
	else 
	{	
		$_SESSION["msg"] = "Technical Error !";
		
		$_SESSION['error'] = 'yes';
		
		header('location:setting.php');exit();
	}
	
}


if(isset($_POST['admin-setting-half']))
{
	$user_without_code = $_POST['user_without_code'];
	
	$update = "UPDATE admin_setting SET value='".$user_without_code."' WHERE field_name='user_without_code' ";
	
	$result = $obj->update_where($update);
	
	if($result == 1)
	{   
		$_SESSION["msg"] = "Setting Updated Successfully !";
		
		$_SESSION['error'] = 'no';
		
		header('location:setting.php');exit();
	}
	
	else 
	{	
		$_SESSION["msg"] = "Technical Error !";
		
		$_SESSION['error'] = 'yes';
		
		header('location:setting.php');exit();
	}
	
}

if(isset($_POST['user_by_referal_btn']))
{
	$user_by_referal = $_POST['user_by_referal'];
	
	$update = "UPDATE admin_setting SET value='".$user_by_referal."' WHERE field_name='user_by_referal'";
	
	$result = $obj->update_where($update);
	
	if($result == 1)
	{   
		$_SESSION["msg"] = "Setting Updated Successfully !";
		
		$_SESSION['error'] = 'no';
		
		header('location:setting.php');exit();
	}
	
	else 
	{	
		$_SESSION["msg"] = "Technical Error !";
		
		$_SESSION['error'] = 'yes';
		
		header('location:setting.php');exit();
	}
	
}


if(isset($_POST['refer_by_user_btn']))
{
	$refer_by_user = $_POST['refer_by_user'];
	
	$update = "UPDATE admin_setting SET value='".$refer_by_user."' WHERE field_name='refer_by_user' ";
	
	$result = $obj->update_where($update);
	
	if($result == 1)
	{   
		$_SESSION["msg"] = "Setting Updated Successfully !";
		
		$_SESSION['error'] = 'no';
		
		header('location:setting.php');exit();
	}
	
	else 
	{	
		$_SESSION["msg"] = "Technical Error !";
		
		$_SESSION['error'] = 'yes';
		
		header('location:setting.php');exit();
	}
	
}

if(isset($_POST['change_password_btn']))
{ 
	$change_password = base64_encode($_POST['newPassword']);
	
	
	$update = "UPDATE employees SET password='".$change_password."' WHERE id='".$_SESSION['id']."' ";
	
	
	$result = $obj->update_where($update);
	
	if($result == 1)
	{   
		$_SESSION["msg"] = "Setting Updated Successfully !";
		
		$_SESSION['error'] = 'no';
		
		header('location:setting.php');exit();
	}
	
	else 
	{	
		$_SESSION["msg"] = "Technical Error !";
		
		$_SESSION['error'] = 'yes';
		
		header('location:setting.php');exit();
	}
	
}
//email change code
if(isset($_POST['emailchangebtn']))
{
	$emailchange = $_POST['emailchange'];
	
	$update = "UPDATE employees SET email='".$emailchange."' WHERE id='".$_SESSION['id']."' ";
	
	$result = $obj->update_where($update);
	
	if($result == 1)
	{   
		$_SESSION["msg"] = "Email Updated Successfully !";
		
		$_SESSION['error'] = 'no';
		
		header('location:setting.php');exit();
	}
	
	else 
	{	
		$_SESSION["msg"] = "Technical Error !";
		
		$_SESSION['error'] = 'yes';
		
		header('location:setting.php');exit();
	}
}


if(isset($_POST['subcontest_entry_fee_btn']))
{ 
	
	$subcontest_entry_fee = $_POST['subcontest_entry_fee'];
	
	$update = "UPDATE admin_setting SET value='".$subcontest_entry_fee."' WHERE field_name='subcontest_entry_fee' ";
	
	
	$result = $obj->update_where($update);
	
	if($result == 1)
	{   
		$_SESSION["msg"] = "Setting Updated Successfully !";
		
		$_SESSION['error'] = 'no';
		
		header('location:setting.php');exit();
	}
	
	else 
	{	
		$_SESSION["msg"] = "Technical Error !";
		
		$_SESSION['error'] = 'yes';
		
		header('location:setting.php');exit();
	}
	
}


if(isset($_POST['promotional_setting']))
{  
	
	$phone_no = $_POST['phone_no'];
	
	$update_phone = "SELECT * from users  WHERE phone='".$phone_no."' ";
	
	
	$result_phone = $obj->select_assoc($update_phone);
	
	if(count($result_phone) > 0){
		
		$name = $_POST['name'];
		$bonus_balance = $_POST['bonus_balance'];
		$earning_balance = $_POST['earning_balance'];
		$addcash_balance = $_POST['addcash_balance'];
		$refferal_balance = $_POST['refferal_balance'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$playername = $_POST['playername'];
		
		$playername_where = "SELECT * FROM users WHERE playername = '".$playername."' AND phone !=".$phone_no." ";
	
		$playername_dup_check = $obj->count_row($playername_where);
		
		$name_exist_count = "SELECT * FROM `team` WHERE name LIKE '%".$playername."(%'";	
		$name_exist_row  =  $obj->count_row($name_exist_count);
		
		if($name_exist_row > 0 || $playername_dup_check > 0)
		{
			
			$_SESSION['msg'] = 'Player name already exist';
			$_SESSION['error'] = 'yes';
			header('location:setting.php');exit();
		}
		
		$update = "UPDATE users SET name='".$name."',bonus_balance='".$bonus_balance."',earning_balance='".$earning_balance."',addcash_balance='".$addcash_balance."',refferal_balance='".$refferal_balance."',city='".$city."',state='".$state."',playername='".$playername."' WHERE phone='".$phone_no."' ";
		
		
		$result = $obj->update_where($update);
		
		if($result == 1)
		{   
			$_SESSION["msg"] = "Setting Updated Successfully !";
			
			$_SESSION['error'] = 'no';
			
			header('location:setting.php');exit();
		}
		
		else 
		{	
			$_SESSION["msg"] = "Technical Error !";
			
			$_SESSION['error'] = 'yes';
			
			header('location:setting.php');exit();
		}
		
	} else {
		
		$_SESSION["msg"] = "Phone Number not exist !";
			
		$_SESSION['error'] = 'yes';
		
		header('location:setting.php');exit();
		
	}
	
	
	
}

/*============================================
=               Setting  Details             =
=============================================*/

$select = "SELECT * FROM admin_setting ORDER BY id ASC";
$result = $obj->select($select);

/*============================================
=            Password Details              =
=============================================*/
$select_pwd = "SELECT * FROM employees WHERE id='1'";
$result_pwd = $obj->select($select_pwd);
$result_pwd = $result_pwd[0];

/*============================================
=           Promotional page Details         =
=============================================*/

$select_user = "SELECT * FROM users WHERE user_id='1'";
$result_user = $obj->select($select_user);
$result_user = $result_user[0];



include 'includes/top-bar.php';
include 'includes/left-sidebar.php';
	

?>

	<section class="content">
        <div class="container-fluid">
           
 
            <!-- Exportable Table -->
			
			<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                              Admin Setting 
                            </h2>
							<div style="margin:20px">
								<?php
							if(isset($_SESSION['error']))
							{
								
							
								if($_SESSION['error'] == 'yes') 
								{  
									?>
						
								  <div class="alert alert-danger alert-dismissible fade in" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
									</button>
									<?php 
										
										echo $_SESSION['msg'];
										
										unset($_SESSION['error']);
										unset($_SESSION['msg']);
										
										?>
								  </div>
				  
									<?php 
								}
								
								
								if($_SESSION['error'] == 'no') 
								{  
									?>
				  
								  <div class="alert alert-success alert-dismissible fade in" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
									</button>
									<?php 
										
										echo $_SESSION['msg'];
										
										unset($_SESSION['error'],$_SESSION['msg']);
										
										?>
								  </div>
					  
									<?php
								} 
							}
								?>
							</div>
                        </div>
						
                        <div class="body">
                        
					
							<form method="post" data-parsley-validate="" class="form-horizontal form-label-left">
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="user_without_code"> User Without Referal Code <span class="required">(In Rupee) *</span> 
									</label>
									<div class="col-md-5 col-sm-5 col-xs-12">
									  <input name="user_without_code" value="<?php echo $result[1]['value']; ?>" type="number" required="required" class="form-control col-md-7 col-xs-12" min="0">
									</div>
								
									<div class="col-md-3 col-sm-3 col-xs-12 ">
									  <button name="admin-setting-half" value="Submit" type="submit"  class="btn bg-red waves-effect"> <i class="material-icons">publish</i>Update</button>
									</div>
								</div>
							  <div class="ln_solid"></div>
							</form>
							
							
							
							<form method="post" class="form-horizontal form-label-left">
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Subcontest Entry Fee <span class="required">(In Rupee) *</span> 
									</label>
									<div class="col-md-5 col-sm-5 col-xs-12">
									  <input name="subcontest_entry_fee" value="<?php echo $result[4]['value']; ?>" type="text" required="required" class="form-control col-md-7 col-xs-12" min="0">
									</div>
									
									<div class="col-md-3 col-sm-3 col-xs-12 ">
									  <button name="subcontest_entry_fee_btn" value="Submit" type="submit"  class="btn bg-red waves-effect"> <i class="material-icons">publish</i>Update</button>
									</div>
								</div>
								<div class="ln_solid"></div>
							</form>
							
							   
					
							<form method="post" data-parsley-validate="" class="form-horizontal form-label-left">						
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="user_by_referal"> User By Referal Code <span class="required">(In Rupee) *</span> 
									</label>
									<div class="col-md-5 col-sm-5 col-xs-12">
									  <input name="user_by_referal" value="<?php echo $result[2]['value']; ?>" type="number" required="required" class="form-control col-md-7 col-xs-12" min="0">
									</div>
									
									<div class="col-md-3 col-sm-3 col-xs-12 ">
									  <button name="user_by_referal_btn" value="Submit" type="submit"  class="btn bg-red waves-effect"> <i class="material-icons">publish</i>Update</button>
									</div>
								</div>
							    <div class="ln_solid"></div>
							</form>
					
							
							
							<form method="post" data-parsley-validate="" class="form-horizontal form-label-left">					
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="refer_by_user">Referal By User <span class="required">(In Rupee) *</span> 
									</label>
									<div class="col-md-5 col-sm-5 col-xs-12">
									  <input name="refer_by_user" value="<?php echo $result[3]['value']; ?>" type="number" required="required" class="form-control col-md-7 col-xs-12" min="0">
									</div>
									
									<div class="col-md-3 col-sm-3 col-xs-12 ">
									  <button name="refer_by_user_btn" value="Submit" type="submit"  class="btn bg-red waves-effect"> <i class="material-icons">publish</i>Update</button>
									</div>
							    </div>
							  <div class="ln_solid"></div>
							</form>
							
							 <form method="post" id="admin-setting" data-parsley-validate="" class="form-horizontal form-label-left">				
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="govt_tax_value">Gov. Tax Value <span class="required">(In percent) *</span> 
									</label>
									
									<div class="col-md-5 col-sm-5 col-xs-12">
									  <input name="govt_tax_value" value="<?php echo $result[0]['value']; ?>" step="any" type="number" required="required" class="form-control col-md-7 col-xs-12" min="0">
									</div>
									
									<div class="col-md-3 col-sm-3 col-xs-12 ">
									  <button name="admin-setting" value="Submit" type="submit" class="btn bg-red waves-effect"> <i class="material-icons">publish</i>Update</button>
									</div>
								</div>
								<div class="ln_solid"></div>
							</form>
							
					
							<div class="row">
							<form method="post" class="form-horizontal form-label-left" name="frmChange" onSubmit="return validatePassword('<?php echo base64_decode($result_pwd['password'])?>')">
							   <div class="header">
									<h2>Change Password</h2>
								</div>
								<div class="body">
								    <div id="Passwordstatus"></div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="name">Current Password<span class="required">*</span> 
											</label>
											<div class="col-md-8 col-sm-8 col-xs-12">
											   <input name="change_password" value="<?php echo base64_decode($result_pwd['password']); ?>" type="password" required="required" class="form-control col-md-7 col-xs-12" min="0" readonly >
											</div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="bonus_balance">Enter Current Password<span class="required">*</span> 
											</label>
											<div class="col-md-8 col-sm-8 col-xs-12">
											  <input name="currentPassword" value="" type="password" required="required" class="form-control col-md-7 col-xs-12" min="0">
											</div>
										</div>
									</div>
									
								<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="earning_balance">New Password<span class="required">*</span> 
											</label>
											<div class="col-md-8 col-sm-8 col-xs-12">
											  <input name="newPassword" value="" id="newPassword" type="password" required="required" class="form-control col-md-7 col-xs-12" min="0">
											</div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="addcash_balance">Confirm Password <span class="required">*</span> 
											</label>
											<div class="col-md-8 col-sm-8 col-xs-12">
											  <input name="confirmPassword" id ="confirmPassword" value="" type="password" required="required" class="form-control col-md-7 col-xs-12" min="0">
											</div>
										</div>
									</div>
																		
									 <div class="col-lg-3 col-md-offset-9">
										<button name="change_password_btn" value="Submit" type="submit"  class="btn bg-red waves-effect"> <i class="material-icons">publish</i>Update</button>
									 </div>
								</div>
							</form>
							</div>
							
							<div class="row">
							<form method="post" class="form-horizontal form-label-left" name="" >
							   <div class="header">
									<h2>Email Change</h2>
								</div>
								<div class="body">
								  
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="addcash_balance">Email Change<span class="required">*</span> 
											</label>
											<div class="col-md-5 col-sm-5 col-xs-12">
											  <input name="emailchange" id ="emailchange" value="<?php echo $result_pwd['email'];?>" type="email" required="required" class="form-control col-md-7 col-xs-12" min="0">
											</div>
											<div class="col-lg-3 col-sm-3 col-xs-12">
												<button name="emailchangebtn" value="Submit" type="submit"  class="btn bg-red waves-effect"> <i class="material-icons">publish</i>Update</button>
											</div>
										</div>
									</div> 
									
									
									 
								</div>
							</form>
							</div>
							
							
							<div class="row">
							<form method="post" class="form-horizontal form-label-left">
							   <div class="header">
									<h2>Promotional Page Setting</h2>
								</div>
								<div class="body">
								
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="refferal_balance">Phone Number<span class="required">*</span> 
											</label>
											<div class="col-md-8 col-sm-8 col-xs-12">
											  <input name="phone_no" value="<?php echo $result_user['phone']; ?>" type="text" required="required" class="form-control col-md-7 col-xs-12" min="0">
											</div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="name">Name <span class="required">*</span> 
											</label>
											<div class="col-md-8 col-sm-8 col-xs-12">
											  <input name="name" value="<?php echo $result_user['name']; ?>" type="text" required="required" class="form-control col-md-7 col-xs-12" min="0">
											</div>
										</div>
										
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="refferal_balance">PlayerName<span class="required">*</span> 
											</label>
											<div class="col-md-8 col-sm-8 col-xs-12">
											  <input name="playername" value="<?php echo $result_user['playername']; ?>" type="text" required="required" class="form-control col-md-7 col-xs-12" min="0">
											</div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="name">City <span class="required">*</span> 
											</label>
											<div class="col-md-8 col-sm-8 col-xs-12">
											  <input name="city" value="<?php echo $result_user['city']; ?>" type="text" required="required" class="form-control col-md-7 col-xs-12" min="0">
											</div>
										</div>
										
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="name">State <span class="required">*</span> 
											</label>
											<div class="col-md-8 col-sm-8 col-xs-12">
												
												
												<?php
													$get_query = "SELECT * FROM `states` WHERE country_id = '101' AND id NOT IN(4,29,36) ORDER BY name ASC";
													$data = $obj->select($get_query);
												?>
												
												<select class="form-control show-tick" name="state" required="">
													<option value="">-- Please select --</option>
													<?php foreach($data as $row)
													{
														?>
														<option value="<?php echo $row['id'];?>"><?php echo ucfirst( $row['name']); ?></option>
														
														<?php 	
													}
													?>
												</select>
											
											    <!--<input name="state" value="<?php echo $result_user['state']; ?>" type="text" required="required" class="form-control col-md-7 col-xs-12" min="0">-->
											  
											  
											</div>
										</div>
										
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="bonus_balance">Cash Bonus <span class="required">*</span> 
											</label>
											<div class="col-md-8 col-sm-8 col-xs-12">
											  <input name="bonus_balance" value="<?php echo $result_user['bonus_balance']; ?>" type="text" required="required" class="form-control col-md-7 col-xs-12" min="0">
											</div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="earning_balance">Winning Amount<span class="required">*</span> 
											</label>
											<div class="col-md-8 col-sm-8 col-xs-12">
											  <input name="earning_balance" value="<?php echo $result_user['earning_balance']; ?>" type="text" required="required" class="form-control col-md-7 col-xs-12" min="0">
											</div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="addcash_balance">Add Cash <span class="required">*</span> 
											</label>
											<div class="col-md-8 col-sm-8 col-xs-12">
											  <input name="addcash_balance" value="<?php echo $result_user['addcash_balance']; ?>" type="text" required="required" class="form-control col-md-7 col-xs-12" min="0">
											</div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="refferal_balance">Referral Amount<span class="required">*</span> 
											</label>
											<div class="col-md-8 col-sm-8 col-xs-12">
											  <input name="refferal_balance" value="<?php echo $result_user['refferal_balance']; ?>" type="text" required="required" class="form-control col-md-7 col-xs-12" min="0">
											</div>
										</div>
									</div>
									
									
									
									 <div class="col-md-2 col-md-offset-4" style="text-a"><button  name="promotional_setting" value="Submit" type="submit"  class="btn bg-red waves-effect "> <i class="material-icons">publish</i>Update</button></div>
								</div>
							
							</form>
							</div>
					
                        </div>
                    </div>
                </div>
            </div>
        </div> 
	</section>
	 
	 <script>
	 	<!-- Automatic Dissmiss Alert starts -->
		 
			$(document).ready(function()
			{
				setTimeout(function(){ $('.alert').slideUp();}, 3000);
			});	
			
		<!-- Automatic Dissmiss Alert ends -->
	</script>
	
	<!-- Change Password Script -->
	
	<script>
	
		function validatePassword(existingPassword) 
		{  
		  
			var currentPassword,newPassword,confirmPassword,output = true;
			currentPassword = document.frmChange.currentPassword;
			newPassword = document.frmChange.newPassword;
			confirmPassword = document.frmChange.confirmPassword;
			
			if(existingPassword != currentPassword.value){
				$("#Passwordstatus").html('<div class="alert alert-danger alert-dismissable animated flipInX"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Danger!</strong>Current Password Not Matched !.</div>');
				return false;
			}
			
			else if(newPassword.value != confirmPassword.value){ 
				newPassword.value="";
				confirmPassword.value="";
				newPassword.focus();
				$("#Passwordstatus").html('<div class="alert alert-danger alert-dismissable animated flipInX"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Danger!</strong>Confirm Password Not Matched !.</div>');
				return false;
			}
			
			else{
				return true;
			}
             			
			
		}
		
	</script>
	
	<!-- End Password Script  -->
	
	<?php 
	
		include 'includes/footer.php';
		
	?>

