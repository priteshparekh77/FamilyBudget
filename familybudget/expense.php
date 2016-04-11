<?php include ('core/init.php'); ?>
<?php include ('includes/protect.php'); ?>
<?php $userid=$_SESSION['user_id'];?>
<!DOCTYPE html>
<html>
    <head>
     <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>
  <script name="javascript">
    function lbox(id)
    {
    	if(id == 7) 
    	{
        	document.getElementById('cstcate').style.display = 'block';
    	} 
    	else
    	 {
        	document.getElementById('cstcate').style.display = 'none';
    	}
}
</script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>

<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jQuery.Validate/1.6/jQuery.Validate.min.js"></script>
<script type="text/javascript">
   $(document).ready(function() {
   $("#theForm").validate();
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
						Expense
					</h1>
				</section>
			</aside>
			
			<aside class="right-side">
  <?php
 if (isset($_POST["ispost"])) 
            { 
                   
 		   $Expense = $_POST["expense"];
 		    $descr = $_POST["descr"];
                   $date = $_POST["date"];
                  //echo $date;
                    $categoryid = $_POST["category"];
                    $cstcategory=$_POST["cst_category"];
                   if($Expense ==0 || $Expense==NULL )
			{
				$errors[] = 'Please enter appropriate expense amount';
				//break;
				?>
				
				<?php
			}
			else if ($categoryid=="" ||$categoryid==0)
			{
				$errors[] = 'Please select category';
			}
			
			else if ($categoryid==7 && $cstcategory==0)
			{
				$errors[] = 'Please select custom category';
			}
			
			else if ($descr==NULL)
			{
				$errors[] = 'Please enter description';
			}
			
			else if ($date=="" ||$date==0)
			{
				$errors[] = 'Please select date';
			}
			else
			{
	                   
	                    $sqlqur2 = "Insert into expense(user_id,cst_category_id,category_id,expense_amount,expense_date,expense_description) values"
	                            . " ('$userid','$cstcategory','$categoryid','$Expense','$date','$descr')";
	                    if (!mysql_query($sqlqur2))
	                    {
	                  	  die('Error: ' . mysql_error($con));
	                    }?>
	                    <script type="text/javascript">
	            			window.location.href = "http://codd.cs.montclair.edu/~hcigroup/cgi-bin/familybudget/expense.php"
	        	      </script> 
	               <?php }}
	             
             ?>
 <div class="box box-warning" style="margin-top:15px;width: 1030px; margin-left: 15px; padding:20px;">
		<div class="box-header">
				<h3 class="box-title"></h3>
		</div>
        <div class="nav-tabs-custom" id="ExpvsCat">
                                <ul class="nav nav-tabs pull-right">
                                    <li><a href="#chart_pie" data-toggle="tab" >Add Expense</a></li>      
                                    
                                    <li class="active"><a href="#chart_Column" data-toggle="tab" >View/Edit/Delete Expense</a></li>
                                   
                                    <li class="pull-left header"><i class="fa fa-money"></i></li>
                                </ul>
                                <div class="tab-content no-padding">
                                    <!-- Morris chart - Sales -->
                                   <div class="chart tab-pane" id="chart_pie" style="position: relative;">
                                   
                                   <form action="expense.php" method="post" >
			<input type="hidden" name="ispost" value="1"/>
			
				<div class="">
					<div class="box-header">
					<h3 class="box-title">Add an Expense</h3>
					</div>
					<div class="box-body">
						<label>Expense:</label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-usd"></i>
							</div>
							<input  name="expense"type="text"class="form-control">
						</div>
						<br />
						<div class="form-group">
							<label>Categories:</label>
							<?php
							 $sql5 = "SELECT * FROM category";
									$result3 = mysql_query($sql5);
									
									echo'<select name="category"  class="form-control" onchange="lbox(this.value)">';
									 echo '<option value="0">'.'Select your category'.'</option>';
									while($row = mysql_fetch_array( $result3 )) 
									{ 
										echo $row['category_name'];
									   
										echo '<option value="'.$row["category_id"].'">' . $row["category_name"] . '</option>';   
									}
									echo '</select>';
							?>
						</div>
						<div class="form-group" style="display: none;" id="cstcate">
							<label>Custom Categories:</label>
							<?php
							 $sql5 = "SELECT * FROM cst_category where user_id=$userid";
									$result3 = mysql_query($sql5);
									
									echo'<select name="cst_category"  class="form-control">';
									 echo '<option value="0">'.'Select your custom category'.'</option>';
									while($row = mysql_fetch_array( $result3 )) 
									{ 
										echo $row['cst_category_name'];
										echo '<option value="'.$row["cst_category_id"].'">' . $row["cst_category_name"] . '</option>';   
									}
									echo '</select>';
							?>
						</div>
						<!--
						 <div class="form-group">
							<label>Financial Year:</label>
							<?php
							 $sql5 = "SELECT * FROM financial_year";
									$result3 = mysql_query($sql5);
									
									echo'<select name="finyear"  class="form-control">';
									while($row = mysql_fetch_array( $result3 )) 
									{ 
									   // echo $row['Category_Name'];
										echo '<option value="'.$row["financial_id"].'">' . $row["financial_year"] . '</option>';   
									}
									echo '</select>';
							?>
						</div>
						 <div class="form-group">
							<label>Month:</label>
							<?php
							 $sql5 = "SELECT * FROM month";
									$result3 = mysql_query($sql5);
									
									echo'<select name="month"  class="form-control">';
									while($row = mysql_fetch_array( $result3 )) 
									{ 
										//echo $row['Category_Name'];
										echo '<option value="'.$row["month_id"].'">' . $row["month_title"] . '</option>';   
									}
									echo '</select>';
							?>
						</div>-->
						<div class="form-group">
							<label>Description:</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-file-text-o"></i>
								</div>
								<input name="descr"type="text"class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label>Date:</label>				
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" id="datepicker" name="date" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
								</div>
						</div>
						<button style="margin-top: 12px;" class="btn btn-primary" type="submit">Add</button>
					</div>
				</div>
		</form>
                                   </div>
                   
                                    
                                     <div class="chart tab-pane active" id="chart_Column" style="position: relative;">
									 				<div class="">
													
                                     <?php
 echo "<table class='table table-bordered'>";
 echo "<tbody><tr>";
 echo "<th style='width: 10px'>#</th>";
 echo "<th>Category</th>";
  echo "<th>Amount</th>";
   echo "<th>Date</th>";
   echo "<th>Description</th>";
   
 echo "<th style='width: 40px'></th>";
 echo "<th style='width: 40px'></th>";
 echo "</tr>";
  $qur = "SELECT cst_category_name as name, expense_amount,expense_date,expense_description,expense_id
				FROM expense
				INNER JOIN cst_category ON cst_category.cst_category_id = expense.cst_category_id
				WHERE expense.user_id =$userid
				UNION ALL 
				SELECT category_name as name, expense_amount,expense_date,expense_description,expense_id
				FROM expense
				INNER JOIN category ON category.category_id = expense.category_id
				WHERE expense.user_id =$userid
				AND expense.category_id <>7";
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
                      
			$expid= $row['expense_id'];                       
                        $Category = $row['name'];
                        $date = $row['expense_date'];
                        $expense = $row['expense_amount'];
                        $descr=$row['expense_description'];
                        $i = $i + 1;
                       //echo $Category;
                        echo "<tr>\n";
                        echo "<td>$i</td>";
                        echo "<td>$Category</td>";
                        echo "<td>$ $expense</td>";
                        echo "<td>$date</td>";
                        echo "<td>$descr</td>";
                        echo "<td><a href='http://codd.cs.montclair.edu/~hcigroup/cgi-bin/familybudget/edtexp.php?eid=$expid'><span class='badge bg-blue'>Edit</span></a></td>";
                      echo "<td><a href='http://codd.cs.montclair.edu/~hcigroup/cgi-bin/familybudget/dltexp.php?eid=$expid'><span class='badge bg-red'>Delete</span></a></td>";
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
							</div>
                            <div id="chart_Column">
		
		</div>
	</aside>
</div>
                          
		
		<!-- Include all the js stuff -->
        <?php include ('includes/jsLibrary.php') ?>
		<?php include('includes/showerrors.php') ?> 
    </body>
</html>