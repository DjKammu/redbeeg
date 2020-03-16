
<!-- MODAL FOR ADD QUESTION-->


<div id="qusModal" class="modal fade" role="dialog">

 <form class="form-horizontal form-label-left" method="POST" id="">

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Question</h4>
      </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
					    <div class="form-group">
							<label for="type">Contest:</label>
								<select class="form-control show-tick" name="type" required="">
									<option value="">-- Please select --</option>
									<option value="10">10</option>
									<option value="20">20</option>
								</select>
							
						</div>
						
						<div class="form-group">
							<label for="qus"> Question :</label>
							<input type="text" class="form-control" name="qus" required>
						</div>
						
						<div class="form-group">
							<label for="point"> Points :</label>
							<input type="number" class="form-control" name="points" value="" min="0" required="" type="any">
						</div>
						
						<div class="form-group">
							<label for="type">Type:</label>
								<select class="form-control show-tick" name="type" required="">
									<option value="">-- Please select --</option>
									<option value="king">King</option>
									<option value="queen">Queen</option>
									<option value="normal">Normal</option>
								</select>
							
						</div>
						
                    </div>
                </div>
            </div>
        </div>
    </div>
      <div class="modal-footer">
        <div class="ln_solid"></div>
		  <div class="form-group">
			<div class="col-md-12">
			 <button type="submit"  name="qus_add" class="btn btn-success waves-effect">
						<i class="material-icons">verified_user</i>
						<span>Save</span>
					</button>
			 <button type="button" class="btn bg-red waves-effect" data-dismiss="modal">
						<i class="material-icons">content_cut</i>
						<span>Cancel</span>
					</button>
			 
			</div>
		  </div>
      </div>
    </div>

  </div>
  
  </form>
  
</div>