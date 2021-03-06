<?php include ('core/init.php'); ?>

<?php
	if(isset($_POST['signin']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		if(empty($username) || empty($password))
		{
			$errors[] = 'You need to enter username/password';
		}
		else if(user_exists($username) === false)
		{
			$errors[] = 'We couldn\'t find this username, have you registered?';
		}
		/* else if(user_active($username) === false)
		{
			$errors[] = 'You haven\'t activated your account yet';
		} */
		else
		{
			$login = login($username, $password);
			if($login === false)
			{
				$errors[] = 'That username/password combination is incorrect';
			}
			else
			{
				//set the user session
                                $_SESSION['username']= $_POST['username'];
				$_SESSION['user_id'] = $login;
				//redirect the user to the index.php
				//header('Location: index.php');?>
				<script type="text/javascript">
            			window.location.href = "http://codd.cs.montclair.edu/~hcigroup/cgi-bin/familybudget/index.php"
        	      </script><?php
			}
		}
	}
	else
	{
		if(!logged_in())
		{
			$errors[] = 'Please log in first';
		}
	}
?>

<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
		
        <title>Budget Planner | Log In</title>
		
        <!-- Include all the css stuff -->
		<?php include ('includes/cssLibrary.php') ?>
		
    </head>
    <body class="bg-black">
		<div style="text-align:center;">
			<img src="img/intro.png"></img>
		</div>
        <div class="form-box" id="login-box">
            <div class="header" style="background:none repeat scroll 0 0 #3c8dbc;">Sign In</div>
            <?php include ('includes/loginform.php') ?>

            <?php include ('includes/loginsocial.php') ?>
        </div>


        <!-- Include all the js stuff -->
        <?php include ('includes/jsLibrary.php') ?> 

    </body>
</html>


<?php include('includes/showerrors.php') ?>