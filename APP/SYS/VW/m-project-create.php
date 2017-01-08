
<!-- Modal -->
<div class="modal fade" id="modal-project-create" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">New Project</h4>
      </div>
      <div class="modal-body">
        <form id="form-project-create" method="POST" class="form-horizontal" role="form">
					<div class="form-group">
							<label for="projCode" class="col-lg-4 control-label">Project Code *</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" required name="projCode">
						</div>
					</div>
						<div class="form-group">
						<label for="projName" class="col-lg-4 control-label">Project Name *</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" required name="projName">
						</div>
					</div>
						<div class="form-group">
						<label for="projLoc" class="col-lg-4 control-label">Project Location *</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" required name="projLoc">
						</div>
					</div>
						<div class="form-group">
						<label for="projDesc" class="col-lg-4 control-label">Project Description *</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" required name="projDesc">
						</div>
					</div>
					<small class="pull-right">* Required Fields</small>
					<span class="clearfix"></span>
        			<button id="btn-project-create" data-loading-text="Creating..." type="submit" class="btn btn-danger pull-right">Create Project</button>
					<span class="clearfix"></span>
				</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->