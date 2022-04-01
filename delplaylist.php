<?php
session_start();
include 'include/config.php';
if(isset($_SESSION['userid']))
{

$id=$_GET['delid'];
$sql="delete from playlist where id='".$id."'";
mysqli_query($conn,$sql);

$sql2="delete from detailplaylist where playlistid='".$id."'";
mysqli_query($conn,$sql2);

header("location:myplaylist.php");
}

else{
	header("location:login.php");
}


 ?>