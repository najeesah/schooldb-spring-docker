<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Vindicia Hosted Fields Documentation">
    <meta name="author" content="Herb Rubin">

    <title>Iframe Validation</title>
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
        <h3>Iframe Validation</h3>
        <p>Even though acces to iframe field data is restricted, you may validate these iframe fields in a few different ways:<p>
<ul>
<li>Inside your own merchant validation function at submit</li>
<li>As blur events happen when the user tabs from field to field in the iframes</li>
<li>As a call to vindicia.isValid() for all iframes or for a single iframe</li>
<li>Just let the submit button block naturally if the iframe fields are not filled in with valid data</li>
</ul>
      </div><!-- end col -->
    </div><!-- end row -->

    <div class="row">
      <div class="col-lg-8">
<h3>Methods to help you validate the iframe fields</h3>
<table class="table table-bordered">
<thead>
</thead>
<tbody>
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
  <td><p>This method will return a positive integer that is a count of characters inside the input box in the iframe. If no selector is specified or if the selector cannot find the iframe it will return zero.</p>
      <p>This is very useful when detecting if the card is an "amex" and in the CVV field four numbers were entered</p>
<pre>
  if (vindicia.cardType == "amex" && vindicia.dataLength('vin_credit_card_cvn') != 4)
  {
      alert("American Express CVV must be 4 numbers");
      return false
  }
</pre>
  </td>
<tr>
  <td>vindicia.isValid(<i>selector</i>)</td>
  <td><p>This method will return true or false if the input box in the iframe is valid. If no selector is specified it will return true if all iframes are valid and false if at least one iframe is not valid.</p>
<pre>
  if (!vindicia.isValid('vin_credit_card_account'))
  {
      alert('Please enter a valid credit card before submitting');
      return false
  }
</pre>
  </td>
</tr>
</tbody>
</table>
<h3>Accessing onblur events with vidicia.setup()</h3>

<pre>
  onVindiciaFieldEvent: function(event) {
      if (event.detail.fieldType == 'cardNumber') {
          setCardImage(event.detail.cardType); // bright or dim the card logo
      }
      if (event.detail.fieldType == 'expirationDate') {
          if (!event.detail.isValid)
          {
              console.log('vindiciaFieldEvent expirationDate not valid');
          }
      }
  },
</pre>
      </div>
    </div><!-- end row -->
  </div><!-- end container-fluid -->
</div><!-- end page-content-wrapper -->
</div><!-- wrapper -->
<?php include "footer.php"; ?>
</body>
</html>
