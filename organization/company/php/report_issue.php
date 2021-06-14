<?php 
session_start();
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
          echo "<script>window.location='index.php'</script>";
      }
      else
      {
        echo "<p>Error in sending feedback:" .mysql_error()."</p>";
      }
}
?>