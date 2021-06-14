<?php 
session_start();
include('connect.php');

if(!isset($_SESSION['ADMINID']))
{
	echo "<script>window.alert('Please Login First to Continue.')</script>";
	echo "<script>window.location='user_login.php'</script>";
}

//issue remark
if (isset($_POST['btnsolve'])) 
{
	$adminID=$_SESSION['ADMINID'];
	$id=$_POST['txtid'];
	$message=$_POST['txtmessage'];
	$Sdate=date('Y-m-d');
	$update="UPDATE feedbacks
		     SET STATUS='Remarked',
		     	 ADMIN_REMARK='$message',
		     	 SOLVED_DATE='$Sdate',
			 	 ADMINID='$adminID'
			 WHERE ID='$id'";
	$upret=mysql_query($update);

	if ($upret) 
	{
		echo "<script>window.alert('Remarked Successfully!')</script>";
		echo "<script>window.location='manage_issue.php'</script>";
	}
	else
	{
		echo "<p>Error in Remark issue:" .mysql_error()."</p>";
	}
}
//end of remark

//issue list
function displayIssue()
{
	$view="SELECT * FROM feedbacks 
		   WHERE STATUS='Pending'";
	$ret=mysql_query($view);
	$count=mysql_num_rows($ret);

	if ($count==0) 
	{
		echo " <div class='alert pending'>
 	 	<span class='closebtn'>&times;</span><strong>Information!</strong> No issuses found!</div>";
	}
	else
	{
		echo "<table align='center' class='approved'>";
		echo "<tr>";
		echo "<th>User Name</th>";
		echo "<th>Issue</th>";
		echo "<th>Description</th>";
		echo "<th>Post Date</th>";
		echo "<th>STATUS</th>";
		echo "<th>Remark Message</th>";
		echo "<th>Action</th>";
		echo "</tr>";

	for ($i=0; $i < $count; $i++) 
	{ 
		$data=mysql_fetch_array($ret);
		$id=$data['ID'];
		echo "<input type='hidden' name='txtid' value='$id'>";
		echo "<tr>";
		echo "<td>".$data['USER_NAME']."</td>";
		echo "<td>".$data['ISSUE']."</td>";
		echo "<td>".$data['DESCRIPTION']."</td>";
		echo "<td>".$data['POST_DATE']."</td>";
		echo "<td>".$data['STATUS']."</td>";
		echo "<td><textarea name='txtmessage'></textarea></td>";
		echo "<td><input type='submit' value='Solve' name='btnsolve' id='j_btnsolve'></td>";
		echo "</tr>";
	}
	echo "</table>";
}
}
//solved issue list
function displaySolveIssue()
{
	$viewsolve="SELECT * FROM feedbacks 
			    WHERE STATUS='Remarked'";
	$ret1=mysql_query($viewsolve);
	$count1=mysql_num_rows($ret1);

	if ($count1==0) 
	{
		echo "<div class='alert approved'><span class='closebtn'>&times;</span><strong>Information!</strong> Issues haven't been solved yet!</div>";
	}
	else
	{
		echo "<table align='center' class='approved'>";
		echo "<tr>";
		echo "<th>User Name</th>";
		echo "<th>Issue</th>";
		echo "<th>Description</th>";
		echo "<th>Status</th>";
		echo "<th>Remark Message</th>";
		echo "<th>Admin</th>";
		echo "<th>Solved Date</th>";
		echo "</tr>";

	for ($j=0; $j < $count1; $j++) 
	{ 
		$datas=mysql_fetch_array($ret1);
		
		$ID=$datas['ID'];
		$adminid=$datas['ADMINID'];
		$select="SELECT ADMIN_NAME FROM admin WHERE ADMINID='$adminid'";
		$retname=mysql_query($select);
		$name=mysql_fetch_array($retname);

		echo "<tr>";
		echo "<td>".$datas['USER_NAME']."</td>";
		echo "<td>".$datas['ISSUE']."</td>";
		echo "<td>".$datas['DESCRIPTION']."</td>";
		echo "<td>".$datas['STATUS']."</td>";
		echo "<td>".$datas['ADMIN_REMARK']."</td>";
		echo "<td>".$name['ADMIN_NAME']."</td>";
		echo "<td>".$datas['SOLVED_DATE']."</td>";
		echo "</tr>";
	}
	echo "</table>";
	}
}
?>