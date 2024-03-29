<?php
/*******************************************************************************
 * Copyright 2009-2018 Amazon Services. All Rights Reserved.
 * Licensed under the Apache License, Version 2.0 (the "License"); 
 *
 * You may not use this file except in compliance with the License. 
 * You may obtain a copy of the License at: http://aws.amazon.com/apache2.0
 * This file is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR 
 * CONDITIONS OF ANY KIND, either express or implied. See the License for the 
 * specific language governing permissions and limitations under the License.
 *******************************************************************************
 * PHP Version 5
 * @category Amazon
 * @package  Marketplace Web Service Products
 * @version  2011-10-01
 * Library Version: 2017-03-22
 * Generated: Thu Oct 11 10:46:02 PDT 2018
 */

/**
 * List Matching Products Sample
 */

require_once('.config.inc.php');
require_once('./../Client.php');
require_once('./../Interface.php');
require_once('./../Mock.php');
require_once('./../Exception.php');
require_once('./../Model.php');
require_once('./../Model/ListMatchingProductsRequest.php');

/************************************************************************
 * Instantiate Implementation of MarketplaceWebServiceProducts
 *
 * AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY constants
 * are defined in the .config.inc.php located in the same
 * directory as this sample
 ***********************************************************************/
// More endpoints are listed in the MWS Developer Guide
// North America:
$serviceUrl = "https://mws.amazonservices.com/Products/2011-10-01";
// Europe
//$serviceUrl = "https://mws-eu.amazonservices.com/Products/2011-10-01";
// Japan
//$serviceUrl = "https://mws.amazonservices.jp/Products/2011-10-01";
// China
//$serviceUrl = "https://mws.amazonservices.com.cn/Products/2011-10-01";


 $config = array (
   'ServiceURL' => $serviceUrl,
   'ProxyHost' => null,
   'ProxyPort' => -1,
   'ProxyUsername' => null,
   'ProxyPassword' => null,
   'MaxErrorRetry' => 3,
 );

 $service = new MarketplaceWebServiceProducts_Client(
        AWS_ACCESS_KEY_ID,
        AWS_SECRET_ACCESS_KEY,
        APPLICATION_NAME,
        APPLICATION_VERSION,
        $config);

/************************************************************************
 * Uncomment to try out Mock Service that simulates MarketplaceWebServiceProducts
 * responses without calling MarketplaceWebServiceProducts service.
 *
 * Responses are loaded from local XML files. You can tweak XML files to
 * experiment with various outputs during development
 *
 * XML files available under MarketplaceWebServiceProducts/Mock tree
 *
 ***********************************************************************/
 // $service = new MarketplaceWebServiceProducts_Mock();

/************************************************************************
 * Setup request parameters and uncomment invoke to try out
 * sample for List Matching Products Action
 ***********************************************************************/
 // @TODO: set request. Action can be passed as MarketplaceWebServiceProducts_Model_ListMatchingProducts
 $request = new MarketplaceWebServiceProducts_Model_ListMatchingProductsRequest();
 $request->setMarketplaceId(MARKETPLACE_ID);
 $request->setQuery("502300999");
 $request->setSellerId(MERCHANT_ID);
 // object or array of parameters
//  $request->getQuery();
 invokeListMatchingProducts($service, $request);

/**
  * Get List Matching Products Action Sample
  * Gets competitive pricing and related information for a product identified by
  * the MarketplaceId and ASIN.
  *
  * @param MarketplaceWebServiceProducts_Interface $service instance of MarketplaceWebServiceProducts_Interface
  * @param mixed $request MarketplaceWebServiceProducts_Model_ListMatchingProducts or array of parameters
  */

  function invokeListMatchingProducts(MarketplaceWebServiceProducts_Interface $service, $request)
  {
      try {
        $response = $service->ListMatchingProducts($request);

        echo ("Service Response\n");
        echo ("=============================================================================\n<br>");
        var_dump($response);
        $dom = new DOMDocument();
        $dom->loadXML($response->toXML());
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        echo $dom->saveXML() . "\n";
        echo("ResponseHeaderMetadata: " . $response->getResponseHeaderMetadata() . "\n<br>");

     } catch (MarketplaceWebServiceProducts_Exception $ex) {
        echo("Caught Exception: " . $ex->getMessage() . "\n<br>");
        echo("Response Status Code: " . $ex->getStatusCode() . "\n<br>");
        echo("Error Code: " . $ex->getErrorCode() . "\n<br>");
        echo("Error Type: " . $ex->getErrorType() . "\n<br>");
        echo("Request ID: " . $ex->getRequestId() . "\n<br>");
        echo("XML: " . $ex->getXML() . "\n<br>");
        echo("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "\n<br>");
     }
 }

