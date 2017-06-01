<?php include("header.php"); 

if(!empty($user_data)){
echo "<script>window.location='search.php';</script>";
}


if(isset($_POST['username'])){

$username =  $_POST['username'];
$password = $_POST['password'];

$qry = "SELECT * from users WHERE user='$username' AND pass='$password'";
$res = result_to_array($con->query($qry));
if(count($res)>0){
$_SESSION['UID'] = $res[0]['ID']; 
header("Location: search.php");
}
else{
echo "<script>alert('Invalid Login Credentials');</script>";
}
}
?>


  <div class="row">
    <form class="col s4 offset-s4" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
       <h4 class="center-align">Login</h4>
       <div class="row">
        <div class="input-field col s12">
          <input name="username" id="username" type="text" class="validate">
          <label for="username">Username</label>
        </div>
      </div>
  
      <div class="row">
        <div class="input-field col s12">
          <input name="password" id="password" type="password" class="validate">
          <label for="password">Password</label>
        </div>
      </div>
     
<button type="submit" class="waves-effect waves-light btn">Login</button>
    </form>
  </div>



<?php include("footer.php"); ?>
