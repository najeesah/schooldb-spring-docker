<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Vindicia Payment Method Tokenization Documentation">
    <meta name="author" content="Herb Rubin">

    <title>Payment Method Tokenization Documentation</title>
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
        <p>These pages will teach you how to use our new PMT option. It is very flexible.</p>
        <p>This system conforms with <a href="pci_compliance.php">PCI SAQ A compliance</a>
      </div>
    </div><!-- end row -->
    <div class="row">
      <div class="col-lg-12">
          <h3>What is it?</h3>
          <p>Payment method tokenization (PMT) is very similar to HOA (Hosted Order Automation). This means you can accept credit cards on your website securely without ever handling the sensitive information within your network.</p>
          <p>What makes it different is that PMT uses REST (api.vindicia.com) to send the credit card information back to Vindicia. HOA uses the SOAP interface. Also, PMT can only create a payment method. It does not create other objects that HOA can.</p>
      </div>
    </div><!-- end row -->
  </div><!-- end container-fluid -->
</div><!-- end page-content-wrapper -->
</div><!-- wrapper -->
<?php include "footer.php"; ?>
</body>
</html>
