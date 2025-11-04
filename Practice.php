<?php

//Write a function that reverses a string without using built-in functions.
function reverseString($str) {
    $reversed = '';
    $length = strlen($str);
    for ($i = $length - 1; $i >= 0; $i--) {
        $reversed .= $str[$i];
    }
    return $reversed;
}

public function reverseStrings($str){
    $reversed='';
}
