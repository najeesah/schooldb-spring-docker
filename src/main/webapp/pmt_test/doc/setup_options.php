<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Vindicia Hosted Fields Documentation">
    <meta name="author" content="Herb Rubin">

    <title>Setup Options Explained</title>
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
        <h3>vindicia.setup() options explained</h3>
        <p>The setup method takes 1 argument:</p>
<pre>
vindicia.setup(options);
</pre>

<table class="table table-bordered">
<thead>
</thead>
<tbody>
<tr>
<td>options</td>
<td><p>The top level options are:</p>
<table class="table table-bordered">
<thead>
</thead>
<tbody>
<tr>
  <td>formId: </td>
  <td>Required, string</td>
  <td>This is the id of the form as shown below in this sample HTML:
<pre>
&lt;form id="mainform"&gt;
</pre>
<p>And would look like this:</p>
<pre>
formId: mainform,
</pre>
</td>
</tr>

<tr>
  <td>vindiciaAuthId:</td>
  <td>Required, object</td>
  <td><p>This option is for your login. We use it for "Basic Authentication"</p>
      <pre>
vindiciaAuthId: "aXdjbF9vbmVfdGltZV9sb2dpbjpBTG5JWnRjZA==", // Authorization: Basic header"
      </pre>
  </td>
</tr>

<tr>
  <td>vindiciaServer:</td>
  <td>Required, object</td>
  <td><p>This option specifies the vindicia server from where to load the iframes from. If not provided it will default to "secure.vindicia.com"</p>
      <pre>
vindiciaServer: "secure.vindicia.com",
      </pre>
  </td>
</tr>

<tr>
  <td>vindiciaRestServer:</td>
  <td>Required, object</td>
  <td><p>This option specifies the location of vindicia REST server to create the payment method on. If not provided it will default to "api.vindicia.com" our production server.</p>
      <pre>
vindiciaServer: "api.vindicia.com",
      </pre>
  </td>
</tr>

<tr>
  <td>hostedFields:</td>
  <td>Required, object</td>
  <td><p>This option has many subobjects, one for each input field that you want protected and a "styles" sub object.
Not all input fields need to be protected.</p>
<pre>
hostedFields: {
  cardnumber: {
    selector: "#vin_credit_card_account", // required
    placeholder: "Enter Credit Card Number" // optional field
  },
  expirationDate: {
    selector: "#vin_credit_card_expiration_date", // required
    placeholder: "Expiration Date MM/YY", // optional field
    format: "MM/YY" // optional, defaults to MM/YY
  },
  cvn: {
    selector: "#vin_credit_card_cvn",
    placeholder: "Enter CVV" // optional field
  },
  styles: {
    "input": {
      "width": "100%",
      "font-family": "'Helvetica Neue',Helvetica,Arial,sans-serif",
       "font-size": "14px"
    }
  }
},
</pre>
<p>Or if you want the month and year separated but still show as input boxes:</p>
<pre>
hostedFields: {
  cardnumber: {
    selector: "#vin_credit_card_account", // required
    placeholder: "Enter Credit Card Number" // optional field
  },
  expirationMonthInput: {
    selector: "#vin_credit_card_expiration_month",
    placeholder: 'Month',
    format: "MM" // only "MM" is supported
  },
  expirationYearInput: {
    selector: "#vin_credit_card_expiration_year",
    placeholder: 'Year',
    format: "YYYY" // "YY" or "YYYY", defaults to YYYY
  },
  cvn: {
    selector: "#vin_credit_card_cvn",
    placeholder: "Enter CVV" // optional field
  },
  styles: {
    "input": {
      "width": "100%",
      "font-family": "'Helvetica Neue',Helvetica,Arial,sans-serif",
       "font-size": "14px"
    }
  }
},
</pre>

