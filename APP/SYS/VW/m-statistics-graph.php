
<!-- Modal -->
        
<div class="modal fade" id="modal-statistics-graph" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Project Statistics Graph</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-6">
          <h3>Monthly Material Count</h3> <canvas id="genChart3" class="center-block" width="500" height="300">Nothing to Display</canvas></div>
          <div class="col-lg-6">
          <h3>Monthly Material Cost</h3><canvas id="genChart2" class="center-block" width="500" height="300">Nothing to Display</canvas></div>
        </div>
        
        
        <table id="table-statistics" class="table table-hovered table-condensed table-bordered">
          <thead>
            <tr><th></th><th colspan="2"><span class="label label-success"><i class="fa fa-fw fa-truck"></i>Stocks Received</span></th><th colspan="2"><span class="label label-danger"><i class="fa fa-fw fa-share-square-o"></i>Stocks Issued</span></th><th colspan="2"><span class="label label-primary"><i class="fa fa-fw fa-gift "></i>Remaining Balance</span></th></tr>
              <tr><th></th><th>Quantity</th><th>Amount</th><th>Quantity</th><th>Amount</th><th>Quantity</th><th>Amount</th></tr>
            </thead>
          <tbody>
            
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->