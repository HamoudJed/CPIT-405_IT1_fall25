<?php
// Student ID: 2243091
// Student Name: Hamoud Mahdi
// Lab 10 - Task 1: Power Function

echo "<h2>Task 1: Power Function</h2>";

// Recursive approach
function powerRecursive($base, $exponent) {
    if ($exponent == 0) {
        return 1;
    }

    if ($exponent > 0) {
        return $base * powerRecursive($base, $exponent - 1);
    } else {
        return 1 / powerRecursive($base, -$exponent);
    }
}

// Iterative approach
function powerIterative($base, $exponent) {
    $result = 1;
    $absExponent = abs($exponent);

    for ($i = 0; $i < $absExponent; $i++) {
        $result *= $base;
    }

    if ($exponent < 0) {
        return 1 / $result;
    }

    return $result;
}

// Test both functions
echo "<h3>Recursive Method:</h3>";
echo "2^3 = " . powerRecursive(2, 3) . "<br>";
echo "5^2 = " . powerRecursive(5, 2) . "<br>";
echo "10^0 = " . powerRecursive(10, 0) . "<br>";
echo "2^-2 = " . powerRecursive(2, -2) . "<br>";

echo "<h3>Iterative Method:</h3>";
echo "2^3 = " . powerIterative(2, 3) . "<br>";
echo "5^2 = " . powerIterative(5, 2) . "<br>";
echo "10^0 = " . powerIterative(10, 0) . "<br>";
echo "2^-2 = " . powerIterative(2, -2) . "<br>";
?>