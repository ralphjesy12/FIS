
<div class="modal fade" id="modal-stock-new" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">New Inventory Transaction</h4>
      </div>
      <div class="modal-body overflow-scrollable" data-offset="220">
        <div class="row">
          <div class="col-lg-4">
        <div class="form-group">
            <label>Transaction Type</label>
            <select id="select-transaction" class="form-control">
              <option value="RECEIVE">Receive Stocks</option>
              <option value="ISSUE">Issue Stocks</option>
            </select>
          </div>
          </div>
          <div class="col-lg-4">
        <div class="form-group">
            <label>Project <small><a href="#modal-project-create" data-toggle="modal" class="text-muted">New</a></small></label>
            <select id="select-project" class="form-control"></select>
          </div>
          </div>
        	<div class="col-lg-4">
				<div class="form-group">
			      <label>Receiving Date</label>
			      <input id="input-receive-date" type="date" class="form-control" >
			    </div>
        	</div>
        </div>
        <div class="row">
        	<div class="col-lg-12">
        		<table id="table-stock-entry" class="table table-bordered table-hover table-responsive table-condensed">
        			<thead><th>DR#</th><th>Qty</th><th>Unit</th><th>Particulars</th><th>Supplier</th><th>Unit Price</th><th>Total Price</th><th width="100px">Action</th></thead>
        			<tbody>
        				<tr id="row-stock-add"><td colspan="8"><button class="btn btn-danger btn-xs col-lg-6 col-lg-offset-3" data-toggle="modal" data-target="#modal-stock-entry">Add Entry</button></td></tr>
        			</tbody>
		        </table>
        	</div>
        </div>
      </div>
        
      <div class="modal-footer">
        <button id="btn-stock-save" type="button" class="btn btn-primary" data-loading-text="Saving..." >Save Transaction</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->