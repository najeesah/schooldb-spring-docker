<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Vindicia Hosted Fields Documentation">
    <meta name="author" content="Herb Rubin">

    <title>Browser Security Notes</title>
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
        <h1>Browser Security Notes</h1>
<h3>Same Origin Policy</h3>
<p>Browser windows and iframes cannot share data unless they are loaded from the same domain (origin). This standard security policy in web browsers allows Vindicia to leverage <a href="pci_compliance.php">SAQ A PCI compliance</a> for the merchant checkout page.</p>

<p>Sensitive credit card fields are loaded in iframes from Vindicia’s web server while the other non-sensitive checkout form fields are loaded in the parent window (from the merchant web server). Each iframe represents one secure input box.</p>

<p>This will cause the browser to block direct access to the data in each of these iframes. </p>

<p>However messages (events) are allowed to be passed back and forth between them. This is how Vindicia will coordinate the submit button on the parent window to tell the iframes to submit their data.</p>

      </div>
    </div><!-- end row -->
  </div><!-- end container-fluid -->
</div><!-- end page-content-wrapper -->
</div><!-- wrapper -->
<?php include "footer.php"; ?>
</body>
</html>
