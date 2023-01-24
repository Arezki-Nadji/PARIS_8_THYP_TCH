<?php
include('../db.php');
include('user_header.php');
include('recommand.php');
            $sql = "select * from user_movie";
            $response = $con->prepare($sql);
            $response->execute();
            if($row=$response->fetchAll())
            {
                foreach($row as $movie)
                {
                    $sql = "select movie_name from movie where id=$movie[id_movie]";
                    $response = $con->prepare($sql);
                    $response->execute();
                    $movie_name = $response->fetch();

                    $sql = "select username from user where id_user=$movie[id_user]";
                    $response = $con->prepare($sql);
                    $response->execute();
                    $username = $response->fetch();

                    $matrix[$username['username']][$movie_name['movie_name']]=$movie['rating'];
                }
}          


?>
<div class="panel-body">
        <div class="container">
        <?php 
           $recommendation=getRecommendation($matrix, $_SESSION['username']);
           foreach($recommendation as $movie_rated=>$rating)
           {
            $sql = "SELECT * FROM movie WHERE movie_name='$movie_rated'";
                    $response = $con->prepare($sql);
                    $response->execute();
                    $movie = $response->fetch()
        ?>
    <div class="card" style="width: 15rem;margin: 15px; display:inline-block;">
        <img class="card-img-top" src="<?php echo '../images/'.$movie['movie_image']; ?>" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title"><?php echo "Title : " .$movie['movie_name'] ?> </h5>
            <p class="card-text"><div id="container"><p><?php echo "Predected rating : " .round($rating,1) ?><p></div></p>
            <form action="movie_details.php">
                <input type="submit" name="movie_details" value="Movie Details" class="btn btn-warning">
                <input type="hidden" name="id" value="<?php echo $movie['id'] ?>">
                
            </form>
        </div>
    </div> 

        <?php } ?>

        