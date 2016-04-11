<?php include ('core/init.php'); ?>
<?php include ('includes/protect.php'); ?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
		
        <title>Budget Planner | Partners</title>
		
        <!-- Include all the css stuff -->
		<?php include ('includes/cssLibrary.php') ?>
		
    </head>
	
    <body class="skin-blue">
		
		<!-- Include header -->
        <?php include ('includes/header.php') ?>
		
        <div class="wrapper row-offcanvas row-offcanvas-left">
		
            <!-- Include side bar -->
            <?php include ('includes/sidebar.php') ?>
            <?php
	
				$host="localhost";//hostname to database
				$username="hcigroup_bisi";//username to the database
				$password="adebisi";//password to the database
				$db_name="hcigroup_fbp";//database name
				//connect to database
				mysql_connect("$host", "$username", "$password") or die("cannot connect to server");
				mysql_select_db("$db_name") or die("cannot select database");
			?>

<?php
function getuserid($owner){
$result = mysql_query("SELECT user_id FROM user where user_name='".$owner."'");
$num_of_rows = mysql_num_rows($result);
if ($num_of_rows == 1) {
$rows = mysql_fetch_array($result);
	$owner1 = $rows['user_id'];
}
return $owner1;
}
function getfullname($useri){
$result = mysql_query("SELECT user_firstname, user_lastname FROM user where user_id='".$useri."' ");
$num_of_rows = mysql_num_rows($result);
if ($num_of_rows == 1) {
$rows = mysql_fetch_array($result);
	$firstname = $rows['user_firstname'];
        $lastname= $rows['user_lastname']; 
}
return $firstname."  ".$lastname;
}

function getuseridpartner($fname, $lname){
$result = mysql_query("SELECT user_id FROM user where user_firstname='".$fname."' and user_lastname='".$lname."'");
$num_of_rows = mysql_num_rows($result);
if ($num_of_rows == 1) {
$rows = mysql_fetch_array($result);
	$owner1 = $rows['user_id'];
}
return $owner1;
}

function printvalue($num_of_rows,$result){
     if ($num_of_rows > 0) {
    		while ($rows = mysql_fetch_array($result)) {
				
	    		 		$invitee1[] = array('invitee'=>$rows['invitees']);
    		}
			$invitee = json_decode(json_encode($invitee1)); 
		for ($i = 0; $i < count($invitee); $i++){
            $user_id= getuserid($invitee[$i]->invitee);
             $fullname = getfullname($user_id);
            $result = mysql_query("SELECT sum(expense_amount)  as s FROM expense WHERE user_id ='".$user_id."'");
    	     $num_of_rows = mysql_num_rows($result);
            
$rows = mysql_fetch_array($result);
$result1 = mysql_query("SELECT sum(income_amount)  as s FROM income WHERE user_id ='".$user_id."'");
    	     $num_of_rows = mysql_num_rows($result1);
$rows1 = mysql_fetch_array($result1);

$stands = $rows1['s'] - $rows['s'];

echo '<tr>';
	echo '<td>'.$i.'</td>';
	echo '<td>'.$fullname.' </td>';
	if($rows1['s']==""){echo '<td>0</td>';}
	else{ echo '<td>'.$rows1['s'].'</td>';}
	
     if($rows['s']==""){echo '<td>0</td>';}
	 else{ echo '<td>'.$rows['s'].'</td>';}
	 
if($stands<0){echo '<td style="background-color:#F00"><p style="color:white">'.$stands.'</p></td>';}
else if($stands==0){echo '<td>'.$stands.'</td>';}
else {echo '<td style="background-color:#0F0" colspan="2"><p>'.$stands.'</p></td>';}
	
	echo '</tr>';
}}
}

if(ISSET($_GET['deleteuser'])&&ISSET($_GET['name'])){
	
                $usertodel = mysql_real_escape_string($_GET['deleteuser']);
		$owner = mysql_real_escape_string($_POST['username']);

 $result = mysql_query("DELETE FROM partners WHERE user_name='".$owner."' AND invitees='".$usertodel."';");
	if($result){  
  echo "
            <script type=\"text/javascript\">
              window.location = 'http://codd.cs.montclair.edu/~hcigroup/cgi-bin/familybudget/partner.php';
            </script>
        ";
}
		}


