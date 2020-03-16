<?php
session_start();
$url_array = explode('?', 'http://'.$_SERVER ['HTTP_HOST'].$_SERVER['REQUEST_URI']);
$url = $url_array[0];

require_once 'google-api-php-client/src/Google_Client.php';
require_once 'google-api-php-client/src/contrib/Google_DriveService.php';
$client = new Google_Client();
$client->setClientId('874470093428-kf9eb4f9cpp92kekhfumu54raceo1ntk.apps.googleusercontent.com');
$client->setClientSecret('NXhRS8H-BZgk5vEgn_ySilJ8');
$client->setRedirectUri($url);
$client->setScopes(array('https://www.googleapis.com/auth/drive'));
if (isset($_GET['code'])) {
    $_SESSION['accessToken'] = $client->authenticate($_GET['code']);
    header('location:'.$url);exit;
} elseif (!isset($_SESSION['accessToken'])) {
    $client->authenticate();
}
$files= array();
$dir = dir('files');
while ($file = $dir->read()) {
    if ($file != '.' && $file != '..') {
        $files[] = $file;
    }
}
$dir->close();
if (!empty($_POST)) {
	$client->setAccessToken($_SESSION['accessToken']);
	$service = new Google_DriveService($client);
	
	/* $fileMetadata = new Google_Service_Drive_DriveFile(array(
    'name' => 'testInvoices',
    'mimeType' => 'application/vnd.google-apps.folder')); */
	
	$folder = new Google_DriveFile();
	
	$folder->setTitle('testInvoices');
	
	$folder->setMimeType('application/vnd.google-apps.folder');
	
	$folder = $service->files->insert($folder, array('fields' => 'id'));
	
//echo "<pre>";print_r($folder['id']);die();
	//1pyL2ufq-wFJs2ckOosy2A7pgCzAMqyhy
    //$client->setAccessToken($_SESSION['accessToken']);
    //$service = new Google_DriveService($client);
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $file = new Google_DriveFile();
	
	
	
    foreach ($files as $file_name) {
        $file_path = 'files/'.$file_name;
        $mime_type = finfo_file($finfo, $file_path);
		$parent = new Google_ParentReference();
		$parent->setId($folder['id']);
		$file->setParents(array($parent));
        $file->setTitle($file_name);
        $file->setDescription('This is a '.$mime_type.' document');
        $file->setMimeType($mime_type);
		//echo "<pre>";print_r($file);die();
        $service->files->insert(
            $file,
            array(
                'data' => file_get_contents($file_path),
                'mimeType' => $mime_type
            )
        );
    }
    finfo_close($finfo);
    header('location:'.$url);exit;
}
include 'index.phtml';
