<?php
    function numSplit($num) {
        if($num < 0){
            $num = $num * -1;
            $num = (string) $num;
            $result = array();
            $index2 = strlen($num) - 1;
            for ($index = 0; $index < strlen($num); $index++, $index2--) {
                $result[$index] = (int)$num[$index] * pow(10, $index2) * -1; //Using exponential with base 10 and -1 for -ve numbers
            }
            return $result;

        }else{
            $num = (string) $num;
            $result = array();
            $index2 = strlen($num) - 1;
            for ($index = 0; $index < strlen($num); $index++, $index2--) {
                $result[$index] = (int)$num[$index] * pow(10, $index2);
            }
            return $result;
        }
    }
    
    echo '<pre>'; print_r(numSplit(39)); echo '</pre>';
    echo '<pre>'; print_r(numSplit(-434)); echo '</pre>';
    echo '<pre>'; print_r(numSplit(100)); echo '</pre>';

?>