<p>Or if you want month and year as dropdown boxes:</p>
<pre>
hostedFields: {
  cardnumber: {
    selector: "#vin_credit_card_account", // required
    placeholder: "Enter Credit Card Number" // optional field
  },
  expirationMonth: { // optional dropdown field or use expirationDate
    selector: "#vin_credit_card_expiration_month",
    format: "N - A" // "N", "A", "N A", "N-A", "N - A" where (N=numeric month, A=Alphabetic Month)
  },
  expirationYear: {
    selector: "#vin_credit_card_expiration_year",
    format: "YYYY" // "YY" or "YYYY", defaults to YYYY
  },
  cvn: {
    selector: "#vin_credit_card_cvn",
    placeholder: "Enter CVV" // optional field
  },
  styles: {
    "input": {
      "width": "100%",
      "font-family": "'Helvetica Neue',Helvetica,Arial,sans-serif",
       "font-size": "14px"
    }
  }
},
</pre>

<p>Multi-language support for month and year dropdown boxes:</p>
<pre>
hostedFields: {
  cardNumber: { // required
    selector: "#vin_credit_card_account",
    placeholder: "Entrez le numéro de carte de crédit" // optional field
  },
  expirationMonth: { // optional dropdown field or use expiration_date
    selector: "#vin_credit_card_expiration_month",
    language: "fr", // en, es, de, pt, fr, zh, ja only allowed
    format: "N - A" // "N", "A", "N A", "N-A", "N - A" where (N=numeric month, A=Alphabetic Month)
  },
  expirationYear: { // optional dropdown field or use expiration_date
    selector: "#vin_credit_card_expiration_year",
    language: "fr", // en, es, de, pt, fr, zh, ja only allowed
    format: "YYYY" // or "YYYY", defaults to YYYY
  },
  cvn: {
    selector: "#vin_credit_card_cvn",
    placeholder: "Entrez CVV" // optional field
  },
  styles: {
    "input": {
      "width": "100%",
      "font-family": "'Helvetica Neue',Helvetica,Arial,sans-serif",
       "font-size": "14px"
    }
  }
},
</pre>

View the list of <a href="allowed_exp_formats.php">Allowed expiration date formats</a>.<br />
View the list of <a href="allowed_styles.php">Allowed styles</a>.
</td>
</tr>
<tr>
  <td>iframeHeightPadding:</td>
  <td>Optional, integer</td>
  <td>During vindicia.setup() the iframe height is adjusted to be the size of the input field inside of it. If any styles require some extra padding around the input box, this is the way to get that. It defaults to zero.
<pre>
iframeHeightPadding: 3,
</pre>
</td>
</tr>
<tr>
  <td><a href="form_validation.php">onSubmitEvent:</a></td>
  <td>Optional, function</td>
  <td><p>This is where you will define a function to be executed when the submit button is pressed. It can be anonymous or a call to an existing function.</p>
<pre>
onSubmitEvent: function(myform) {
  return merchantValidate(myform);
},
</pre>
</td>
</tr>
<tr>
  <td><a href="form_validation.php">onSubmitCompleteEvent:</a></td>
  <td>Optional, function</td>
  <td><p>Us this callback function when the REST server successfully creates a payment method. Status returned is 200.
      </p>
      <pre>
         onSubmitCompleteEvent: function(data) {
             $('#message').html('submitted OK');
             return true;
         },
      </pre>
   </td>
</tr>
<tr>
  <td><a href="form_validation.php">onSubmitCompleteFailedEvent:</a></td>
  <td>Optional, function</td>
  <td><p>This is where you will define a function to be executed when the submit to the REST server fails. It can be anonymous or a call to an existing function. The most common reasons for failure are:
<ul>
  <li>OneTimeLogin token is being reused and rejected</li>
  <li>The vin_id specified in the form is already in our system and cannot be reused</li>
</ul>
</p>
<pre>
onSubmitEvent: function(myform) {
  return merchantValidate(myform);
},
</pre>
</td>
</tr>
<tr>
  <td><a href="on_vindicia_field_event.php">onVindiciaFieldEvent:</a></td>
  <td>Optional, function</td>
  <td><p>To have access to real time validation of iframe blur events, use this optional handler</p>
