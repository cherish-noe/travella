<?php
session_start();
require('admin\php\connect.php');

if(isset ($_POST['btnsignin']))
{
	$email=$_POST['txtemail'];
	$password=$_POST['txtpassword'];
	if ($email=="")
	{
		echo "<script>window.alert('Please Enter Your Email')</script>";
	}
	elseif ($password=="") 
	{
		echo "<script>window.alert('Please Enter Password')</script>";
	}
	else
	{
		$email=mysql_real_escape_string($email);
		$password=mysql_real_escape_string($password);
		
		$check="SELECT u.*,c.* FROM user u,company c
			    WHERE u.USERID=c.USERID
			    AND u.EMAIL='$email'
				AND u.PASSWORD='$password'
				AND c.STATUS='Approved'";

			$ret=mysql_query($check);
			$count=mysql_num_rows($ret);
			$row=mysql_fetch_array($ret);

		$checkadmin="SELECT * FROM admin
			    	 WHERE EMAIL='$email'
					 AND PASSWORD='$password'";
			$retadmin=mysql_query($checkadmin);
			$countrow=mysql_num_rows($retadmin);
			$row1=mysql_fetch_array($retadmin);

			if($count!==1 && $countrow!==1)
			{
				echo"<script> window.alert('Your Email or Password Incorrect Or Your Account Have not Accepted') </script>";
				echo"<script> window.location='user_login.php'</script>";

			}
			else
			{	
				$_SESSION['USERID']=$row['USERID'];
				$_SESSION['ROLE']=$row['ROLE'];
				$_SESSION['USERNAME']=$row['USERNAME'];
				$_SESSION['EMAIL']=$row['EMAIL'];
				$Role=$_SESSION['ROLE'];
				$UserName=$row['USERNAME'];
				switch ($Role) {
					case 'Company':
					echo"<script> window.alert('Welcome $UserName')</script>";
					echo "<script>window.location='company/index.php'</script>";
						break;
					
					default:
					$_SESSION['ADMINID']=$row1['ADMINID'];
					$_SESSION['ADMIN_NAME']=$row1['ADMIN_NAME'];
					$_SESSION['ADMIN_EMAIL']=$row1['EMAIL'];
					$adminName=$row1['ADMIN_NAME'];
					echo"<script> window.alert('Welcome $adminName')</script>";
					echo "<script>window.location='admin/index.php'</script>";
						break;
				}
			}	
	}	
}
?>
<html>
<head>
	<title>User Login</title>
	<link rel="stylesheet" type="text/css" href="style/login.css">
</head>
<body>	
		Sign in Your Account
		<form action='user_login.php' method='post'>
		<table cellspacing="7" cellpadding="4">
			<tr>
				<td>
					<input type="email" name="txtemail" placeholder="Enter Email Address" >
				</td>
			</tr>
			<tr>
				<td>
					<input type="password" name="txtpassword" placeholder="Enter Password" >
				</td>	
			</tr>
			<tr>
				<td>
					<input type="submit" class="btn" name="btnsignin" value="Sign in">
					<input type="reset" class="btn" name="btnclear" value="Clear">
				</td>
			</tr>
		</table>
 			<p>Don't have an account? </p>  
 			   Register Here For Your <a href="company_registration.php">Company</a>
</body>
</html>