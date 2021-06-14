<?php 
include("connect.php");
if (isset($_POST['btnconfirm']))
{
	$userID=$_POST['txtuserID'];
	$current_pw=$_POST['txtcurrentpw'];
	$new_pw=$_POST['txtnewpw'];
	$retype_pw=$_POST['txtretypepw'];

	$select="SELECT PASSWORD FROM user WHERE USERID='$userID'";
	$rets=mysql_query($select);
	for ($i=0; $i<1; $i++) 
	{ 
		$datapw=mysql_fetch_array($rets);
		$pw=$datapw['PASSWORD'];
		if ($current_pw!==$pw) 
		{
			echo "<script>window.alert('Wrong Password')</script>";
			echo "<script>window.location='../change_psw.php'</script>";
		}
	}

	if ($new_pw!==$retype_pw) 
	{
		echo "<script>window.alert('Retype password did not match with new password')</script>";
		echo "<script>window.location='../change_psw.php'</script>";
	}
	else
	{	
		$update="UPDATE user
				 Set PASSWORD='$new_pw'
			 	 WHERE USERID='$userID'";
		$retup=mysql_query($update);

		if($retup)
		{
			echo "<script>window.alert('Your Password Changed Successfully!')</script>";
			echo "<script>window.location='../index.php'</script>";
		}
    		else
		{
	 		echo "<p>Error in changing password:" .mysql_error()."</p>";
		}
	}
}
?>