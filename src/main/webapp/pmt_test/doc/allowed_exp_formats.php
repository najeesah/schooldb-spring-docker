<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Vindicia Hosted Fields Documentation">
    <meta name="author" content="Herb Rubin">

    <title>Allowed Expiration Date Format</title>
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
        <h3>Allowed Expiration Date Format</h3>
        <p>When passing in format via the setup() method, we only allow these specific month and year formats:</p>
      </div><!-- end col -->
    </div><!-- end row -->

    <div class="row">
      <div class="col-lg-12">
<pre>
MM/YY
MM-YY
MMYY
YY/MM
YY-MM
YYMM
YYYY/MM
YYYY-MM
YYYYMM
MM/YYYY
MM-YYYY
MMYYYY
</pre>
<p>The default format is MM/YY. Any other format will cause a browser error</p>
<a href="setup_options.php" class="btn btn-primary">Next: setup options explained</a>
      </div>
    </div><!-- end row -->
  </div><!-- end container-fluid -->
</div><!-- end page-content-wrapper -->
</div><!-- wrapper -->
<?php include "footer.php"; ?>
</body>
</html>
