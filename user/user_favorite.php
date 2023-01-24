<?php
include('user_header.php');
include('../db.php');
?>
<div class="container" style="margin-rigth:70px">
<?php 

            $count=$con->prepare("SELECT count(id_favorite) as cpt FROM user_favorite WHERE id_user=?");
            $count->execute([$_SESSION['id']]);
            $tcount = $count->fetchAll();

            if(empty($_GET['page'])) { $page=1; } else{$page=$_GET['page'];} 
       
            
            
            $nb_element_par_page=8;
            $nbr_depage=ceil($tcount[0]["cpt"]/$nb_element_par_page);
            $debut=($page-1)*$nb_element_par_page;

            $sql = "SELECT * FROM movie WHERE(SELECT id_movie FROM user_favorite WHERE movie.id=user_favorite.id_movie AND user_favorite.id_user=?)";
            $response = $con->prepare($sql);
            $response->execute([$_SESSION['id']]);
            if($row=$response->fetchAll())
            {
                
                    foreach($row as $movie){    
                        $sql = "SELECT * FROM user_favorite WHERE id_movie=? AND id_user=?";
                        $response = $con->prepare($sql);
                        $response->execute([$movie['id'],$_SESSION['id']]);
                        $fav = $response->fetch();
            
                
        ?>

    <div class="card" style="width: 15rem;margin: 15px; display:inline-block;">
        <img class="card-img-top img-fluid" src="<?php echo '../images/'.$movie['movie_image']; ?>" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title"><?php echo $movie['movie_name'] ?> </h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <div class="row">
                <div class="col-lg-3">
            <form class="form-inline" action="movie_details.php">
                <button type="submit" name="movie_details" class="btn btn-warning fa-solid fa-circle-info"></button>
                <input type="hidden" name="id" value="<?php echo $movie['id'] ?>">
            </form>
                </div>
                <div class="col-lg-2">
                <?php 
                if(isset($fav['id_movie'])){ ?>   
            <form class="form-inline" action="delete_favorite.php" method="post">            
                <button type="submit" name="del_fav" class="btn btn-danger fa-solid fa-star"> Favorite</button>
                <input type="hidden" name="id" value="<?php echo $movie['id'] ?>">
            </form>
            <?php } else { ?>
                <form class="form-inline" action="make_favorite.php" method="post">            
                    <button type="submit" name="fav" class="btn btn-danger fa-regular fa-star"> Favorite</button> 
                <input type="hidden" name="id" value="<?php echo $movie['id'] ?>">
            </form>
                <?php }?>
                </div>
            </div>
        </div>
    </div> 
    <?php }} ?>
</div>
<div class="container" style="margin-left:550px">
<?php
    if($page!=1){
        $prev=$page-1;
        echo "<a href='?page=$prev'><<</a>&nbsp;";
    }

    for($i=1;$i<=$nbr_depage;$i++)
    {
        if($page!=$i)
        {
        echo "<a href='?page=$i'>$i</a>&nbsp;";
        }
        else
        {
            echo "<a>$i</a>&nbsp;";
        }
    } 
    if($page!=$nbr_depage){
        $prev=$page+1;
        echo "<a href='?page=$prev'>>></a>&nbsp;";
    }
    ?>
</div>
