<!DOCTYPE html> 
<?php 
session_start(); 
$con = mysqli_connect("localhost","root","","php");
?>
<html>
	<head>
		<title>Admin Panel - Login</title> 
	</head> 
	
<style>
body {
	padding:0; 
	margin:0;
	background:BlanchedAlmond;
}
table{
	color:orange;
	width:400px;
}
input{
	padding:5px;
}
</style>

<body> 

	<form action="admin_login.php" method="post"> 
		
		<table align="center" bgcolor="maroon" width="500">
			<tr align="center">
				<td colspan="6" >
					<h2>Admin Login</h2>
				</td>
			</tr>
			
			<tr>
				<td align="right"><strong>Email:</strong></td>
				<td>
					<input type="text" name="admin_email" placeholder="Enter your email" required="required"/> 
				</td>
			</tr>
			
			<tr>
				<td align="right"><strong>Password:</strong></td>
				<td>
					<input type="password" name="admin_pass" placeholder="Enter your pass"required="required"/> 
				</td>
			</tr>
				
			<tr align="center">
				<td colspan="6">
					<input type="submit" name="admin_login" value="Admin Login"/>
				</td>
			</tr>
			
		</table>
	
	</form>
	
	<?php 
	if(isset($_POST['admin_login'])){

		$admin_pass = mysqli_real_escape_string($con,$_POST['admin_pass']);
		$admin_email = mysqli_real_escape_string($con,$_POST['admin_email']);
		
		$sel = "select * from admin where admin_email='$admin_email' AND admin_pass='$admin_pass'";
		$run = mysqli_query($con,$sel);
		$check = mysqli_num_rows($run); 
		
		if($check==0){
		echo "<script>alert('Password or Email is not correct, try again!')</script>";
		exit();
		}
		else {
		$_SESSION['admin_email']=$admin_email; 
		echo "<script>window.open('view_users.php','_self')</script>";
		}
	
	}
	
	?>


</body>
</html>