<!DOCTYPE html> 
<?php 
session_start(); 
$con = mysqli_connect("localhost","root","","php");
?>
<html>
	<head>
		<title>Login Form</title> 
	</head> 
	
<style>
body {
	padding:0; 
	margin:0;
	background:BlanchedAlmond;
}
table{
	color:orange;
	padding:10px;
	width:400px;
}
input{
	padding:5px;
}
</style>

<body> 

	<form action="login.php" method="post"> 

		<table align="center" bgcolor="maroon" width="500">
			<tr align="center">
				<td colspan="6" >
					<h2>Login Here</h2>
				</td>
			</tr>
			
			<tr>
				<td align="right"><strong>Email:</strong></td>
				<td>
					<input type="text" name="user_email" placeholder="Enter your email" required="required"/> 
				</td>
			</tr>
			<tr>
				<td align="right"><strong>Password:</strong></td>
				<td>
					<input type="password" name="user_pass" placeholder="Enter your pass"required="required"/> 
				</td>
			</tr>
			<tr align="center">
				<td colspan="6">
					<input type="submit" name="login" value="Login"/>
				</td>
			</tr>
			
		</table>
        
	</form>
	<center><h3>New User? <a href="registration.php">Register Here</a></h3></center>
	
	<?php 
	if(isset($_POST['login'])){

		$user_pass = mysqli_real_escape_string($con,$_POST['user_pass']);
		$user_email = mysqli_real_escape_string($con,$_POST['user_email']);
		
		$sel = "select * from register_user where user_email='$user_email' AND user_pass='$user_pass'";
		$run = mysqli_query($con,$sel);
		$check = mysqli_num_rows($run); 
		
		if($check==0){
		echo "<script>alert('Password or Email is not correct, try again!')</script>";
		exit();
		} 
        else {    
		$_SESSION['user_email']=$user_email; 
		echo "<script>window.open('home.php','_self')</script>";  
		}
	
	  }
	
	?>

</body>
</html>