<?php 
session_start();
include('includes/connect.php');
require('includes/AutoID_Function.php');
//save button
if (isset($_POST['btnsend'])) 
{
      $name=$_POST['txtname'];
      $issue=$_POST['selissue'];
      $desc=$_POST['txtdesc'];
      $date=date('Y-m-d');
      $userid=$_SESSION['USERID'];
    $insert="INSERT INTO feedbacks
            (USERID,USER_NAME,ISSUE,DESCRIPTION,ADMIN_REMARK,POST_DATE,STATUS,ADMINID)
            VALUES
            ('$userid','$name','$issue','$desc','Pending','$date','Pending','-')";
    $ret=mysql_query($insert);

      if($ret)
      {
          echo "<script>window.alert('Successfully Sent!')</script>";
          echo "<script>window.location='company.php'</script>";
      }
      else
      {
        echo "<p>Error in sending feedback:" .mysql_error()."</p>";
      }
}
//End of save
?>
<html>
<head>
	<title>Report Issue</title>
	<link rel="stylesheet" type="text/css" href="style/login.css">
</head>
<body>	
		<form action='report_issue.php' method='post'>

			<label>Name</label>
			<input type="text" name="txtname">
			<br>	
			<label>Issue</label>
			<select name="selissue"> 
        <option>Registration</option>
        <option>Funds</option>
        <option>Updating</option>
        <option>Other</option>
      </select>
			<br>
			<label>Description</label>
			<textarea name="txtdesc"></textarea>
			<br>
			<input type="submit" name="btnsend" value="Send">
			<a href='#'><input type="button" name="btncancel" value="Cancel"></a>
</body>
</html>