<?php

function getMultiplesOfN(int $n, int $max = 1000): array
{
    $multiples = [];
    for($currentNumber = $n; $currentNumber < $max; $currentNumber = $currentNumber + $n) {
        array_push($multiples, $currentNumber);
    }
    return $multiples;
}

function getSumOfMultiplesOf3or5(int $max = 1000): int
{
    $multiplesOf3 = getMultiplesOfN(3, $max);
    $multiplesOf5 = getMultiplesOfN(5, $max);
    $multiples = array_unique(array_merge($multiplesOf3, $multiplesOf5));

    return array_sum($multiples);
}

function getSumOfMultiplesOf3and5(int $max = 1000): int
{
    $multiplesOf3 = getMultiplesOfN(3, $max);
    $multiplesOf5 = getMultiplesOfN(5, $max);
    $multiples = array_intersect($multiplesOf3, $multiplesOf5);

    return array_sum($multiples);
}

function getSumOfMultiplesOf3or5and7(int $max = 1000): int
{
    $multiplesOf3 = getMultiplesOfN(3, $max);
    $multiplesOf5 = getMultiplesOfN(5, $max);
    $multiplesOf7 = getMultiplesOfN(7, $max);
    $multiples = array_unique(array_merge($multiplesOf3, $multiplesOf5));
    $multiples = array_intersect($multiples, $multiplesOf7);

    return array_sum($multiples);
}

function isMultipleOfN(int $number, int $n): bool
{
    return $number % $n === 0;
}
