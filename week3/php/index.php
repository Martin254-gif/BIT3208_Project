<?php
// Week 3: PHP Syntax Practice
// This file demonstrates basic PHP syntax

// --- Variable Declaration ---
$name = "John Doe";
$age = 25;
$isStudent = true;
$courses = ["Mathematics", "Science", "English"];

// --- Output Variables ---
echo "<h1>Welcome to Week 3 PHP Practice</h1>";
echo "<p>Name: " . $name . "</p>";
echo "<p>Age: " . $age . "</p>";
echo "<p>Student Status: " . ($isStudent ? 'Yes' : 'No') . "</p>";

// --- Loop through array ---
echo "<h3>Courses:</h3>";
echo "<ul>";
foreach ($courses as $course) {
    echo "<li>" . $course . "</li>";
}
echo "</ul>";

// --- Conditional Statement ---
$score = 85;
echo "<h3>Grade Calculation</h3>";
if ($score >= 80) {
    echo "<p>Score: " . $score . " = Grade: A</p>";
} elseif ($score >= 70) {
    echo "<p>Score: " . $score . " = Grade: B</p>";
} elseif ($score >= 60) {
    echo "<p>Score: " . $score . " = Grade: C</p>";
} else {
    echo "<p>Score: " . $score . " = Grade: F</p>";
}

// --- Function ---
function greetUser($username) {
    return "Hello, " . $username . "! Welcome to the system.";
}

echo "<h3>Function Output:</h3>";
echo "<p>" . greetUser("Martin") . "</p>";

// --- Date and Time ---
echo "<h3>Current Date and Time:</h3>";
echo "<p>Today is: " . date("l, F j, Y") . "</p>";
echo "<p>Current time: " . date("h:i:s A") . "</p>";

// --- Array Operations ---
$fruits = ["Apple", "Banana", "Orange", "Mango"];
echo "<h3>Array Operations:</h3>";
echo "<p>Number of fruits: " . count($fruits) . "</p>";
echo "<p>Sorted fruits: " . implode(", ", $fruits) . "</p>";
?>