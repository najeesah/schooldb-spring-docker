<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Vindicia Hosted Fields Documentation">
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
        <h2>The vindicia object: properties and methods</h2>
      </div><!-- end col -->
    </div><!-- end row -->

    <div class="row">
      <div class="col-lg-8">
<p>The following properties are supported:</p>
<table class="table table-bordered">
<thead>
</thead>
<tbody>
<tr>
  <td>vindicia.setup</td>
  <td>The heart of this Hosted Fields system. It is described in more detail on <a href="vindicia_setup.php">its own page</a>. But basically calling this function will take over the submit event and create iframes on your checkout page. Each iframe represents a single input field such as credit card number or expiration date.</td>
</tr>
<tr>
  <td>vindicia.cardType</td>
  <td><p>A string property that will hold the short name of the card type that was detected:</p>
      <p>The supported values are:</p>
      amex<br/>
      dankort<br/>
      diners_club_carte_blanche<br/>
      diners_club_international<br/>
      discover<br/>
      jcb<br/>
      laser<br/>
      visa_electron<br/>
      visa<br/>
      mastercard<br/>
      maestro<br/>
  </td>
</tr>
<tr>
  <td>vindicia.dataLength(<i>selector</i>)</td>
  <td><p>This method will return an integer that is a count of characters inside the input box in the iframe. If no selector is specified or if the selector cannot find the iframe it will return zero.</p>
      <p>This is very useful when detecting if the card is an "amex" and in the CVV field four numbers were entered</p>
<pre>
  if (vindicia.cardType == "amex" && vindicia.dataLength('vin_credit_card_cvn') != 4)
  {
      alert("American Express CVV must be 4 numbers");
      return false
  }
</pre>
  </td>
</tr>
<tr>
  <td>vindicia.isValid(<i>selector</i>)</td>
  <td><p>This method will return a boolean value that represents if the input box in the iframe is valid. If no selector is specified it will check all the iframe input boxes and return true if all are valid and false if at least one is not valid.</p>
<pre>
  if (!vindicia.isValid('vin_credit_card_account'))
  {
      alert('Please enter a valid credit card before submitting');
  }
</pre>
  </td>
</tr>
<tr>
  <td>vindicia.isSynced()</td>
  <td><p>This method will return true if all the iframes have reported their data to the master iframe and the notified the parent window its validity status. This method will return false if at least one iframe has not reported its data. The reporting happens normally during an onblur or onchange event.
This method was added to help work around a Mobile Safari bug where blur events were not consistently being triggered.</p>
  </td>
</tr>
<tr>
  <td>vindicia.clearSyncFlags()</td>
  <td><p>This method will set all iframe sync values to false. It is usually called right before syncData().
    <p>This method is also used on submit to ensure any changes in the form fields are captured.</p>
  </td>
</tr>
<tr>
  <td>vindicia.syncData()</td>
  <td><p>This method will send a message to each iframe to simulate a blur event. This will cause the iframes to validate its form data, send its results to the master iframe and notify the parent window for validation purposes. 
This method was added to help work around a Mobile Safari bug where blur events were not consistently being triggered. See also isSynced() and clearSyncFlags()</p>
<p>This method is also used on submit to ensure any changes in the form fields are captured.</p>
<pre>
setInterval(function() { vindicia.syncData(); },300);
</pre>
  </td>
</tr>
<tr>
  <td>vindicia.clearData()</td>
  <td><p>This method clear the data in the iframes input boxes and dropdown boxes</p>
    <p>It will also clear the sync flags and isValid flags. It will also set isComplete() to false</p>
  </td>
</tr>
<tr>
  <td>vindicia.isLoaded()</td>
  <td><p>This method returns true if all the iframes have reported to the parent window that they are loaded.</p>
    <p>We use this when dealing with a Chrome bug that lets random focus and blur events happen during iframe loading.</p>
  </td>
</tr>
<tr>
  <td>vindicia.resetCompleteStatus()</td>
  <td><p>This method will set isComplete() to false. This allows the submit button to initiate a POST again.</p>
      <p>This is useful in single page apps where you do not want to call clearData()</p>
  </td>
</tr>
<tr>
  <td>vindicia.submit()</td>
  <td><p>This method will cause the form to begin its three phase submit directly to vindicia.com <b>as long as the data is valid</b></p>
<p>Not required for normal operation.</p>
  </td>
</tr>
<tr>
  <td>vindicia.isComplete()</td>
  <td><p>This method will return true if the form has already been submitted to Vindicia.</p>
<p>Not required for normal operation.</p>
  </td>
</tr>
<tr>
  <td>vindicia.onSubmitComplete(<i>event</i>)</td>
  <td><p>This method will indicate that you would like to use AJAX to submit the fields. This method will be called when the POST is finished</p>
<p>Optional</p>
<pre>
onSubmitCompleteEvent: function(event) {
    $('#message').html('submitted OK, vid ' + event.detail.vid);
    return;
},
</pre>
  </td>
</tr>
</tbody>
</table>
      </div>
    </div><!-- end row -->
  </div><!-- end container-fluid -->
</div><!-- end page-content-wrapper -->
</div><!-- wrapper -->
<?php include "footer.php"; ?>
</body>
</html>
