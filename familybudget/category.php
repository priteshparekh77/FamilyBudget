<?php include ('core/init.php'); ?>
<?php include ('includes/protect.php'); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
		
        <title>Budget Planner | Categories</title>
		
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
						Categories
					</h1>
				</section>
			</aside>
			
			<aside class="right-side">
			<div class="box box-warning" style="margin-top:15px;width: 1030px; margin-left: 15px; padding:20px;">
                            <?php
                            $userid=$_SESSION['user_id'];
 if (isset($_POST["ispost"])) 
            { 
                
 		    $catname = $_POST["catname"];
                    if ($catname==NULL )
                    {
                    	$errors[] = 'Please enter appropriate category name';
                    }
                    else
                    {        
	                    $sqlqur2 = "Insert into cst_category(user_id,cst_category_name,category_id) values"
                            . " ('$userid','$catname','7')";
	                    if (!mysql_query($sqlqur2))
	                    {
	                    die('Error: ' . mysql_error($con));
	                    }
	            ?>
	            <script type="text/javascript">
            			window.location.href = "http://codd.cs.montclair.edu/~hcigroup/cgi-bin/familybudget/category.php"
        	    </script>
        	    
               <?php }}
             ?>
             <div class="nav-tabs-custom" id="ExpvsCat">		
			  <ul class="nav nav-tabs pull-right">
                                   <li><a href="#chart_pie" data-toggle="tab" >Add Custom Category</a></li>      
                                   <li class="active"><a href="#chart_Column" data-toggle="tab" >View Custom Category</a></li>
                                   <li class="pull-left header"><i class="fa fa-th"></i></li>
                            </ul>
                            <div class="tab-content no-padding">
                                    <!-- Morris chart - Sales -->
                                   <div class="chart tab-pane" id="chart_pie" style="position: relative;">
                            <form name="addcategory" method="post" action="category.php">
                                 <input type="hidden" name="ispost" value="1"/>
					
                                    <form action="category.php">
						<div class="box-body">
							<label>Name:</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-th"></i></span>
								<input class="form-control" name="catname"type="text" placeholder="Category Name">
							</div>
							<br/>
							<button style="margin-top: 12px;" class="btn btn-primary" type="submit">Add</button>
						</div>
					</form>
			
				
                            </form></div>
            <?php ?>
				
 
<div class="chart tab-pane active" id="chart_Column" style="position: relative;">
 <?php
 echo "<table class='table table-bordered'>";
 echo "<tbody><tr>";
 echo "<th style='width: 10px'>#</th>";
 echo "<th>Name</th>";
 echo "<th style='width: 40px'></th>";
 echo "<th style='width: 40px'></th>";
 echo "</tr>";
  $qur = "select * from cst_category where cst_category.user_id=$userid";
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
                      
                        $Category = $row['cst_category_name'];
                        $cid = $row['cst_category_id'];
                        $i = $i + 1;
                       //echo $Category;
                        echo "<tr>\n";
                        echo "<td>$i</td>";
                        echo "<td>$Category</td>";
                        echo "<td><a href='http://codd.cs.montclair.edu/~hcigroup/cgi-bin/familybudget/updatecategory.php?cid=$cid'><span class='badge bg-blue'>Edit</span></a></td>";
                        echo "<td><a href='http://codd.cs.montclair.edu/~hcigroup/cgi-bin/familybudget/dltct.php?cid=$cid'><span class='badge bg-red'>Delete</span></a></td>";
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
    <!-- /.box-body -->
					
				</div>
				</div>
			</aside>
			
        </div>
		
		
		<!-- Include all the js stuff -->
        <?php include ('includes/jsLibrary.php') ?>
		<?php include('includes/showerrors.php') ?> 
    </body>
</html>