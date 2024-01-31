<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
   <div class="container m-auto text-center">
   <h2 class=" mt-5">Hi,
   <?php 
   echo "<span class='text-success'> 
   {$_SESSION['username']} </span>" ?> Welcome to our website.</h2>
    <form action="<?php $_PHP_SELF ?>" method="POST">
     <input type="submit" name="signout" value="Sign out" class="btn btn-success mt-5">
    </form>

   </div>
</body>
</html>

<?php 
if(isset($_POST["signout"])){
    session_destroy();
    setcookie("PHPSESSID","",time()-3600,"/");
    header("Location: login.php");
}

?>