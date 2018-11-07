<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Vindicia Hosted Fields Documentation">
    <meta name="author" content="Herb Rubin">
    <title>Payment Method Tokenization Setup</title>
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
        <h1>Payment Method Tokenization</h1>
      </div>
      <div class="col-lg-2">
        <a href="#menu-toggle" class="btn btn-info btn-xs pull-right" id="menu-toggle">Toggle Menu</a>
      </div><!-- end class -->
    </div><!-- end row -->

    <div class="row">
      <div class="col-lg-12">
<h3>Basic PMT setup</h3>
<h4>1) Include the vindicia javascript file in your page near the bottom.</h4>

<pre>
&lt;script src="https://secure.vindicia.com/ws/vindicia.js"&gt;&lt;/script&gt;
</pre>

<h4>2) Generate a new one time login string</h4>
<p>Choose a unique string we call a "session id" and place it into the form as a hidden field. This string will be used in the payment method
object that gets created on form submission. This is your unique identifier.</p>
<p>Using your OTL HMAC key that Vindicia provided for you, create a hash using HMAC256 or HMAC512. The format of this string is:</p>
<pre>
session_id#POST#/payment_methods
</pre>
<pre>
#! /usr/bin/perl
use Digest::SHA qw(hmac_sha256_hex hmac_sha512_hex);

my $otl_hmac_key = 'Zb7xZDtJ4OEHNZ9-Y7IjvPYn4N4';
my $session_id = "CC4930533";
my $session = "$session_id#POST#/payment_methods";
my $session_hash = hmac_sha256_hex($session, $otl_hmac_key);
print "session_id:   $session_id\n";
print "session_hash: $session_hash\n";
</pre>

<p>Results of above Perl program run would be:</p>
<pre>
session_id:   CC4930533
session_hash: 511e8c48bc8b1caa9def400fc11975391440e0c72fc9c630edafb8d46691aec5
</pre>

<h4>3) Create a form with some hidden fields</h4>
<p>Two of which are required</p>
<pre>
&lt;h3&gt;Credit/Debit Card Information&lt;/h3&gt;

&lt;form id="mainForm" name="mainForm" class="form-horizontal" method="post"&gt;
&lt;input name="vin_session_id" value="CC403930495" type="hidden" /&gt;
&lt;input name="vin_session_hash" value="4812242031705a2413c6363067298bb3023b474084d11614c89a089f6ba35ec9" type="hidden" /&gt;
</pre>

<h4>4) Create some input fields not requiring protection</h4>
<pre>
&lt;input type="text" id="vin_account_holder" name="vin_account_holder" placeholder="Enter Cardholder Name" value=""/&gt;
&lt;input type="text" id="vin_billing_address_line1" name="vin_billing_address_line1" placeholder="Enter Address Line 1" value=""/&gt;
&lt;input type="text" id="vin_billing_address_line2" name="vin_billing_address_line2" placeholder="Enter Address Line 2" value=""/&gt;
&lt;input type="text" id="vin_billing_address_line3" name="vin_billing_address_line3" placeholder="Enter Address Line 3" value=""/&gt;
&lt;input type="text" id="vin_billing_address_city" name="vin_billing_address_city" placeholder="Enter City" value=""/&gt;
&lt;input type="text" id="vin_billing_address_district" name="vin_billing_address_district" placeholder="Enter State" value=""/&gt;
&lt;input type="text" id="vin_billing_address_postal_code" name="vin_billing_address_postal_code" placeholder="Enter Cardholder Name" value=""/&gt;
&lt;input type="text" id="vin_billing_address_country" name="vin_billing_address_country" placeholder="Enter Country" value=""/&gt;
&lt;input type="text" id="vin_billing_address_phone" name="vin_billing_address_phone" placeholder="Enter Phone Number" value=""/&gt;
</pre>

<h4>5) Create some input fields requiring protection as div tags</h4>
<pre>
&lt;div id="vin_credit_card_account"&gt;&lt;/div&gt;
&lt;div id="vin_credit_card_expiration_date"&gt;&lt;/div&gt;
&lt;div id="vin_credit_card_cvn"&gt;&lt;/div&gt;
</pre>

<h4>6) Call vindicia.setup to establish the protected fields inside iframes</h4>
<pre>
&lt;script type="text/javascript"&gt;
  vindicia.setup(options);
&lt;/script&gt;
</pre>
<p>Learn more about <a href="setup_example.html">setting up options</a></p>

<h3>Using Javascript for HMAC hash</h3>

<p>See <a href="https://github.com/brix/crypto-js">https://github.com/brix/crypto-js</a></p>

<pre>
&lt;script&gt;
  var otl_hmac_key = "A39485F85039D394059B948390";
  var vin_session_id = "CC403930495";
  var vin_session_hash = CryptoJS.HmacSHA512(vin_session_id + "#POST#/payment_methods", otl_hmac_key);
&lt;/script&gt;
</pre>

      </div>
    </div><!-- end row -->
  </div><!-- end container-fluid -->
<a href="basic_hoa_finalize.php" class="btn btn-primary">Next: Basic HOA Finalize</a>
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

