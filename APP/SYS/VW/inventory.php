	<style type="text/css">
	 .ui-widget {
    z-index: 3000;
}
</style>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
				<button class="btn btn-lg btn-block btn-danger" data-toggle="modal" data-target="#modal-project"><h1><i class="fa fa-briefcase"></i></h1>Projects</button>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 ">
				<button class="btn btn-lg btn-block btn-danger" data-toggle="modal" data-target="#modal-stock"><h1><i class="fa fa-archive"></i></h1>Stocks</button>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 ">
				<button class="btn btn-lg btn-block btn-danger" data-toggle="modal" data-target="#modal-material"><h1><i class="fa fa-gavel"></i></h1>Items</button>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 ">
				<button class="btn btn-lg btn-block btn-danger" data-toggle="modal" data-target="#modal-print-report"><h1><i class="fa fa-bar-chart-o"></i></h1>Reports</button>
			</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<hr>
</div>
<div class="col-lg-6">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center">
	<div class="col-lg-12 thumbnail">
		<button class="btn btn-lg btn-block btn-primary disabled">
		<h1 id="stat-proj">3</h1>
		</button>
		<h4>Managed Projects</h4>
	</div>
</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center">
	<div class="col-lg-12 thumbnail">
		<button class="btn btn-lg btn-block btn-primary disabled">
		<h1 id="stat-stocks">3</h1>
		</button>
		<h4>Available Stocks</h4>
	</div>
</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center">
	<div class="col-lg-12 thumbnail">
		<button class="btn btn-lg btn-block btn-primary disabled">
		<h1 id="stat-items">3</h1>
		</button>
		<h4>Distinct Materials</h4>
	</div>
</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center">
	<div class="col-lg-12 thumbnail">
		<button class="btn btn-lg btn-block btn-primary disabled">
		<h1 id="stat-trans">3</h1>
		</button>
		<h4>Transactions Made</h4>
	</div>
</div>
</div>
<div class="col-lg-6">
	<canvas id="genChart4" class="center-block" width="500" height="300">Nothing to Display</canvas>
</div>
<script type="text/javascript" src="APP/RES/JS/inventory.js"> </script>