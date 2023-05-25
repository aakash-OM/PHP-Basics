<?php
$name = "Aakash";
$sentence = "Hi, My name is Aakash Mittal, Currently pursuing MCA";  // 9 words
$xyz = "                My country name is India                     ";
echo $name;
echo "<br>";
echo "<br>";

echo strlen($name);  // 1.
echo "<br>";
// OR
echo "My name is $name and the characters are: " . strlen($name);   // join the strings using dot operator
echo "<br>";

echo str_word_count($sentence);   // 2.
echo "<br>";

echo strrev($sentence);    // 3.
echo "<br>";

echo strpos($sentence, "Mittal");  // 4.
echo "<br>";

echo str_replace("Aakash", "Atul", $sentence);  // 5.
echo "<br>";

echo str_repeat($name, 5);  // 6.
echo "<br>";

echo rtrim($xyz)

?>