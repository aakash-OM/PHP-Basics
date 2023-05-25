<?php
$Multidim = array( 
    array(1,2,3,5,7), 
    array(2,8,6,7,4), 
    array(3,5,7,8,1));
    
echo var_dump($Multidim); 
echo "<br>";

echo ($Multidim[1][0]);  // 2 element

echo "<br>";
echo "<br>";
 for($i=0 ; $i<count($Multidim); $i++){
    for($j=0; $j<count($Multidim[$i]); $j++){
        echo $Multidim[$i][$j];
        echo" ";
    }
    echo "<br>";
 }

?>