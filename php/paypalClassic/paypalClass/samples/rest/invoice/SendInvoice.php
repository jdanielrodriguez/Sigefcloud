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
$PayPal = new \angelleye\PayPal\rest\invoice\InvoiceAPI($configArray);

$InvoiceID = 'INV2-L2AC-WQSM-Q5PR-QVUY';    // Required. The ID of the invoice to send.

$returnArray = $PayPal->send_invoice($InvoiceID);
echo "<pre>";
print_r($returnArray);
