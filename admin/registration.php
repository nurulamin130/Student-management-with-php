<?php
require_once './dbcon.php';
session_start();
    if(isset($_POST['registration'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];


        $photo = explode('.',$_FILES['photo']['name']);
        $photo = end($photo);
        $photo_name = $username.'.'.$photo; 

        // echo $photo_name;

        $input_error = array();

       




        if(empty($name)){
            $input_error['name'] = "The Name field is required";
        }

        if(empty($email)){
            $input_error['email'] = "The email field is required";
        }

        if(empty($username)){
            $input_error['username'] = "The username field is required";
        }

        if(empty($password)){
            $input_error['password'] = "The password field is required";
        }

        if(empty($c_password)){
            $input_error['c_password'] = "The c_password field is required";
        }

        if (count($input_error) == 0){
            $email_check = mysqli_query($link, "SELECT * FROM `user` WHERE `email` = '$email';");

            if(mysqli_num_rows($email_check) == 0){
                $username_check = mysqli_query($link, "SELECT * FROM `user` WHERE `username` = '$username';");
                if(mysqli_num_rows($username_check) == 0){
                   if(strlen($username) > 4){
                       if(strlen($password) > 6){
                           if($password == $c_password){

                               $password= md5($password);
                            $query="INSERT INTO `user`( `name`, `email`, `username`, `password`, `photo`, `status`) VALUES ('$name','$email','$username','$password','$photo_name','inactive')";
                            $result=mysqli_query($link,$query);
                            if($result){
                                $_SESSION['data_insert_succes'] = "Data Insert Success";
                                
                                move_uploaded_file($_FILES['photo']['tmp_name'],'images/'.$photo_name);
                               
                                header('location:registration.php');
                            }
                            else{
                                $_SESSION['data_insert_error'] = "Data Insert Error";
                            }



                            
                           } 
                           else {
                                   $password_not_match = "Confirm password not match";
                           }

                       } else {
                           $password_l = "Password more than 8 characters";
                       }
                   }
                   else{
                       $username_l = "Username more than 8 characters";
                   }
                } else {
                    $username_error = "This username already exists"; 
                }

            } else {
                $email_error = "This email already exists";
            }

           
        }
    }

    
 
?>
    



<!doctype html>
<html lang="en">
  <head>
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>User Regsistration </title>
    <link rel="stylesheet" href="style.css">

  </head>
  <body>
      <div class="container">
          <h1 class="reg_h1">User Regsistration Form</h1>
          <?php
          if(isset($_SESSION['data_insert_succes']))
          {echo '<div class="alert alert-success">' .$_SESSION['data_insert_succes'].'</div>';} ?>
         
           <?php
          if(isset($_SESSION['data_insert_error']))
         { echo '<div class="alert alert-warning">' .$_SESSION['data_insert_error'].'</div>';} ?>
         
          
         
          <hr>
          <div class="row">
              <div class="col-md-12">
                     <form action="" method="POST" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group">
                            <label for="name" class="control-label col-sm-1"><b>Name</b></label>
                                <div class="col-md-4">
                                    <input class="form-control" id="name" type="text" name="name" placeholder="Enter your name" value="<?php if(isset($name)) {echo $name;} ?>">
                                </div>
                                <label class="error"> <?php if(isset($input_error['name'])){ echo $input_error['name']; }?></label>
                        </div>
                        <div class="form-group">
                              <label for="email" class="control-label col-sm-1"><b>Email</b></label>
                                <div class="col-sm-4">
                                    <input class="form-control" id="email" type="text" name="email" placeholder="Enter your email" value="<?php if(isset($email)) {echo $email;} ?>">
                                </div>
                                <label class="error"> <?php if(isset($input_error['email'])){ echo $input_error['email']; }?></label>
                                <label class="error"> <?php if(isset($email_error )){ echo $email_error; }?></label>
                        </div>
                        <div class="form-group">
                            <label for="username" class="control-label col-sm-1"><b>Username</b></label>
                                <div class="col-md-4">
                                    <input class="form-control" id="username" type="text" name="username" placeholder="Enter your username" value="<?php if(isset($username)) {echo $username;} ?>">
                                </div>
                                <label class="error"> <?php if(isset($input_error['username'])){ echo $input_error['username']; }?></label>
                                <label class="error"> <?php if(isset($username_error)){ echo $username_error; }?></label>
                                <label class="error"> <?php if(isset($username_l)){ echo $username_l; }?></label>
                          
                        
                        </div>
                        <div class="form-group">
                              <label for="password" class="control-label col-sm-1"><b>Password</b></label>
                                <div class="col-sm-4">
                                    <input class="form-control" id="password" type="text" name="password" placeholder="Enter your password" value="<?php if(isset($password)) {echo $password;} ?>">
                                </div>
                                <label class="error"> <?php if(isset($input_error['password'])){ echo $input_error['password']; }?></label>
                                <label class="error"> <?php if(isset($password_l)){ echo $password_l; }?></label>
                        </div>
                        <div class="form-group">
                            <label for="c_password" class="control-label col-sm-1"><b>Confirm_Password</b></label>
                                <div class="col-md-4">
                                    <input class="form-control" id="c_password" type="password" name="c_password" placeholder="Enter your Confirm Password" value="<?php if(isset($c_password)) {echo $c_password;} ?>">
                                </div>
                                <label class="error"> <?php if(isset($input_error['c_password'])){ echo $input_error['c_password']; }?></label>
                                <label class="error"> <?php if(isset($password_not_match)){ echo $password_not_match; }?></label>
                          
                        
                        </div>
                        <div class="form-group">
                              <label for="photo" class="control-label col-sm-1"><b>photo</b></label>
                                <div class="col-sm-4">
                                    <input  id="photo" type="file" name="photo" >
                                </div>
                        </div>
                        <br>

                        <div class="col-md-4 col-sm-offset-6">
                            <input type="submit" value="Registration" name="registration" class="btn btn-success">

                        </div>

                
                    </form>
              </div>
          </div>
          <br>
          <p>If you have an account ? then please <a href="login.php">Login</a></p>
          <br>

          <footer>
              <p> Copyright &copy;2016-<?= date('Y') ?> All Right Reserved</p>
          </footer>
      </div>
  
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  
  </body>
</html>