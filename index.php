<?php 
include 'include/header.php';
include 'fetchmoviedata.php';
include 'include/config.php';

 if(isset($_POST['search']))
{
	$mname=$_POST['moviename'];
	$data = getImdbRecord($mname);

  if($data['Response']=='True')
  {
    $res=$data['Response'];
  }
  else
  {
    $error="failed to find moviename";
  }
}

if(isset($_POST['add']))
{
  $plist=$_POST['playlist'];
  $imdbid=$_POST['imdbid'];

  $sql2="select * from playlist where userid='".$_SESSION['userid']."' and id='".$plist."'";
  $res2=mysqli_query($conn,$sql2);
  $row=mysqli_fetch_assoc($res2);
  $pname=$row['playlistname'];
  $visible=$row['visibility'];
 $sql="INSERT INTO detailplaylist (playlistname,visibility,playlistid,userid,movieid) VALUES ('".$pname."','".$visible."','".$plist."','".$_SESSION['userid']."','".$imdbid."')";
 mysqli_query($conn,$sql);
}

?>
<div class="container-fluid py-3 px-md-5">
<div class="row">
  <div class="col-md-12">
    <div class="card" style="height: 300px;  background-image: url('banner.jpg');">
      <div class="card-body">
      	<div class="text-center">
                <div class="row">
        <div class="col-lg-4 col-lg-offset-4">
           <div class="input-group" style="margin-top: 100px;">
          <form  method="post" action="">
            <div class="form-group">
            <div class="input-group">
            <input id="1" class="form-control input-lg" type="text" name="moviename" placeholder="Search here Movie..." required/>
            <span class="input-group-btn">
            <button class="btn btn-warning btn-lg"  name="search" type="submit">
            <i class="glyphicon glyphicon-search"  aria-hidden="true"></i> Search
            </button>
            </span>
            </div>
            </div>
            </form>
        </div><!-- /input-group -->
    </div><!-- /.col-lg-4 -->
</div><!-- /.row -->
<style type="text/css">
  .col-centered{
    width: 100%;
    margin: 0 auto;
    float: none;
}
</style>

      	</div>
      </div>
    </div>
  </div>

<?php 

if(!empty($res))
{
 ?>

<div class="col-md-4">
  <img  height="450px;" width="130px;"  src="<?php echo $data['Poster']; ?>" class="card-img-top" alt="...">
  
</div>
<div class="col-md-8">

    <h5 class="card-title"><i><b>Title :</b> </i><?php echo $data['Title'] ."(".$data['Year'].")"; ?></h5>
    <p class="card-text"><i><b>Desc :</b> </i><?php echo $data['Plot']; ?></p>
      <p class="card-text"><i><b>Genrec :</b> </i><?php echo $data['Genre']; ?></p>
      <p class="card-text"><i><b>Type :</b> </i><?php echo $data['Type']; ?></p>
   

    <table class="table">
      <tr>
        <td><i><b>Rating : </b> </i><?php echo $data['Rated']; ?></td>
        <td><i><b>Release : </b></i> <?php echo $data['Released']; ?></td>
        <td><i><b>Duration : </b></i> <?php echo $data['Runtime']; ?></td>
      </tr>
        <tr>
        <td><i><b>Director : </b> </i><?php echo $data['Director']; ?></td>
        <td><i><b>Writer : </b></i> <?php echo $data['Writer']; ?></td>
        <td><i><b>Actor : </b></i> <?php echo $data['Actors']; ?></td>
      </tr>
      <tr>
        <td><i><b>Language : </b> </i><?php echo $data['Language']; ?></td>
        <td><i><b>Country : </b></i> <?php echo $data['Country']; ?></td>
        <td><i><b>Award : </b></i> <?php echo $data['Awards']; ?></td>
      </tr>
      <tr>
        <td><i><b>IMDB Rating : </b> </i><?php echo $data['imdbRating']; ?></td>
        <td><i><b>IMDB Votes : </b></i> <?php echo $data['imdbVotes']; ?></td>
        <td><i><b>Ratings : </b></i> <?php echo $data['Ratings'][0]['Value'];?></td>
      </tr>
    </table>
  <input type="hidden" name="imdbid" value="<?php echo $data['imdbID']; ?>">
     <button class="btn btn-warning" onClick="userValidate()" data-toggle="modal" data-target="#myModal" name="addtoplaylist">Add in PlayList</button>
</div>  

<input type="hidden" id="checkLogin" value="<?php echo $_SESSION['userid']?>">


<?php } ?>


<div class="col-md-12"></div>



<br>
<?php
if(isset($_SESSION['userid']))
{ 

  echo"<div class='col-md-12'><h3 class='text-center'>All Movies</h3></div>";
  $sql="select * from detailplaylist where userid='".$_SESSION['userid']."' order by id desc";
  $res=mysqli_query($conn,$sql);
  while ($row=mysqli_fetch_assoc($res)) 
  {
    $playlist=getImdbRecordId($row['movieid']);  
 ?>
 <div class="col-md-3 " style="height:500px; overflow: hidden;">
    <div class="card " style="height:470px; overflow: hidden;">
      <div class="card-body">
        <div class="text-left">
            <div class="imageselect row add-clearfix image-imagebox">
                    <article class="imagebox">
                        <figure>
                            <img  height="250px;" width="50px;"  src="<?php echo $playlist['Poster']; ?>" class="card-img-top" alt="...">
                            <figcaption> 
                                <small style="color:white">Story :<?php echo $playlist['Plot']; ?></small>
                            </figcaption>
                        </figure>
                    </article>
            </div>
            <h4><?php echo $playlist['Title'] ."(".$playlist['Year'].")"; ?></h4>
             <p>Release :<?php echo $playlist['Released']; ?></p>
              <p>Director :<?php echo $playlist['Director']; ?></p>
              <p>Writer :<?php echo $playlist['Writer']; ?></p>
            <p>Genrec: <?php echo $playlist['Genre']; ?></p>
            <p>Rating: <?php echo $playlist['imdbRating']; ?></p>
            </div>
      </div>
    </div>
  </div>
<?php } ?>

<?php } ?>

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

