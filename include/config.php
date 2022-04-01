<?php 

$host="localhost";//hostname
$user="root";//username
$password="";//password
$database="movie_laibrary";//database password

$conn=mysqli_connect($host,$user,$password,$database);

if($conn)
{
	//echo "connected";
}
else
{
	//echo "failed";
}

 ?>