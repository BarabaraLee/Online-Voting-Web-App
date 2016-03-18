<?php
session_start();
if(!$_SESSION['user_email']){//if the session of the email is not active
    header("location: login.php");
}
else{
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Online Voting System</title>
        <p align="center">Each voter can vote for only one person, and one time. <a href="logout.php" >Logout</a></p>
        
    <style>
        body{
            background-color:blanchedalmond;
            padding:0;
            margin:0;
        }
        #con{
            margin:auto;
            width:1000px;
            padding:10px;
            background-color: maroon;
        }
        #musician{
            width:1000px;
            margin:auto;
        }
        #musician img{
            padding:4px;
            border:3px solid brown;
            border-radius:80%;
        }
        form input{
            padding:inherit;
            margin:50px;
        }
        h2{color:orange;}
        </style>
    </head>
<body>
    <div id="con">
    <h2 align="center">Your Vote to the Best Pop Star of the Year</h2>
    <div id="musician" align="center">
        <img src="justinbieber.jpg" width="210" height="280"/>
        <img src="Jaychou.jpg" width="210" height="280"/>
        <img src="shawnmendes.jpg" width="210" height="280"/>
    </div>
        <form action="home.php" method="post" align="center">
            <input type="submit" name="justin" value=" Vote to Justin Bieber "/>
            <input type="submit" name="jay" value="    Vote to Jay Chou    "/>
            <input type="submit" name="shawn" value="Vote to Shawn Mendes"/>
        </form>
    <?php
        
    $con = mysqli_connect("localhost","root","","php");
    if(isset($_POST['justin'])){
        $justin="update musicians set justin=justin+1";
        $run_justin=mysqli_query($con,$justin);
		echo "<center><h2>Your Vote Has Been Collected! <br/>";
		echo "<a href='home.php?results'>See Results</a></h2></center>";
    }
    if(isset($_POST['jay'])){
        $jay="update musicians set jay=jay+1";
        $run_jay=mysqli_query($con,$jay);
		echo "<center><h2>Your Vote Has Been Collected! <br/>";
		echo "<a href='home.php?results'>See Results</a></h2></center>";
    }
    if(isset($_POST['shawn'])){
        $shawn="update musicians set shawn=shawn+1";
        $run_shawn=mysqli_query($con,$shawn);
		echo "<center><h2>Your Vote Has Been Collected! <br/>";
		echo "<a href='home.php?results'>See Results</a></h2></center>";
    }
        
    ?>
    <?php
        if(isset($_GET['results'])){
            $sel = "select * from musicians";
            $run = mysqli_query($con,$sel);
            $row=mysqli_fetch_array($run);
            
            $justin_votes=$row['justin'];
            $jay_votes=$row['jay'];
            $shawn_votes=$row['shawn'];
            
            $count_all=$justin_votes+$jay_votes+$shawn_votes;
            $per_justin=round(100*$justin_votes/$count_all);
            $per_jay=round(100*$jay_votes/$count_all);
            $per_shawn=round(100*$shawn_votes/$count_all);
            
            echo "
            <div align='center'>
                <h2>Results So Far:</h2>
                <p style='color:black;background:blanchedalmond;width:300px;padding:8px;'>Justin Bieber: $justin_votes votes ($per_justin%)</p>
                <p style='color:black;background:blanchedalmond;width:300px;padding:8px;'>Jay Chou: $jay_votes votes ($per_jay%)</p>
                <p style='color:black;background:blanchedalmond;width:300px;padding:8px;'>Shawn Mendes: $shawn_votes votes ($per_shawn%)</p>
            </div>
            ";
        }
    
    ?>    
    </div>
    
    
</body>
</html>
<?php } ?>


