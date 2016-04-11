<?php include ('core/init.php'); ?>
<?php include ('includes/protect.php'); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
		
       <title>Budget Planner | Help</title>
		
        <!-- Include all the css stuff -->
		<?php include ('includes/cssLibrary.php') ?>
		
    </head>
	
    <body class="skin-blue">
		
		<!-- Include header -->
        <?php include ('includes/header.php') ?>
		
        <div class="wrapper row-offcanvas row-offcanvas-left">
		
            <!-- Include side bar -->
            <?php include ('includes/sidebar.php') ?>
			
            <aside class="right-side">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						Help
					</h1>
				</section>
			</aside>
			
			<aside class="right-side">
				<div class="col-md-5" style="padding-top:15px; padding-right: 0px; right:-5px;">	
					<div class="box box-warning">
						<div class="box-body">
                        <a href="http://codd.cs.montclair.edu/~hcigroup/cgi-bin/familybudget/help.php?helpaddcategories=yes">How to Add a Category.</a><br/>
                            <a href="http://codd.cs.montclair.edu/~hcigroup/cgi-bin/familybudget/help.php?helpaddexpenses=yes">How to add an Expense.</a><br/>
                            <a href="http://codd.cs.montclair.edu/~hcigroup/cgi-bin/familybudget/help.php?helpaddpartner=yes">How to Add a Partner.</a><br/>
						<!--	<a href="#">How to Add a Chart.</a><br/>
							<a href="#">How to Predict.</a><br/>
							<a href="#">How to Change your Profile.</a><br/>
							<a href="#">How to Add an Event.</a><br/>
							<a href="#">How to Check a Received Event.</a><br/>
							<a href="#">How to Check Calendar Notifications.</a><br/>
							<a href="#">How to Add an Event.</a><br/>
							<a href="#">How to Send an Email to your Partner(s).</a><br/>
							<a href="#">Searching Tool.</a><br/>-->
						</div>
					</div>
				</div>
				<div align="center" class="col-md-7" style="padding-top:15px; padding-left: 0px; height:100%; right:5px;">
					<div class="box box-warning">
						<div class="box-body">
							<div class="timeline-item">
								<div class="timeline-body">
						
                            <?php
							if(ISSET($_GET[helpaddpartner])){
								
								echo "<iframe width='560' height='315' src='//www.youtube.com/embed/-TZgXEE75BM' frameborder='0' allowfullscreen></iframe>";}
							
						else if(ISSET($_GET[helpaddcategories])){
								echo "<iframe width='560' height='315' src='//www.youtube.com/embed/pLvZ7ecUgeA' frameborder='0' allowfullscreen></iframe>";}
						else if(ISSET($_GET[helpaddexpenses])){
								echo "<iframe width='560' height='315' src='//www.youtube.com/embed/tZToNzipkQY' frameborder='0' allowfullscreen></iframe>";}
						else{echo "<iframe width='560' height='315' src='//www.youtube.com/embed/tZToNzipkQY' frameborder='0' allowfullscreen></iframe>";}
                         
						  ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</aside>
        </div>
		
		
		<!-- Include all the js stuff -->
        <?php include ('includes/jsLibrary.php') ?>
		
    </body>
</html>
<script>
	$('.box-body').height($(window).height() - $('#header').height());
</script>