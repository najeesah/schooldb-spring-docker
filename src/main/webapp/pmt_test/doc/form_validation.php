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
        <h2>Merchant Form Validation</h2>
<p>When the user clicks the submit button on the form, you will want to validate the form fields before allowing the submit action to complete.</p>
<p>Since the vindicia object took over the submit event when you called <b>vindicia.setup()</b>, you cannot call a validation function directly. Instead your validation function will be called for you. Specify the validation function in vindicia.setup like this: </p>
<pre>
hostedFields: {
  onSubmitEvent: function(event) {
    return merchantValidate();
  },
},
</pre>

<p>Your validation function could look like this:</p>
<pre>
function merchantValidate(theform)
{
  if (!vindicia.isValid('vin_account_holder'))
  {
      alert('Please enter card holders name before submitting');
      return false;
  }
  if (!vindicia.isValid('vin_credit_card_account'))
  {
      alert('Please enter a valid credit card before submitting');
      return false;
  }
  else
  {
      if (!vindicia.isValid('vin_credit_card_expiration_date'))
      {
          alert('Please enter a valid expiration date YYYYMM before submitting');
          return false;
      }
  }

  if (theform.vin_account_holder.value.length == 0)
  {
      // non sensitive field
      alert('Please enter the Account Name');
      return false;
  }

  if (vindicia.cardType == "amex" && vindicia.dataLength('vin_credit_card_cvn') != 4)
  {
      alert("American Express CVV must be 4 digits");
      return false
  }
  return true;
}
</pre>

<p>You must return true or false.</p>
      </div><!-- end col -->
    </div><!-- end row -->
<a href="iframe_validation.php" class="btn btn-primary">Next: Iframe Validation</a>
  </div><!-- end container-fluid -->
</div><!-- end page-content-wrapper -->
</div><!-- wrapper -->
<?php include "footer.php"; ?>
</body>
</html>