<!-- Modal -->

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
       <?php
      if(empty($_SESSION['userid']))
      {
       ?>
      <div class="modal-header">
         <h4 class="modal-title"><a href="login.php">Please Login to Add Movie in play list</a></h4> 
      </div>
       <?php
      } 
      else{
      $sql="select * from playlist where userid='".$_SESSION['userid']."'";
      $result=mysqli_query($conn,$sql);
      $count=mysqli_num_rows($result);
      if($count>0)
      {
       ?>
       <div class="modal-header">
         <h4 class="modal-title">Add Movies in Playlist</h4> 
      </div>

      <div class="modal-body">
       <form action="" method="post">
        <div class="row"> 
            <div class="col-md-12">
            <label class="  ">Playlist Name :</label>
              <select name="playlist" required class="form-control">
                <option value="">Select Option</option>
                <?php 
                $sql="select * from playlist where userid='".$_SESSION['userid']."'";
                $res=mysqli_query($conn,$sql);
                while ($r=mysqli_fetch_assoc($res)) {
                 ?>
                <option value='<?php echo $r['id']; ?>'><?php echo $r['playlistname']." (".$r['visibility'].")"; ?></option>
                  <?php } ?>
              </select> 
             <input type="hidden" name="imdbid" value="<?php echo $data['imdbID']; ?>">
          </div>
          <div class="col-md-12 py-4 px-md-5">
           <button class="btn btn-warning" name="add">Add</button>
          </div>
        </div>
       </form>
      </div>
    <?php
     }
     else{
     ?>
     <h4 class="modal-title text-center">Your Playlist Are empty please create</h4> 
      <div class="col-md-12 py-4 px-md-5">
           <a href="myplaylist.php"><button class="btn btn-warning" name="add">Create</button></a>
          </div>
     <?php } ?>


      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<?php } ?>

<div class="col-md-12 col-xs-12" >
      <div class="card bg-light">
    <div class="card-body text-center">
      <h4 class="card-text text-center"><b>My PlayList Movies</b></h4>
    </div>
  </div>
  <?php 
  $sql="select * from playlist where userid='".$_SESSION['userid']."'";
  $res=mysqli_query($conn,$sql);
  while ($r=mysqli_fetch_assoc($res)) 
  {
    $plid=$r['id'];
    $plname=$r['playlistname'];
    $visibility=$r['visibility'];

     $sql2="select * from detailplaylist where playlistid='".$plid."'";
  $res2=mysqli_query($conn,$sql2);

    $cnt=mysqli_num_rows($res2);
    if($cnt<1)
    {

    }
    else {
      if($visibility=='public')
      {
        $publicpath="http://localhost/movie_laibrary/publicshare.php?id=";
        $suid=$_SESSION['userid'];
        $plnm=$plname;
        $pviblty=$visibility;
        $finallink= $publicpath.$suid."&".$plnm."&".$pviblty;
       echo "<div class='col-md-12'>
    <h4>$plname($visibility) ($cnt movies) </h4></div>";



   echo"
   <div class='col-md-12'>
   <b style='color:black;'>Copy link to Share Anyone : <font style='background-color:black;color:white;'>$finallink</fornt></b>
   </div>";


 }
 else
 {
   echo "<div class='col-md-12'>

    <h4>$plname($visibility) ($cnt movies)</h4>

   </div>";

 }
    }


   
  while ($r2=mysqli_fetch_assoc($res2)) 
  {
    $playlist=getImdbRecordId($r2['movieid']);  
    ?>


   <div class="col-md-3 ">
    <div class="card " style="height:470px; color:black; overflow: hidden;">
      <div class="card-body">
        <div class="text-left">
            <div class="imageselect row add-clearfix image-imagebox">
                    <article class="imagebox">
                        <figure>
                            <img  height="250px;" width="50px;"  src="<?php echo $playlist['Poster']; ?>" class="card-img-top" alt="...">
                            <figcaption> 
                                <small style="color:white">Story :<?php echo $playlist['Plot']; ?></small>
                            </figcaption>
                        </figure>
                    </article>
            </div>
            <h4><?php echo $playlist['Title'] ."(".$playlist['Year'].")"; ?></h4>
             <p>Release :<?php echo $playlist['Released']; ?></p>
              <p>Director :<?php echo $playlist['Director']; ?></p>
              <p>Writer :<?php echo $playlist['Writer']; ?></p>
            <p>Genrec: <?php echo $playlist['Genre']; ?></p>
            <p>Rating: <?php echo $playlist['imdbRating']; ?></p>
            </div>
      </div>
    </div>
  </div>


  <?php
  }
  echo "<br>";
      
  }


   ?>



    
  </div>--add>

</body>
<?php
include 'include/footer.php';
?>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</html>
