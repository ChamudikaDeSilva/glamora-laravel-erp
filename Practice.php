<?php

function reverseString($str)
{
    $reversed='';
    for($i=strlen($str)-1; $i>=0; $i--){
        $reversed=$reversed.$str[$i];
    }
}

$arr =[1,2,3,4,5,10,5,5,4,11,10,22,16,16];

function findDuplicates($array){
    $duplicated ='';
    for($i=0; $i<array_count_values($array); $i++){
        for($j=$i+1; $j<array_count_values($array); $j++){
            if($array[$i]==$array[$j]){
                $duplicated = $duplicated . $array[$i] . ' ';
            }
        }
    }    return $duplicated;
}

function findDup($arr)
{
    $dup=[];
    for($i=0; $i<count($arr); $i++){
        for($j=$i+1; $j<count($arr); $j++){
            if($arr[$i]==$arr[$j] && !in_array($arr[$i], $dup)){
                $dup[]=$arr[$i];
            }
        }
    }
    return $dup;
}
