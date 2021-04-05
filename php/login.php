<?php
$login=true;
if($_SERVER["REQUEST_METHOD"] == "POST"){
        
    include 'mysql/connect.php';
    $username=$_POST['username'];
    $password=$_POST['password'];

    $sql="Select * from user1 where username='$username' AND password='$password'";
    $result=mysqli_query($conn,$sql);
    $num=mysqli_num_rows($result);
    if($num==1){
        $login = true;
        session_start();
        $_SESSION['loggedin']=true;
        $_SESSION['username']=$username;
        header("location: welcome.php");
    }
    else{
        $login=false;
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
<?php
    require '../html/nav.php'
    ?>
    
    <h1 class="para">Login</h1>

    <?php
    if (!$login){
  echo'<p class="login-para">Username or password incorrect</p>';
  }
  ?>
  
    <form id="form" action="login.php" method="post">
       <div class="form-group">
          <label for="username">Username</label><br>
          <input type="text" name="username" id="username">
       </div> 
    
       <div class="form-group">
          <label for="password">Password</label><br>
          <input type="password" name="password" id="password">
       </div> 

       <div class="form-group">
          <input type="submit" value="Login">
       </div>  
    </form>
    
</body>
</html>