<?php 
session_start();
include('includes/connect.php');
if(!isset($_SESSION['USERID']))
{
	echo "<script>window.alert('Please Login First to Continue.')</script>";
	echo "<script>window.location='user_login.php'</script>";
}

//Delete
if(isset($_POST['btndelete']))
{
  $ID=$_POST['txtid'];
  $Delete="DELETE FROM feedbacks WHERE ID='$ID'";
  $execute=mysql_query($Delete);

  if ($execute) 
  {
    echo "<script>window.alert('Your Issue Deleted Successfully!')</script>";
    echo "<script>window.location='issue_list.php'</script>";
  }
  else
  {
    echo "<p>Error in Deleting Issue.".mysql_error()."</p>";
  }
}
//End of Delete

?>
<html>
<head>
	<title>Issue List</title>
</head>
<body>
	<h1>Your Issues Lists</h1>
	<p>*The admins will remark the issues within 24 hour!</p>
<form action="issue_list.php" method="post">
<?php 
$userid=$_SESSION['USERID'];
$view="SELECT * FROM feedbacks WHERE USERID='$userid'";
$ret=mysql_query($view);
$count=mysql_num_rows($ret);

if ($count==0) 
{
	echo "<p>No Issues Found!</p>";
}
else
{
		echo "<table align='center'>";
		echo "<tr>";
		echo "<th>User Name</th>";
		echo "<th>Issue</th>";
		echo "<th>Description</th>";
		echo "<th>Post Date</th>";
		echo "<th>Remarked Date</th>";
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
		echo "<td>".$data['SOLVED_DATE']."</td>";
		echo "<td>".$data['ADMIN_REMARK']."</td>";
		echo "<td><input type='submit' value='Delete' name='btndelete'></td>";
		echo "</tr>";
	}
	echo "</table>";
}
?>
</form>
</body>
</html>