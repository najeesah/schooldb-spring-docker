<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Vindicia Hosted Fields Documentation">
    <meta name="author" content="Herb Rubin">

    <title>Allowed Styles in iframes</title>
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
        <h3>Allowed Styles in vindicia.setup() for Iframes</h3>
        <p>When passing in styles via the setup() method, we only allow these specific tags:</p>
      </div><!-- end col -->
    </div><!-- end row -->

    <div class="row">
      <div class="col-lg-12">
<pre>
color
width
height
border
border-color
border-radius
font
font-family
font-size
font-size-adjust
font-stretch
font-style
font-variant
font-variant-alternates
font-variant-caps
font-variant-east-asian
font-variant-ligatures
font-variant-numeric
font-weight
line-height
opacity
outline
padding
margin
text-shadow
box-shadow
-webkit-box-shadow
-moz-osx-font-smoothing
-moz-transition
-webkit-font-smoothing
-webkit-transition
transition
</pre>
<p>Any other styles will be ignored. Attempts to send script tags in values will also be ignored.</p>
<a href="setup_options.php" class="btn btn-primary">Next: setup options explained</a>
      </div>
    </div><!-- end row -->
  </div><!-- end container-fluid -->
</div><!-- end page-content-wrapper -->
</div><!-- wrapper -->
<?php include "footer.php"; ?>
</body>
</html>
