<!DOCTYPE html>
<html>
<head>
  <title>Application Tracker</title>
</head>
<body>
  <?php 
  // Assuming you have the total number of steps in a flow and the current step
$totalSteps = 12; // Total number of steps in the flow
$currentStep = 5; // Current step of the request in the flow

// Calculate the progress percentage
$progressPercentage = ($currentStep / $totalSteps) * 100;

// Display the progress bar
echo "Progress: " . $progressPercentage . "%<br>";
echo '<div style="width: 100%; background-color: #ccc;">';
echo '<div style="width: ' . $progressPercentage . '%; background-color: #0f0;">&nbsp;</div>';
echo '</div>';



// Assuming you have an array of photos associated with each step
$photos = array(
    1 => array('http://gurukashiuniversity.co.in/gkuadmin/images/logo2.png', 'photo3.jpg'),
    2 => array('http://gurukashiuniversity.co.in/gkuadmin/images/logo2.png', 'photo5.jpg'),
    3 => array('http://gurukashiuniversity.co.in/gkuadmin/images/logo2.png',  'photo8.jpg'),
    4 => array('http://gurukashiuniversity.co.in/gkuadmin/images/logo2.png', 'photo10.jpg'),
    5 => array('http://gurukashiuniversity.co.in/gkuadmin/images/logo2.png', 'photo13.jpg')
);

// Display the photos associated with the current step
if (isset($photos[$currentStep])) {
    foreach ($photos[$currentStep] as $photo) {
        echo '<img src="' . $photo . '" alt="Photo" width="100">';
    }
}

?>

</body>
</html>
