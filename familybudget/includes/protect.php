<?php 
	if(!logged_in())
	{	?><script type="text/javascript">
            			window.location.href = "http://codd.cs.montclair.edu/~hcigroup/cgi-bin/familybudget/login.php"
        	      </script><?php
		//header('Location: login.php');
	}
?>