if(ISSET($_POST['invita'])){

$email =$_POST['invita'];

$to=$email; 
$subject="Family Budget Planner"; 
$header="From:budgetplanner@mysite.com"; 
$message="Dear User,\n Your friend invites you to use Family Budget Planner Application \n click the below link to register \n http://codd.cs.montclair.edu/~hcigroup/cgi-bin/familybudget/register.php"; 


if(mail($to,$subject,$message,$header)) 
{ 
$_POST['invitationsent']="mail sent successfully";


} 
else 
{ 
$_POST['invitationsent']= "mail not sent..error,  try again"; 

}
}

if(ISSET($_POST['invitee_username'])){
                
		$invitee_username = mysql_real_escape_string($_POST['invitee_username']);
		$username = mysql_real_escape_string($_POST['username']);
		$result = mysql_query("SELECT * FROM user where user_name='".$username."'");
    	$num_of_rows = mysql_num_rows($result);
		if ($num_of_rows > 0) {
	    $result = mysql_query("SELECT * FROM user where user_name='".$invitee_username."'");
    	$num_of_rows = mysql_num_rows($result);
		
        if ($num_of_rows > 0) {
	    $result = mysql_query("INSERT INTO partners(partners_id, user_name,invitees) VALUES(NULL,'".$username."','".$invitee_username."')");
	if($result){ 
$_POST['partner']="Partner successfully added"; 
  echo "
            <script type=\"text/javascript\">
              window.location = 'http://codd.cs.montclair.edu/~hcigroup/cgi-bin/familybudget/partner.php';
            </script>
        ";
}
	
}
	else {
	        $data = false;
}
}	else {
	        $data = false;
}

}else{

$partnersdata = json_decode(json_encode($data));    

}
   



	

