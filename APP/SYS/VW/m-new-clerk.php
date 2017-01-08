
<!-- Modal -->
<div class="modal fade" id="modal-new-clerk" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">New Clerk</h4>
      </div>
      <div class="modal-body">
         <form id="form-clerk" class="form-horizontal" role="form">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
              <div class="col-sm-10">
                <input id="clerk_un" name="un" type="text" class="form-control" placeholder="Username" >
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
              <div class="col-sm-10">
                <input id="clerk_pw" name="pw" type="text" class="form-control" placeholder="Password" >
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">Save</button>
              </div>
            </div>
          </form>

      </div>
      <div class="modal-footer">
      <button id="randomClerk" class="btn btn-danger">Randomize</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->