<?php
// 1. Autoload the SDK Package. This will include all the files and classes to your autoloader
//require __DIR__ . '/PayPal-PHP-SDK/autoload.php';
require $_SERVER["DOCUMENT_ROOT"] . "/php/lib/PayPal-PHP-SDK/autoload.php";
// 2. Provide your Secret Key. Replace the given one with your app clientId, and Secret
// https://developer.paypal.com/webapps/developer/applications/myapps
$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'AbRxndOMfW0CLWgVMO7pVB46QCDTynQxWQOAyw8BrXD54_p9AP8XJ4M4nLfu_Qz-eO6f1TKEqs2sOTXJ',     // ClientID
        'EKDaTzjodxRrbzn1ie53TEP_uP5j20_cUTqmpTtSEvWNW5u3rrDx0KGUZ9SY3EhvRTc1kQadlZnWOKMV'      // ClientSecret
    )
);
// 3. Lets try to save a credit card to Vault using Vault API mentioned here
// https://developer.paypal.com/webapps/developer/docs/api/#store-a-credit-card
$creditCard = new \PayPal\Api\CreditCard();
$creditCard->setType("visa")
    ->setNumber("4417119669820331")
    ->setExpireMonth("11")
    ->setExpireYear("2019")
    ->setCvv2("012")
    ->setFirstName("Joe")
    ->setLastName("Shopper");
// 4. Make a Create Call and Print the Card
try {
    $creditCard->create($apiContext);
    echo $creditCard;
}
catch (\PayPal\Exception\PayPalConnectionException $ex) {
    // This will print the detailed information on the exception.
    //REALLY HELPFUL FOR DEBUGGING
    echo $ex->getData();
}