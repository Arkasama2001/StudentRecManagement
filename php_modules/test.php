<?php

$timestamp1 = strtotime("2023-11-07 10:00:00");
$timestamp2 = strtotime("2023-11-07 10:04:30");

$timeDifference = abs($timestamp2 - $timestamp1);

if ($timeDifference < 250) { // 5 minutes = 300 seconds
    echo "The time difference is less than 5 minutes.";
} else {
    echo "The time difference is 5 minutes or more.";
}
?>