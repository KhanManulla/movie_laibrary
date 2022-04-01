<?php 
include 'include/header.php';
include 'fetchmoviedata.php';
include 'include/config.php';

if(empty($_SESSION['userid']))
{
  echo '<script type="text/javascript">
           window.location = "login.php"
      </script>';
}

?>


<div class="container-fluid py-3 px-md-5">
<div class="row"><!---row-->
 <div class="col-md-12"></div>

 <div class="row"><!---row-->



 	<div class="col-md-12">
<?php

  $sql="select * from detailplaylist where  visibility='public'  order by id desc";
  $res=mysqli_query($conn,$sql);
  while ($row=mysqli_fetch_assoc($res)) 
  {
    $playlist=getImdbRecordId($row['movieid']);  
    $uid=$row['userid'];
    $sql2="select * from user where id='".$uid."'";
    $res2=mysqli_query($conn,$sql2);
    $name=mysqli_fetch_assoc($res2);
    $n=$name['name'];
 ?>

 <div class="col-md-3 "style="height:500px;  overflow: hidden;">
    <div class="card ">
        
                    
      <div class="card-body">
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
      	<!--<p>User Name: <?php echo  $n; ?></p>-->
        <div class="text-left" >
            <h4><?php echo $playlist['Title'] ." (".$playlist['Year'].")"; ?></h4>
             <small>Release :<?php echo $playlist['Released']; ?></small><br>
             <small>Director :<?php echo $playlist['Director']; ?></small><br>
              <small>Writer :<?php echo $playlist['Writer']; ?></small><br>
            <!--<p>Story :<?php echo $playlist['Plot']; ?></p>-->
           <small>Genrec: <?php echo $playlist['Genre']; ?></small><br>
           <small>Rating: <?php echo $playlist['imdbRating']; ?></small>
            </div>
      </div>
    </div>
  </div>
  
            
<?php } //}?>
</div><!---col-md-9-->
</div><!---row-->
</div><!---row-->
</div><!--container-->

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
include 'include/footer.php';
 ?>

</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</html>
