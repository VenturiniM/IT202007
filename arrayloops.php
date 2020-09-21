<?php
function arrayLoop(){
$list = array(1,2,3,4,5,6,7,8,9,10,11,12);
echo "Here is the output for looping through the array: <br>\n";
for($i=0;$i<count($list);$i++){
	echo $list[$i];
	echo " ";
  }
echo "<br>\n<br>\nHere are the even numbers of the array:<br>\n";
foreach($list as $val){
	if($val % 2==0){
	   echo $val;
	   echo " ";
   }
 }
}

arrayloop();
?>
