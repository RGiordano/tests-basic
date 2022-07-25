<?php
require("assert.php");
require("exerc1.php");

// getMultiplesOfN
assertEquals([3, 6, 9], getMultiplesOfN(3, 10));
assertEquals([5, 10, 15, 20, 25], getMultiplesOfN(5, 26));

// getSumOfMultiplesOf3or5
assertEquals(23, getSumOfMultiplesOf3or5(10));
assertEquals(233168, getSumOfMultiplesOf3or5());

// getSumOfMultiplesOf3and5
assertEquals(15, getSumOfMultiplesOf3and5(20));
assertEquals(33165, getSumOfMultiplesOf3and5());

// getSumOfMultiplesOf3or5and7
assertEquals(33173, getSumOfMultiplesOf3or5and7());

// isMultipleOfN
assertEquals(true, isMultipleOfN(6, 3));
assertEquals(false, isMultipleOfN(10, 3));
