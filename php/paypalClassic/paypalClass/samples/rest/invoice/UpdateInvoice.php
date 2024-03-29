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

$InvoiceID = 'INV2-X62M-AZPE-MCSA-N3W6';                       // Required. The ID of the invoice to update.

$merchantInfo = array(
    'Email' => 'paypal-facilitator@angelleye.com',              // The merchant email address. Maximum length is 260 characters.
    'FirstName' => 'Test',                                      // The merchant first name. Maximum length is 30 characters.
    'LastName'  => 'Testerson',                                 // The merchant last name. Maximum length is 30 characters.
    'BusinessName' => 'Testerson\'s store',                     // The merchant company business name. Maximum length is 100 characters.
);

$merchantPhone = array(
    'CountryCode' => '001',                                     // Country code (from in E.164 format).
    'NationalNumber' => '5032141716',                           // In-country phone number (from in E.164 format).
    'Extension' => '',                                          // Phone extension.
);

$merchantAddress = array(
    'Line1' => '1234 Main St.',                                 // Line 1 of the Address (eg. number, street, etc).
    'Line2' => '',                                              // Optional line 2 of the Address (eg. suite, apt #, etc.).
    'City'  => 'Portland',                                      // City name.
    'CountryCode' => 'US',                                      // 2 letter country code.    
    'PostalCode'  => '97217',                                   // Zip code or equivalent is usually required for countries that have them. For list of countries that do not have postal codes please refer to http://en.wikipedia.org/wiki/Postal_code. 
    'State'       => 'OR',                                      // 2 letter code for US states, and the equivalent for other countries.     
);

$billingInfo = array(
    'Email' => 'paypal-facilitator@angelleye.com',              // The invoice recipient email address. Maximum length is 260 characters.
    'FirstName' => '',                                          // The invoice recipient first name. Maximum length is 30 characters.
    'LastName'  => '',                                          // The invoice recipient last name. Maximum length is 30 characters. 
    'BusinessName' => 'AngellEye',                              // The invoice recipient company business name. Maximum length is 100 characters.
    'Language' => '',                                           // The language in which the email was sent to the payer. Used only when the payer does not have a PayPal account. Valid Values: ["da_DK", "de_DE", "en_AU", "en_GB", "en_US", "es_ES", "es_XC", "fr_CA", "fr_FR", "fr_XC", "he_IL", "id_ID", "it_IT", "ja_JP", "nl_NL", "no_NO", "pl_PL", "pt_BR", "pt_PT", "ru_RU", "sv_SE", "th_TH", "tr_TR", "zh_CN", "zh_HK", "zh_TW", "zh_XC"]
    'AdditionalInfo' => 'Business hours 10:00 AM to 7:30 PM.',  // Additional information, such as business hours. Maximum length is 40 characters.
    'NotificationChannel' => '',                                // Valid Values: ["SMS", "EMAIL"]. Preferred notification channel of the payer. Email by default.
    
);

$billingInfoPhone = array(
    'CountryCode' => '001',                                     // Country code (from in E.164 format).
    'NationalNumber' => '5032141717',                           // In-country phone number (from in E.164 format).
    'Extension' => '',                                          // Phone extension.
);

$billingInfoAddress = array(
    'Line1' => '1234 Main St.',                                 // Line 1 of the Address (eg. number, street, etc).
    'Line2' => '',                                              // Optional line 2 of the Address (eg. suite, apt #, etc.).
    'City'  => 'Portland',                                      // City name.
    'CountryCode' => 'US',                                      // 2 letter country code.    
    'PostalCode'  => '97217',                                   // Zip code or equivalent is usually required for countries that have them. For list of countries that do not have postal codes please refer to http://en.wikipedia.org/wiki/Postal_code. 
    'State'       => 'OR',                                      // 2 letter code for US states, and the equivalent for other countries.         
);
  
$itemArray = array();

$item1 = array(
    'Name' => 'Sutures',                                        // Name of the item. 200 characters max.
    'Description' => '',                                        // Description of the item. 1000 characters max.
    'Quantity' => '100',                                        // Quantity of the item. Range of -10000 to 10000.
    'UnitPrice'  => array(
                        'Currency' => 'USD',                    // 3 letter currency code as defined by ISO 4217.     
                        'Value'    => '5.00'                    // amount up to N digit after the decimals separator as defined in ISO 4217 for the appropriate currency code.
                       ),                                       // Unit price of the item. Range of -1,000,000 to 1,000,000.
    'Tax' => array(
                        'Name'    => 'Local Tax on Sutures',    // The tax name. Maximum length is 20 characters. 
                        'Percent' => '1',                       // The rate of the specified tax. Valid range is from 0.001 to 99.999.                        
                     ),                                         // Tax associated with the item.
    'Date' => '',                                               // The date when the item or service was provided. The date format is *yyyy*-*MM*-*dd* *z* as defined in [Internet Date/Time Format](http://tools.ietf.org/html/rfc3339#section-5.6).
    'Discount' => array(
                        'Percent' => '',                        
                    ),                                          // The item discount, as a percent or an amount value.
    'UnitOfMeasure' => '',                                      // Valid Values: ["QUANTITY", "HOURS", "AMOUNT"] The unit of measure of the item being invoiced.
);

array_push($itemArray,$item1);

