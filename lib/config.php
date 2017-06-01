<?php
error_reporting(0);
session_start();
$con=mysqli_connect("localhost","root","","library");
$user_data=getUserDetails($_SESSION['UID'])[0];
function result_to_array($result){

$res=array();

while($row=mysqli_fetch_assoc($result)){

$res[]=$row;

}

return $res;

}

function crypto_rand_secure($min, $max)
{
    $range = $max - $min;
    if ($range < 1) return $min; // not so random...
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd > $range);
    return $min + $rnd;
}

function getToken($length)
{
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet); // edited

    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[crypto_rand_secure(0, $max-1)];
    }

    return $token;
}

function get_sorted_array($table,$sort){
	  global $con;
	  $fields=array();
	  $result = mysqli_query($con,"SELECT * FROM ".$table." ".$sort);
	  if ($result)
	  { if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $fields[]=$row;
    }


}
}

return $fields;
}

function insert($table,$row=array(),$values=array()){
	global $con;
	  $a=implode(",",$row);
	  $a='('.$a.')';
	  foreach($values as &$value)
	  {
	  mysqli_real_escape_string($conn,$value);
	  $value="'".$value."'";

	  }
	  $b=implode(",",$values);
	  $b='('.$b.')';
	  $query="INSERT INTO ".$table." ".$a." VALUES".$b;
	  $result = mysqli_query($con,$query);
	 if($result)
	 return true;
	}

function update($table, $array, $array_2,$column,$ID) {
        global $con;
        if (count($array) > 0) {
            foreach ($array_2 as $key => $value) {
                $value = "'$value'";
                $updates[] = "$array[$key] = $value";
            }
        }
        $implodeArray = implode(', ', $updates);
        $sql = "UPDATE ".$table." SET $implodeArray  WHERE ".$column."=$ID";
        $result= mysqli_query($con,$sql);
        if($result)
        return true;
}

 function getUserDetails($id){
 	global $con;
$query="select * from users where ID=$id";

$result = mysqli_query($con,$query);
return result_to_array($result);
 }

function getAName($id){
     global $con;

$query="select * from anames where ID IN ($id)";

$result = mysqli_query($con,$query);
$m = result_to_array($result);

$ak=array();
foreach ($m as $n) {

$ak[]=$n['name'];
}

return implode(", ",$ak);
}

function getCourse($id){
     global $con;

$query="select * from courses where ID IN ($id)";

$result = mysqli_query($con,$query);
$m = result_to_array($result);

$ak=array();
foreach ($m as $n) {

$ak[]=$n['name'];
}

return implode(", ",$ak);
}




 ?>
