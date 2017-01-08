<?php
    session_start();
    if(!isset($_SESSION['u'])) header('Location:login');
?>
<link rel="stylesheet" type="text/css" href="APP/RES/CSS/home.css">
<div id="wrapper">
  <div id="sidebar-wrapper" class="hidden-xs">
    <ul id="sidebar_menu" class="sidebar-nav pull-right">
      <li class="sidebar-brand"><a id="menu-toggle" href="#">Menu<span id="main_icon" class="glyphicon glyphicon glyphicon-fire"></span></a></li>
    </ul>
    <ul class="sidebar-nav pull-right" id="sidebar">
      <!-- <li><a href="#Dashboard" class="active scroll">Dashboard<span class="sub_icon glyphicon glyphicon-tasks"></span></a></li> -->
      <!-- <li><a href="#Inventory">Inventory<span class="sub_icon glyphicon glyphicon-briefcase"></span></a></li> -->
      <li><a href="#modal-project" data-toggle="modal" title="Project">Project<span class="sub_icon fa fa-briefcase"></span></a></li>
      <li><a href="#modal-stock" data-toggle="modal" title="Stocks">Stocks<span class="sub_icon fa fa-archive"></span></a></li>
      <li><a href="#modal-material" data-toggle="modal" title="Items">Items<span class="sub_icon fa fa-gavel"></span></a></li>
      <li><a href="#modal-print-report" data-toggle="modal" title="Reports">Reports<span class="sub_icon fa fa-bar-chart-o"></span></a></li>
      <li><a href="#modal-settings" data-toggle="modal" title="Settings">Settings<span class="sub_icon glyphicon glyphicon-cog"></span></a></li>
    </ul>
  </div>
  <div id="page-content-wrapper">
    <div class="page-content inset">
      <div class="navbar-wrapper">
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span><span
            class="icon-bar"></span><span class="icon-bar"></span>
            </button>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
            <li class="text-right"><a href="#"><?php echo APP_NAME;?></a></li>
              <li class="dropdown text-right"><a href="#" data-toggle="dropdown">Account
                <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li>
                    <div class="navbar-content">
                      <div class="row">
                        <div class="col-lg-5  col-md-5   col-sm-5  col-xs-5   ">
                          <img src=<?php echo '"APP/RES/IMG/'.$_SESSION["l"].'.png"';?>
                          alt="User Photo" class="profile-img" />
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 ">
                          <strong>Signed in as <?php echo $_SESSION["u"]?></strong>
                          <p class="text-muted small"><?php echo $_SESSION["l"]?></p>
                        </div>
                      </div>
                    </div>
                    <div class="navbar-footer">
                      <div class="navbar-footer-content">
                        <div class="row">
                          <div class="col-lg-6 col-lg-offset-6">
                          <button id="btn-signout" class="btn btn-danger btn-sm pull-right">Sign Out</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
        </div>

      <div style="padding:10px;padding-top:60px;">
        <div id="Inventory" class="panel panel-default panel-main">
          <div class="panel-heading">
            <h3 class="panel-title"><?php echo APP_NAME;?></h3>
          </div>
          <div class="panel-body">
            <?php include 'inventory.php';?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php
  include 'm-project.php';
  include 'm-stock.php';
  include 'm-stock-material.php';
  include 'm-print-report.php';
  include 'm-settings.php';
  include 'm-logs.php';

  include 'm-new-clerk.php';
  include 'm-item-create.php';
  include 'm-item-edit.php';
  include 'm-project-create.php';
  include 'm-stock-entry.php';
  include 'm-stock-edit.php';
  include 'm-stock-new.php';
  include 'm-usage-graph.php';
  include 'm-stock-search.php';
  include 'm-stock-filterdate.php';
  include 'm-statistics-graph.php';
?>

<script type="text/javascript" src="APP/RES/JS/home.js"></script>