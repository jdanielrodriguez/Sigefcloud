<?php
require_once('../../includes/config.php');
?>
<html lang="en">
<head>
<meta charset="utf-8">
<title>PayPal Express Checkout Basic Demo | Order Review | PHP Class Library | Angell EYE</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
<!--script src="/assets/js/less-1.3.3.min.js"></script-->
<!--append ‘#!watch’ to the browser URL, then refresh the page. -->

<link href="../../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/style.css" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
    <script src="/assets/js/html5shiv.js"></script>
    <![endif]-->

<!-- Fav and touch icons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/images/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/images/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/images/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="../assets/images/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="../assets/images/favicon.png">
<script type="text/javascript" src="../assets/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/js/scripts.js"></script>
</head>

<body>
<div class="container">
  <div class="row clearfix">
    <div class="col-md-12 column">
      <div id="header" class="row clearfix">
        <div class="col-md-6 column">
          <div id="angelleye_logo"> <a href="/"><img alt="Angell EYE PayPal PHP Class Library Demo" src="../assets/images/logo.png"></a> </div>
        </div>
        <div class="col-md-6 column">
          <div id="paypal_partner_logo"> <img alt="PayPal Partner and Certified Developer" src="../assets/images/paypal-partner-logo.png"/> </div>
        </div>
      </div>
      <h2 align="center">Order Review</h2>
      <p class="bg-info">Here we display a final review to the buyer now that we've calculated shipping, handling, tax and other charges. The
      billing and shipping information provided here is what we obtained by calling payment details API and
      </p>
      <p class="bg-info">
      The payment has not been processed at this point because we have not yet called the final Execute Payment API. That is what will
      happen when we click the "Complete Order" button below.
      </p>
      <table class="table table-bordered">
        <thead>
        <tr>
            <th>Sku</th>
            <th>Name</th>
            <th>Description</th>
            <th class="center">Price</th>
            <th class="center">QTY</th>
            <th class="center">Total</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($_SESSION['orderItems'] as $cart_item) {
            ?>
            <tr>
                <td><?php echo isset($cart_item['Sku']) ? $cart_item['Sku'] : ''; ?></td>
                <td><?php echo isset($cart_item['Name']) ? $cart_item['Name'] : ''; ?></td>
                <td><?php echo isset($cart_item['Description']) ? $cart_item['Description'] : '' ; ?></td>
                <td class="center"> $<?php echo isset($cart_item['Price']) ? number_format($cart_item['Price'],2) : ''; ?></td>
                <td class="center"><?php echo isset($cart_item['Quantity']) ? $cart_item['Quantity'] : ''; ?></td>
                <td class="center"> $<?php echo number_format($cart_item['Quantity'] * $cart_item['Price'],2); ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
      </table>
      <div class="row clearfix">
        <div class="col-md-4 column">
          <p><strong>Billing Information</strong></p>
          <p>
          	<?php
            echo (!empty($_SESSION['payer_info']['suffix'])) ? $_SESSION['payer_info']['suffix'].' ' : '';
            echo (!empty($_SESSION['payer_info']['first_name'])) ? $_SESSION['payer_info']['first_name'].' ' : '';
            echo (!empty($_SESSION['payer_info']['middle_name'])) ? $_SESSION['payer_info']['middle_name'].' ' : '';
            echo (!empty($_SESSION['payer_info']['last_name'])) ? $_SESSION['payer_info']['last_name'].' ' : '';
            echo (!empty($_SESSION['payer_info']['payer_id'])) ? '<br/><strong>Payer ID : </strong>'.$_SESSION['payer_info']['payer_id'] : '';
            echo (!empty($_SESSION['payment_id'])) ? '<br/><strong>Payment ID : </strong>'. $_SESSION['payment_id'] : '';
			?>
          </p>
        </div>
        <div class="col-md-4 column">
          <p><strong>Shipping Information</strong></p>
          <p>
          	<?php
            echo (!empty($_SESSION['shipping_address']['line1'])) ? $_SESSION['shipping_address']['line1'] : '';
            echo (!empty($_SESSION['shipping_address']['line2'])) ? '<br/>'.$_SESSION['shipping_address']['line2'] : '';
            echo (!empty($_SESSION['shipping_address']['city'])) ? '<br/>'.$_SESSION['shipping_address']['city'].', ' : '';
            echo (!empty($_SESSION['shipping_address']['state'])) ? $_SESSION['shipping_address']['state'].', ' : '';
            echo (!empty($_SESSION['shipping_address']['postal_code'])) ? $_SESSION['shipping_address']['postal_code'].', ' : '';
            echo (!empty($_SESSION['shipping_address']['country_code'])) ? $_SESSION['shipping_address']['country_code'] : '';
            echo (!empty($_SESSION['shipping_address']['phone'])) ? '<br/>'.$_SESSION['shipping_address']['phone'] : '';
            echo (!empty($_SESSION['shipping_address']['type'])) ? '<br/> Address Type : '.$_SESSION['shipping_address']['type'] : '';
			?>
          </p>
        </div>
          <div class="col-md-4 column">
              <table class="table">
                  <tbody>
                  <tr>
                      <td><strong> Subtotal</strong></td>
                      <td> $<?php echo isset($_SESSION['paymentDetails']['Subtotal']) ? number_format($_SESSION['paymentDetails']['Subtotal'],2) : ''; ?></td>
                  </tr>
                  <tr>
                      <td><strong>Shipping</strong></td>
                      <td>$<?php echo isset($_SESSION['paymentDetails']['Shipping']) ? number_format($_SESSION['paymentDetails']['Shipping'],2) : ''; ?></td>
                  </tr>
                  <tr>
                      <td><strong>Tax</strong></td>
                      <td>$<?php echo isset($_SESSION['paymentDetails']['Tax']) ? number_format($_SESSION['paymentDetails']['Tax'],2) : ''; ?></td>
                  </tr>
                  <tr>
                      <td><strong>Gift Wrap</strong></td>
                      <td>$<?php echo isset($_SESSION['paymentDetails']['GiftWrap']) ? number_format($_SESSION['paymentDetails']['GiftWrap'],2) : '0.00'; ?></td>
                  </tr>
                  <tr>
                      <td><strong>Grand Total</strong></td>
                      <td>$<?php echo isset($_SESSION['amount']['Total']) ? number_format($_SESSION['amount']['Total'],2) : ''; ?></td>
                  </tr>
                  <tr>
                      <td class="center" colspan="2"><a href="ExecutePayment.php" class="btn btn-success btn-lg" role="button">Complete Order</a></td>
                  </tr>
                  </tbody>
              </table>
          </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>