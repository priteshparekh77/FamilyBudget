<?php include ('core/init.php'); ?>
<?php include ('includes/protect.php'); ?>
<html>
<head>
<script name="javascript">
dlt(){
  alert("are your sure want to delete");
  retrun false;
};
</script>
</head>
<body onload="javascript:dlt">
<?php
$id=$_GET["cid"];
    $userid=$_SESSION['user_id'];
 $qur = "delete from cst_category where user_id=$userid and cst_category_id=$id";
 //echo $qur;
  if (!mysql_query($qur))
                    {
                    die('Error: ' . mysql_error($con));
                    }
?>
  <script type="text/javascript">
            			window.location.href = "http://codd.cs.montclair.edu/~hcigroup/cgi-bin/familybudget/category.php"
        	      </script>
 </body>
 </html>
 