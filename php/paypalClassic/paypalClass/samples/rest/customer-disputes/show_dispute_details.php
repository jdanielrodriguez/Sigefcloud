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

$PayPal = new \angelleye\PayPal\rest\customerdisputes\CustomerDisputesAPI($configArray);

$dispute_id  = 'PP-D-5615';   // The ID of the dispute for which to show details.

$response = $PayPal->showByID($dispute_id);  

echo "<pre>";
print_r($response);
exit;
