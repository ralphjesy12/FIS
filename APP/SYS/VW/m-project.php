<!-- Modal -->
<div class="modal fade" id="modal-project" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Projects</h4>
      </div>
      <div class="modal-body">
       <div class="row">
         <div class="col-lg-12" style="margin:10px;">
      <button class="btn btn-danger btn-lg" data-toggle="modal" data-target="#modal-project-create"><i class="fa fa-credit-card fa-fw"></i> New Project</button>
    </div>
      <div class="col-lg-4 overflow-scrollable" data-offset="270">
        <div id="list-project" class="list-group badged-left"> </div>
    </div>
      <div class="col-lg-8">
        <div class="well">
          <form class="form-horizontal" role="form">
            <div class="form-group">
            <label for="projCode" class="col-lg-3 control-label">Project Code</label>
              <div class="col-sm-9">
                <div class="input-group">
                <input type="text" class="form-control" disabled id="projCode">
                <span class="input-group-btn">
                <button class="btn btn-info btn-projInfo-edit" type="button"><i class="fa fa-fw fa-pencil"></i></button>
                </span>
              </div>
            </div>
          </div>
            <div class="form-group">
            <label for="projName" class="col-lg-3 control-label">Project Name</label>
              <div class="col-sm-9">
                <div class="input-group">
                <input type="text" class="form-control" disabled id="projName">
                <span class="input-group-btn">
                <button class="btn btn-info btn-projInfo-edit" type="button"><i class="fa fa-fw fa-pencil"></i></button>
                </span>
              </div>
            </div>
          </div>
            <div class="form-group">
            <label for="projLoc" class="col-lg-3 control-label">Project Location</label>
              <div class="col-sm-9">
                <div class="input-group">
                <input type="text" class="form-control" disabled id="projLoc">
                <span class="input-group-btn">
                <button class="btn btn-info btn-projInfo-edit" type="button"><i class="fa fa-fw fa-pencil"></i></button>
                </span>
              </div>
            </div>
          </div>
            <div class="form-group">
            <label for="projDesc" class="col-lg-3 control-label">Project Description</label>
              <div class="col-sm-9">
                <div class="input-group">
                <input type="text" class="form-control" disabled id="projDesc">
                <span class="input-group-btn">
                <button class="btn btn-info btn-projInfo-edit" type="button"><i class="fa fa-fw fa-pencil"></i></button>
                </span>
              </div>
            </div>
          </div>
        </form>
        <button id="btn-proj-stats" class="btn btn-danger" data-toggle="button" data-loading-text="Calculating...">
        <i class="fa fa-fw fa-bar-chart-o"></i>Statistics
        </button>
        <button id="btn-project-reports" class="btn btn-danger">
        <i class="fa fa-fw fa-tasks"></i>Reports
        </button>
        <button id="btn-project-remove" class="btn btn-danger">
        <i class="fa fa-fw fa-trash-o"></i>Remove
        </button>
      </div>
    </div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->