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

$dispute_id  = '';                                              // The ID of the dispute to escalate to a claim.

$parameters = array(
    'note' => '',                                               // The merchant's notes about the claim. PayPal can, but the customer cannot, view these notes. Minimum length: 1. Maximum length: 2000.   
);

$response = $PayPal->disputes_escalate($dispute_id,$parameters);  

echo "<pre>";
print_r($response);
exit;