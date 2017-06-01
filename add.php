<?php include("header.php");

if(!empty($_POST)){

if (!empty($_FILES["picpdf"]))
{
    if ($_FILES["picpdf"]["error"] > 0)
       {echo "Error: " . $_FILES["picpdf"]["error"] . "<br>";}
    else
       {
$name = $_FILES["picpdf"]["name"];
$ext = end((explode(".", $name))); 
$file = "files/".getToken(8).".".$ext;
$files = array("png","jpg","jpeg","pdf");
       if (in_array($ext,$files)){
       if(move_uploaded_file($_FILES["picpdf"]["tmp_name"],$file)){
       $courses =  explode(",",$_POST['courses']);
       $authors = explode(",",$_POST['authors']);
       $au_ids = array();
       $cu_ids = array();
       foreach($authors as $author){
       $am = get_sorted_array("amnames","WHERE name='$author'");
       if(empty($am)){
       insert("anames",array("name"),array($author));
       $am = get_sorted_array("anames","WHERE name='$author'");
       }
       $au_ids[]=$am[0]['ID'];
        

       }
       foreach($courses as $course){
       $am = get_sorted_array("courses","WHERE name='$course'");
       if(empty($am)){
       insert("courses",array("name"),array($course));
       $am = get_sorted_array("courses","WHERE name='$course'");
       }
       $cu_ids[]=$am[0]['ID'];
 }
       
   $courze = implode(",",$cu_ids);
   $auz = implode(",",$au_ids);

  insert("artics",array("name","type","course","year","file","aname"),array($_POST['name'],$_POST['type'],$courze,$_POST['year'],$file,$auz));
 $n= $_POST['name'];
echo $n;
   $m = get_sorted_array("artics","WHERE name='$n' ORDER BY ID DESC LIMIT 1");
   foreach ($au_ids as $au){


     $am = get_sorted_array("anames","WHERE name='$au'");
     $artics_in = explode(",",$am[0]['artics_in']);
     $artics_in[]= $m[0]['ID']; 
     $artics= implode(",",array_filter($artics_in));
update("anames", array("artics_in"), array($artics),"ID",$au) ;
  
   }


      }


      }
      else{
     
      echo "<script>alert('Upload Failed. Only these extentions are allowed: png,jpg,jpeg,pdf');</script>";

      }

       }
}

}

 ?>

<div class="row">
    <form enctype="multipart/form-data" class="col s4 offset-s4" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
       <h4 class="center-align">Add To Search</h4>
       <div class="row">
        <div class="input-field col s12">
          <input name="name" id="name" type="text" class="validate">
          <label for="name">Name</label>
        </div>
      </div>

     <div class="row">
        <div class="input-field col s12">
          <input name="type" id="type" type="text" class="validate">
          <label for="type">Type (1- Book, 2- Instructor, 3- Research Paper)</label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12">
          <input name="courses" id="courses" type="text" class="validate">
          <label for="courses">Courses (comma separated) </label>
        </div>
      </div>
  
 <div class="row">
        <div class="input-field col s12">
          <input name="authors" id="authors" type="text" class="validate">
          <label for="authors">Authors (comma separated - leave empty for instructors)</label>
        </div>
      </div>

<div class="row">
        <div class="input-field col s12">
          <input name="year" id="year" type="text" class="validate">
          <label for="year">Year (book/paper publishing Year, instructor teaching since)</label>
        </div>
      </div>
  
  <div class="file-field input-field">
      <div class="btn">
        <span>Picture or PDF</span>
        <input name="picpdf" type="file">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
     

<button type="submit" class="waves-effect waves-light btn">Submit</button>
    </form>
  </div>


<?php include("footer.php"); ?>
