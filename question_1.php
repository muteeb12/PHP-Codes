<?php
    function isSpecialArray($arr) {
        for ($index = 0; $index < count($arr); $index++) 
        {
            if ($index % 2 == 0 && $arr[$index] % 2 != 0) { //Check if index is even and array value is odd
                return false;
            } else if ($index % 2 != 0 && $arr[$index] % 2 == 0) { //Check if index is odd and array value is even
                return false;
            }
        }
        return true;
    }

    echo (isSpecialArray([2, 7, 4, 9, 6, 1, 6, 3]) ? 'true': 'false'); // True
    echo (isSpecialArray([2, 7, 9, 1, 6, 1, 6, 3]) ? 'true': 'false'); // False
    echo (isSpecialArray([2, 7, 8, 8, 6, 1, 6, 3]) ? 'true': 'false'); // False
?>
