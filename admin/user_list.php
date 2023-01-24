<?php
include('admin_header.php');
include('../db.php');
$flag =0;
?>
<div class="panel panel-default" style="margin:20px">
    <div class="panel-body">
        <table class="table table-stripped">
        <th>Movie Title</th>
        <th>Delete</th>
        <th>Ban</th>
        <?php 
            

            $count=$con->prepare("SELECT count(id_user) as cpt FROM user");
            $count->execute();
            $tcount = $count->fetchAll();

            if(empty($_GET['page'])) { $page=1; } else{$page=$_GET['page'];} 
            $nb_element_par_page=8;
            $nbr_depage=ceil($tcount[0]["cpt"]/$nb_element_par_page);
            $debut=($page-1)*$nb_element_par_page;


            $sql = "SELECT * FROM user LIMIT $debut,$nb_element_par_page";
            $response = $con->prepare($sql);
            $response->execute();
            if($row=$response->fetchAll())
            {
               
                    foreach($row as $user){
            
                
        ?>
        <tr><td> <?php echo $user['username'] ?></td>
        <td>
            <form action="admin_delete_user.php">
                <input type="submit" name="delete_user" value="Delete User" class="btn btn-danger">
                <input type="hidden" name="id_user" value="<?php echo $user['id_user'] ?>">
            </form>
        </td>

        <td>
            <form action="admin_ban_user.php">
                <?php if($user['ban_status']==1){ ?>
                    <input type="submit" name="ban_user" value="Unban User" class="btn btn-warning">
                <?php }else {?>
                
                <input type="submit" name="ban_user" value="Ban User" class="btn btn-warning">
                <?php } ?>
                <input type="hidden" name="id_user" value="<?php echo $user['id_user'] ?>">
                <input type="hidden" name="ban_status" value="<?php echo $user['ban_status'] ?>">
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


