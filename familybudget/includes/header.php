<header class="header">
	<?php 
	function getregdate(){
	 $userid=$_SESSION['user_id'];
$result = mysql_query("SELECT user_regdate FROM user where user_id='".$userid."'");
$num_of_rows = mysql_num_rows($result);

if ($num_of_rows == 1) {
$rows = mysql_fetch_array($result);
	$user_regdate1 = $rows['user_regdate'];
}
return $user_regdate1;
}
?>
	<a href="./index.php" class="logo">
		<!-- Add the class icon to your logo image or logo icon to add the margining -->
		Budget Planner
	</a>
	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top" role="navigation">
		<!-- Sidebar toggle button-->
		<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</a>
		<div class="navbar-right">
			<ul class="nav navbar-nav">
				<!-- Messages: style can be found in dropdown.less-->
				<li class="dropdown messages-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-envelope"></i>
					</a>
				</li>
				<!-- Notifications: style can be found in dropdown.less -->
				<li class="dropdown notifications-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-warning"></i>
					</a>
				</li>
				<!-- User Account: style can be found in dropdown.less -->
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="glyphicon glyphicon-user"></i>
						<span><?php echo $user_data['user_firstname']; ?> <i class="caret"></i></span>
					</a>
					<ul class="dropdown-menu">
						<!-- User image -->
						<li class="user-header bg-light-blue">
							<img src="img/default.png" class="img-circle" alt="User Image" />
							<p>
								<?php echo $user_data['user_firstname'] . ' ' . $user_data['user_lastname'] ; ?>
								<small><? if (getregdate()!=""){echo "Member since"." ".getregdate();} ?></small>
							</p>
						</li>
						<!-- Menu Footer-->
						<li class="user-footer">
							<div class="pull-left">
								<a href="profile.php" class="btn btn-default btn-flat">Profile</a>
							</div>
							<div class="pull-right">
								<a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>