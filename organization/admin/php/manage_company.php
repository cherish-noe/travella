<?php  
include('connect.php');
session_start();

if(!isset($_SESSION['ADMINID']))
{
	echo "<script>window.alert('Please Login First to Continue.')</script>";
	echo "<script>window.location='../../home(index.php'</script>";
}

//company approve
if (isset($_POST['btnapprove'])) 
{
	$adminID=$_SESSION['ADMINID'];
	$id=$_POST['txtid'];
	$update="UPDATE company
		     SET STATUS='Approved',
			 	 ADMINID='$adminID'
			 WHERE USERID='$id'";
	$upret=mysql_query($update);

	if ($upret) 
	{
		echo "<script>window.alert('Approved Company Successfully!')</script>";
		echo "<script>window.location='../company_list.php'</script>";
	}
	else
	{
		echo "<p>Error in Approving the Company:" .mysql_error()."</p>";
	}
}
//end of approve
//Decline
if(isset($_POST['btndecline']))
{
  $id=$_POST['txtid'];
  $Delete="DELETE FROM Company WHERE USERID='$id'";
  $execute=mysql_query($Delete);

  $delete="DELETE FROM user WHERE USERID='$id'";
  $execute=mysql_query($delete);
  if ($execute) 
  {
    echo "<script>window.alert('Decline Company Successfully!')</script>";
    echo "<script>window.location='../company_list.php'</script>";
  }
  else
  {
    echo "<p>Error in Decline.".mysql_error()."</p>";
  }
}
//End of Decline
//ban company 
if (isset($_POST['btnban'])) 
{
	$AdminID=$_SESSION['ADMINID'];
	$cid=$_POST['txtcmpid'];
	$updateban="UPDATE company
		     SET STATUS='Banned',
			 	 ADMINID='$AdminID'
			 WHERE USERID='$cid'";
	$retban=mysql_query($updateban);

	if ($retban) 
	{
		echo "<script>window.alert('Banned Company Successfully!')</script>";
		echo "<script>window.location='../company_list.php'</script>";
	}
	else
	{
		echo "<p>Error in Banning the Company:" .mysql_error()."</p>";
	}
}
//end_of_ban