$item2 = array(
    'Name' => 'Injection',                                          // Name of the item. 200 characters max.
    'Description' => '',                                            // Description of the item. 1000 characters max.
    'Quantity' => '5',                                              // Quantity of the item. Range of -10000 to 10000.
    'UnitPrice'  => array(
                        'Currency' => 'USD',                        // 3 letter currency code as defined by ISO 4217.     
                        'Value'    => '5.00'                        // amount up to N digit after the decimals separator as defined in ISO 4217 for the appropriate currency code.
                       ),                                           // Unit price of the item. Range of -1,000,000 to 1,000,000.
    'Tax' => array(
                        'Name'    => 'Local Tax on Injection',      // The tax name. Maximum length is 20 characters. 
                        'Percent' => '3',                           // The rate of the specified tax. Valid range is from 0.001 to 99.999.                        
                     ),                                             // Tax associated with the item.
    'Date' => '',                                                   // The date when the item or service was provided. The date format is *yyyy*-*MM*-*dd* *z* as defined in [Internet Date/Time Format](http://tools.ietf.org/html/rfc3339#section-5.6).
    'Discount' => array(
                        'Percent' => null,                        
                    ),                                              // The item discount, as a percent or an amount value.
    'UnitOfMeasure' => '',                                          // Valid Values: ["QUANTITY", "HOURS", "AMOUNT"] The unit of measure of the item being invoiced.
);

array_push($itemArray,$item2);

$finalDiscountForInvoice = array(
    'Percent' => '2'                                                // The rate of the specified Discount. Valid range is from 0.001 to 99.999.                         
);

$shippingInfo = array(
    'FirstName' => 'Sally',                                         // The invoice recipient first name. Maximum length is 30 characters. 
    'LastName'  => 'Patient',                                       // The invoice recipient last name. Maximum length is 30 characters.
    'BusinessName' => 'Not applicable',                             // The invoice recipient company business name. Maximum length is 100 characters.     
);

$shippingInfoPhone = array(
    'CountryCode' => '001',                                         // Country code (from in E.164 format).
    'NationalNumber' => '5039871234',                               // In-country phone number (from in E.164 format).
    'Extension' => '',                                              // Phone extension.
);

$shippingInfoAddress = array(
    'Line1' => '1234 Main St.',                                     // Line 1 of the Address (eg. number, street, etc).
    'Line2' => '',                                                  // Optional line 2 of the Address (eg. suite, apt #, etc.).
    'City'  => 'Portland',                                          // City name.
    'CountryCode' => 'US',                                          // 2 letter country code.    
    'PostalCode'  => '97217',                                       // Zip code or equivalent is usually required for countries that have them. For list of countries that do not have postal codes please refer to http://en.wikipedia.org/wiki/Postal_code. 
    'State'       => 'OR',                                          // 2 letter code for US states, and the equivalent for other countries.     
);

$paymentTerm = array(
    'TermType' => 'NET_45',                                         // Valid Values: ["DUE_ON_RECEIPT", "DUE_ON_DATE_SPECIFIED", "NET_10", "NET_15", "NET_30", "NET_45", "NET_60", "NET_90", "NO_DUE_DATE"]. The terms by which the invoice payment is due.
    'DueDate'  => ''                                                // The date when the invoice payment is due. This date must be a future date. Date format is *yyyy*-*MM*-*dd* *z*, as defined in [Internet Date/Time Format](http://tools.ietf.org/html/rfc3339#section-5.6).   
);

$invoiceData = array(
    'Note' => 'Thank you for your Payment',                         // Note to the payer. 4000 characters max.
    'Number' => '',                                                 // Unique number that appears on the invoice. If left blank will be auto-incremented from the last number. 25 characters max.
    'TemplateId' => '',                                             // The template ID used for the invoice. Useful for copy functionality.   
    'Uri' => '',                                                    // URI of the invoice resource.
    'MerchantMemo' => '',                                           // A private bookkeeping memo for the merchant. Maximum length is 150 characters.
    'LogoUrl'      => 'https://www.paypalobjects.com/webstatic/i/logo/rebrand/ppcom.svg',                                     // Full URL of an external image to use as the logo. Maximum length is 4000 characters.    
);

$attachments = array(
    'Name' => 'AttachmentImage',                                    // Name of the file attached. 
    'Url'  => 'https://cdn.pixabay.com/photo/2016/09/16/19/15/gear-1674891_960_720.png' // URL of the attached file that can be downloaded.                                             // URL of the attached file that can be downloaded. 
);

$requestData =array(
    'merchantInfo'            => $merchantInfo,
    'merchantPhone'           => $merchantPhone,
    'merchantAddress'         => $merchantAddress,
    'billingInfo'             => $billingInfo,
    'billingInfoPhone'        => $billingInfoPhone,
    'billingInfoAddress'      => $billingInfoAddress,
    'itemArray'               => $itemArray,
    'finalDiscountForInvoice' => $finalDiscountForInvoice,
    'shippingInfo'            => $shippingInfo,
    'shippingInfoPhone'       => $shippingInfoPhone,
    'shippingInfoAddress'     => $shippingInfoAddress,
    'paymentTerm'             => $paymentTerm,
    'invoiceData'             => $invoiceData,
    'InvoiceID'               => $InvoiceID,
    'attachments'             => $attachments
);

$returnArray = $PayPal->update_invoice($requestData);
echo "<pre>";
print_r($returnArray);

