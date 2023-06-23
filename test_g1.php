<?php 
$vehicleId = 1;
$existingStartTime = '4:00 PM';
$existingEndTime = '6:00 PM';
$newStartTime = '3:00 PM';
$newEndTime = '4:30 PM';

// Convert 12-hour format to 24-hour format
$existingStartTime24Hour = date('H:i', strtotime($existingStartTime));
$existingEndTime24Hour = date('H:i', strtotime($existingEndTime));
$newStartTime24Hour = date('H:i', strtotime($newStartTime));
$newEndTime24Hour = date('H:i', strtotime($newEndTime));

// Calculate the overlapping duration
$overlapDuration = max(0, min(strtotime($existingEndTime24Hour), strtotime($newEndTime24Hour)) - max(strtotime($existingStartTime24Hour), strtotime($newStartTime24Hour)));

// Convert the overlap duration to minutes
$overlapDurationMinutes = floor($overlapDuration / 60);

if ($overlapDurationMinutes > 0) {
    // Display alert message
    echo "This time slot is not available. Overlapping duration: " . $overlapDurationMinutes . " minutes.";
} else {
    // Proceed with the booking process
    // ...

    // Display success message or perform the necessary operations
    echo "Booking successful!";
}
?>