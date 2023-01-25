<?php

$array = array(
    "student-1" => array("id" => 1, "name" => "James", "age" => 22),
    "student-2" => array("id" => 2, "name" => "William", "age" => 26),
    "student-3" => array("id" => 3, "name" => "Henry", "age" => 18),
    "student-4" => array("id" => 4, "name" => "Isabella", "age" => 25),
    "student-5" => array("id" => 5, "name" => "Alexander", "age" => 19)
);

$arr_len = count($array);    //Length of given array
$keys = array_keys($array);  //Kes of the given array

for ($index_1 = 0; $index_1 < $arr_len; $index_1++) {
    for ($j = 0; $j < $arr_len - $index_1 - 1; $j++) {
        if ($array[$keys[$j]]['age'] > $array[$keys[$j + 1]]['age']) {
            $temporary = $array[$keys[$j]];
            $array[$keys[$j]] = $array[$keys[$j + 1]];
            $array[$keys[$j + 1]] = $temporary;
        }
    }
}

echo '<pre>'; print_r($array); echo '</pre>';


?>


