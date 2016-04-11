<?php include ('core/init.php'); ?>
<?php include ('includes/protect.php'); ?>
<?php $userid=$_SESSION['user_id'];?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Budget Planner | Dashboard</title>
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
                        <section class="content-header">
                                <h1>Dashboard</h1>
                        </section>
                </aside>
<aside class="right-side">
        <div class="row"
                style="margin-left: 0px; margin-right: 0px; margin-top: 15px">
                <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-yellow">
                                <div class="inner">
                                        <h3>
<?php 
function getuserid($owner){
$result = mysql_query("SELECT user_name FROM user where user_id='".$owner."'");
$num_of_rows = mysql_num_rows($result);

if ($num_of_rows == 1) {
$rows = mysql_fetch_array($result);
	$owner1 = $rows['user_name'];
}
return $owner1;
}
$username = mysql_real_escape_string(getuserid($userid));
	    $result = mysql_query("SELECT invitees FROM partners WHERE user_name ='".$username."'");
    	     $num_of_rows = mysql_num_rows($result);
			 echo $num_of_rows;

                                        ?>
</h3>
                                        <p>Partners</p>
                                </div>
                                <div class="icon">
                                        <i class="ion ion-person-add"></i>
                                </div>
                                <a class="small-box-footer" href="http://codd.cs.montclair.edu/~hcigroup/cgi-bin/familybudget/partner.php"> Explore <i
                                        class="fa fa-arrow-circle-right"></i>
                                </a>
                        </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-aqua">
                                <div class="inner">
                                        <h3><?php 
                                        $qur = "SELECT (SELECT COUNT(*) FROM category where category_id <>7 )+ (SELECT COUNT(*) from cst_category WHERE user_id = $userid ) AS SumCount";
                                         $result1=mysql_query($qur);
                                        $row = mysql_fetch_array($result1);
                                        $totalCategory = $row['SumCount'];
                                        echo $totalCategory;
                                        ?></h3>
                                        <p>Categories</p>
                                </div>
                                <div class="icon">
                                        <i class="ion ion-bag"></i>
                                </div>
                                <a class="small-box-footer" href="category.php"> Explore <i
                                        class="fa fa-arrow-circle-right"></i>
                                </a>
                        </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-green">
                                <div class="inner">
                                        <h3>3</h3>
                                        <p>Charts</p>
                                </div>
                                <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                </div>
                                <a class="small-box-footer">
                                      &nbsp;
                                </a>
                                
                        </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-red">
                                <div class="inner">
                                        <h3>&nbsp;</h3>
                                        <p>Predict</p>
                                </div>
                                <div class="icon">
                                        <i class="ion ion-arrow-graph-up-right"></i>
                                </div>
                                <a href="#" class="small-box-footer"> Go <i
                                        class="fa fa-arrow-circle-right"></i>
                                </a>
                        </div>
                </div>
        </div>

<div class="col-md-6">
    <div class="box">
		<div class="box-header">
        	<h3 class="box-title">Expenses in Each Category</h3>
		</div>
       
       <div class='box-body'>
                 <?php
                 
                echo "<TABLE class='table table-bordered'>\n";
                echo "<TBODY>\n";
                echo "<tr>\n";
                echo "<th style='width: 10px'>#</th>\n";
                echo "<th>Category</th>\n";
                echo "<th>Amount</th>\n";
                echo "<th>Percentage</th>\n";
                echo "<th style='width: 40px'></th>\n";
                echo "</tr>\n";
                $query2 = "select sum(expense_amount)as TotalSum from expense where user_id=$userid";
                //echo $query2;
                $result2=mysql_query($query2);
                $row = mysql_fetch_array($result2);
                $TotalExp = $row['TotalSum'];
               // echo $TotalExp;
                
                
                /*$qur = "SELECT category_name, expense_amount, SUM(expense_amount)as TotalExp FROM expense
                        inner join category on
                        category.category_id=expense.category_id where expense.user_id=$userid
                     GROUP BY expense.category_id";*/
                       $qur = "SELECT cst_category_name as name, expense_amount
				FROM expense
				INNER JOIN cst_category ON cst_category.cst_category_id = expense.cst_category_id
				WHERE expense.user_id =$userid
				UNION ALL 
				SELECT category_name as name, expense_amount
				FROM expense
				INNER JOIN category ON category.category_id = expense.category_id
				WHERE expense.user_id =$userid
				AND expense.category_id <>7";                   
                                      
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
                    $color=array("green","blue","yellow","green","blue","yellow");	
                    $i=0;
                    $j=0;
                    while ($row = mysql_fetch_array($result))
                    {
                        $Category = $row['name'];
                       $Exp_Amt= $row['expense_amount'];
                        //echo $Exp_Amt;
                        $PercentExp = (100*$row['expense_amount'] ) / $TotalExp ;
                        $per = round($PercentExp);
                       // $exp = ($row['exp_amount']);
                       //echo $Category;
			//echo $color[$i];
                        echo "<tr>\n";
                        $i = $i + 1;
                     //   echo $color[$i];
                            echo "<td>$i</td>\n";
                            echo "<td>".$Category."</td>\n";
                            
                            echo "<td>$".$Exp_Amt."</td>\n";
                            echo "<td>\n";
                            echo "<div class='progress xs progress-striped active'>\n";
                            echo "<div style='width:$per%' class='progress-bar progress-bar-$color[$j]'>";
                            echo "</div>\n";
                            echo "</div>\n";
                            echo "</td>\n";
                            echo "<td><span class='badge bg-$color[$j]'>$per%</span></td>\n";
                             $j= $j+1;
                        echo "</tr>";
                       // $j= $j+1;
                    }
                }
                echo "</TBODY>";
                echo "</TABLE>";
                }
        ?>
        </div>
<div class="box-footer clearfix">
   <!-- <ul class="pagination pagination-sm no-margin pull-right">
	<li><a href="#"><</a></li>
	<li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">></a></li>
    </ul>-->
</div>
     </div>
    
</div>	
    <!-- /.box-body -->
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
	            			window.location.href = "http://codd.cs.montclair.edu/~hcigroup/cgi-bin/familybudget/index.php"
	        	      </script> 
	               <?php }}
	             
             ?>
		<form action="index.php" method="post" >
			<input type="hidden" name="ispost" value="1"/>
			<div class="col-md-6">
				<div class="box box-warning">
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
			</div>
		</form>
	</aside>
</div>

	<!-- Include all the js stuff -->
	<?php include ('includes/jsLibrary.php') ?>
<?php include('includes/showerrors.php') ?> 

</body>
</html>