<?php
require"admin-panel/includes/connection.php";
$obj = new connection;
$pornstar = $_GET['pornstar'];
$search = $_GET['search'];
$Star =  $row['Star_Name'];

//die();

// get the category form url and make a query
$tag_query = "SELECT * FROM `category` WHERE `name` = '$pornstar'";
// for serach module
$get_query = "SELECT * FROM `contest` WHERE `Star_Name` = '$search' ";

// get the category tables
$star_details = "SELECT * FROM `category` ";

//$get_query_main = "SELECT * FROM `contest` INNER JOIN category ON contest.category_id=category.id ORDER BY contest_id DESC"   INNER JOIN category ORDER BY contest_id DESC;
$get_query_main = "SELECT * FROM `contest`  ORDER BY `contest_id` DESC";
$data_main = $obj->select_where($get_query_main);

//echo "<pre>";
//print_r($data_main);
$data = $obj->select_where($get_query);

$pornstar_list = $obj->select_where($tag_query);

$star_details_query = $obj->select_where($star_details);
$limit = 10;  // Number of entries to show in a page. 
    // Look for a GET variable page if not found default is 1.  
	function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
	}
	
	$latest = current($data);
	$latestVid = current($data);
	unset($latest['details']);
	unset($latest['tags']);
	$latestVideo = json_encode($latest);
	
	
	
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    
    <!-- font link -->
    <!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i" rel="stylesheet">
    <!-- icon cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="https://cdn1.iconfinder.com/data/icons/mobile-device/512/drop-ink-color-printer-blue-round-512.png" />
	<link href="dist/skin/blue.monday/css/jplayer.blue.monday.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/font.css">
	<!-- Material Design Bootstrap -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/css/mdb.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	
    <title>RedBeeg.</title>
  </head>
  <body>
 <body class="expansion-alids-init" style="">
 	<header class="navbar-dark fixed-top bg-dark">
 		<div class="">
 			 <nav class="navbar navbar-expand-md  container">
		      <a class="navbar-brand mr-5" href="index.php"><span style="color: red; font-weight: bold">Red</span>Beeg.</a>
		      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
		        <span class="navbar-toggler-icon"></span>
		      </button>
		      <div class="collapse navbar-collapse" id="navbarCollapse">
		        <ul class="navbar-nav ml-auto ">
		          <li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			        	Star's
			        </a>
			        	  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
					  	<?php foreach($star_details_query AS $row){  
							if ( !empty($row['name'])) {
								

		        			?> 
				        		<a class="dropdown-item" href="catagory_page.php?pornstar=<?php echo $row['name'];?>"> <?php echo $row['name'];?> </a>
						        
				          <?php
		        		}
		        		}
		        		?>
					</div>
			      </li>
			       <li class="nav-item">
			        <a class="nav-link" href="#">People</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link " href="#" tabindex="-1" aria-disabled="true">Tags</a>
			      </li>
                </li>
		        </ul>
		        <!-- <div id="wrap">
				  <form style="margin: 0px;" action="" autocomplete="on">
				  <input id="search" name="search" type="text" placeholder="What're we looking for ?">
				
				  <i class="fa fa-search" aria-hidden="true"  id="search_submit" value="Rechercher" type="submit"></i>
				  </form>
				</div> -->
		      </div>
		    </nav>
 		</div>
 	</header>

