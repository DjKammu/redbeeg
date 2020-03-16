
    <!-- Select Plugin Js -->
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>
	
	 <!-- Autosize Plugin Js -->
    <script src="plugins/autosize/autosize.js"></script>
 
    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
	
	
 
    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

	 <!-- Jquery CountTo Plugin Js -->
    <script src="plugins/jquery-countto/jquery.countTo.js"></script>
	
	   <!-- Morris Plugin Js -->
	   
	<script src="plugins/morrisjs/morris.min.js"></script>
    <script src="plugins/raphael/raphael.min.js"></script>
    <script src="plugins/morrisjs/morris.js"></script>
 
	
	   

    <!-- ChartJs -->
    <script src="plugins/chartjs/Chart.bundle.js"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="plugins/flot-charts/jquery.flot.js"></script>
    <script src="plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="plugins/flot-charts/jquery.flot.time.js"></script>
	

    <!-- Sparkline Chart Plugin Js -->
    <script src="plugins/jquery-sparkline/jquery.sparkline.js"></script>
	
	
    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/index.js"></script>
	<script src="js/demo.js"></script>
	<script src="js/pages/ui/tooltips-popovers.js"></script>
	
	
	 
    <!-- Jquery DataTable Plugin Js -->
    <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
	
    <!-- fix header script -->
	
    <script src="https://cdn.datatables.net/fixedheader/3.1.3/js/dataTables.fixedHeader.min.js"></script>
	



    <!-- Custom Js -->
	
    <script src="js/pages/tables/jquery-datatable.js"></script>

	  <script src="js/pages/ui/dialogs.js"></script>
	  
	  <!-- SweetAlert Plugin Js -->
    <script src="plugins/sweetalert/sweetalert.min.js"></script>

	
	<!-- script to highligh the current menu list -->	
	
	<script>

		$(document).ready(function(){
			var listitem = '<?php echo str_replace( "." , "" , basename($_SERVER['PHP_SELF'])); ?>';
			$('li').removeClass("active");
			$('.'+listitem).addClass("active");
			
			if(listitem == 'dashboardphp'){
					document.title = "Admin Home";
			}else{
				document.title = $('.card .header h2').text();	
			}
			
		    var fileName = document.location.pathname.match(/[^\/]+$/)[0];
			
			/* if(fileName != "question.php"){$(".modal-dialog").addClass("flipInX  animated");} */
			
			$(".refresh").attr("href" , "<?php echo  basename($_SERVER['PHP_SELF']) ?>");
			
		});

		
		<!-- required validation script -->
		
	   $(document).ready(function()
		{
				
			$('.form-control').find('select').each(function(){
				if($(this).prop('required')){
					$(this).parents(".bootstrap-select").attr('style', 'border-left-color: red !important;border-left-width:3px !important');
				} 
			});
		});	
			
		
		<!-- more info coding-->
	
		$(document).ready(function()
		{   
			$(document).on("click" , ".read_more" , function(){
				
				var div_id = $(this).attr('id').match(/\d+/);
				
				var icon = $('#read_more'+div_id+' i').text();
				
				if(icon=="keyboard_arrow_down"){
					$('#read_more'+div_id+' i').text("keyboard_arrow_up");
					$('#read_more'+div_id).attr("title" , "Less Information");
					$('#read_more'+div_id).attr("data-original-title" , "Less Information");
					

				}
				else{
					$('#read_more'+div_id+' i').text("keyboard_arrow_down");
					$('#read_more'+div_id).attr("title" , "More Information");
					$('#read_more'+div_id).attr("data-original-title" , "More Information");
					
				}
			
				 $('#more_info'+div_id).slideToggle(1000);
				 $('[data-toggle="tooltip"]').tooltip(); 	 
			
			});
		});
		
		<!-- more info coding for subcontest details -->
		
		$(document).ready(function()
		{   
			$(document).on("click" , "#myModalGetExcel .read_morepopUp" , function(){
				
				var div_id = $(this).attr('id').match(/\d+/);
			
				
				var icon = $('#myModalGetExcel #read_morepopUp'+div_id+' i').text();
				
	
				if(icon=="keyboard_arrow_down"){
					
					$('#myModalGetExcel #read_morepopUp'+div_id+' i').text("keyboard_arrow_up");
					$('#myModalGetExcel #read_morepopUp'+div_id).attr("title" , "Less Information");
					$('#myModalGetExcel #read_morepopUp'+div_id).attr("data-original-title" , "Less Information");
				}
				else{
					$('#myModalGetExcel #read_morepopUp'+div_id+' i').text("keyboard_arrow_down");
					$('#myModalGetExcel #read_morepopUp'+div_id).attr("title" , "More Information");
					$('#myModalGetExcel #read_morepopUp'+div_id).attr("data-original-title" , "More Information");
				}
				
				 $('#myModalGetExcel #popup_more_info'+div_id).slideToggle(1000);
				  $('[data-toggle="tooltip"]').tooltip(); 
				  
			
			});
		});
		
		<!-- more info coding ends -->
		
		
		$(document).on('click', 'button[type="reset"]', function(e)
		{
		
			$("select").val('default');
			$("select").selectpicker("refresh");
		
		});
		
	</script>

	
	
	
</body>
</html>