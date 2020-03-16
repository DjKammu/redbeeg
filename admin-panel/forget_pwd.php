<?php

//include_once ('Config.php');
    //include_once ('../public/functions.php');

	/* DEFINE ('DB_HOST', $host);
	DEFINE ('DB_USER', $user);	 
	DEFINE ('DB_PASSWORD', $pass);
	DEFINE ('DB_NAME', $database); */
	 
	/* $mysqli = @mysql_connect (DB_HOST, DB_USERNAME, DB_PASSWORD) OR die ('Could not connect to MySQL');
	@mysql_select_db (DB_NAME) OR die ('Could not select the database'); */
	
	
	

$phone = $_REQUEST['phone'];


if(!empty($phone)){
	
	/* $select = "SELECT * from devices where email='".$phone."'";

	$select_qry = mysql_query($select);
	
	$user_det = mysql_fetch_assoc($select_qry); */
	
	/* if(count($user_det) > 0){
		
		
		$obj['status'] = 'SUCCESS';
		
		$obj['msg'] = 'Please check your number for password !';
		
	} else {
		
		$obj['status'] = 'FAIL';
	
		$obj['msg'] = 'This number not exist in the system !';
	} */
	
	
	$phone = '8699609502';
	
	$pwd = 'this is your password : 9779309578';

	$base = 'http://sms.mbdrecharge.com/sendsms.jsp?user=jeevan&password=jeevan&mobiles=8699609502&sms=Test%20Sms&senderid=JAKPOT';
	 $response = file_get_contents($base);
	// create a new cURL resource
/* $ch = curl_init();

// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, "http://sms.mbdrecharge.com/sendsms.jsp?user=jeevan&password=jeevan&mobiles=8699609502&sms=Test%20Sms&senderid=JAKPOT");
curl_setopt($ch, CURLOPT_HEADER, 0);

// grab URL and pass it to the browser
$str = curl_exec($ch);

// close cURL resource, and free up system resources
curl_close($ch); */
	
	 
	print_r($response);
	die('yy');
	
	
}





echo json_encode($obj);

?>