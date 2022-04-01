<?php 
include 'include/header.php';
include 'fetchmoviedata.php';
include 'include/config.php';
 $error='';
 $updatesuccess='';
 if(empty($_SESSION['userid']))
{
 echo '<script type="text/javascript">
           window.location = "login.php"
      </script>';

}

if(isset($_POST['add']))
{
  if(empty($_POST['pname']) || empty($_POST['visibility'])){ }
  else{
  $pname=$_POST['pname'];
  $visibility=$_POST['visibility'];

  $sql="select * from playlist where userid='".$_SESSION['userid']."' and playlistname='".$pname."' and visibility='".$visibility."'";
  $result=mysqli_query($conn,$sql);
  if(mysqli_num_rows($result) > 0)
  {
    $error= "Playlist already exist";
  }
  else
  {
    $sql="insert into playlist (userid,playlistname,visibility) values('".$_SESSION['userid']."','".$pname."','".$visibility."')";
  mysqli_query($conn,$sql);

  $updatesuccess="Playlist inserted successfully";
  }
}
}


if(isset($_POST['updateplaylist']))
{
   $_POST['visibility'];
   $_POST['id'];
   $sql="update playlist set visibility='".$_POST['visibility']."' where id='".$_POST['id']."'";
   $res=mysqli_query($conn,$sql);
   $sql2="update detailplaylist set visibility='".$_POST['visibility']."' where playlistid='".$_POST['id']."'";
   mysqli_query($conn,$sql2);

   if($res)
   {
    $updatesuccess=" Playlist update successfully";
   }
   else
   {
    $error="failed";
   }
}

if(isset($_POST['updatesinglemovie']))
{

   $_POST['visibility'];
   $_POST['id'];
   $sql2="update detailplaylist set visibility='".$_POST['visibility']."' where playlistid='".$_POST['id']."'";
   mysqli_query($conn,$sql2);

   if($res)
   {
    $updatesuccess=" Movie Playlist update successfully";
   }
   else
   {
    $error="failed to update";
   }
}



if(isset($_POST['delsinglemovie']))
{
  $id= $_POST['smid'];
  $sql="delete from detailplaylist where id='".$id."'";
  if(mysqli_query($conn,$sql))
  {
    $updatesuccess="Delete movie successfully .";
  }
  else
  {
    $error='to delete movie';
  }

}
?>

<div class="container-fluid py-3 px-md-5">
<div class="row">
  <div class="col-md-5 col-xs-12" >
      <div class="card bg-light">
        <div class="row">
          <div class="col-md-12">
            <?php
              if($updatesuccess!='')
                {
                 ?>
                   <div class="alert alert-success fade in alert-dismissible" style="margin-top:18px;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    <strong>Success!</strong> <?php echo $updatesuccess; ?>
                    </font>.
                </div>
                <?php $updatesuccess=''; }  
                   if($error!='') {  ?>
                <div class="alert alert-danger fade in alert-dismissible" style="margin-top:18px;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    <strong>Failed!</strong>
                    <?php  echo $error; ?>.
                </div>
                <?php  $error=''; }  ?>
          </div>
        <div class="col-md-6  col-xs-6">
          <h3 class="card-text text-left" style="margin-left: 30px;">My PlayList </h3>
        </div>
        <div class="col-md-6  col-xs-6 text-right"  >
          <h3>
            <button type="button" style="margin-right: 30px;" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" class="btn btn-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
  <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"></path></svg> </button>
          </h3>
        </div>
      </div>  
     <table class="table table-hover table-striped text-center" >
      <tr>
        <td>Id</td>
        <td>Name</td>
        <td>Visible</td>
        <td>Action</td>
      </tr>
      <?php 
      $sql="select * from playlist where userid='".$_SESSION['userid']."'";
      $res=mysqli_query($conn,$sql);
      while ($r=mysqli_fetch_assoc($res)) {
        $plid=$r['id'];
         $sql2="select * from detailplaylist where playlistid='".$plid."'";
        $res2=mysqli_query($conn,$sql2);
        $cnt=mysqli_num_rows($res2);
       ?>
        <tr>
        <td><?php echo $r['id']; ?></td>
        <td><?php echo $r['playlistname']."<small> movies($cnt)</small>"; ?> </td>
        <td><?php echo $r['visibility']; ?></td>
        <td> 
          <button data-toggle="modal" data-target="#playlistupdate<?php echo $r['id']?>" type="button" class="btn btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
              </svg>
          </button>

          <a href="delplaylist.php?delid=<?php echo $r['id'];  ?>"><button type="button" class="btn btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"></path>
              </svg></button>
          </a>
       </td>
      </tr>

    
<!-- Modal -->
<div id="playlistupdate<?php echo $r['id']?>" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
     <div class="modal-header">
      
       <h4 class="modal-title">Update Playlist</h4> 
      </div>
      <div class="modal-body">
       <form action="" method="post">
        <?php 
      $sql="select * from playlist where id='".$r['id']."'";
      $presult=mysqli_query($conn,$sql);
      while ($rw=mysqli_fetch_assoc($presult)) {

       ?>
        <div class="row">
          <div class="col-md-12">
            <label class="  ">Name</label>
             <input type="text" readonly class="form-control" value="<?php echo $rw['playlistname']; ?>" name="pname"/>
          </div>


            <div class="col-md-12">
            <label class="  ">Visibility</label>
              <select name="visibility"  class="form-control">
                 <option  <?php if($rw['visibility'] == 'private' ) { echo "selected='selected'"; }?> value="private" >Private</option>
                  <option <?php if($rw['visibility'] == 'public' ) { echo "selected='selected'"; }?> value="public" >Public</option>
              </select> 
          </div>

        

          <input type="hidden" name="id" value="<?php echo $r['id']; ?>">
          <div class="col-md-6 col-xs-6 py-4 px-md-5">
           <button class="btn btn-success" name="updateplaylist">Update</button>
          </div>
          <div class="col-md-6 col-xs-6 text-right py-4 px-md-5">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      <?php } ?>
       </form>
      </div>
      
    </div>

  </div>
</div>
<!-- Modal -->


    <?php } ?>

    </table>


  </div>
    
  </div>

  <div class="col-md-7 col-xs-12" >
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
   <div class='col-md-4'>
   <b>Copy link to Share Anyone</b>
   </div>

   <div class='col-md-8'>
   <input type='text' name='' class='form-control' id='myInput' value='$finallink' readonly/>
   </div>
   

   ";

   


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




    <div class="col-md-6 ">
    <div class="card ">
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
            <div class="col-md-12  col-xs-12 text-right">
              <form action="" method="post">
                <input type="hidden" name="smid" value="<?php echo $r2['id']; ?>">
              <button  name="delsinglemovie"class="btn btn-danger">Delete</button>
            </form>
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

