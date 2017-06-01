<?php
include("lib/config.php");
$val =  $_GET['val'];

$query = "SELECT * from artics WHERE name LIKE '%".$val."%'";

$x = $con->query($query);

$datas = result_to_array($x);

$books = array();
$intru = array();
$papers = array();

foreach($datas as $key=>$data){

$data['course']= getCourse($data['course']);


if ($data['type'] == 1 )
$books[]= $data;
if ($data['type'] == 2 )
$instru[]= $data;
if ($data['type'] == 3)
$papers[]= $data;

unset($datas[$key]);



}

$datas = json_encode(array($books,$instru,$papers));

echo $datas;
 ?>
