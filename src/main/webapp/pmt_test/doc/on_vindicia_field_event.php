<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Vindicia Hosted Fields Documentation">
    <meta name="author" content="Herb Rubin">

    <title>Understanding onVindiciaFieldEvent</title>
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
        <h3>Understanding onVindiciaFieldEvent</h3>
        <p>Events happen inside the iframes that the parent window will not be allowed to respond to. The onVindiciaFieldEvent property can be used to call your function when validation events are happening inside the iframes.</p>
<pre>
  onVindiciaFieldEvent: function(event) {
      if (event.detail.fieldType == 'cardNumber') {
          setCardImage(event.detail.cardType); // bright or dim the card logo
      }
      if (event.detail.fieldType == 'expirationDate') {
          if (!event.detail.isValid)
          {
              alert('vindiciaFieldEvent expirationDate not valid');
          }
      }
      if (event.detail.fieldType == 'cvn') {
          if (!event.detail.isValid && event.detail.dataLength > 0)
          {
              alert('vindiciaFieldEvent cvn not valid');
          }
      }
  }
</pre>
      </div><!-- end col -->
    </div><!-- end row -->

    <div class="row">
      <div class="col-lg-8">
<table class="table table-bordered">
<thead>
</thead>
<tbody>
<tr>
  <td>event.detail.fieldType</td>
  <td><p>cardNumber, expirationDate, cvn.</p>
      <p>cardNumber: validation by luhn check, forces all numeric characters, returns a cardType if detectable.<br />
         expirationDate: Defaults to mm/yy format for validation. But you may specify another format.<br />
         cvn: Forces all numeric characters, is valid if character count is 3 or 4.
  </td>
</tr>
<tr>
  <td>event.detail.cardType</td>
  <td><p>A string property that will hold the short name of the card type that was detected. It only exists on events with fieldType 'cardNumber'.</p>
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
  <td>event.detail.isValid</td>
  <td>A boolean value. True means the data is acceptable and can be submitted. False means that its illegal or incomplete.</td>
</tr>
<tr>
  <td>event.detail.dataLength</td>
  <td><p>This method will return an integer that is a count of characters inside the input box in the iframe. An blank field returns zero.</p>
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
