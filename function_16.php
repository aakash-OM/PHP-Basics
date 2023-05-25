<?php

function processMarks($marksArr){
    $sum = 0;
    foreach($marksArr as $value){
        $sum += $value;
    }

    return $sum;
}

$aakash = [45,66,78,32,99,93];
$sumMarks = processMarks($aakash);

$dev = [34,76,54,99,76,91];
$sumMarks_dev = processMarks($dev);

echo "Total marks scored by the Aakash is $sumMarks <br>";
echo "Total marks scored by the Dev is $sumMarks_dev ";


?>
