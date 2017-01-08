<div class="modal fade" id="modal-item-create" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-fw fa-plus"></i> New Item Entry</h4>
      </div>
      <div class="modal-body overflow-scrollable" data-offset="220">
        <div class="row">
			<div class="form-group col-lg-6">
		      <label>Name</label>
		      <div class="input-group">
		      	<span class="input-group-addon"><i class="fa fa-fw fa-archive"></i></span>
		      	<input id="input-item-name" type="text" class="form-control" placeholder="e.g. Plywood" autofocus="autofocus">
		      </div>
		    </div>
			<div class="form-group col-lg-6">
		      <label>Code</label>
		      <div class="input-group">
		      	<span class="input-group-addon"><i class="fa fa-fw fa-qrcode"></i></span>
		      	<input id="input-item-code" type="text" class="form-control" placeholder="e.g. 502-10004" maxlength="12">
		      </div>
		    </div>
			<div class="form-group col-lg-12">
		      <label>Particulars <small>( Size, Type , Category )</small></label>
		      <div class="input-group">
		      	<span class="input-group-addon"><i class="fa fa-fw fa-file-text-o"></i></span>
		      	<input id="input-item-desc" type="text" class="form-control" placeholder="e.g. 0.5 x 4 x 8">
		      </div>
		    </div>
			<div class="form-group col-lg-6">
		      <label>Unit Price</label>
		      <div class="input-group">
		      	<span class="input-group-addon"><i class="fa fa-fw fa-rub "></i></span>
		      	<input id="input-item-price" type="number" class="form-control" value="0.00" min="0.00" step="0.50">
		      </div>
		    </div>
			<div class="form-group col-lg-6">
		      <label>Unit</label>
		      <div class="input-group">
		      	<span class="input-group-addon"><i class="fa fa-fw fa-certificate"></i></span>
		      	<input id="input-item-unit" type="text" class="form-control" placeholder="e.g. grams">
		      </div>
		    </div>
        </div>
      </div>
        
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="btn-item-create" type="button" data-loading-text="Adding.." class="btn btn-danger" >Add Item</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->