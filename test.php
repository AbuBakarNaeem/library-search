<?php
error_reporting(0);
mb_internal_encoding("UTF-8");
$files = scandir("pdfs/outlines");
$files = array_unique(array_values($files));
unset($files[0]);
unset($files[1]);

$x = shell_exec('ls -l');
echo $x;
foreach ($files as $kk){
shell_exec('pdftotext "pdfs/outlines/'.$kk.'" test.txt');

shell_exec('pdftotext "pdfs/outlines/'.$kk.'" pest.txt -raw');

$x = file_get_contents('test.txt');
$y = file_get_contents('pest.txt');

$l = explode(PHP_EOL,utf8_decode($y));
$m = explode(PHP_EOL,utf8_decode($x));

$secondaryArray = array();
$array = array();
$bnot = array("textbook","following","these","will","that","lahore","readings","reading","recommended","casebook","textbook","book","reference","designated","case studies",".html","at:","http://","online","use:","students","course","optional");
foreach ($m as $key => $value) {
    
    if ($value!="") {
        $secondaryArray[] = trim($value);
        unset($m[$key]);
    }
  else{
     $array[] = $secondaryArray;
$secondaryArray = array();
        unset($m[$key]);
  }
}
$book_array=array();
foreach ($array as $arr){
if(strpos($arr[0],"TEXTBOOK(S)")!==false || strpos($arr[1],"TEXTBOOK(S)")!==false  ){
$book_array = $arr;
}

}
$books=array();
$x=0;
foreach ($book_array as $barry){

 foreach($bnot as $b){

   if (strpos(strtolower($barry),$b)>-1)
   $x=1;
  
 }
if($x!=1 && strlen(trim($barry))>3)
$books[]=trim($barry);
$x=0;

}

foreach($books as $key=>$book){
if(count(explode('"',$book))==2)
{
$books[$key]="*".$books[$key].$books[$key+1];
$books[$key]=preg_replace("/\*\d?\)/","",$books[$key]);
$books[$key]=preg_replace("/\*\d+\./","",$books[$key]);
unset($books[$key+1]);
}
else{
$books[$key]="*".$books[$key];
$books[$key]=preg_replace("/\*\d?\)/","",$books[$key]);
$books[$key]=preg_replace("/\*\d+\./","",$books[$key]);
}
$books[$key]=str_replace("*","",$books[$key]);
}


foreach($l as $key=>$raw){
 if(strpos($raw,"Instructor")>-1){
 echo trim(str_replace("?"," ",utf8_decode($raw)))."<br>";
 break;
}
}

foreach($l as $key=>$raw){
 if ($key>0 && strlen($raw)>1 && strpos($raw,"Lahore") === false){
 echo "Course:".trim(str_replace("?"," ",utf8_decode($raw)))."<br>";
 break;
}
}

if (!empty($books))
echo "<b>Books:".trim(str_replace("?"," ",utf8_decode(implode("<br>",$books))))."</b><br>";

echo "XXXXXXXXXXXXx----------XXXXXXXXXx"."<br>";
}

?>
