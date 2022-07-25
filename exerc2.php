<?php

function isHappyNumber(int $number, array $history = []): bool
{
    if ($number === 1) return true;
    $numberArray = array_map('intval', str_split($number));
    $numberArray = array_map(function ($currentNumber) {
        return pow($currentNumber, 2);
    }, $numberArray);

    $resultNumber = array_sum($numberArray);
    if (in_array($resultNumber, $history, true)) return false;

    array_push($history, $resultNumber);
    return isHappyNumber($resultNumber, $history);
}
