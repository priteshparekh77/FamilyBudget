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
	<?php
	$a=$_GET["cid"];
	
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
						Categories
					</h1>
				</section>
			</aside>
			
			<aside class="right-side">
                            <?php
                            $userid=$_SESSION['user_id'];
 if (isset($_POST["ispost"])) 
            { 
                
 		    $catname = $_POST["catname"];
 		     $cid = $_POST["cid"];
 		      //$catname = $_POST["catname"];
                    if ($catname==NULL)
                    {
                    	$errors[] = 'Please enter appropriate category name';
                    }
                    else
                    {    
                    $sqlqur2 = "update cst_category
                               set cst_category_name='$catname'
                                where user_id=$userid and cst_category_id=$cid";
                   // echo $sqlqur2;
                    if (!mysql_query($sqlqur2))
                    {
                    die('Error: ' . mysql_error($con));
                    }?>
                    <script type="text/javascript">
            			window.location.href = "http://codd.cs.montclair.edu/~hcigroup/cgi-bin/familybudget/category.php"
        	      </script>
               <?php }}
            
             ?>
             <?php
             $qur = "select * from cst_category where user_id=$userid and cst_category_id=$a";
            // echo $qur;
                $sql_result = mysql_query($qur); 
                //echo $sql_query;
                if (($sql_result)||(mysql_errno($con))) 
                {   
                $result=mysql_query($qur);
                $rowrs=mysql_num_rows($result);while ($row = mysql_fetch_array($result))
                    {
                $cstname = $row['cst_category_name'];}
             //  echo $cstname;
                }
             ?>
                            <form name="updatecategory"method="post" action="updatecategory.php">
                                 <input type="hidden" name="ispost" value="1"/>
                                 <input type="hidden" name="cid" value="<?php echo $a?>"/>
				<div class="box box-warning" style="margin-top:15px;width: 1030px; margin-left: 15px;">
					<div class="box-header">
						<h3 class="box-title">Update Categories</h3></div>
                                    <form action="category.php">
						<div class="box-body">
							<label>Name:</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-th"></i></span>
								<input class="form-control" value="<?php echo $cstname?>" name="catname"type="text" placeholder="Category Name">
							</div>
							<br/>
							<button style="margin-top: 12px;" class="btn btn-primary" type="submit">Update</button>
						</div>
					</form>
				</div>
                            </form>
            <?php?>
				
                                    
 
    <!-- /.box-body -->
					<!---<div class="box-footer clearfix">
						<ul class="pagination pagination-sm no-margin pull-right">
							<li><a href="#"><</a></li>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">></a></li>
						</ul>
					</div>--->
				</div>
			</aside>
			
        </div>
		
		
		<!-- Include all the js stuff -->
        <?php include ('includes/jsLibrary.php') ?>
		<?php include('includes/showerrors.php') ?> 
    </body>
</html>