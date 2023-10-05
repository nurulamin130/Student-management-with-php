<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Students Management System</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    
  </head>
  <body>
    <div class="container">
     
        <br />
       
        <br />
        <br />
        <h1 class="text-center ">Welcome to Students Management System</h1>
        <br />

        <div class="row">
            <div class="col-sm-4  col-sm-offset-4">
            <form action="" method="POST">
            <table class="table table-bordered">
                <tr>
                   <td colspan="2" class="text-center"><label>Student information</label></td>
                </tr>
                <tr>
                   <td><label for="choose">Choose Class</label></td>
                   <td>
                        <select class="form-control" id="choose" name="choose">
        
                           <option value="">Select</option>
                           <option value="1st">1st</option>
                           <option value="2nd">2nd</option>
                           <option value="3rd">3rd</option>
                           <option value="4th">4th</option>
                           <option value="5th">5th</option>
                       </select>
                   </td>
                </tr>
                <tr>
                   <td><label for="roll">Roll</label></td>
                   <td><input class="form-control" type="text" name="roll" pattern="[0-9]{6}" placeholder="Roll" /></td>
                </tr>
                <tr>
                    <td class="text-center" colspan="2"><input class="btn btn-info"type="submit" value="Show info" name="show_info" /></td>
                </tr>
            </table>
    </form>
            </div>
        </div>



    <br />
    <br />
    <?php
    require_once './admin/dbcon.php';

    if(isset($_POST['show_info'])){
      $choose = $_POST['choose'];
      $roll = $_POST['roll'];

      $result = mysqli_query($link,"SELECT * FROM `student_info` WHERE `class` = '$choose' and `roll` ='$roll'");
      if(mysqli_num_rows($result)==1){
        $row = mysqli_fetch_assoc($result);
        
        ?>
        <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
    <table class="table table-bordered">
          <tr>
            <td rowspan="4">
              <img src="admin/student_image/<?= $row['photo'] ?>" class="img-thumbnail" style="width: 150px;" alt="" />
            </td>
            <td>Name</td>
            <td><?= ucwords($row['name']) ?></td>
          </tr>
          <tr>
            
            <td>Roll</td>
            <td><?= $row['roll'] ?></td>
          </tr>

          <tr>
            
            <td>Class</td>
            <td><?= $row['class'] ?></td>
          </tr>

          <tr>
            
              <td>City</td>
              <td><?= ucwords($row['city']) ?></td>
          </tr>
      </table>
    </div>
   </div>


      <?php
    }
    ?>

 

        <?php
      }else{
        echo'no';
      }

      ?>
</div>     


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>