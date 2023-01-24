<?php
include('admin_header.php');
include('../db.php');
$flag =0;
?>
<div class="panel panel-default" style="margin:20px">
    <div class="panel-heading">
    <h2>
        <a class="btn btn-success" href="admin_add_movie.php"> Add Movie </a>
    </h2>
    </div>

    <div class="panel-body">
        <table class="table table-stripped">
        <th>Movie Title</th>
        <th>Delete</th>
        <th>Update</th>
        <th>Details</th>
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
        <tr><td> <?php echo $movie['movie_name'] ?></td>
        <td>
            <form action="admin_delete_movie.php">
                <input type="submit" name="delete_movies" value="Delete Movie" class="btn btn-danger">
                <input type="hidden" name="id" value="<?php echo $movie['id'] ?>">
            </form>
        </td>

        <td>
            <form action="delete_movie.php">
                <input type="submit" name="update" value="update" class="btn btn-warning">
                <input type="hidden" name="id" value="<?php echo $movie['id'] ?>">
            </form>
        </td>

        <td>
            <form action="movie_details.php">
                <input type="submit" name="details" value="Show Details" class="btn btn-primary">
                <input type="hidden" name="id" value="<?php echo $movie['id'] ?>">
            </form>
         
        </td>
        </tr>

        <?php }} ?>
            
        </table>
    </div>
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
