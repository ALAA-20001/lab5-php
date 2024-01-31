<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/signup.css">
</head>
<body>
    <div class="container">
    <div class="w-50 m-auto mt-5">
    <form action="<?php $_PHP_SELF ?>" method="POST">

    
                <h2>Login</h2>
                <p>Please fill in your credentials to login.</p>
                <hr>
                <label for="username" class="form-label">Username</label>
                <input type="text" name="name" id="name" class="form-control" 
                value="<?php if(!empty($_POST["name"]) && !empty($_POST["password"])   ){
                 echo "";
                 }elseif(isset($_POST["submit"])){
                 if(isset($_POST["name"]))
                 {if(!empty($_POST["name"]))
                    {echo $_POST["name"];
                    }
                 }
                 } ?>">

     <?php  
                                
if(isset($_POST["submit"])){
    if(empty($_POST["name"]))
{
    echo "<p class='text-danger'>* Username is required.</p>";
}
}
?>

                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control mb-3">

                <?php  
if(isset($_POST["submit"])){
if(empty($_POST["password"]))
{
    echo "<p class='text-danger'>* Password is required.</p>";
}
}
?>
                <input class="btn btn-primary" type="submit" name="submit" value="Login">
                <p class="mt-3">Don't have an account? <a href="signup.php" class="text-decoration-none">Sign up now.</a></p>

             
     </form>
    </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
if(isset($_POST["submit"]) && !empty($_POST["username"]) && !empty($_POST["password"])){

$username = $_POST["username"];
$password = $_POST["password"];
include 'config.php';
$sql = "SELECT username, password 
        FROM test
        WHERE username = '$username';";

mysqli_select_db($conn,$dbname);
$result = mysqli_query($conn,$sql); 


if(mysqli_num_rows($result) == 1){
    $row = mysqli_fetch_assoc($result); 
    if($row["username"] == $username ){ 
        if($row["password"] == $password){ 
            session_start();
            print_r($_SESSION);
            $_SESSION["login"] = true; 
            $_SESSION["username"] = $username; 
            header("Location: index.php");
            
        }else{
            echo "<p class='text-danger text-center'> Please enter correct password.</p>";
        }
    }
}else{
    echo "<p class='text-danger text-center'> Please enter correct username.</p>";

}
mysqli_close($conn);
}

?>
