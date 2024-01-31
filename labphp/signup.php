<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/signup.css">
</head>
<body>
    <div class="container">
        <div class="w-50 m-auto mt-5">
            <form action="<?php $_PHP_SELF ?>" method="POST">
                <h2>Sign Up</h2>
                <p>Please fill this form to create an account.</p>
                <hr>
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control"
                 value="<?php 
                 if(!empty($_POST["name"]) && !empty($_POST["password"])   ){
                echo "";
                }elseif(isset($_POST["submit"])){
                if(isset($_POST["username"]))
                {if(!empty($_POST["username"])){
                 echo $_POST["username"];
                 }
              }
                            } ?>">

        <?php  
if(isset($_POST["submit"])){
    if(empty($_POST["username"]))
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
                <input class="btn btn-success" type="submit" name="submit" value="Submit">
                <input class="btn btn-secondary" type="reset" name="reset" value="Reset">
                <p class="mt-3">Already have an account? <a href="login.php" class="text-decoration-none">Login here.</a></p>
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
$sqlgetdata = "SELECT username 
               FROM users 
               WHERE username = '$username';";

mysqli_select_db($conn,$dbname);
$retval = mysqli_query($conn, $sqlgetdata);
if(mysqli_num_rows($retval ) == 1){
    $result = mysqli_fetch_assoc($retval);
    if($result["username"] == $username){
    echo "<p class='text-danger text-center'>Username already exists, Please choose another username.</p>";
    }
}else{

    $sql = "INSERT INTO users (username, password)
    VALUES ('$username' , '$password');";

mysqli_select_db($conn,$dbname);
$addretval = mysqli_query($conn, $sql);

if(!$addretval) {
 die('Could not sign up: ' . mysqli_error($conn));
 }
header("Location: login.php");
}
mysqli_close($conn);
}
?>