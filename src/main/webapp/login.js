$(document).ready(function(){
  $("form#loginForm").submit(function() { // loginForm is submitted
    var username = $('#username').attr('value'); // get username
    var password = $('#password').attr('value'); // get password

    var JSONObject= {"username":username, "credential":password };
    //var JSONObject = {"username":"father@operator.com","credential":"letmein"};
    //var jsonData = JSON.parse( JSONObject );
    if (username && password) { // values are not empty
      $.ajax({
        type: "POST",
        //url: "http://qa-hap60-01.toronto.uxp/platform/rest/v60/session/start", // URL of the Perl script
        //url: "http://localhost:8077",
        url:  configOptions.mainurl + "/session/start",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        // send username and password as parameters to the Perl script
        data: JSON.stringify(JSONObject),
        crossOrigin: true,
        // script call was *not* successful
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          var jsonResp = JSON.parse(XMLHttpRequest.responseText);
          alert('Exception: ' + JSON.stringify(jsonResp.operationError));
        }, // error
        // script call was successful
        // data contains the JSON values returned by the Perl script
        success: function(data){
          //alert('Successfully called');//else
          window.location.href = "/teliaui/getuser.html?id=" + data.userId;
        } // success
      }); // ajax
    } // if
    else {
      $('div#loginResult').text("enter username and password");
      $('div#loginResult').addClass("error");
    } // else
    $('div#loginResult').fadeIn();
    return false;
  });
});