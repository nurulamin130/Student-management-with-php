<?php
// database connection code
if(isset($_POST['txtName']))
{
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');
$con = mysqli_connect('localhost', 'root', '','mini_project');

// get the post records

$txtName = $_POST['txtName'];
$txtEmail = $_POST['txtEmail'];
$txtPhone = $_POST['txtPhone'];
$txtMessage = $_POST['txtMessage'];

// database insert SQL code
$sql = "INSERT INTO `contact` (`id`, `name`, `email`, `phone`, `message`) VALUES ('0', '$txtName', '$txtEmail', '$txtPhone', '$txtMessage')";


$rs = mysqli_query($con, $sql);
if($rs)
{
	//echo "Contact Records Inserted";
	echo "<script>alert('Thank You for Yoour feedback')</script>";
	echo "<script>location.replace('contact.html')</script>";
}
}
else
{
	//echo "Are you a genuine visitor?";
	echo "<script>alert('Are you a genuine visitor?')</script>";
	echo "<script>location.replace('contact.html')</script>";
	
}
?>