function displayCompany()
{
	$viewcompany="SELECT c.*,u.* FROM company c,user u 
				  WHERE c.USERID=u.USERID
				  AND STATUS='Pending'";
	$rets=mysql_query($viewcompany);
	$count=mysql_num_rows($rets);
	
	if ($count==0) 
	{	
		echo " <div class='alert pending'>
	  <span class='closebtn'>&times;</span><strong>Success!</strong> All companies are approved!</div>";
	}
	else
	{
			echo "<table align='center' class='pending'>";
			echo "<tr>";
			echo "<th>Company Logo</th>";
			echo "<th>User-ID</th>";
			echo "<th>Company Name</th>";
			echo "<th>Address</th>";
			echo "<th>Phone</th>";
			echo "<th>E-mail</th>";
			echo "<th>About Company</th>";
			echo "<th>Registration Date</th>";
			echo "<th>Status</th>";
			echo "<th>Action</th>";
			echo "</tr>";
	
		for ($i=0; $i < $count; $i++) 
		{ 
			$data=mysql_fetch_array($rets);
			$id=$data['USERID'];
			echo "<input type='hidden' name='txtid' value='$id'>";
			$image=$data['PROFILE_IMAGE'];
			$cmpName=$data['COMPANYNAME'];
			echo "<tr>";
			echo "<td><img src='../company/$image' rel='$cmpName'></td>";
			echo "<td>".$data['USERID']."</td>";
			echo "<td>".$data['COMPANYNAME']."</td>";
			echo "<td>".$data['ADDRESS']."</td>";
			echo "<td>".$data['PHONENO']."</td>";
			echo "<td>".$data['EMAIL']."</td>";
			echo "<td>".$data['SHORT_DESCRIPTION']."</td>";
			echo "<td>".$data['ACCOUNT_DOB']."</td>";
			echo "<td>".$data['STATUS']."</td>";
			echo "<td><input type='submit' value='Approve' name='btnapprove' class='j_btnsubmit j_approve'> &nbsp | &nbsp <input type='submit' value='Decline' name='btndecline' class='j_btnsubmit j_decline'></td>";
			echo "</tr>";
		}
		echo "</table>";
	}
}
//accepted company list
function displayAcceptedCompany()
{
	$viewcompany1="SELECT c.*,u.* FROM company c,user u 
			   WHERE c.USERID=u.USERID
			   AND STATUS='Approved'";
	$ret1=mysql_query($viewcompany1);
	$count1=mysql_num_rows($ret1);
	
	if ($count1==0) 
	{
		echo "<div class='alert approved'>
	  <span class='closebtn'>&times;</span><strong>Information!</strong> Companies haven't approved yet!</div>";
	}
	else
	{
		echo "<table align='center' class='approved'>";
		echo "<tr>";
		echo "<th></th>";
		echo "<th>User-ID</th>";
		echo "<th>Company Name</th>";
		echo "<th>Address</th>";
		echo "<th>Phone</th>";
		echo "<th>E-mail</th>";
		echo "<th>About Company</th>";
		echo "<th>Admin</th>";
		echo "<th>Status</th>";
		echo "<th>Action</th>";
		echo "</tr>";

	for ($j=0; $j < $count1; $j++) 
	{ 
		$datas=mysql_fetch_array($ret1);
		$image=$datas['PROFILE_IMAGE'];
		$cmpName=$datas['COMPANYNAME'];
		$cmpid=$datas['USERID'];
		$adminid=$datas['ADMINID'];
		$select="SELECT ADMIN_NAME FROM admin WHERE ADMINID='$adminid'";
		$retname=mysql_query($select);
		$name=mysql_fetch_array($retname);

		echo "<input type='hidden' name='txtcmpid' value='$cmpid'>";
		echo "<tr>";
		echo "<td><img src='../company/$image' rel='$cmpName'></td>";
		echo "<td>".$datas['USERID']."</td>";
		echo "<td>".$datas['COMPANYNAME']."</td>";
		echo "<td>".$datas['ADDRESS']."</td>";
		echo "<td>".$datas['PHONENO']."</td>";
		echo "<td>".$datas['EMAIL']."</td>";
		echo "<td>".$datas['SHORT_DESCRIPTION']."</td>";
		echo "<td>".$name['ADMIN_NAME']."</td>";
		echo "<td>".$datas['STATUS']."</td>";
		echo "<td><input type='submit' value='Ban' name='btnban' class='j_btnsubmit j_Ban'></td>";
		echo "</tr>";
	}
		echo "</table>";
	}
}
//banned company list
function displayBanList()
{
	$viewban="SELECT c.*,u.* FROM company c,user u 
		  WHERE c.USERID=u.USERID
		  AND STATUS='Banned'";
	$ret=mysql_query($viewban);
	$countban=mysql_num_rows($ret);

	if ($countban==0) 
	{
		echo "<div class='alert banned'>
 	 	<span class='closebtn'>&times;</span><strong>Information!</strong> There is no banned companies!</div>";
	}
	else
	{
		echo "<table align='center' class='banned'>";
		echo "<tr>";
		echo "<th>Company Logo</th>";
		echo "<th>User-ID</th>";
		echo "<th>Company Name</th>";
		echo "<th>Address</th>";
		echo "<th>Phone</th>";
		echo "<th>E-mail</th>";
		echo "<th>About Company</th>";
		echo "<th>Admin</th>";
		echo "<th>Status</th>";
		echo "</tr>";

	for ($j=0; $j < $countban; $j++) 
	{ 
		$bandata=mysql_fetch_array($ret);
		$image=$bandata['PROFILE_IMAGE'];
		$cmpName=$bandata['COMPANYNAME'];

		$Aid=$bandata['ADMINID'];
		$selectA="SELECT ADMIN_NAME FROM admin WHERE ADMINID='$Aid'";
		$retA=mysql_query($selectA);
		$adminname=mysql_fetch_array($retA);
		echo "<tr>";
		echo "<td><img src='$image' rel='$cmpName'></td>";
		echo "<td>".$bandata['USERID']."</td>";
		echo "<td>".$bandata['COMPANYNAME']."</td>";
		echo "<td>".$bandata['ADDRESS']."</td>";
		echo "<td>".$bandata['PHONENO']."</td>";
		echo "<td>".$bandata['EMAIL']."</td>";
		echo "<td>".$bandata['SHORT_DESCRIPTION']."</td>";
		echo "<td>".$adminname['ADMIN_NAME']."</td>";
		echo "<td>".$bandata['STATUS']."</td>";
		echo "</tr>";
	}
	echo "</table>";
	}
}
?>