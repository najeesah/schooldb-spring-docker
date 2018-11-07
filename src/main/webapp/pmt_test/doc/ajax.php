<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Vindicia Hosted Fields Documentation">
    <meta name="author" content="Herb Rubin">

    <title>Hosted Fields Using AJAX</title>
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
        <h3>Using AJAX with PMT, The Easy Way</h3>
        <p>If you include the following element "onSubmitCompleteEvent" in your setup method, then AJAX will be used. Control will return to you after the POST.</p>
        <pre>
onSubmitCompleteEvent: function(data) {
    $('#message').html('submitted OK, vid ' + data.detail.vid);
    return;
},
        </pre>
        <p>If this element is missing then the url returned from the POST will cause the browser to redirect there.</p>
        <h3>Using AJAX with PMT, The Single Page App</h3>
        <p>If you want a single page app then keep in mind that after the POST, the One time login string will be invalid. You are only allowed one POST per one time login. You will have to refresh the one-time-login value and signed value in the hidden fields in the form.</p>
        <p>Then you must call vindicia.clearData() to notify the iframes to reset their data. This also unblocks the submit button.</p>
        <pre>
           var newOTL = getNewOTL();
           $('#vin_session_id').value = newOTL.unsignedValue;
           $('#vin_session_hash').value = newOTL.signedValue;
           vindicia.clearData();
        </pre>
        <p>Note: getNewOTL() is a Javascript method you will have to write that makes an ajax request back to your merchant server.</p>
        <p>This is useful if the user wants to enter more than one payment method. You do not have to refresh the OTL value on failed POSTs to the REST server.</p>
      </div>
    </div><!-- end row -->
  </div><!-- end container-fluid -->
</div><!-- end page-content-wrapper -->
</div><!-- wrapper -->
<?php include "footer.php"; ?>
</body>
</html>
