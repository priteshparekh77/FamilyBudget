<?php include ('core/database/connect.php'); ?>
<?php
session_start();
$_POST['username']=$_SESSION['username']; ?>
<?php
if(ISSET($_POST['username'])){

		$username = mysql_real_escape_string($_POST['username']);
	    $result = mysql_query("SELECT distinct u.user_firstname, u.user_lastname, u.user_name FROM user u, partners p 
             Inner Join partners On p.user_name='".$username."'
			 WHERE p.invitees = u.user_name");
    	     $num_of_rows = mysql_num_rows($result);
        if ($num_of_rows > 0) {
    		while ($rows = mysql_fetch_array($result)) {
				echo $rows['user_firstname'];
	    		 		$data[] = array('fname'=>$rows['user_firstname'], 'lname'=>$rows['user_lastname'], 'uname'=>$rows['user_name']);
    		}
		}else{
			$data[] = array('fname'=>"");
			}

}
$partnersdata = json_decode(json_encode($data));       



	

?>
<aside class="left-side sidebar-offcanvas">
    <?php include 'core/database/connect.php';?>
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="img/default.png" class="img-circle" alt="User Image" />
			</div>
			<div class="pull-left info">
				<p>Hello, <?php echo $user_data['user_firstname']; ?>!</p>
			</div>
		</div>

		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li class="active"> <!-- Right now the Dashboard is always active so I have to find a way to switch between the li -->
				<a href="index.php">
					<i class="fa fa-dashboard"></i> <span>Dashboard</span>
				</a>
			</li>
			<li>
				<a href="income.php">
					<i class="fa fa-usd"></i>
					<span>Income</span>
				</a>
			</li>
			<li>
				<a href="expense.php">
					<i class="fa fa-money"></i>
					<span>Expense</span>
				</a>
			</li>
			<li class="treeview">
				<a href="">
					<i class="fa fa-users"></i> 
					<span>Partners</span>
					<i class="fa fa-angle-right pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a style="font-weight: bold;" href="partner.php"><i class="fa fa-gear"></i> Explore</a></li>
  <?php 
for ($i = 0; $i < count($partnersdata); $i++){
echo '<li><a ><i class="fa fa-angle-double-right"></i> '.$partnersdata[$i]->fname.'</a></li>';
} ?>

				</ul>
			</li>
			<li class="treeview">
				<a href="">
					<i class="fa fa-th"></i> 
					<span>Categories</span>
					<i class="fa fa-angle-right pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a style="font-weight: bold;" href="category.php"><i class="fa fa-gear"></i> Explore</a></li>
					 <?php
                $qur = "select * from category where category_id<>7";
                $sql_result = mysql_query($qur); 
                //echo $sql_query;
                if (($sql_result)||(mysql_errno($con))) 
                {   
                $result=mysql_query($qur);
                $rowrs=mysql_num_rows($result);
                //echo $rowrs+"This is row rs";
                If ($rowrs >0)
                {
                     while ($row = mysql_fetch_array($result))
                    {
                        $Category = $row['category_name'];
                        echo "<li><a href='category.php?cat=1'><i class='fa fa-angle-double-right'></i>$Category</a></li>";
                    }
                }
                }
        ?>
				</ul>
			</li>
			<li class="treeview">
				<a href="">
					<i class="fa fa-bar-chart-o"></i>
					<span>Charts</span>
					<i class="fa fa-angle-right pull-right"></i>
				</a>
				<ul class="treeview-menu">
                                    <li><a href="CatExpChart.php" ><i class="fa fa-angle-double-right"></i>Category Vs Expense </a></li>
					<li><a href="MonExpChart.php"><i class="fa fa-angle-double-right"></i>Expense vs Month</a></li>
					<li><a href="IncMonChart.php"><i class="fa fa-angle-double-right"></i>Income vs Month</a></li>
				</ul>
			</li>
			<li>
				<a href="predict.php">
					<i class="fa fa-flag"></i>
					<span>Predict</span>
				</a>
			</li>
			<li>
				<a href="calendar.php">
					<i class="fa fa-calendar"></i> <span>Calendar</span>
					<small class="badge pull-right bg-red">0</small>
				</a>
			</li>
			<li>
				<a href="mailbox.php">
					<i class="fa fa-envelope"></i> <span>Mailbox</span>
					<small class="badge pull-right bg-yellow">0</small>
				</a>
			</li>
			<li>
				<a href="about.php">
					 <i class="fa fa-info-circle"></i>
					<span>About Us</span>
				</a>
			</li>
			<li>
				<a href="help.php">
					 <i class="fa fa-question-circle"></i>
					<span>Help</span>
				</a>
			</li>
		</ul>
	</section>

</aside>