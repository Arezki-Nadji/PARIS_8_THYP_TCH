<?php
include('../db.php');
include('user_header.php');
$rated = 0;
$sql = "SELECT * FROM `movie` WHERE id=?";
            $response = $con->prepare($sql);
            $response->execute([$_GET['id']]);
            $movie= $response->fetch();
if(isset($_GET['id']))
{
 
    $_SESSION['id_movie']=$_GET['id'];
    $sql = "SELECT DISTINCT rating FROM `user_movie` WHERE id_movie=? AND id_user=?";
            $response = $con->prepare($sql);
            $response->execute([$_SESSION['id_movie'],$_SESSION['id']]);
            $movie_rating = $response->fetch();
            if($movie_rating)
            {
              $rated=1;
              $_SESSION['movie_rating']=$movie_rating['rating'];
              
            }
            
            
    
}
if(isset($_POST['add']))
{
  $sql = "SELECT DISTINCT rating FROM `user_movie` WHERE id_movie=? AND id_user=?";
            $response = $con->prepare($sql);
            $response->execute([$_SESSION['id_movie'],$_SESSION['id']]);
            $movie_rating = $response->fetch();
            if($movie_rating)
            {
              $rated=1;
              $_SESSION['movie_rating']=$movie_rating['rating'];
              
            }
  if($rated){
    $rating = $_POST['rating'];
    $sql = "UPDATE user_movie SET rating=? WHERE id_movie=? AND id_user =?";
    $stmt= $con->prepare($sql);
    $stmt->execute([$rating,$_SESSION['id_movie'],$_SESSION['id']]);
    header('location:movie_details.php?movie_details=Movie+Details&id='.$_SESSION['id_movie']);
  }
  else
  {
    echo "teoost";
  $rating = $_POST['rating'];
  $sql = "INSERT INTO user_movie (id_movie,id_user,rating) VALUES(?,?,?)";
  $stmt= $con->prepare($sql);
  $stmt->execute([$_SESSION['id_movie'],$_SESSION['id'],$rating]);
  header('location:movie_details.php?movie_details=Movie+Details&id='.$_SESSION['id_movie']);
}
}
?>
<div class="container" style="margin: 20px">
  <div class="row">
    <div class="col-md-4">
      <img src="<?php echo '../images/'.$movie['movie_image']; ?>" class="img-fluid" alt="Movie poster">
      <div class="row">
      <div class="col-md-4">
      <form action="movie_details.php" method="post">
        <div class="rateyo" id="rating" data-rateyo-rating="<?php if($rated==1) { echo $movie_rating['rating']; }else {echo "0";}?>" data-rateyo-num-stars="5" data-rateyo-score="3">
    </div>
    
      <span class="result"><?php if($rated==1) { echo "Rating: ".$movie_rating['rating']; }?></span>
      <input type="hidden" id="rating" name="rating" value="<?php if($rated==1) { echo "Rating: ".$movie_rating['rating'];} ?>">
      <input type="hidden" name="id" value="<?php echo $_SESSION['id_movie'] ?>">
      <div><input type="submit" class="btn btn-primary" value="Save" name="add"></div>
    </div>
    </div>
    </form>  
    </div>
    <div class="col-md-8">
      <h1><?php echo $movie['movie_name']; ?></h1>
      <p><b>Release year:</b> January 1, 2020</p>
      <p><b>Genre: </b><?php echo $movie['Category'];?></p>
      <p><b>Director:</b> <?php echo $movie['director'];?></p>
      <p><b>Starring: </b><?php echo $movie['actor'];?></p>
      <p><b>Summary :</b> <?php echo $movie['summary'];?></p>
    </div>
  </div>
</div>

<script>
    $(function()
    {
        $(".rateyo").rateYo().on("rateyo.change",function(e,data){
            var rating = data.rating;
            $(this).parent().find('.score').text('score:'+$(this).attr('data-rateyo-score'));
            $(this).parent().find('.result').text("Rating: "+ rating);
            $(this).parent().find('input[name="rating"]:hidden').val(rating);

        });
    });
</script>