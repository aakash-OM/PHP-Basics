<?php
function combineStrings($string1, $string2) {
    $combinedString = $string1 . ' ' . $string2;
    return $combinedString;
}

$string1 = "Hello";
$string2 = "Aakash Mittal";
$result = combineStrings($string1, $string2);
echo $result; // Output: Hello Aakash Mittal
?>

