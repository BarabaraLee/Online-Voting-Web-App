<!DOCTYPE html>
<?php
$con=mysqli_connect("localhost","root","","php");
?>
<html>
    <head>
        <title>Registration Form</title>
    </head>
<style>
    body{
        padding:0;
        margin:0;
        background:BlanchedAlmond;
    }
    table{
        color:orange;
        padding:10px;
        width:40px;
    }
    input{
        padding:4.5px;
    }
    
</style>
<body>
    <form action="registration.php" method="post" enctype="multipart/form-data">
    <table align="center" bgcolor="maroon" width="400">
        <tr align="center">
            <td colspan="8">
                <h2>New User? Register Here: </h2>
            </td>
        </tr>
        <tr>
            <td align="right"><strong>Name:</strong></td>
            <td>
                <input type="text" name="user_name" placeholder="Enter your Name" required="required" />
            </td>
        </tr>
        <tr>
            <td align="right"><strong>Password:</strong></td>
            <td><input type="password" name="user_pass" placeholder="Enter your Pass" required="required" /></td>
        </tr>
        <tr>
            <td align="right"><strong>Email:</strong></td>
            <td><input type="text" name="user_email" placeholder="Enter your Email" required="required" /></td>
        </tr>
        <tr>
            <td align="right" ><strong>Country:</strong></td>
            <td><select name="user_country" required="required">
                <option>Select a Country</option>
                <option>Afghanistan</option>
                <option>Pakistan</option>
                <option>United States</option>
                <option>Germany</option>
                <option>China</option>
                <option>Korea</option>
                <option>Singapore</option>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right"><strong>Phone No:</strong></td>
            <td><input type="text" name="user_no" placeholder="Enter your Phone No." required="required" /></td>
        </tr>
        <tr>
            <td align="right"><strong>Address:</strong></td>
            <td>
                <textarea name="user_address" cols="30" rows="5" placeholder="Enter your Address"></textarea>
            </td>
        </tr>
        <tr>
            <td align="right"><strong>Gender:</strong></td>
            <td>
                Male:<input type="radio" name="user_gender" placeholder="Male"/>
                Female:<input type="radio" name="user_gender" placeholder="Female"/>
            </td>
        </tr>
        <tr>
            <td align="right"><strong>Birthday:</strong></td>
            <td>
                <input type="date" name="b_day" required="required" />
            </td>
        </tr>
        
        <tr>
            <td align="right"><strong>Image:</strong></td>
            <td>
                <input type="file" name="user_image" required="required" /> 
            </td>
        </tr>
        <tr align="center">
            <td colspan="8">
                <input type="submit" name="register" value="Register Now"/>
            </td>
        </tr>
    </table>
    </form>
    
    <center>
        <h3>Already Registered? <a href="login.php">Login Here</a></h3>
    </center>
    
    <?php
    if(isset($_POST['register'])){
        //getting the text information and saving in local variables
		$user_name = mysqli_real_escape_string($con,$_POST['user_name']);
		$user_pass = mysqli_real_escape_string($con,$_POST['user_pass']);
		$user_email = mysqli_real_escape_string($con,$_POST['user_email']);
		$user_country = mysqli_real_escape_string($con,$_POST['user_country']);
		$user_gender = mysqli_real_escape_string($con,$_POST['user_gender']);
		$user_no = mysqli_real_escape_string($con,$_POST['user_no']);
		$user_address = mysqli_real_escape_string($con,$_POST['user_address']);
		$user_b_day = mysqli_real_escape_string($con,$_POST['b_day']);
	
        //getting the image details in saving in local variables
        $user_image = $_FILES['user_image']['name'];
        $user_tmp = $_FILES['user_image']['tmp_name'];
	
		if($user_address=='' OR $user_country=='' OR $user_image=='' OR $user_gender==''){
		echo "<script>alert('Please fill all the fields!')</script>";
		exit();
		}
		
		if(!filter_var($user_email,FILTER_VALIDATE_EMAIL)){
		echo "<script>alert('Your email is not valid!')</script>";
		exit();
		}
		
		if(strlen($user_pass)<8){
		echo "<script>alert('Please select a password of 8 litters minimum')</script>";
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

             $insert = "insert into register_user (user_name,user_pass,user_email,user_country,user_no,user_address,user_gender,b_day,user_image,register_date) values ('$user_name','$user_pass','$user_email','$user_country','$user_no','$user_address','$user_gender','$user_b_day','$user_image',NOW()) ";

             $run_insert = mysqli_query($con, $insert);
		 
             if($run_insert){
                  echo "<script>alert('Registration Successful, Welcome!')</script>";
                  echo "<script>window.open('home.php','_self')</script>";
			}
		}
    }
    
    
    ?>
</body> 
</html>
