<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Vindicia Hosted Fields Documentation">
    <meta name="author" content="Herb Rubin">

    <title>Internal Notes</title>
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
        <h1>Internal Notes</h1>
<h3>Custom Field Luhn Check</h3>
<p>If the merchant has setup any custom fields (custom iframes) using our vindicia.setup() method we must ensure no credit cards have been entered there. So, at each blur event on a custom field, we perform a luhn check. If it passes a luhn check that field is not valid.</p>

<h3>When The Submit Button Is Pressed</h3>
<p>A three phase submit has been implemented to coordinate the parent window submit event with the iframes</p>
<p><strong>Phase 1: Collect iframe data for the last time</strong></p>
<ul>
  <li>If the form fields pass validation then let the submit process begin</li>
  <li>Set submitFormRequest flag to true to trigger phase two when ready</li>
  <li>Call clearSyncFlags() which resets all iframe sync flags to false</li>
  <li>Call syncData() which sends events to each iframe to simulate a blur event</li>
  <li>When the last iframe sends its data to the master iframe, go to phase 2</li>
</ul>
<p><strong>Phase 2: AJAX POST to Vindicia REST server from master iframe</strong></p>
<ul>
  <li>If all the data in all the iframes is valid then the parent window collects all the non iframe form fields</li>
  <li>This data is sent to the master iframe with a "submitForm" event</li>
  <li>The master iframe performs an AJAX POST with all its collected data in JSON format back to Vindicia's REST server.</li>
</ul>
<p><strong>Phase 3: After form submission activity</strong></p>
<ul>
  <li>Master iframe sends "submitComplete" event to parent window after the AJAX POST finishes</li>
  <li>This triggers the event onSubmitCompleteEvent to invoke merchant application Javascript</li>
</ul>
<h3>Methods of Interest</h3>
<p>The vindicia object has a few interesting methods</p>
<table class="table table-bordered">
<thead>
</thead>
<tbody>
<tr>
  <td>vindicia.isValid(tagId)</td>
  <td>Programmer Ok</td>
  <td>Return boolean value of last reported onblur validation state. If tagId is not provided it returns true if all iframes are holding valid data, false otherwise.</td>
</tr>
<tr>
  <td>vindicia.isSynced(tagId)</td>
  <td>Programmer Ok</td>
  <td>Return boolean value about if iframe(s) ever reported in on its data. If tagId is not provided it returns true if all iframes have reported in, false otherwise. Note: if isValid is true then isSynced is true but not vice versa.</td>
</tr>
<tr>
  <td>vindicia.clearSyncFlags()</td>
  <td>Programmer Ok</td>
  <td>Set all sync flags to false for every iframe, master iframe is ignored. Use this with syncData()</td>
</tr>
<tr>
  <td>vindicia.syncData()</td>
  <td>Programmer Ok</td>
  <td>Send an event ("syncData") to all iframes to simulate a blur event. This causes each iframe to do 3 things: validate its data, send it to the master iframe and notify the parent window ("validationReport" event) with its validation boolean state. The parent window is also given the iframe's data length but not its value.</td>
</tr>
<tr>
  <td>vindicia.clearData()</td>
  <td>Programmer Ok</td>
  <td><p>This method clear the data in the iframes input boxes and dropdown boxes</p>
    <p>It will also clear the sync flags and isValid flags. It will also set isComplete() to false</p>
  </td>
</tr>
<tr>
  <td>vindicia.resetCompleteStatus()</td>
  <td>Programmer Ok</td>
  <td><p>This method will set isComplete() to false. This allows the submit button to initiate a POST again.</p>
      <p>This is useful in single page apps where you do not want to call clearData()</p>
  </td>
</tr>
<tr>
  <td>vindicia.dataLength(tagId)</td>
  <td>Programmer Ok</td>
  <td>Return an integer count of the length of the input field in the tagId iframe.</td>
</tr>
<tr>
  <td>vindicia.getForm()</td>
  <td>Programmer Ok</td>
  <td>Return string value of the name of the form from parent window that this object has taken over the submit event on.</td>
</tr>
<tr>
  <td>vindicia.isComplete(tagId)</td>
  <td>Programmer Ok</td>
  <td>Return boolean value of last reported state of tagId iframe submission. If tagId is not provided it returns true if all iframes have completed submission of their forms, false otherwise. Not typically needed by merchant Javascript programmer.</td>
</tr>
<tr>
  <td>vindicia.submit()</td>
  <td>Internal use only</td>
  <td>Begin the three phase submit of the form back to Vindicia. All iframes send data to the master iframe one last time. If not all iframe data is currently valid then just return false.</td>
</tr>
<tr>
  <td>vindicia.submit2()</td>
  <td>Internal use only</td>
  <td>If all iframe data is valid, send master iframe the rest of the form fields from parent window and master iframe will perform a POST back to Vindicia with entire set of data.</td>
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
