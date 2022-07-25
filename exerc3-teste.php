<?php
require("assert.php");
require("exerc3.php");

// getLetterValue
assertEquals(1, getLetterValue("a"));
assertEquals(26, getLetterValue("z"));
assertEquals(27, getLetterValue("A"));
assertEquals(52, getLetterValue("Z"));
assertEquals(18, getLetterValue("r"));

// getWordValue
assertEquals(19, getWordValue("ra"));

// isPrimeNumber
assertEquals(false, isPrimeNumber(1));
assertEquals(true, isPrimeNumber(2));
assertEquals(true, isPrimeNumber(3));
assertEquals(false, isPrimeNumber(4));
assertEquals(true, isPrimeNumber(5));
assertEquals(false, isPrimeNumber(6));
assertEquals(true, isPrimeNumber(7));
assertEquals(true, isPrimeNumber(19));

// checkWord
assertEquals(false,checkWord("Aba"));
