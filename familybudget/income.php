<?php include ('core/init.php'); ?>
<?php include ('includes/protect.php');
if(ISSET($_POST['add']) and ISSET($_POST['income']) and ISSET($_POST['date'])){
       $mydate = $_POST['date'];
        $month = $mydate[1];
		$year = $mydate[2];   
		$income = mysql_real_escape_string($_POST['income']);
		$month = mysql_real_escape_string($month);
		$year = mysql_real_escape_string($year);
		$userid = mysql_real_escape_string($_SESSION['user_id']);
		if ($income == 0 || $income == NULL)
		{
			$errors[] = 'Please enter appropriate income amount';
		}
		else if ($mydate == 0 || $mydate == NULL)
		{
			$errors[] = 'Please enter appropriate date';
		}
		else
		{
		$result = mysql_query("INSERT INTO income(income_id,user_id,date,income_amount) VALUES(NULL,'".$userid."','".$mydate."','".$income."')");
			if($result){ 
          echo "
            <script type=\"text/javascript\">
              window.location = 'http://codd.cs.montclair.edu/~hcigroup/cgi-bin/familybudget/income.php';
            </script>
               ";
}}
}
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
       <title>Budget Planner | Income</title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>		
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
						Income
					</h1>
				</section>
			</aside>
			
			<aside class="right-side" style="margin-right: 30px;">
	<div class="box box-warning" style="margin-top:15px; margin-left:15px; padding:20px;">
			<div class="nav-tabs-custom" id="ExpvsCat">		
			  <ul class="nav nav-tabs pull-right">
                                    <li><a href="#chart_pie" data-toggle="tab" >Add Income</a></li>      
                                   <li class="active"><a href="#chart_Column" data-toggle="tab" >View Income</a></li>
                                   <li class="pull-left header"><i class="fa fa-usd"></i></li>
                            </ul>
                            
                            
                            
                                <div class="tab-content no-padding">
                                    <!-- Morris chart - Sales -->
                                   <div class="chart tab-pane" id="chart_pie" style="position: relative;">
					<form method="POST" action="income.php" >
						<div class="box-body">
							<label>Income:</label>
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input class="form-control" type="text" placeholder="Income USD" name="income">
							</div>
							<br/>
							<label>Date:</label>
							<div class="input-group">             
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" id="datepicker" name="date" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
							</div>
                            <br/>
                            <button style="margin-top: 12px;" class="btn btn-primary" type="submit" name="add" value="add">Add</button>
					
					</form>	
	</div>
	</div>	
					
                           
<div class="chart tab-pane active" id="chart_Column" style="position: relative;">	

 <?php
    $userid=$_SESSION['user_id'];
 echo "<table class='table table-bordered'>";
 echo "<tbody><tr>";
 echo "<th style='width: 10px'>#</th>";
 echo "<th>Income Amount</th>";
 echo "<th style='width: 40px'>Date</th>";
// echo "<th style='width: 40px'></th>";
 echo "</tr>";
  $qur = "select * from income where user_id=$userid and income_amount <>0";
  //echo $qur;
                $sql_result = mysql_query($qur); 
                //echo $sql_query;
                if (($sql_result)||(mysql_errno($con))) 
                {   
                $result=mysql_query($qur);
                $rowrs=mysql_num_rows($result);
                //echo $rowrs+"This is row rs";
                If ($rowrs >0)
                {
                      $i=0;
                    while ($row = mysql_fetch_array($result))
                    {
                      
                        $inc = $row['income_amount'];
                        $date = $row['date'];
                        $i = $i + 1;
                       //echo $Category;
                        echo "<tr>\n";
                        echo "<td>$i</td>";
                        echo "<td>$ $inc</td>";
                        echo "<td>$date</td>";
                       // echo "<td><a href='http://codd.cs.montclair.edu/~hcigroup/cgi-bin/familybudget/dltct.php?cid=$cid'><span class='badge bg-red'>Delete</span></a></td>";
                        echo "</tr>";
                       
                    }
                }
                }
  echo "</tbody>";
  echo"</table>";
?>

</div>
</div>
				</div>
			</aside>
        </div>
	
  
	
		
		<!-- Include all the js stuff -->
        <?php include ('includes/jsLibrary.php') ?>
		<?php include('includes/showerrors.php') ?>
    </body>
</html>