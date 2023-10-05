<?php
require_once './dbcon.php';
session_start();
if(isset($_SESSION['user_login'])){
    header('location: index.php');
}


if(isset($_POST['login'])){
   
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username_check = mysqli_query($link, "SELECT * FROM `user` WHERE `username` = '$username'") ;
    if(mysqli_num_rows($username_check) > 0){
        
        $row = mysqli_fetch_assoc($username_check);
        
        if($row['password'] == md5($password)){
            if($row['status'] == 'active'){
                $_SESSION['user_login'] = $username;
                header('location: index.php');
            } else {
                $status_inactive = "You are an inactivate user. Please activate again";
            }

            } else {
            $wrong_password = "Wrong password";
        }

    } else {
        $username_not_found = "This username is not found";
    }
}

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Students Management System </title>
  </head>
  <body>
  <div class="container center">
          <h1 class="text-center">Students Management System </h1>
          <br>
          <div class="row ">
              <div class="col-sm-4 col-sm-offset-4">
                  <h2 class= "text-center">Admin Login Form</h2>
                  <br>
                  <form action="login.php" method="POST">
                      <div>
                          <label for="">User Name</label>
                          <input type="text" placeholder="username" name="username" required="" class="form-control" value="<?php if(isset($username)){echo $username;}?>"/>
                      </div>
                      <div>
                          <label for="">Password</label>
                          <input type="password" placeholder="password" name="password" required="" class="form-control" value="<?php if(isset($password)){echo $password;}?>"/>
                      </div>
                      <br>
                      <div>
                          <input type="submit" value="Login" name="login" class="btn btn-danger "/>
                      </div>
                  </form>
              </div>
          </div>
          <br />
          <?php if(isset($username_not_found)) { echo '<div class = "alert alert-danger col-sm-3">'.$username_not_found.'</div>';} ?>
          <?php if(isset($wrong_password)) { echo '<div class = "alert alert-danger col-sm-3">'.$wrong_password.'</div>';} ?>
          <?php if(isset($status_inactive)) { echo '<div class = "alert alert-danger col-sm-3">'.$status_inactive.'</div>';} ?> 
         
 </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  
  </body>
</html>