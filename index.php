
<!-- database connection code -->

<?php 

 $db = mysqli_connect("localhost", "root", "", "newstoday");

 if($db){
  //echo "Database connection established!";
 }else{
  echo "Database connection error!";
 }

 ob_start();

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- custom css file link -->
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <title>News Today!</title>
  </head>
  <body>

    <center class="my-5">
      <h1>CRUD Operation in PHP</h1>
    </center>

    <div class="container">
      <div class="row">
        <!-- form (create operation) -->
        <div class="col-md-6">
          <form method="POST">
            <div class="mb-3">
               <label for="exampleFormControlInput1" class="form-label">Add New Category</label>
               <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Category Name"  name="cat_name"> 
             </div>
             <div class="mb-3">
               <label for="exampleFormControlTextarea1" class="form-label">Category Description</label>
               <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="desc"></textarea>
                </div>
                <input type="submit"class="btn btn-md btn-primary" name="add_cat" value="Add Category">
          </form>
        </div>

        <?php

        // create operation
        if(isset($_POST['add_cat'])){
          $cat_name = $_POST['cat_name'];
          $cat_desc = $_POST['desc'];

          // send value to the database


          $sql = "INSERT INTO category (c_name,c_description) VALUES ('$cat_name','$cat_desc')";
          $result = mysqli_query($db,$sql);

          if ($result){
            //echo "Value inserted!";
          }else{
            echo "Insert error!";
          }

        }

       ?>
        <!-- table (read operation) -->
        <div class="col-md-6">
          <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

    <?php

    // read from database
    //3

    $sql2 = "SELECT * from category";
    $result = mysqli_query($db,$sql2);

    $count = 0;

    while($row = mysqli_fetch_assoc($result)){
      $c_id = $row['c_id'];
      $c_name = $row['c_name'];     
      $c_description = $row['c_description'];
      $count++;

      ?>

      <tr>
      <th scope="row"><?php echo $count?></th>
      <td><?php echo $c_name;?></td>
      <td><?php echo $c_description;?></td>
      <td>
        <a href="">
          <span class="badge bg-warning text-dark">Edit</span>
        </a>

        <a href="index.php?delete_id=<?php echo $c_id;?>">
          <span class="badge bg-danger">Delete</span>
        </a>
      </td>
    </tr>

    <?php

    }

    ?>

  </tbody>
</table>

        </div>
      </div>
    </div>

    <?php

    // delete operation

    if(isset($_GET['delete_id'])){
      $del_id = $_GET['delete_id'];

      // delete

      $sql3 = "DELETE FROM category WHERE c_id = '$del_id'";
      $result = mysqli_query($db,$sql3);

      if($result){
        //echo "Successfully deleted!";
        header('Location: index.php');
      }else{
        echo "delete Operation error!";
      }




    }

    ?>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <?php
    ob_end_flush();

    ?>

  </body>
</html>
