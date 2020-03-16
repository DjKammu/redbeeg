<?php

	session_start();
	require"includes/connection.php";
	
	$obj = new connection;
	include 'includes/top-bar.php';
	include 'includes/left-sidebar.php';
	

	
	
	$contest = "SELECT * FROM `contest` ORDER BY contest_id DESC LIMIT 10";
	$contest_query = $obj->select_where($contest);
	$contest_data = $contest_query;
	$contest_count['total'] = count($contest_query);

	

	
?>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header" style="background:transparent;font-size:20px ;border-bottom:none;">
			 <b class="blink_me">DASHBOARD</b>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Users</div>
                            <div class="number count-to" data-from="0" data-to="0" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">poll</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Videos</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $contest_count['total'];?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">assignment_late</i>
                        </div>
                        <div class="content">
                            <div class="text">Sub Video</div>
                            <div class="number count-to" data-from="0" data-to="0" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
				
              
            </div>
            <!-- #END# Widgets -->
          
            

            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>VIDEOS</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Videos</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									
									<?php
									
									$i=1;
									
									foreach($contest_data as $data)
									{   
									
								
									   $contestName = ucfirst($data['name']);
									
										?>
										<tr>
                                            <td><?php echo $i; $i++;?></td>
                                            <td><?php echo $contestName; ?></td>
                                            
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
                <!-- #END# Task Info -->
            
            </div>
        </div>
    </section>

<?php

	include 'includes/footer.php';
	
	
?>