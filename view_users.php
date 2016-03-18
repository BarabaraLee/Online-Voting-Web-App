<!DOCTYPE html> 
<?php 
session_start(); 
$con = mysqli_connect("localhost","root","","php");

if(!$_SESSION['admin_email']){
//if($_SESSION['admin_email']){	
	header("location: admin_login.php");
}
else {
?>
<html>
	<head>
		<title>View Users - Admin Panel</title> 
<style>
body {
	padding:0; 
	margin:0;
	background:maroon;
}
table{
	color:black;
	padding:2px;
	width:1000px;
	background:orange;
}
th {
	border:2px solid black;
}
input{
	padding:5px;
}
h3 {
	float:right; 
	margin-right:120px;

}
</style>

	</head> 
<body>

	<table align="center">
		<tr align="center">
			<td colspan="7"><h2>View All Users</h2></td>
		</tr>
		<tr align="center">
			<th>S.N.</th>
			<th>Name</th>
			<th>Email</th>
			<th>Image</th>
			<th>Date</th>
			<th>Delete</th>
			<th>Edit</th>
		</tr>
		<?php 
		$sel = "select * from register_user";
		$run = mysqli_query($con,$sel);
		
		$i=0; 
		while($row=mysqli_fetch_array($run)){
            
			$id = $row['user_id'];
			$name = $row['user_name'];
			$email = $row['user_email'];
			$image = $row['user_image'];
			$date = $row['register_date'];
			$i++;
		?>
		<tr align="center">
			<td><?php echo $i;?></td>
			<td><?php echo $name;?></td>
			<td><?php echo $email;?></td>
			<td><img src="images/<?php echo $image;?>" width="50" height="50"/></td>
			<td><?php echo $date;?></td>
			<td><a href="view_users.php?id=<?php echo $id;?>">Delete</a></td>
			<td><a href="edit_user.php?id=<?php echo $id;?>">Edit</a></td>
		</tr>
		<?php } ?>
	</table>
	
	<h3>Welcome: <?php echo $_SESSION['admin_email'];?> <a href="admin_logout.php" >Logout</a></h3>
	
	<?php 
	
	if(isset($_GET['id'])){
	
	    $get_id = $_GET['id']; 
		$delete = "delete from register_user where user_id='$get_id'"; 
		$run_delete = mysqli_query($con,$delete); 
		
		if($run_delete){
		   echo "<script>alert('User Deleted Successfully!')</script>";
		   echo "<script>window.open('view_users.php','_self')</script>";
		}
	}
	
	?>

</body>
</html>
<?php } ?>