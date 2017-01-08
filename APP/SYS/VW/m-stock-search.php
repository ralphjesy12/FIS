
<!-- Modal -->
<div class="modal fade" id="modal-stock-search" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Search Material</h4>
      </div>
      <div class="modal-body">
        <div class="row">
        	<div class="col-lg-12">
        		<form id="form-stock-search" class="input-group">
        			<input type="text" class="form-control" placeholder="Type a Name, Code, or Project ..." name="search-stock">
        			<input type="hidden" value="alpha-asc" name="sort">
        			<span class="input-group-btn">
        				<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-filter"></i>Sort by<i class="fa fa-fw fa-caret-down"></i></button>
				        <ul class="dropdown-menu pull-right">
				          <li><a href="#Inventory" class="sorter" data-sort="alpha-asc"><i class="fa fa-fw fa-sort-alpha-asc"></i>Name (Asc)</a></li>
				          <li><a href="#Inventory" class="sorter" data-sort="alpha-desc"><i class="fa fa-fw fa-sort-alpha-desc"></i>Name (Desc)</a></li>
				          <li class="divider"></li>
				          <li><a href="#Inventory" class="sorter" data-sort="amt-asc"><i class="fa fa-fw fa-sort-amount-asc"></i>Qty (Asc)</a></li>
				          <li><a href="#Inventory" class="sorter" data-sort="amt-desc"><i class="fa fa-fw fa-sort-amount-desc"></i>Qty (Desc)</a></li>
				        </ul>
        				<button type="submit" class="btn btn-danger"><i class="fa fa-search"></i></button>
        			</span>
        		</form>
        		<hr>
        		<table id="table-stock-search" class="table table-condensed table-bordered table-hover">
		        	<thead><th>Project</th><th>Code</th><th>Particulars</th><th>Qty</th><th></th></thead>
		        	<tbody></tbody>
		        </table>
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->