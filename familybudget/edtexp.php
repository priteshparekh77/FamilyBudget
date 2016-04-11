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
<?php
	$a=$_GET["eid"];
	
	?>	
		<!-- Include header -->
        <?php include ('includes/header.php') ?>
		
        <div class="wrapper row-offcanvas row-offcanvas-left">
		
            <!-- Include side bar -->
            <?php include ('includes/sidebar.php') ?>
			
            <aside class="right-side">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						Edit Expense
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
                   $a =$_POST["eid"];
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
	                   
	                    $sqlqur2 = "Update expense set expense_amount=$Expense,expense_description='$descr',expense_date='$date',
	                    cst_category_id=$cstcategory,category_id=$categoryid
	                    where expense_id=$a and user_id=$userid";
	                    //echo $sqlqur2;
	                    if (!mysql_query($sqlqur2))
	                    {
	                  	  die('Error: ' . mysql_error($con));
	                    }?>
	                    <script type="text/javascript">
	            			window.location.href = "http://codd.cs.montclair.edu/~hcigroup/cgi-bin/familybudget/expense.php"
	        	      </script> 
	               <?php }}
	             
             ?>
             <?php
             $qur1 = "select * from expense where user_id=$userid and expense_id=$a";
           
                $sql_result = mysql_query($qur1); 

                if (($sql_result)||(mysql_errno($con))) 
                {   
                $result=mysql_query($qur1);
                $rowrs=mysql_num_rows($result);
                while ($row = mysql_fetch_array($result))
                {
                $exp = $row['expense_amount'];
                $date = $row['expense_date'];
                $descr =$row['expense_description'];
               }
             //  echo $cstname;
                }
             ?>
 <div class="box box-warning" style="margin-top:15px;width: 1030px; margin-left: 15px;">
		<div class="box-header">
				<h3 class="box-title"></h3>
		</div>
      
                                   <form action="edtexp.php" method="post" >
			<input type="hidden" name="ispost" value="1"/>
			 <input type="hidden" name="eid" value="<?php echo $a?>"/>
				<div class="">
					<div class="box-header">
					<h3 class="box-title">Edit an Expense</h3>
					</div>
					<div class="box-body">
						<label>Expense:</label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-usd"></i>
							</div>
							<input  name="expense"type="text"class="form-control" value="<?php echo $exp?>">
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
						
						<div class="form-group">
							<label>Description:</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-file-text-o"></i>
								</div>
								<input name="descr"type="text"class="form-control"value="<?php echo $descr?>">
							</div>
						</div>
						<div class="form-group">
							<label>Date:</label>				
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" id="datepicker" value="<?php echo $date?>" name="date" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
								</div>
						</div>
						<button style="margin-top: 12px;" class="btn btn-primary" type="submit">Update</button>
					</div>
				</div>
		</form>
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