<?php
/*******************************************************************************
 * Copyright 2009-2017 Amazon Services. All Rights Reserved.
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
 * Generated: Wed Mar 22 23:24:40 UTC 2017
 */

/**
 * Get My Price For ASIN Sample
 */

require_once('.config.inc.php');

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

$config = array(
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
//  $service = new MarketplaceWebServiceProducts_Mock();

/************************************************************************
 * Setup request parameters and uncomment invoke to try out
 * sample for Get My Price For ASIN Action
 ***********************************************************************/
// @TODO: set request. Action can be passed as MarketplaceWebServiceProducts_Model_GetMyPriceForASIN
$request = new MarketplaceWebServiceProducts_Model_GetMyPriceForASINRequest();
$request->setSellerId(MERCHANT_ID);
$request->setMarketplaceId(MARKETPLACE_ID);
$asinList = new MarketplaceWebServiceProducts_Model_ASINListType();
$asinList->setASIN(["B000XPE6SE"]);
$request->setASINList($asinList);
// object or array of parameters
invokeGetMyPriceForASIN($service, $request);

/**
 * Get Get My Price For ASIN Action Sample
 * Gets competitive pricing and related information for a product identified by
 * the MarketplaceId and ASIN.
 *
 * @param MarketplaceWebServiceProducts_Interface $service instance of MarketplaceWebServiceProducts_Interface
 * @param mixed $request MarketplaceWebServiceProducts_Model_GetMyPriceForASIN or array of parameters
 */

function invokeGetMyPriceForASIN(MarketplaceWebServiceProducts_Interface $service, $request) {

    try {
        $response = $service->GetMyPriceForASIN($request);

//        echo("Service Response\n");
//        echo("=============================================================================\n");
//        $dom = new DOMDocument();
        $data = $response->toXML();
//        $xml = $dom->loadXML($data);
//        $dom->preserveWhiteSpace = false;
//        $dom->formatOutput = true;
//        echo $dom->saveXML();
//        echo("ResponseHeaderMetadata: " . $response->getResponseHeaderMetadata() . "\n");
//        var_dump($response);
        $sxml = new SimpleXMLElement($data);
        var_dump($sxml);
        foreach ($sxml as $product) {
            $product = $product->Product;
            if (count($product) > 0) {
                $asin = $product->Identifiers->MarketplaceASIN->ASIN;
                $sku = $product->Offers->Offer->SellerSKU;
                $landedCurrency = $product->Offers->Offer->BuyingPrice->LandedPrice->CurrencyCode;
                $landedAmount = $product->Offers->Offer->BuyingPrice->LandedPrice->Amount;
                $listingCurrency = $product->Offers->Offer->BuyingPrice->ListingPrice->CurrencyCode;
                $listingAmount = $product->Offers->Offer->BuyingPrice->ListingPrice->Amount;
                $shippingCurrency = $product->Offers->Offer->BuyingPrice->Shipping->CurrencyCode;
                $shippingAmount = $product->Offers->Offer->BuyingPrice->Shipping->Amount;
                $regularCurrency = $product->Offers->Offer->RegularPrice->CurrencyCode;
                $regularAmount = $product->Offers->Offer->RegularPrice->Amount;
                echo "ASIN: $asin<br>";
                echo "SKU: $sku<br>";
                echo "Buying price<br>";
                echo "Landed price: $landedCurrency - $landedAmount<br>";
                echo "Listing price: $listingCurrency - $listingAmount<br>";
                echo "Shipping price: $shippingCurrency - $shippingAmount<br><br>";
                echo "Regular price<br>";
                echo "Regular price: $regularCurrency - $regularAmount<br>";
                var_dump($product);
                echo "<br><br><br><br>";
            }
        }
    } catch (MarketplaceWebServiceProducts_Exception $ex) {
        echo("Caught Exception: " . $ex->getMessage() . "\n");
        echo("Response Status Code: " . $ex->getStatusCode() . "\n");
        echo("Error Code: " . $ex->getErrorCode() . "\n");
        echo("Error Type: " . $ex->getErrorType() . "\n");
        echo("Request ID: " . $ex->getRequestId() . "\n");
        echo("XML: " . $ex->getXML() . "\n");
        echo("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "\n");
    }
}