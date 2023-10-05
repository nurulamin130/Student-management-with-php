<?php
$username=$_POST['username'];
$password=$_POST['password'];

if(!empty($username)|| !empty($password)){
$host="localhost";
$dbUsername="";
$dbPassword="";
$dbname="employee_management_system";

    $conn = new mysqli($host,$dbUsername,$dbPassword,$dbPassword);
    if(mysqli connect error()){
        die('Connection Error('.mysqli_connect_errno().')'. mysqli_connect_error());

    }
    else{
        $SELECT = "SELECT  "
    }

}

else{
    echo "All field are required";
    die();
}
?>