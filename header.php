<?php include("lib/config.php"); 

if (strpos($_SERVER['PHP_SELF'],"search.php") !==false && empty($user_data))
{
header("Location: login.php");
die();
}
elseif (strpos($_SERVER['PHP_SELF'],"add.php") !==false && empty($user_data))
{
header("Location: login.php");
die();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Library Search</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <nav class="white" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="index.php" class="brand-logo">Library Search</a>
      <ul class="right hide-on-med-and-down">
<?php if ( $_SESSION['UID'] =="" ) {?>
        <li><a href="login.php">Login to search</a></li>
<?php } else { ?>
      <li><a href="add.php">Add to search</a></li>
      <li><a href="logout.php">Log Out</a></li>
<?php } ?>      
</ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
