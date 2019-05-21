<?php
$page['title']		=	isset($page['title']) ? $page['title'] : 'Systemantech Payslip Utility Tool';
$page['subtitle']	=	isset($page['subtitle']) ? $page['subtitle'] : 'Powered by Lohica';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Payslip Utility Tool</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo SITEURL; ?>/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo SITEURL; ?>/assets/bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo SITEURL; ?>/assets/bower_components/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo SITEURL; ?>/assets/dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo SITEURL; ?>/assets/dist/css/skins/_all-skins.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
	<header class="main-header">
		<a href="<?php echo SITEURL; ?>" class="logo">
			<span class="logo-mini">SMTI</span>
			<span class="logo-lg">Payslip Utility Tool</span>
		</a>
		<nav class="navbar navbar-static-top">
			<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<li class="dropdown messages-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-envelope-o"></i>
						<span class="label label-success">4</span>
					</a>
					<ul class="dropdown-menu">
						<li class="header">You have 4 messages</li>
						<li>
						<ul class="menu">
							<li>
								<a href="#">
									<div class="pull-left">
										<img src="https://avatars.dicebear.com/v2/male/mmmaske.svg" class="img-circle" alt="User Image">
									</div>
									<h4>
										Support Team
										<small><i class="fa fa-clock-o"></i> 5 mins</small>
									</h4>
									<p>Why not buy a new awesome theme?</p>
								</a>
							</li>
						</ul>
						</li>
						<li class="footer"><a href="#">See All Messages</a></li>
					</ul>
					</li>
					<li class="dropdown notifications-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-bell-o"></i>
							<span class="label label-warning">10</span>
						</a>
						<ul class="dropdown-menu">
							<li class="header">You have 10 notifications</li>
							<li>
								<ul class="menu">
									<li>
										<a href="#">
											<i class="fa fa-users text-aqua"></i> 5 new members joined today
										</a>
									</li>
								</ul>
							</li>
							<li class="footer"><a href="#">View all</a></li>
						</ul>
					</li>
					<li class="dropdown tasks-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-flag-o"></i>
							<span class="label label-danger">9</span>
						</a>
						<ul class="dropdown-menu">
							<li class="header">You have 9 tasks</li>
							<li>
								<ul class="menu">
									<li>
									<a href="#">
										<h3>
											Design some buttons
											<small class="pull-right">20%</small>
										</h3>
										<div class="progress xs">
											<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
												<span class="sr-only">20% Complete</span>
											</div>
										</div>
									</a>
									</li>
								</ul>
							</li>
							<li class="footer">
								<a href="#">View all tasks</a>
							</li>
						</ul>
					</li>
					<li class="dropdown user user-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img src="https://avatars.dicebear.com/v2/male/mmmaske.svg" class="user-image" alt="User Image">
							<span class="hidden-xs">Alexander Pierce</span>
						</a>
						<ul class="dropdown-menu">
							<li class="user-header">
								<img src="https://avatars.dicebear.com/v2/male/mmmaske.svg" class="img-circle" alt="User Image">
								<p>
									Payroll Master - SMTI
								</p>
							</li>
							<li class="user-body">
								<div class="row">
									<div class="col-xs-4 text-center">
										<a href="#">Followers</a>
									</div>
									<div class="col-xs-4 text-center">
										<a href="#">Sales</a>
									</div>
									<div class="col-xs-4 text-center">
										<a href="#">Friends</a>
									</div>
								</div>
							</li>
							<li class="user-footer">
								<div class="pull-left">
									<a href="#" class="btn btn-default btn-flat">Profile</a>
								</div>
								<div class="pull-right">
									<a href="#" class="btn btn-default btn-flat">Sign out</a>
								</div>
							</li>
						</ul>
					</li>
					<li>
						<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
					</li>
				</ul>
			</div>
		</nav>
	</header>
	<aside class="main-sidebar">
		<section class="sidebar">
			<ul class="sidebar-menu" data-widget="tree">
				<li class="header">MAIN NAVIGATION</li>
				<li class="treeview">
					<a href="#">
						<i class="fa fa-dashboard"></i> <span>File Management</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li><a href="<?php echo HTTP_PATH; ?>/upload/payslips"><i class="fa fa-circle-o"></i> Upload Payslips</a></li>
						<li><a href="<?php echo HTTP_PATH; ?>/upload/reference"><i class="fa fa-circle-o"></i> Upload Reference File</a></li>
					</ul>
				</li>
			</ul>
		</section>
	</aside>
	<div class="content-wrapper">
		<section class="content-header">
			<h1>
			<?php echo $page['title']; ?>
			<small><?php echo $page['subtitle']; ?></small>
			</h1>
		</section>
		<section class="content">
			<?php include($viewfile); ?>
		</section>
	</div>
	<footer class="main-footer">
		<div class="pull-right hidden-xs">
			<b>Version</b> 0.1
		</div>
	</footer>
	<aside class="control-sidebar control-sidebar-dark">
		<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
			<li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
			<li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane" id="control-sidebar-home-tab">
				<h3 class="control-sidebar-heading">Recent Activity</h3>
				<ul class="control-sidebar-menu">
					<li>
						<a href="javascript:void(0)">
							<i class="menu-icon fa fa-birthday-cake bg-red"></i>
							<div class="menu-info">
								<h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
								<p>Will be 23 on April 24th</p>
							</div>
						</a>
					</li>
					<li>
						<a href="javascript:void(0)">
							<i class="menu-icon fa fa-user bg-yellow"></i>
							<div class="menu-info">
								<h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
								<p>New phone +1(800)555-1234</p>
							</div>
						</a>
					</li>
					<li>
						<a href="javascript:void(0)">
							<i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
							<div class="menu-info">
								<h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
								<p>nora@example.com</p>
							</div>
						</a>
					</li>
					<li>
						<a href="javascript:void(0)">
							<i class="menu-icon fa fa-file-code-o bg-green"></i>
							<div class="menu-info">
								<h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
								<p>Execution time 5 seconds</p>
							</div>
						</a>
					</li>
				</ul>
				<h3 class="control-sidebar-heading">Tasks Progress</h3>
				<ul class="control-sidebar-menu">
					<li>
						<a href="javascript:void(0)">
							<h4 class="control-sidebar-subheading">
								Custom Template Design
								<span class="label label-danger pull-right">70%</span>
							</h4>
							<div class="progress progress-xxs">
								<div class="progress-bar progress-bar-danger" style="width: 70%"></div>
							</div>
						</a>
					</li>
					<li>
						<a href="javascript:void(0)">
							<h4 class="control-sidebar-subheading">
								Update Resume
								<span class="label label-success pull-right">95%</span>
							</h4>
							<div class="progress progress-xxs">
								<div class="progress-bar progress-bar-success" style="width: 95%"></div>
							</div>
						</a>
					</li>
					<li>
						<a href="javascript:void(0)">
							<h4 class="control-sidebar-subheading">
								Laravel Integration
								<span class="label label-warning pull-right">50%</span>
							</h4>
							<div class="progress progress-xxs">
								<div class="progress-bar progress-bar-warning" style="width: 50%"></div>
							</div>
						</a>
					</li>
					<li>
					<a href="javascript:void(0)">
						<h4 class="control-sidebar-subheading">
							Back End Framework
							<span class="label label-primary pull-right">68%</span>
						</h4>
						<div class="progress progress-xxs">
							<div class="progress-bar progress-bar-primary" style="width: 68%"></div>
						</div>
					</a>
					</li>
				</ul>
			</div>
			<div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
			<div class="tab-pane" id="control-sidebar-settings-tab">
				<form method="post">
					<h3 class="control-sidebar-heading">General Settings</h3>
					<div class="form-group">
						<label class="control-sidebar-subheading">
							Report panel usage
							<input type="checkbox" class="pull-right" checked>
						</label>
						<p>
							Some information about this general settings option
						</p>
					</div>
					<div class="form-group">
						<label class="control-sidebar-subheading">
							Allow mail redirect
							<input type="checkbox" class="pull-right" checked>
						</label>
						<p>
							Other sets of options are available
						</p>
					</div>
					<div class="form-group">
						<label class="control-sidebar-subheading">
							Expose author name in posts
							<input type="checkbox" class="pull-right" checked>
						</label>
						<p>
							Allow the user to show his name in blog posts
						</p>
					</div>
					<h3 class="control-sidebar-heading">Chat Settings</h3>
					<div class="form-group">
						<label class="control-sidebar-subheading">
							Show me as online
							<input type="checkbox" class="pull-right" checked>
						</label>
					</div>
					<div class="form-group">
						<label class="control-sidebar-subheading">
							Turn off notifications
							<input type="checkbox" class="pull-right">
						</label>
					</div>
					<div class="form-group">
						<label class="control-sidebar-subheading">
							Delete chat history
							<a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
						</label>
					</div>
				</form>
			</div>
		</div>
	</aside>
	<div class="control-sidebar-bg"></div>
</div>
<script src="<?php echo SITEURL; ?>/assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo SITEURL; ?>/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo SITEURL; ?>/assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo SITEURL; ?>/assets/bower_components/fastclick/lib/fastclick.js"></script>
<script src="<?php echo SITEURL; ?>/assets/dist/js/adminlte.min.js"></script>
<script src="<?php echo SITEURL; ?>/assets/dist/js/demo.js"></script>
<script>
	$(document).ready(function () {
		$('.sidebar-menu').tree()
	})
</script>
</body>
</html>
