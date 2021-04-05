<?php
$showalert=false;
$showerror=false;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
      include 'mysql/connect.php';
     $username = $_POST['username'];
     $email = $_POST['email'];
     $password = $_POST['password'];
     $cpassword = $_POST['cpassword'];
    $existsql= "SELECT * FROM `user1` WHERE username='$username ' ";
    $result= mysqli_query($conn, $existsql);
    $numExistrows=mysqli_num_rows($result);
    $existsql1= "SELECT * FROM `user1` WHERE email='$email ' ";
    $result1= mysqli_query($conn, $existsql1);
    $numExistrows1=mysqli_num_rows($result1);
    
    
    if(empty($username)||empty($email)||empty($password)||empty($cpassword)){
       
       $showerror="Empty fields";
    }
    elseif ($numExistrows>0)
    {
        
        $showerror="Username exists";
    }
    elseif ($numExistrows1>0)
    {

        $showerror="Email invalid";
    }

     elseif(($password == $cpassword)){
         $sql="INSERT INTO `user1` (`Username`, `Email`, `Password`) VALUES ( '$username', '$email', '$password')";
         $result = mysqli_query($conn, $sql);
         if($result){
             $showalert = true;
         }
      }
       else{
            $showerror="Password do not match";
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
    <h1 class="para">Signup</h1>
    <?php
  if ($showalert){
  echo'<p class="login-para">Success!Your account is creted.</p>';
  }

    if ($showerror){
        echo'<p class="login-para">
        Error! '.$showerror.'</p>';
        }
        
?>
    
    <form id="form" action="signup.php" method="post">
       <div class="form-group">
          <label for="username">Username</label><br>
          <input type="text" name="username" id="username">
       </div> 

       <div class="form-group">
          <label for="email">Email</label><br>
          <input type="email" name="email" id="email">
       </div> 
    
       <div class="form-group">
          <label for="password">Password</label><br>
          <input type="password" name="password" id="password">
       </div> 

       <div class="form-group">
          <label for="cpassword">Confirm Password</label><br>
          <input type="password" name="cpassword" id="cpassword">
       </div> 

       <div class="form-group">
          <input type="submit" name="signup-sub" value="Signup">
       </div> 
    </form>
    
</body>
</html>