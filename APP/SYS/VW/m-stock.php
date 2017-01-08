<!-- Modal -->
<div class="modal fade" id="modal-stock" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Stocks</h4>
      </div>
      <div class="modal-body">
      <div class="row" style="margin:10px 0px;">
      <div class="col-lg-3">
        <button class="btn btn-danger btn-block" data-toggle="modal" data-target="#modal-stock-new"><i class="fa fa-plus"></i> New Transaction</button>
      </div>
      <div class="col-lg-9">
        <div class="btn-toolbar" role="toolbar">
          <div class="btn-group">
            <button class="btn btn-danger" data-toggle="modal" data-target="#modal-stock-search"><i class="fa fa-fw fa-search"></i>Search Material</button>
            <button class="btn btn-danger" data-toggle="modal" data-target="#modal-stock-filterdate"><i class="fa fa-fw fa-calendar"></i>Filter by Date</button>
          </div>
          <div class="btn-group">
            <button id="btn-save" class="btn btn-danger"><i class="fa fa-fw fa-floppy-o"></i>Save as</button>
            <button id="btn-print-preview" class="btn btn-danger"><i class="fa fa-fw fa-print"></i>Print Preview</button>
          </div>
          <div class="btn-group">
            <button id="usage-graph" data-toggle="modal" data-target="#modal-usage-graph" class="btn btn-danger"><i class="fa fa-fw fa-bar-chart-o"></i>Usage Graph</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row" style="margin:10px 0px;">
        <div class="col-lg-3">
          <div class="input-group">
            <span class="input-group-addon">
              Project
            </span>
            <select id="select-project-2" class="form-control">
              <option>Choose one...</option>
            </select>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="input-group">
            <span class="input-group-addon">
              Material
            </span>
            <select id="list-item" class="form-control">
              <option>Choose one...</option>
            </select>
          </div>
        </div>
    </div>
    <div class="table-responsive " style="margin:10px 0px;">
          <table id="table-stock-info" class="table table-condensed table-bordered table-hover">
            <thead><th>Date</th><th>Supplier</th><th>RIR #</th><th>Qty</th><th>Unit Cost</th><th>Total Cost</th><th>Recipient</th><th>RIS #</th><th>Qty</th><th>Unit Cost</th><th>Total Cost</th><th> Action </th></thead>
            <tbody></tbody>
            <tfoot style="font-weight:bold">
              <tr><td>Total</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
            </tfoot>
          </table>
      </div>
      <div class="table-responsive " style="margin:10px 0px;">
          <table id="table-stock-total" class="table table-responsive table-condensed table-bordered table-hover">
            <thead class="text-center">
              <tr><th colspan="2"><i class="fa fa-fw fa-truck"></i>Received</th><th colspan="2"><i class="fa fa-fw fa-share-square-o"></i>Issued</th><th colspan="2"><i class="fa fa-fw fa-gift "></i>Balance</th></tr>
              <tr><th>Qty</th><th>Amt</th><th>Qty</th><th>Amt</th><th>Qty</th><th>Amt</th></tr>
            </thead>
            <tbody>

            </tbody>
          </table>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
