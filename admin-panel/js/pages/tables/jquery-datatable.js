$(function () {
    $('.js-basic-example').DataTable({
        responsive: true,
		select: true
    }); 
	//$('.table').DataTable();
    //Exportable table   
    $('.js-exportable').DataTable({
        //dom: 'Bfrtip',
        dom: 'lBfrtip',
	
	
		fixedHeader: true,
	    "lengthMenu": [[11, 25, 50,100, -1], [11, 25, 50,100, "All"]],
		
        responsive: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});