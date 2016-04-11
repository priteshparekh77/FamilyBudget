<div class="header" style="background:none repeat scroll 0 0 #3c8dbc;" >Register New Membership</div>
<form action="register.php" method="post">
	<div class="body bg-gray">
		<div class="form-group" style="width:49%; display:inline-block; margin-bottom:0px;">
			<input type="text" autocomplete="off" name="firstname" class="form-control" placeholder="First name"/>
		</div>
		 <div class="form-group" style="width:50%; display:inline-block; margin-bottom:0px;">
			<input type="text" autocomplete="off" name="lastname" class="form-control" placeholder="Last name"/>
		</div>
		<div class="form-group">
			<input type="text" autocomplete="off" name="username" class="form-control" placeholder="Username"/>
		</div>
		<div class="form-group">
			<input type="email" autocomplete="off" name="email" class="form-control" placeholder="Email"/>
		</div>
		<div class="form-group">
			<input type="password" autocomplete="off" name="password" class="form-control" placeholder="Password"/>
		</div>
		<div class="form-group">
			<input type="password" autocomplete="off" name="re_password" class="form-control" placeholder="Re-type password"/>
		</div>
	</div>
	<div class="footer">                    

		<input type="submit" class="btn btn-block" style="background:none repeat scroll 0 0 #3c8dbc; color:white;" name="signup" value="Sign me up" />

		<a href="login.php" class="text-center">I already have a membership</a>
	</div>
</form>