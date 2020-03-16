<?php
require"includes/connection.php";

$obj = new connection;

session_start();


if(isset($_POST['password']) && isset($_POST['user_name']))
{
	
	$password = md5($_POST['password']);
	$user_name = $_POST['user_name'];
	$data = "SELECT id,name,user_name,type from employees where user_name='".$user_name."' AND password='".$password."'";

	$result = $obj->select_where($data);

	if(count(array_filter($result)) > 0)
	{
		 
		foreach($result as $deatil) 
		{
			
			$_SESSION = $deatil;  
		}
		
		$_SESSION['error'] = 'no';
		
		header('Location:dashboard.php');
		
	} 
	
	else 
	{
	
		$_SESSION['error'] = 'yes';
		
	
		$_SESSION['msg'] = 'Wrong username or password !';
	
	}
	

}

//forgot password code

if(isset($_POST['email']))
{
	$data = "SELECT * From employees WHERE `email` = '".$_POST['email']."'";

	$result = $obj->select_where($data);
	
	
	if(count($result)>0)
	{   
		$password = base64_decode($result[0]['password']);
		$to = $_POST['email'];
		$subject = "Your Recovered Password";
		$message = "Please use this password to login : " . $password;
		$headers = "From: sms@smsfordwarder.com";
		$status = mail($to,$subject,$message,$headers);
		
		if($status > 0)	{
			$_SESSION["msg"] =  "Your Password has been sent to your email id !";
		}
		
		else{
			$_SESSION["msg"] =  "Failed to Recover your password, try again!";
		}
		$_SESSION['error'] = 'no';
		
		header("location:index.php");
		
		exit();
	}
	
	else
	{
		$_SESSION["msg"] =  "Email Does Not Exist !";
		$_SESSION['error'] = 'yes';
		
		header("location:index.php");
		
		exit();
	}	
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title> Admin Panel</title>
    <!-- Favicon-->
   <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />


    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

</head>

<body class="login-page">
    <div class="login-box">
    	<h2 class=" text-center text-white"><span style="color: ">Red</span>Beeg.</h2>
    	<hr class="main-line">
    	<br>
    	<br>
             <div class="card loginform">
            <div class="body">
            	<br>

                <form id="sign_in" method="POST">
				
					
					 <?php
					 if(isset($_SESSION['error']))
					 {
					
						
						if($_SESSION['error'] == 'yes')
						{ 
							?>
							<div class="alert alert-danger alert-dismissable fade in" style="  box-shadow: inset 0 0 10px #fff!important;color: #fff !important;">
							<a href="#" class="close" data-dismiss="alert" aria-label="close" style="color:#fff !important;">&times;</a><?php echo $_SESSION['msg'];unset($_SESSION['error'],$_SESSION['msg']);?></div><?php 
						}
					 }
						?>
						
                    <div class="input-group">
                        
                        <div class="form-line">
                            <input type="text" class="form-control" name="user_name" placeholder="Username" required autofocus>
                        </div>
                    </div>
					
                   
						
                        <div class="form-line password">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                        	<br>

                        <div class="row">
                        <div class="col-xs-7 p-t-5">
                        	<a href="" class="" data-toggle="modal" data-target="#myModalForgot">Forgot Password ?</a>
                        </div>
						
                        <div class="col-xs-5">
                            <button class="btn btn-danger" type="submit"><i class="material-icons" style="font-size:15px !important;">input</i> SIGN IN</button>

                        </div>
				    </div>
                    </div>
					
                    <div class="row  m-b--20">
                        <div class="col-xs-6"> 
                        </div>
                        <div class="col-xs-6 text-right">
                           
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
	
	<div class="copyrightDiv">
		<!--<p class="copyright text-center">  Copyright © playwith11.com 2018 . All Rights Reserved </p>
		<p class="copyright text-center">
		Designed &amp; Developed by :-  <a href="JavaScript:Void(0);" target="_blank"><b data-toggle="tooltip" data-placement="top" title="Ibitol Technologies">IBITOL</b></a></p>-->
	</div>

	<!-- Forgot Modal-->
	
	<div class="modal fade" id="myModalForgot" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-sm  flipInX animated" role="document" style="width:340px;">
			<form method="post">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title text-center" id="smallModalLabel" >What's My Password?</h4>
				</div>
				
			
					<div class="modal-body">
						<div class="form-group">
								<label for="email">Enter Email</label>
								<input name="email" type="email" id="email" class="form-control"  placeholder="Enter Registered Email" required>
						</div>
					</div>
					
					<div class="modal-footer">
						<button type="submit" name="submit" class="btn btn-danger">SEND MY PASSWORD</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
					</div>
				
			</div>
			</form>
		</div>
    </div>
	
    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/examples/sign-in.js"></script>
	
	<!-- script to dissmiss alert automaically -->
	
<script>
	
	$(document).ready(function()
	{
		
		setTimeout(function()
		{
			$(".alert").slideUp(3000);
		},3000);
		
	});
		
		
<!-- Show Password Code Stars -->
	
	$(document).on("click" , "#sign_in .showPassword" , function()
	{
		var type = $("input[type='password']").attr('type');
		
		if(type=='password'){
				$('input[name="password"]').attr('type' , 'text');
				$('.showPassword').removeClass('fa-eye');
				$('.showPassword').addClass('fa-eye-slash');
				$('.showPassword').attr('title' , 'Hide Password');
				$('.showPassword').attr('data-original-title' , 'Hide Password');
				
			}
			
			else{
				$('input[name="password"]').attr('type' , 'password');
				$('.showPassword').removeClass('fa-eye-slash');
				$('.showPassword').addClass('fa-eye');
				$('.showPassword').attr('title' , 'Show Password' );
				$('.showPassword').attr('data-original-title' , 'Show Password' );
			}
		
	}); 
	
	
	
	
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip(); 
	});
		
<!-- Show Password Code Ends -->
		
</script>
	
	
</body>

</html>

<style>
	body {
  background: linear-gradient(-45deg, #EE7752, #E73C7E, #23A6D5, #23D5AB);
  background-size: 400% 400%;
  -webkit-animation: Gradient 15s ease infinite;
  -moz-animation: Gradient 15s ease infinite;
  animation: Gradient 15s ease infinite;
}

@-webkit-keyframes Gradient {
  0% {
    background-position: 0% 50%
  }
  50% {
    background-position: 100% 50%
  }
  100% {
    background-position: 0% 50%
  }
}

@-moz-keyframes Gradient {
  0% {
    background-position: 0% 50%
  }
  50% {
    background-position: 100% 50%
  }
  100% {
    background-position: 0% 50%
  }
}

@keyframes Gradient {
  0% {
    background-position: 0% 50%
  }
  50% {
    background-position: 100% 50%
  }
  100% {
    background-position: 0% 50%
  }
}

</style>