<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Wargame.kr - 2.1</title>

	<!-- Core CSS - Include with every page -->
	<link href="/static/css/bootstrap.min.css" rel="stylesheet">
	<link href="/static/font-awesome/css/font-awesome.css" rel="stylesheet">

	<!-- Page-Level Plugin CSS - Blank -->
    <script src="/static/js/jquery-9991.10.2.js"></script>
	<script src="/static/js/custom/user.js"></script>
	<script src="/static/js/custom/chat.js"></script>

	<!-- SB Admin CSS - Include with every page -->
	<link href="/static/css/sb-admin.css" rel="stylesheet">

	<style>
		.sidebar-logged-info {padding:15px;}
		.sidebar-logged-info div.btn-group{margin-top:10px;}
		.custom-alert {position: absolute; z-index: 1090;}
		img.achievement_img {width:150px; height:150px; margin:10px auto; border:1px solid gray;}
		div.panel-default>div.panel-body {height:500px;}
		ul.chat .left .chat-body {margin-left:5px;}
		ul.chat .left .chat-body p {margin-left:10px;}
	</style>
	<script>
		var is_logged_in = <?php if(is_logged_in()) echo 'true'; else echo 'false';?>;
	</script>

</head>

<body>

	<div id="wrapper">

		<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/">Wargame.kr v2.1</a>
			</div>
			<!-- /.navbar-header -->

			<ul class="nav navbar-top-links navbar-right">
				<!-- /.dropdown -->
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-wechat fa-fw"></i>  <i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-chat" style="min-width:600px; padding:10px;">
						<li>

							<?php if ($page != "main") : ?>

									<div class="chat-panel panel panel-default">
										<div class="panel-heading">
											<i class="fa fa-comments fa-fw"></i> Chat
										</div>
										<div class="panel-body">
											<ul class="chat"></ul>
										</div>
										<div class="panel-footer">
											<div class="input-group">
												<input id="btn-input" maxlength="120" type="text" class="form-control input-sm" placeholder="Type your message here..." />
												<span class="input-group-btn">
													<button class="btn btn-warning btn-sm" id="btn-chat"> Send </button>
												</span>
											</div>
										</div>
									</div>

								<?php else: ?>

									<div class="text-center">
										<strong>Not allowed in Main page</strong>
									</div>

								<?php endif; ?>

						</li>
					</ul>
					<!-- /.dropdown-tasks -->
				</li>
				<!-- /.dropdown -->

				<?php if(is_logged_in()) : ?>

				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-user">
						<li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
						</li>
						<li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
						</li>
						<li class="divider"></li>
						<li><a href="/user/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
						</li>
					</ul>
					<!-- /.dropdown-user -->
				</li>
				<!-- /.dropdown -->

				<?php endif; ?>

			</ul>
			<!-- /.navbar-top-links -->

			<div class="navbar-default navbar-static-side" role="navigation">
				<div class="sidebar-collapse">
					<ul class="nav" id="side-menu">
						<li class="sidebar-logged-info">
							
							<?php if(!is_logged_in()) : ?>

							<div>
								<img class="img-responsive center-block achievement_img" src="/static/img/achievement/guest.jpg">
							</div>
							<div class="text-center">
								<div id="login_text">
									<p>{not logged on}</p>
								</div>
								<div class="btn-group btn-group-sm btn-group-justified">
									<a href="#login" class="btn btn-default">Login</a>
									<a href="#join" class="btn btn-default">Join</a>
								</div>
							</div>
							<!-- /logged-group -->

							<?php else: ?>

							<div>
								<img class="img-responsive center-block achievement_img" src="/static/img/achievement/<?=preg_replace('/ /i', '_', $this->session->userdata('achievement'))?>.jpg">
							</div>
							<div class="text-center">
								<div>
									<p class="lead"><?=$this->session->userdata('name')?>
									<small>(<?=$this->session->userdata('point');?>p)</small></p>
								</div>
							</div>
							<!-- /logged-group -->

							<?php endif;?>

						</li>
						<li>
							<a href="/main"><i class="fa fa-wechat fa-fw"></i> Main</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-graduation-cap fa-fw"></i> Tutorial<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li>
									<a href="/tutorial/web">Web</a>
								</li>
								<li>
									<a href="/tutorial/system">System</a>
								</li>
							</ul>
							<!-- /.nav-second-level -->
						</li>
						<li>
							<a href="#"><i class="fa fa-gamepad fa-fw"></i> Wargame<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li>
									<a href="/challenge">Challenge</a>
								</li>
								<li>
									<a href="/rank">Rank</a>
								</li>
							</ul>
							<!-- /.nav-second-level -->
						</li>
						<li>
							<a href="/achievement"><i class="fa fa-star-half-full fa-fw"></i> Achievement</a>
						</li>
						<li>
							<a href="/board"><i class="fa fa-beer fa-fw"></i> Free Board</a>
						</li>
						<li>
							<a href="/magazine"><i class="fa fa-bookmark fa-fw"></i> Magazine</a>
						</li>
						<li>
							<a href="/favorites"><i class="fa fa-thumbs-o-up fa-fw"></i> Favorites</a>
						</li>
						<li>
							<a href="/about"><i class="fa fa-question-circle fa-fw"></i> About</a>
						</li>
					</ul>
					<!-- /#side-menu -->
				</div>
				<!-- /.sidebar-collapse -->
			</div>
			<!-- /.navbar-static-side -->
		</nav>

		<div id="page-wrapper">
