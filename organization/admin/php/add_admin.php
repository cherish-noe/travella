<?php 
include('connect.php');
require('AutoID_Function.php');
session_start();
//save button
if (isset($_POST['btnadd'])) 
{
  if(strcmp($_SESSION['code'],$_POST['code'])!=0)
  {
    echo"<script>window.alert('Security Does Not Match')</script>";
  }
  else
  {
      $adminID=AutoID('Admin','AdminID','AD-',3);
      $Name=$_POST['txtname'];
      $email=$_POST['txtemail'];
      $password=$_POST['txtpassword'];
    
  //checking the duplicate data
  $samecheck="SELECT * FROM admin
              WHERE ADMIN_NAME='$Name'
              OR EMAIL='$email'";
  $retcheck=mysql_query($samecheck);
  $countrow=mysql_num_rows($retcheck);

  if($countrow!==0)
  {
    echo "<script>window.alert('Admin $Name Already Exist.')</script>";
    echo "<script>window.location='../admin_registration.php'</script>";
  }
  else
  {
    $insertadmin="INSERT INTO admin
            (ADMINID,ADMIN_NAME,EMAIL,PASSWORD)
            VALUES
            ('$adminID','$Name','$email','$password')";
    $retadmin=mysql_query($insertadmin);

      if($retadmin)
      {
          echo "<script>window.alert('Admin Successfully Added.')</script>";
          echo "<script>window.location='../admin_registration.php'</script>";
      }
      else
      {
        echo "<p>Error in Admin Infomation Insert:" .mysql_error()."</p>";
      }
    }
  }
}
//End of save

//update
if(isset($_GET['Mode']))
{
  $adminid=$_GET['AdminID'];
  $select="SELECT * FROM admin WHERE ADMINID='$adminid'";
  $ret=mysql_query($select);
  $row=mysql_fetch_array($ret);
  $adminName=$row['ADMIN_NAME'];
  $email=$row['EMAIL'];
}
if (isset($_POST['btnupdate']))
{
  $up_Adminid=$_POST['txtadminID'];
  $up_adminName=$_POST['txtname'];
  $up_email=$_POST['txtemail'];
  
  $update="UPDATE admin
       Set ADMIN_NAME='$up_adminName',
           EMAIL='$up_email'
       WHERE ADMINID='$up_Adminid'";
  $ret=mysql_query($update);

  if($ret)
  {
    echo "<script>window.alert('Admin Successfully Updated.')</script>";
    echo "<script>window.location='../admin_registration.php'</script>";
  }
    else
  {
    echo "<p>Error in Admin Update:" .mysql_error()."</p>";
  }
}
//End of Update
//Delete
if(isset($_GET['Mode1']))
{
  $aID=$_GET['Aid'];
  $Delete="DELETE FROM admin WHERE ADMINID='$aID'";
  $execute=mysql_query($Delete);

  if ($execute) 
  {
    echo "<script>window.alert('Admin Info Deleted Successfully!')</script>";
    echo "<script>window.location='admin_registration.php'</script>";
  }
  else
  {
    echo "<p>Error in Admin Info Deleting Process.".mysql_error()."</p>";
  }
//End of Delete
}
//admin table
function displayAdmin()
{
 $select="SELECT * FROM admin ORDER BY ADMINID";
    $ret=mysql_query($select);
    $count=mysql_num_rows($ret);

    for ($i=0; $i < $count; $i++) 
    { 
    $row=mysql_fetch_array($ret);
    $AdminID=$row['ADMINID'];
    echo "<tr>";
      echo "<td>".$AdminID."</td>";
      echo "<td>".$row['ADMIN_NAME']."</td>";
      echo "<td>".$row['EMAIL']."</td>";
      echo "<td><a href='admin_registration.php?AdminID=$AdminID&Mode=Update'><i class='fa fa-edit' style='font-size:20px;color:#009900;'></i>&nbsp;</a> | <a href='admin_registration.php?Aid=$AdminID&Mode1=Delete'>&nbsp;<i class='fa fa-trash' style='font-size:20px;color:#e60000'></i></a></td>";
    echo "</tr>";
    }
}
?>