<!-- Modal  change single movie status-->
<div id="singlemovieupdate<?php echo $r2['id']?>" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
     <div class="modal-header">
      <h4 class="modal-title">Update Single Movie</h4> 
      </div>
      <div class="modal-body">
       <form action="" method="post">
        <?php 
      $sql="select * from playlist where id='".$r['id']."'";
      $presult=mysqli_query($conn,$sql);
      while ($rw=mysqli_fetch_assoc($presult)) {
       ?>
        <div class="row">
          <div class="col-md-12">
            <label class="  ">Name</label>
             <input type="text" readonly class="form-control" value="<?php echo $playlist['Title'] ."(".$playlist['Year'].")"; ?>" name="pname"/>
          </div>
            <div class="col-md-12">
            <label class="  ">Visibility</label>
              <select name="visibility"  class="form-control">
                 <option  <?php if($rw['visibility'] == 'private' ) { echo "selected='selected'"; }?> value="private" >Private</option>
                  <option <?php if($rw['visibility'] == 'public' ) { echo "selected='selected'"; }?> value="public" >Public</option>
              </select> 
          </div>

            <div class="col-md-12">
            <label class="  ">Playlist Name</label>
              <select name="plname"  class="form-control">
                <?php 
                $sql="select * from playlist where userid='".$_SESSION['userid']."'";
                $playname=mysqli_query($conn,$sql);
                while($nl=mysqli_fetch_assoc($playname))
                {
                 ?>
                 <option value="<?php echo $r['playlistname']; ?>"><?php echo $r['playlistname']; ?></option>
                 <option value="<?php echo $nl['playlistname']; ?>"><?php echo $nl['playlistname']; ?></option>
                <?php } ?>
              </select> 
          </div>

          <input type="hidden" name="id" value="<?php echo $r['id']; ?>">
          <div class="col-md-6 col-xs-6 py-4 px-md-5">
           <button class="btn btn-success" name="updatesinglemovie">Update</button>
          </div>
          <div class="col-md-6 col-xs-6 text-right py-4 px-md-5">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      <?php } ?>
       </form>
      </div>
   </div>
  </div>
</div>
<!-- Modal  change single movie status-->

            </div>
      </div>
    </div>
  </div>



  <?php
  }
  echo "<br>";
      
  }


   ?>



    
  </div>
  




</div>
</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
     <div class="modal-header">
       <h4 class="modal-title">Create Playlist</h4> 
      </div>
      <div class="modal-body">
       <form action="" method="post">
        <div class="row">
          <div class="col-md-12">
            <label class="  ">Name</label>
             <input type="text" class="form-control" name="pname"/>
          </div>
            <div class="col-md-12">
            <label class="  ">Visibility</label>
              <select name="visibility"  class="form-control">
                <option value="">Select Option</option>
                <option value='private'>Private</option>
                <option value='public'>Public</option>
              </select> 
          </div>
          <div class="col-md-12 py-4 px-md-5">
           <button class="btn btn-success" name="add">Add</button>
          </div>
        </div>
       </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal -->






<?php 
include 'include/footer.php';
 ?>

</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</html>
