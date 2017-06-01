<?php include("header.php"); 

?>

<div class="container" style="min-height:750px">
<div class="row">

<div class="col l12 m12">

<h3>Search for books, instructors and research papers here.. </h3>
 <nav class="green">
    <div class="nav-wrapper">
      <form>
        <div class="input-field">
          <input id="search" type="search" required>
          <label class="label-icon" for="search"><i class="material-icons">search</i></label>
          <i class="material-icons">close</i>
        </div>
      </form>
    </div>
  </nav>

</div>

</div>



 <div class="row">
    <div class="col s12">
      <ul class="tabs search_tabs">
        <li class="tab col s4"><a style="color:black;" class="active" href="#test1">Books</a></li>
        <li class="tab col s4"><a style="color:black;" href="#test2">Instructors</a></li>
        <li class="tab col s4"><a style="color:black;" href="#test3">Research Papers</a></li>
      </ul>
    </div>
    <div id="test1" class="col s12">
 <ul class="collection">
   

  </ul>


</div>
    <div id="test2" class="col s12">

<ul class="collection">

  </ul>


</div>
    <div id="test3" class="col s12">

<ul class="collection">
    

  </ul>

</div>
  </div>
  


</div>

<?php include("footer.php"); ?>

