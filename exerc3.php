<?php
require("exerc1.php");
require("exerc2.php");

function getLetterValue(string $letter): int
{
    $letterValues = array_merge(range('a', 'z'), range('A', 'Z'));
    $letterValues = array_flip($letterValues);
    $letterValues = array_map(function ($value) {
        return $value + 1;
    }, $letterValues);

    if (!array_key_exists($letter, $letterValues)) return 0;

    return $letterValues[$letter];
}

function getWordValue(string $word): int
{
    $wordArray = str_split($word);
    $wordArray = array_map('getLetterValue', $wordArray);
    return array_sum($wordArray);
}

function isPrimeNumber(int $number): bool
{
    if ($number <= 1) return false;
    for ($i = $number - 1; $i > 1; $i--) {
        if ($number % $i === 0) {
            return false;
        }
    }
    return true;
}

function checkWord(string $word): bool
{
    $wordNumber = getWordValue($word);
    return isPrimeNumber($wordNumber) && isHappyNumber($wordNumber) &&
        isMultipleOfN($wordNumber, 3) && isMultipleOfN($wordNumber, 5);
}
