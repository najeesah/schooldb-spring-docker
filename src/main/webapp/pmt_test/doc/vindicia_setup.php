<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Vindicia Payment Method Tokenization">
    <meta name="author" content="Herb Rubin">

    <title>How To Set It Up</title>
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
<p>This explains how to use a checkout page for PCI SAQ A compliance with our REST back end. We call this Payment Method Tokenization PMT.</p>
<h2>Step 1: div Tags In Your Form</h2>
<p>Place a div tag into your form <b>instead of an input field</b> for sensitive data such as credit card number, expiration date and cvn.
<br />So this:</p>
<pre>
&lt;input type="text" id="vin_credit_card_account" name="vin_credit_card_account" placeholder="Enter Credit Card Number" /&gt;
</pre>
<p>Becomes this:</p>
<pre>
&lt;div id="vin_credit_card_account"&gt;&lt;/div&gt;
</pre>
<a href="pmt_fields_list.php">See all the fields</a>


        <h2>Step 2: Include vindicia.js on your checkout page</h2>
<pre>
&lt;script src="https://secure.vindicia.com/pmt/vindicia.js"&gt;&lt;/script&gt;
</pre>
        <p>There is no requirement of JQuery or any other Javascript framework. But we do recommend including vindicia.js after you include the framework file.</p>
        <p>Note: This will instantiate an object called "vindicia" for you.</p>

        <h2>Step 3: Call vindicia.setup() with options</h2>
        <p>Call the <b>vindicia.setup()</b> method to initialize the Hosted Fields on your checkout form.</p>
<p>Note: vindicia.setup() <b>will take over the submit event</b> in your form. So, to do validation please read on.</p>
<p>You will need to pass in some options to the setup() method.</p>
<pre>
&lt;script&gt;
vindicia.setup(options);
&lt;/script&gt;
      </div><!-- end col -->
    </div><!-- end row -->
<a href="setup_example.php" class="btn btn-primary">Next: setup() example</a>
  </div><!-- end container-fluid -->
</div><!-- end page-content-wrapper -->
</div><!-- wrapper -->
<?php include "footer.php"; ?>
</body>
</html>
