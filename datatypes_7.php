<?php
$name = "Aakash";        //string
$income = 324324;       //integer
$debt = 32.5;           // float

$x = true;             //Boolean
$y = false;            //Boolean

$friends = array("harsh", "dev", "Ayan", "Mayank");  //Array
echo var_dump($friends);
echo "<br>";
echo $friends[1];
echo "<br>";
echo $friends[2];
echo "<br>";

echo "$name has $income income with $debt debt <br>";

echo $y;
echo "<br>";
echo $x; 
echo var_dump($y);

$name = null;    // to reset datatype here datatype is name
echo $name;
echo "<br>";
echo var_dump($name); // gives actual value of variable after reseting it to null 
?>