<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Vindicia Hosted Fields Documentation">
    <meta name="author" content="Herb Rubin">

    <title>vindicia.setup() example</title>
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
        <h3>A vindicia.setup() example</h3>
        <p>This Javascript example uses all the optional features of the vindicia.setup() method. It initializes the Hosted Fields on the checkout form.</p>
      </div><!-- end col -->
    </div><!-- end row -->

    <div class="row">
      <div class="col-lg-12">
<pre>
&lt;script&gt;
vindicia.setup({
  // Options
  formId: "mainForm", // dom element of form
  vindiciaAuthId: "aXdjbF9vbmVfdGltZV9sb2dpbjpBTG5JWnRjZA==", // Authorization: Basic header"
  vindiciaServer: "secure.qa.vindicia.com", // to load the iframes from
  vindiciaRestServer: "api.qa.vindicia.com", // REST server to submit JSON to
  hostedFields: {
    cardNumber: {
      selector: "#vin_credit_card_account",
      placeholder: "Enter Credit Card Number" // optional field
    },
    expirationDate: {
      selector: "#vin_credit_card_expiration_date",
      placeholder: "Expiration Date MM/YY", // optional field
      format: "MM/YY" // optional, default is MM/YY <span data-toggle="tooltip" title="All the supported formats are: MM/YY, MM-YY, MMYY, YY/MM, YY-MM, YYMM, YYYY/MM, YYYY-MM, YYYYMM, MM/YYYY, MM-YYYY, MMYYYY" data-placement="right" class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
    },
    cvn: { 
      selector: "#vin_credit_card_cvn",
      placeholder: "Enter CVV" // optional field
    },
    styles: { // optional
      "input": {
        "width": "100%",
        "font-family": "'Helvetica Neue',Helvetica,Arial,sans-serif",
        "font-size": "14px",
        "color": "#555",
        "height": "34px",
        "padding": "6px 12px",
        "margin": "5px 0px",
        "line-height": "1.42857",
        "border": "1px solid #ccc",
        "border-radius": "4px",
        "box-shadow": "0px 1px 1px rgba(0,0,0,0.075) inset",
        "-webkit-transition": "border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s",
        "transition": "border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s",
      },
      ":focus": { // optional
         "border-color": "#66afe9",
         "outline": "0",
         "-webkit-box-shadow": "inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6)",
         "box-shadow": "inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6)"
      },
      ".valid": { // optional
         "border-color": "#228B22",
      },
      ".notValid": { // optional
         "border-color": "#ff0000",
      },
      // custom width
      "@media (min-width: 600px) and (max-width: 800px)": {
         "input": {
            "font-size": "16pt"
         }
      }
    },
  },
  iframeHeightPadding: 2, // optional
  onSubmitEvent: function(myform) {
      return merchantValidate(myform); <span data-toggle="tooltip" title="This method is for your use to interact with the user when he presses the submit button. Its for when you want to validate the fields yourself." data-placement="right" class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
  },
  onSubmitCompleteEvent: function(data) {
      $('#message').html('submitted OK, vid ' + data.detail.vid);
      return;
  },
  onSubmitCompleteFailedEvent: function(data) {
      console.log(data.detail.status);
      if (data.detail.error) {
          console.log(data.detail.error);
      }
      return true; <span data-toggle="tooltip" title="This method is for your use to interact with the user when he presses the submit button and the payment method is not created." data-placement="right" class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
  },
  onVindiciaFieldEvent: function(event) { // optional
      if (event.detail.fieldType == 'cardNumber') {
          setCardImage(event.detail.cardType); // bright or dim the card logo <span data-toggle="tooltip" title="This function is just an example of what you can do with this event." data-placement="right" class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
      }
      if (event.detail.fieldType == 'expirationDate') {
          if (!event.detail.isValid)
          {
              console.log('vindiciaEvent expirationDate not valid');
          }
      }
      if (event.detail.fieldType == 'cvn') {
          if (!event.detail.isValid)
          {
              console.log('vindiciaEvent cvn not valid');
          }
          console.log('cvn length ' + event.detail.dataLength);
      }
  }
});

// optional function shown being used above
function setCardImage(type)
{
  // use a sprite to display one credit card logo brightly with JQuery
  if (type == 'visa' || type == 'visa_electron') {  
      $('#ccTypeImage').css('background-position', '0 -23px');  
  }  
  else if (type == 'mastercard' || type == 'maestro') {
      $('#ccTypeImage').css('background-position', '0 -46px');  
  }  
  else if (type == 'amex') {
      $('#ccTypeImage').css('background-position', '0 -69px');  
  }  
  else if (type == 'discover') {
      $('#ccTypeImage').css('background-position', '0 -92px');  
  }  
  else {
      $('#ccTypeImage').css('background-position', '0 0');  
  }     
}

&lt;/script&gt;
</pre>
<p>The function "merchantValidate(myform)" will be a custom function written by you.</p>
<a href="setup_options.php" class="btn btn-primary">Next: setup options explained</a>
      </div>
    </div><!-- end row -->
  </div><!-- end container-fluid -->
</div><!-- end page-content-wrapper -->
</div><!-- wrapper -->
<?php include "footer.php"; ?>
</body>
</html>
