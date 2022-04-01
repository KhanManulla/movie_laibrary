<?php
session_start();
include 'include/config.php';
include 'fetchmoviedata.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<link rel="stylesheet" type="text/css" href="css/style.css">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>

<header class="p-3 bg-dark text-white">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="index.php" class="nav-link px-20 text-secondary">Home</a></li>
          <li><a href="myplaylist.php" class="nav-link px-20 text-white">Playlist</a></li>
          <li><a href="explore.php" class="nav-link px-20  text-white">Explore</a></li>
        </ul>

        <?php
        if(isset($_SESSION['userid']))
        { ?>

          <div class="text-end">
          <a href="signout.php"><button type="button" class="btn btn-danger">Sign-out</button></a>
        </div>


        <?php } else {?>

        <div class="text-end">
          <a href="login.php"><button type="button" class="btn btn-outline-light me-2">Login</button></a>
          <a href="signup.php"><button type="button" class="btn btn-warning">Sign-up</button></a>
        </div>
      <?php } ?>


      </div>
    </div>
  </header>
  <div class="b-example-divider"></div>

<div class="container-fluid py-3 px-md-5">
<div class="row"><!---row-->
 <div class="col-md-12"></div>

 <div class="row"><!---row-->

 	<div class="col-md-12">
<?php

if(isset($_GET['id']))
{
 
$url =$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$a=explode('/', $url);
$b=explode("=", $a[2]);
$c=explode('&', $b[1]);
if($c[2]=='public')
{
 $sql="SELECT * FROM detailplaylist WHERE playlistname='".$c[1]."' and visibility='".$c[2]."' and userid='".$c[0]."'";
	$result=mysqli_query($conn,$sql);
		if($result)
		{
			if(mysqli_num_rows($result)>0)
			{
				while ($row=mysqli_fetch_assoc($result))
				 {
				 	$publist=getImdbRecordIdpubshare($row['movieid']); 
				 	?>

					 <div class="col-md-4 ">
					    <div class="card ">
					      <div class="card-body">
					        <div class="text-left">
					            
                                 <div class="imageselect row add-clearfix image-imagebox">
                                                    <article class="imagebox">
                                                        <figure>
                                                            <img  height="250px;" width="50px;"  src="<?php echo $publist['Poster']; ?>" class="card-img-top" alt="...">
                                                            <figcaption> 
                                                                <small style="color:white">Story :<?php echo $publist['Plot']; ?></small>
                                                            </figcaption>
                                                        </figure>
                                                    </article>
                                            </div>
					            <h4><?php echo $publist['Title'] ." (".$publist['Year'].")"; ?></h4>
					             <p>Release :<?php echo $publist['Released']; ?></p>
					              <p>Director :<?php echo $publist['Director']; ?></p>
					              <p>Writer :<?php echo $publist['Writer']; ?></p>
					            <p>Genrec: <?php echo $publist['Genre']; ?></p>
					            <p>Rating: <?php echo $publist['imdbRating']; ?></p>
					            </div>
					      </div>
					    </div>
					  </div>
					  
					  
					  <style>
.imageselect .imagebox {
    position: relative
}
.imageselect .imagebox figure {
    position: relative;
    overflow: hidden
}
.imageselect .imagebox figcaption {
    background: rgba(45, 62, 82, 0.9);
    position: absolute;
    left: 0px;
    right: 0px;
    bottom: 0px;
    padding: 20px;
    -webkit-transform: translateY(140%);
    -moz-transform: translateY(140%);
    -ms-transform: translateY(140%);
    -o-transform: translateY(140%);
    transform: translateY(140%);
    -moz-transition: -moz-transform 0.5s ease;
    -o-transition: -o-transform 0.5s ease;
    -webkit-transition: -webkit-transform 0.5s ease;
    -ms-transition: -ms-transform 0.5s ease;
    transition: transform 0.5s ease
}
.imageselect .imagebox .caption-title {
    margin-bottom: 0;
    color: #fff
}
.imageselect .imagebox .price {
    color: #fdb714
}
.imageselect .imagebox:hover figcaption {
    -webkit-transform: translateY(0);
    -moz-transform: translateY(0);
    -ms-transform: translateY(0);
    -o-transform: translateY(0);
    transform: translateY(0)
}
.price {
    color: #f0715f;
    font-size: 1.6667em;
    text-transform: uppercase;
    float: right;
    text-align: right;
    line-height: 1;
    display: block
}
</style>
		<?php		
	}
			}
			else
			{
				echo "sorry this playlist appears to be missing please ask to resend it.";
			}
		}
		else
		{
			echo "something wrong please resend link";
		}
}
	else
	{
		echo "you are not authotize to access";
	}

}/////if end
else
{
	echo "<h2><P class='blocktext'>Direct Access Forbidden</P></h2>";
}


 ?>
 
 
 



 <style type="text/css">
 	P.blocktext {
 	margin-top: 200px;
 	margin-bottom: auto;
    margin-left: auto;
    margin-right: auto;
    width: 15em
}
 </style>

 </div><!---col-md-9-->
</div><!---row-->
</div><!---row-->
</div><!--container-->

<?php
include 'include/footer.php';
?>



</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</html>
