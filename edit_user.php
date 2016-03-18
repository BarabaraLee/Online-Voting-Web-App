<!DOCTYPE html> 
<?php 
session_start(); 
$con = mysqli_connect("localhost","root","","php");

	if(isset($_GET['id'])){
	
        $edit_id = $_GET['id']; 
	    $sel = "select * from register_user where user_id='$edit_id'";
		$run = mysqli_query($con,$sel);
		$row = mysqli_fetch_array($run);
			
        $id = $row['user_id'];
        $name = $row['user_name'];
        $pass = $row['user_pass'];
        $email = $row['user_email'];
        $country = $row['user_country'];
        $gender = $row['user_gender'];
        $phone = $row['user_no']; 
        $address = $row['user_address']; 
        $image = $row['user_image'];
        $date = $row['register_date'];
	}
?>
<html>
	<head>
		<title>Registration Form</title> 
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

	<form action="edit_user.php?id=<?php echo $id;?>" method="post" enctype="multipart/form-data"> 
		
		<table align="center" bgcolor="maroon" width="500">
			<tr align="center">
				<td colspan="6" >
					<h2>Update the User</h2>
				</td>
			</tr>
			<tr>
				<td align="right"><strong>Name:</strong></td>
				<td>
					<input type="text" name="user_name" value="<?php echo $name;?>" required="required"/> 
				</td>
			</tr>
			
			<tr>
				<td align="right"><strong>Password:</strong></td>
				<td>
					<input type="password" name="user_pass" value="<?php echo $pass;?>"required="required"/> 
				</td>
			</tr>
			
			<tr>
				<td align="right"><strong>Email:</strong></td>
				<td>
					<input type="text" name="user_email" value="<?php echo $email;?>" required="required"/> 
				</td>
			</tr>
			
			<tr>
				<td align="right"><strong>Country:</strong></td>
				<td>
					<select name="user_country" disabled="disabled">
						<option><?php echo $country;?></option>
					</select>
				</td>
			</tr>
			
			<tr>
				<td align="right"><strong>Phone No:</strong></td>
				<td>
					<input type="text" name="user_no" value="<?php echo $phone;?>" required="required"/> 
				</td>
			</tr>
			
			<tr>
				<td align="right"><strong>Address:</strong></td>
				<td>
					<textarea name="user_address" cols="20" rows="5"><?php echo $address;?></textarea>
				</td>
			</tr>
			
			<tr>
				<td align="right"><strong>Birthday:</strong></td>
				<td>
					<input type="date" name="b_day" required="required" disabled="disabled"/> 
				</td>
			</tr>
			
			<tr>
				<td align="right"><strong>Image:</strong></td>
				<td>
					<input type="file" name="user_image" required="required"/><br>
					<img src="images/<?php echo $image;?>" width="50" height="50"/>
				</td>
			</tr>
			
			<tr align="center">
				<td colspan="6">
					<input type="submit" name="update" value="Update Now"/>
				</td>
			</tr>
			
			
			
		</table>
	
	</form>
	
	<?php 
	if(isset($_POST['update'])){
	
	//getting the text information and saving in local variables
		$user_name = mysqli_real_escape_string($con,$_POST['user_name']);
		$user_pass = mysqli_real_escape_string($con,$_POST['user_pass']);
		$user_email = mysqli_real_escape_string($con,$_POST['user_email']);
		$user_no = mysqli_real_escape_string($con,$_POST['user_no']);
		$user_address = mysqli_real_escape_string($con,$_POST['user_address']);
	
	//getting the image details in saving in local variables
	$user_image = $_FILES['user_image']['name'];
	$user_tmp = $_FILES['user_image']['tmp_name'];
	
		if($user_address=='' OR $user_image==''){
		
		echo "<script>alert('Please fill all the fileds!')</script>";
		exit();
		}
		
		if(!filter_var($user_email,FILTER_VALIDATE_EMAIL)){
		
		echo "<script>alert('Your email is not valid!')</script>";
		exit();
		}
		
		if(strlen($user_pass)<8){
		
		echo "<script>alert('Plz select a password of 8 litters minimum')</script>";
		exit();
		
		}
		
		$sel_email = "select * from register_user where user_email='$user_email'";
		$run_email = mysqli_query($con,$sel_email); 
		
		$check_email = mysqli_num_rows($run_email);
		
		if($check_email==1){
		
		echo "<script>alert('This email is already registered, try another one!')</script>";
		exit();
	
		}
		else {
			
        $_SESSION['user_email']=$user_email;
         move_uploaded_file($user_tmp,"images/$user_image");
		 
		 $update = "update register_user set user_name='$user_name',user_pass='$user_pass',user_email='$user_email',user_no='$user_no',user_address='$user_address',user_image='$user_image' where user_id='$edit_id'";
            
		 $run_update = mysqli_query($con, $update);
		 
			if($run_update){
				echo "<script>alert('User has been updated!')</script>";
				echo "<script>window.open('view_users.php','_self')</script>";
			}
		}
		
	
	}
	
	
	
	?>


</body>
</html>