<pre>
onVindiciaFieldEvent: function(event) { // optional
  if (event.detail.fieldType == 'expirationDate') {
      if (!event.detail.isValid)
      {
          console.log('vindiciaEvent expirationDate not valid');
      }
  }
}
</pre>
  </td>
</tr>
</table>
</pre>
</td>
</tr>
</tbody>
</table>
      </div><!-- end col -->
    </div><!-- end row -->

    <div class="row">
      <div class="col-lg-8">
<p>The following properties are supported in hostedfields:</p>
<table class="table table-bordered">
<thead>
</thead>
<tbody>
<tr>
  <td>cardNumber</td>
  <td>
<p>A required field.</p>
<pre>
    cardNumber: {
      selector: "#vin_credit_card_account",
      placeholder: "Enter Credit Card Number" // optional field
    },
</pre>
  </td>
</tr>
<tr>
  <td>expirationDate</td>
  <td>
<p>A required field unless you use the optional fields below for separating the month and year as dropdowns or input boxes.</p>
supported formats<br />
  'MM/YY' (the default)<br />
  'MM-YY'<br />
  'MMYY'<br />
  'YY/MM'<br />
  'YY-MM'<br />
  'YYMM'<br />
  'YYYY/MM'<br />
  'YYYY-MM'<br />
  'YYYYMM'<br />
  'MM/YYYY'<br />
  'MM-YYYY'<br />
  'MMYYYY'<br />
<pre>
    expirationDate: { 
      selector: "#vin_credit_card_expiration_date",
      placeholder: "Expiration Date MM/YY", // optional field
      format: "MM/YY" // defaults to MM/YY
    },
</pre>
  </td>
</tr>
<tr>
  <td>cvn</td>
  <td>
<pre>
    cvn: {
        selector: "#vin_credit_card_cvn",
        placeholder: "Enter CVV" // optional field
    },
</pre>
  </td>
</tr>
<tr>
  <td>expirationMonth</td>
  <td>
    <p>Optional field to show a dropdown box for the month</p>
<pre>
  expirationMonth: {
    selector: "#vin_credit_card_expiration_month",
    language: "fr", // en, es, de, fr, ja, pt, zh only allowed
    format: "N - A" // "N", "A", "N A", "N-A", "N - A" where (N=numeric month, A=Alphabetic Month)
  },
</pre>
<p>The "language" is optional and defaults to "en" English. All the month names will display in the chosen language.
Currently only "en" (English), "es" (Spanish), "de" (German), "fr", (French), "ja" (Japanese), "pt" (Portuguese), "zh" (Chinese)
are supported.</p>
  </td>
</tr>
<tr>
  <td>expirationYear</td>
  <td>
    <p>Optional field to show a dropdown box for the year</p>
<pre>
  expirationYear: { 
    selector: "#vin_credit_card_expiration_year",
    language: "fr", // en, es, de, fr, ja, pt, zh only allowed
    format: "YYYY" // or "YYYY", defaults to YYYY
  },
</pre>
<p>The "language" is optional and defaults to "en" English. All the month names will display in the chosen language.
Currently only "en" (English), "es" (Spanish), "de" (German), "fr", (French), "ja" (Japanese), "pt" (Portuguese), "zh" (Chinese)
are supported.</p>
  </td>
</tr>

<tr>
  <td>expirationMonthInput</td>
  <td>
<p>Optional field to show an input box for the month</p>
<pre>
  expirationMonthInput: {
    selector: "#vin_credit_card_expiration_month",
    placeholder: 'Month',
    format: "MM" // only "MM" is supported
  },
</pre>
  </td>
</tr>
<tr>
  <td>expirationYearInput</td>
  <td>
<p>Optional field to show an input box for the year</p>
<pre>
  expirationYearInput: {
    selector: "#vin_credit_card_expiration_year",
    placeholder: 'Year',
    format: "YYYY" // "YY" or "YYYY", defaults to YYYY
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
