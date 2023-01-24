<?php
include('admin_header.php');
include('../db.php');
$flag = 0;
if(isset($_POST['submit']))
{
    $sql = "INSERT INTO movie (movie_name,category,movie_image,summary,actor,director) VALUES (?,?,?,?,?,?)";
    $result= $con->prepare($sql);
    // File name
    $filename = $_FILES['movie_image']['name'];
      
    // Location
    $target_file = '../images/'.$filename;
  
    // file extension
    $file_extension = pathinfo(
        $target_file, PATHINFO_EXTENSION);
         
    $file_extension = strtolower($file_extension);
  
    // Valid image extension
    $valid_extension = array("png","jpeg","jpg");
  
    if(in_array($file_extension, $valid_extension)) {
        if(move_uploaded_file(
            $_FILES['movie_image']['tmp_name'],
            $target_file)
        ) {
            $result->execute([$_POST['movie_name'], $_POST['movie_category'],$_FILES['movie_image']['name'],$_POST['summary'],$_POST['actor'],$_POST['director']]);
        }
    }
    if($result)
    {
        $flag = 1;
    }
}
?>
<div class="panel panel-default" style="margin:20px;">
    <?php if($flag){ ?>
         <div class="alert alert-success">Movie Successfully Inserted in the database 

         
        </div>
    <?php } ?>


    
            <div class="row">
                <div class="col-md-12">
                    <form action ="admin_add_movie.php" method="post" enctype='multipart/form-data'>

                            <div class="form-group">
                                <label for="movie_image">Movie Jacket</labes>
                                <input type="file" class="form-control-file" name="movie_image" id="movie_image" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="movie_name">Movie Name</labes>
                                <input type="text" name="movie_name" id="movie_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="movie_category">Movie category</labes>
                                <input type="text" name="movie_category" id="movie_category" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="summary">Movie Summary</labes>
                                <textarea class="form-control" rows="3" name="summary" id="summary" class="form-control" required> </textarea>
                            </div>
                            <div class="form-group">
                                <label for="actor">Movie Actor</labes>
                                <input type="text" name="actor" id="actor" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="director">Movie Actor</labes>
                                <input type="text" name="director" id="director" class="form-control" required>
                            </div>
                        
                        <div class="form-group">
                            <input type="submit" name="submit" value="submit" class="btn btn-primary" required>
                        </div>
                </form>
            </div>
        </div>
<div></div>