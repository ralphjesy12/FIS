<div class="modal fade" id="modal-stock-edit" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit Receiving Stock Entry</h4>
      </div>
      <div class="modal-body overflow-scrollable" data-offset="220">
        <div class="row">
			<div class="form-group col-lg-6">
		      <label>Delivery Receipt # </label>
		      <input id="input-edit-drnum" type="text" class="form-control" placeholder="e.g. 502-1000">
		    </div>
			<div class="form-group col-lg-6">
					<label>Quantity </label>
					<div class="input-group">
					<input id="input-edit-quantity" type="number" class="form-control" value="1" min="1">
						<span id="text-edit-unit" class="input-group-addon">
							Unit
						</span>
					</div>
		    </div>
			<div class="form-group col-lg-6">
		      <label>Item  <small><a href="#modal-item-create" data-toggle="modal" class="text-muted">New</a></small></label>
		      <select id="select-edit-item" class="form-control"></select>
		    </div>
			<div class="form-group col-lg-6 ui-widget">
		      <label>Supplier</label>
		      <input id="input-edit-supplier" type="text" class="form-control" placeholder="e.g. Ace Hardware">
		    </div>
			<div class="form-group col-lg-6">
		      <label>Unit Price</label>
		      <input id="input-edit-unitprice" type="number" class="form-control" value="0.00" step="0.50" min="0.00">
		    </div>
			<div class="form-group col-lg-6">
		      <label>Total Price</label>
		      <input id="input-edit-totalprice" type="number" class="form-control" disabled="">
		    </div>
        </div>
      </div>
        
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="btn-stock-edit" data-row="0" type="button" class="btn btn-danger" data-loading-text="Saving..." >Save Entry</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->