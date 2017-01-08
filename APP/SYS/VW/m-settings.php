
<!-- Modal -->
<div class="modal fade" id="modal-settings" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Settings</h4>
      </div>
      <div class="modal-body">
        
          <div class="row">
            <div class="col-lg-12">
              <form id="form-account" class="form-horizontal" role="form">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                  <div class="col-sm-10">
                    <input name="un" type="text" class="form-control" placeholder="Username" value="<?php echo $_SESSION["u"];?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-10">
                    <input name="pw" type="password" class="form-control" placeholder="Password" value="1234567890">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Save</button>
                  </div>
                </div>
              </form>
            </div>
              
              <?php if($_SESSION["l"]=="ADMIN"){
                echo '<div class="col-lg-12">
                <hr>
              </div>
              <div class="col-lg-12">
                <h4>Clerks&nbsp;<small><a class="text-muted" href="#modal-new-clerk" data-toggle="modal">New</a></small></h4>
                <table class="table table-hover table-bordered table-condensed">
                  <thead><th>Username</th><th>Password</th></thead>
                  <tbody id="clerks"></tbody>
                </table>
              </div>
              <div class="col-lg-12"><button class="btn btn-danger" data-target="#modal-logs" data-toggle="modal">View Logs</button></div>';
                }?>

          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->