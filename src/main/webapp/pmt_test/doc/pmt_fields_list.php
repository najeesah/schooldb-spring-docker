<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Vindicia Hosted Fields Documentation">
    <meta name="author" content="Herb Rubin">

    <title>PMT Fields List</title>
<?php include "css_include.php"; ?>
</head>
<body>
<div id="wrapper">
<?php include "sidebar.php"; ?>
<!-- Page Content -->
<div id="page-content-wrapper">
  <div class="container-fluid">
<?php include "top.php"; ?>
    <div class="row">
      <div class="col-lg-12">
        <h3>PMT Fields List</h3>
        <p>These are the allowed form field names for Payment Method Tokenization</p>
<table class="table table-bordered">
<tr><th>Name In Form</th><th>Type</th><th>Notes</th></tr>
<tr><td>vin_session_id</td><td>input</td><td>Required and must be unique on each successful submit</td></tr>
<tr><td>vin_session_hash</td><td>hidden</td><td>Required and must be unique on each successful submit. HMAC256 or HMAC512</td></tr>
<tr><td>vin_id</td><td>hidden</td><td>Optional but recommended. This is the unique merchant payment method identifier</tr>
<tr><td>vin_vid</td><td>hidden</td><td>Optional. Used for updating an existing payment method.</td></tr>
<tr><td>vin_customer_specified_type</td><td>hidden</td><td>Optional</td></tr>
<tr><td>vin_primary</td><td>hidden</td><td>Optional: true or false</td></tr>
<tr><td>vin_active</td><td>hidden</td><td>Optional: true or false</td></tr>
<tr><td>vin_billing_address_line1</td><td>input</td><td></td></tr>
<tr><td>vin_billing_address_line2</td><td>input</td><td></td></tr>
<tr><td>vin_billing_address_line3</td><td>input</td><td></td></tr>
<tr><td>vin_billing_address_city</td><td>input</td><td></td></tr>
<tr><td>vin_billing_address_district</td><td>input</td><td>Also known as state in the US</td></tr>
<tr><td>vin_billing_address_postal_code</td><td>input</td><td></td></tr>
<tr><td>vin_billing_address_country</td><td>input</td><td></td></tr>
<tr><td>vin_billing_address_phone</td><td>input</td><td></td></tr>
<tr><td>vin_credit_card_account</td><td>div</td><td>Required. The credit card number</td></tr>
<tr><td>vin_credit_card_expiration_date</td><td>div</td><td>not needed if month and year specified</td></tr>
<tr><td>vin_credit_card_expiration_month</td><td>div</td><td>not needed if date specified. Dropdown and input boxes are supported</td></tr>
<tr><td>vin_credit_card_expiration_year</td><td>div</td><td>not needed if date specified. Dropdown and input boxes are supported</td></tr>
<tr><td>vin_credit_card_cvn</td><td>div</td><td></td></tr>
</table>

<h3>Notes about onSubmitCompleteFailedEvent</h3>
<p>The callback function onSubmitCompleteFailedEvent will be called when the submit button does not return 200 (success) from the REST server.</p>
<pre>
         onSubmitCompleteFailedEvent: function(data) {
             $('#message').html('submitted Failed');
             console.log(data.detail.status); // server return code
             if (data.detail.error) {
                 console.log(data.detail.error);
             }
             return true;
         },
</pre>
<p>If the vindiciaAuthId used in the vindicia.setup() call is not valid you will receive a 403 Forbidden from the REST server. This might appear as a status code of zero in Javascript because of the browser.</p>
<p>You might receive a status code of 400 if:</p>
<ul>
<li>The id POSTed is already in use</li>
<li>The onetime login is reused from a previous successful POST</li>
</ul>
<p>For example:</p>
<pre>
400 PaymentMethod already exists: id="paymeth_100"
</pre>
<p>would be returned from the REST server if you try to create a payment method but the id was already used</p>
      </div><!-- end col -->
    </div><!-- end row -->

    <div class="row">
      <div class="col-lg-12">
      </div>
    </div>
  </div><!-- container -->
</div>
</body>
</html>
