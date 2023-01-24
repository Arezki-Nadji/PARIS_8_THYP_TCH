<?php
include('admin_header.php');
include('../db.php');

?>
<div class="container" style="margin-rigth:10px">
<?php 

            $count=$con->prepare("SELECT count(id) as cpt FROM movie");
            $count->execute();
            $tcount = $count->fetchAll();

            if(empty($_GET['page'])) { $page=1; } else{$page=$_GET['page'];} 
            $nb_element_par_page=8;
            $nbr_depage=ceil($tcount[0]["cpt"]/$nb_element_par_page);
            $debut=($page-1)*$nb_element_par_page;

            
            $sql = "SELECT * FROM movie LIMIT $debut,$nb_element_par_page";
            $response = $con->prepare($sql);
            $response->execute();
            if($row=$response->fetchAll())
            {
               
                    foreach($row as $movie){
            
                
        ?>

<div class="card" style="width: 15rem;margin: 10px; display:inline-block;">
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
            <form class="form-inline" action="movie_details.php">
                <button type="submit" class="btn btn-danger fa-regular fa-star"> Favorite</button>
                <input type="hidden" name="id" value="<?php echo $movie['id'] ?>">
            </form>
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