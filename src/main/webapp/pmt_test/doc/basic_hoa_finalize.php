<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Vindicia Hosted Fields Documentation">
    <meta name="author" content="Herb Rubin">
    <title>Hosted Fields Documentation</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head><body><div id="wrapper">
<?php include "sidebar.php"; ?>
<!-- Page Content -->
<div id="page-content-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-10">
        <h1>Vindicia Hosted Fields Documentation</h1>
      </div>
      <div class="col-lg-2">
        <a href="#menu-toggle" class="btn btn-info btn-xs pull-right" id="menu-toggle">Toggle Menu</a>
      </div><!-- end class -->
    </div><!-- end row -->

    <div class="row">
      <div class="col-lg-12">
<h3>Basic HOA Finalize</h3>
<p>You may finalize via browser redirect or via an AJAX call. The description below works either way.</p>
<h4>1) Include the SOAP Client in your page</h4>
<pre>
&lt;?php
require_once("Vindicia/Soap/Vindicia.php");
?&gt;
</pre>
<h4>2) Retrieve the WebSession</h4>
<p>Pass the session ID to this PHP page so we can retrieve the object from Vindicia</p>
<pre>
&lt;?php
$session_id = $_GET['session_id'];

$websession = new WebSession();
$srd = ""; // Soap version 13.0 and higher uses SRD
$response = $websession->fetchByVid($srd, $session_id);
$return_code = $response['returnCode'];
$response_object = $response['data'];
$websession = $response_object->session;
?&gt;
</pre>
<h4>3) See if fetchByVid succeeded</h4>
<pre>
&lt;?php
if (($return_code=="200") && ($websession->apiReturn->returnCode == "200"))
{
  // All is good to finalize
else
{
  // fetchByVid failed
  $error_message = $websession->apiReturn->returnCode . " " . $websession->apiReturn->returnString;
}
?&gt;
</pre>
<h4>4) Finalize WebSession</h4>
<pre>
&lt;?php
  $show_receipt = false;
  $srd = "";
  $response_final = $websession->finalize($srd);
  $response_object_final = $response_final['data'];
  $websession_final = $response_object_final->session;
  if ($response_final['returnCode'] == 200)
  {
      if ($websession_final->apiReturn->returnCode == "200")
      {
          // Created autobill, show receipt page
          $show_receipt = true;
      }
      else
      {
          // finalize failed
          $error_message = $websession_final->apiReturn->returnString;
      }
  }
  else
  {
      // Tried to reuse an old WebSession?
      $error_message = $response_final['returnString'];
  }
?&gt;
</pre>
<h4>5) Show Receipt Data In Browser from WebSession</h4>
<pre>
&lt;?php
  if ($show_receipt)
  {
      $receipt_values = $websession_final->apiReturnValues->autoBillUpdate->autobill;
      $trans = $websession_final->apiReturnValues->autoBillUpdate->initialTransaction;
      $pay_method = $trans->sourcePaymentMethod;

      $account = $receipt_values->account->merchantAccountId;
      $name    = $receipt_values->account->name;
      $cc_number = $pay_method->creditCard->account;
      $billing_plan = $receipt_values->billingPlan->description;
      $trans_id = $trans->merchantTransactionId;
      $currency = $trans->currency;
      $amount   = $trans->amount;
?&gt;
    &lt;h3&gt;Receipt&lt;/h3&gt;
    &lt;p&gt;Account: &lt;?php print $account; ?&gt;&lt;/p&gt;
    &lt;p&gt;Name: &lt;?php print $name; ?&gt;&lt;/p&gt;
    &lt;p&gt;Transaction: &lt;?php print $trans_id; ?&gt;&lt;/p&gt;

    &lt;table class="table"&gt;
    &lt;thead&gt;
      &lt;tr&gt;
        &lt;th&gt;Quantity&lt;/th&gt;
       &lt;th&gt;Description&lt;/th&gt;
       &lt;th&gt;Amount&lt;/th&gt;
      &lt;/tr&gt;
    &lt;/thead&gt;
    &lt;tbody&gt;
&lt;?php
    foreach ($trans->transactionItems as $line_item)
    {
        print "&lt;tr&gt;";
        $description = $line_item->name;
        $price = $line_item->price;
        $quantity = $line_item->quantity;

        print "&lt;td&gt; . $quantity . "&lt;td&gt;";
        print "&lt;td&gt; . $description . "&lt;td&gt;";
        print "&lt;td&gt; . $price . "&lt;td&gt;";
        print "&lt;tr&gt;";
    }
?&gt;
    &lt;tbody&gt;
    &lt;tfoot&gt;
    &lt;tr&gt;
      &lt;td&gt;&nbsp;&lt;/td&gt;
      &lt;td&gt;&nbsp;&lt;/td&gt;
      &lt;td&gt;&lt;strong&gt;&lt;?php print $amount; ?&gt;&lt;/strong&gt;&lt;/td&gt;
    &lt;/tr&gt;
    &lt;/tfoot&gt;
    &lt;/table&gt;
&lt;?php
  } // bottom of "if show_receipt"
?&gt;

</pre>

      </div>
    </div><!-- end row -->
  </div><!-- end container-fluid -->
</div><!-- end page-content-wrapper -->
</div><!-- wrapper -->
<!-- jQuery -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- Menu Toggle Script -->
<script>
  $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
  });
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>
</body>
</html>

