<?php
// Include required library files.
require_once('../../../autoload.php');
require_once('../../../includes/config.php');

$configArray = array(
    'ClientID' => $rest_client_id,
    'ClientSecret' => $rest_client_secret,
    'LogResults' => $log_results, 
    'LogPath' => $log_path,
    'LogLevel' => $log_level  
);

$PayPal = new \angelleye\PayPal\rest\paymentexperience\PaymentExperianceAPI($configArray);

$ProfileID = '';       // Required. The ID of the profile for which to show details.

$returnArray = $PayPal->delete_web_profile($ProfileID);
echo "<pre>";
print_r($returnArray);