?>			
            
			<aside class="right-side">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						Partners
					</h1>
				</section>
			</aside>
			
	<aside class="right-side">
		
			<div class="nav-tabs-custom" id="ExpvsCat">
				<ul class="nav nav-tabs pull-right">		   
					<li class="active"><a href="#add_div" data-toggle="tab">Invite/Add Partner</a></li>
					<li><a href="#shared_div" data-toggle="tab" >Shared Partner</a></li>
					<li class="pull-left header"><i class="fa fa-users"></i></li>
				</ul>
				<div class="tab-content no-padding">
					<div class="chart tab-pane active" id="add_div"style="position: relative; background:white;">
					<br/>
						<div class="col-md-6" style="background:white">
							<div class="box" >
								<div class="box-header">
									<h3 class="box-title">Invite Partners</h3>
								</div>
								<?php 
									if(ISSET($_POST['invitationsent'])){echo $_POST['invitationsent']; }
								
									echo $_POST['deleteuser'];

									if(ISSET($_POST['userdeleted'])){echo $_POST['userdeleted'];}
								?>
								<form method="POST" action="partner.php" >
									<div class="box-body">
										<label>Email:</label>
										<div class="input-group">
											<span class="input-group-addon">@</span>
											<input class="form-control" type="text" placeholder="Email" name="invita">
										</div>
										<br/>
										
										<div class='box-body pad' style="padding: 0px;">
											<form>
												<textarea class="textarea" placeholder="Send a message to the partner" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
											</form>
										</div>
										
										<br/>
										<button style="margin-top: 12px;" class="btn btn-primary" type="submit">Send Invitation</button>
									</div>
								</form>
							</div>
						</div>
						<?php 
							if(ISSET($_POST['partner']))
							{
								echo $_POST['partner']; 
							}
						?>
						<div class="col-md-6" style="background:white; height:518px">
							<div class="box">
								<div class="box-header">
									<h3 class="box-title">Add Partners</h3>
								</div>
								<form method="POST" action="partner.php" >
									<div class="box-body">
										<label>Add new partner:</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-users"></i>
											</div>
											<input class="form-control" type="text" placeholder="Invitee Username" name="invitee_username">
										</div>
										<br/>
										
										<button style="margin-top: 12px;" class="btn btn-primary" type="submit">Add User</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="chart tab-pane" id="shared_div" style="position: relative;">
						<br/>
						<div class="col-md-12" style="background:white">
							<div class="box">
								<div class="box-header">
									<h3 style="width: 100%;" class="box-title">People Sharing this Account
										
										<form style="float:right; width:30%;" class="text-right" action="#">
											<div class="input-group">
												<input type="text" placeholder="Search" class="form-control input-sm">
												<div class="input-group-btn">
													<button class="btn btn-sm btn-primary" name="q" type="submit"><i class="fa fa-search"></i></button>
												</div>
											</div>
										</form>
										
									</h3>
								</div>
								
								<div class="box-body">
									<table class="table table-bordered">
										<tbody>
											<tr>
												<th style="width: 10px">S/N</th>
												<th >FullName </th>
												<th > Income</th>
												<th > Expenses</th>                                                                
												<th colspan="2" > Stand</th>
											</tr>
											<?php
											
												if($partnersdata[0]->fname == "")
												{
													echo '<tr>';
													echo '<td colspan="6">No Partner yet </td>';
													echo '</tr>';
												}

												else
												{  
													for ($i = 0; $i < count($partnersdata); $i++)
													{
														$user_id= getuseridpartner($partnersdata[$i]->fname, $partnersdata[$i]->lname);
														$result = mysql_query("SELECT sum(expense_amount)  as s FROM expense WHERE user_id ='".$user_id."'");
														$num_of_rows = mysql_num_rows($result);
														$rows = mysql_fetch_array($result);

														$result1 = mysql_query("SELECT sum(income_amount)  as s FROM income WHERE user_id ='".$user_id."'");
														$num_of_rows = mysql_num_rows($result1);
														$rows1 = mysql_fetch_array($result1);

														$stands = $rows1['s']-$rows['s'];

														echo '<tr>';
														echo '<td>'.$i.'</td>';
														echo '<td>'.$partnersdata[$i]->fname.' '.$partnersdata[$i]->lname.'</td>';
														if($rows1['s']=="")
														{
															echo '<td>0</td>';
														}
														else
														{ 
															echo '<td>'.$rows1['s'].'</td>';
														}
														if($rows['s']=="")
														{
															echo '<td>0</td>';
														}
														else
														{ 
															echo '<td>'.$rows['s'].'</td>';
														}
														if($stands<0)
														{
															echo '<td style="background-color:#F00">'.$stands.'</td>';
														}
														else if($stands==0)
														{
															echo '<td>'.$stands.'</td>';
														}
														else 
														{
															echo '<td style="background-color:#0F0">'.$stands.'</td>';
														}
											
														echo '<td><a href="http://codd.cs.montclair.edu/~hcigroup/cgi-bin/familybudget/partner.php?name=delete&deleteuser='.$partnersdata[$i]->uname.'"><span class="badge bg-red">Delete</span></a></td>';
										
														echo '</tr>';
													}
												}
											?>
																
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="col-md-12" style="background:white">
							<div class="box">
								<div class="box-body">
								<table class="table table-bordered">
									<tbody>
										<?php	
											echo '<div class="box-header">';
												echo '<h3 style="width: 100%;" class="box-title">Accounts shared with other people</h3>';	
											echo '</div>';
											if(ISSET($_POST['username']))
											{
												$username = mysql_real_escape_string($_POST['username']);
												$result = mysql_query("SELECT user_name FROM partners WHERE invitees='".$username."'");
												$num_of_rows = mysql_num_rows($result);

												if ($num_of_rows > 0) 
												{
													while ($rows = mysql_fetch_array($result)) 
													{	
														$owner1[] = array('owner'=>$rows['user_name']);
													}
													$owner = json_decode(json_encode($owner1)); 
													for ($i = 0; $i < count($owner); $i++)
													{
														echo '<td bordercolorlight="#FF0000" colspan="6"><h4 style="font-style: oblique;">'.getfullname(getuserid($owner[$i]->owner)).'</h4></td>';
											
														{
															$result = mysql_query("SELECT invitees FROM partners WHERE user_name ='".$owner[$i]->owner."'");
															$num_of_rows = mysql_num_rows($result);
															{

										?>


													<tr>
														<th>S/N</th>
														<th>Name </th>
														<th> Income</th>
														<th> Expenses</th>                                                                
														<th  colspan="2"> Stand</th>
													</tr>
											<?php
											printvalue($num_of_rows,$result);
											   
											}
										}	




											}
										}
									}	
								?>
								</tbody></table>
								</div>
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