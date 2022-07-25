<?php

function assertEquals($expected, $actual)
{
    $printedExpected = $expected;
    $printedActual = $actual;
    if (gettype($expected) == 'boolean') {
        $printedExpected = $expected ? 'true' : 'false';
    } elseif (gettype($expected) == 'array') {
        $printedExpected = print_r($expected, true);
    }
    if (gettype($actual) == 'boolean') {
        $printedActual = $actual ? 'true' : 'false';
    } elseif (gettype($actual) == 'array') {
        $printedActual = print_r($actual, true);
    }
    if ($expected === $actual) {
        echo("Expected: {$printedExpected} | Actual: {$printedActual} | Result: \e[32mSUCCESS!\e[39m\n");
    } else {
        echo("Expected: {$printedExpected} | Actual: {$printedActual} | Result: \e[31mFAIL!\e[39m\n");
    }
}
