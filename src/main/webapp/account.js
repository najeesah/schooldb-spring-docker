function getAccountProfile() {
    removedivs();
    var param = window.location.search.substring(1);
    var account_id = param.substring(param.lastIndexOf("=") + 1, param.lenght);
    $.ajax({
        type: "GET",
        url: configOptions.mainurl + "/account/" + account_id, // URL of the Perl script
        crossOrigin: true,
        async: false,
        // script call was *not* successful
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            document.body.innerHTML += "<div id=\"showAPIData\" class=\"leftdiv\"></div>";
                        var divContainer = document.getElementById("showAPIData");
                        divContainer.innerHTML = "<h2>Error</h2><br/>";
                        divContainer.innerHTML += createErrorTable(JSON.parse(XMLHttpRequest.responseText));
        }, // error
        success: function(data) {
            console.log(data);
            console.log(Object.keys(data).length);
            document.body.innerHTML += "<div id=\"showAPIData\" class=\"leftdiv\"></div>";
            var divContainer = document.getElementById("showAPIData");
            setSessionUserCookie(data.id);
            divContainer.innerHTML = "<h2>API Call GET /account/{accountId}</h2><br/>";
            divContainer.innerHTML += createTable(data);;
        } // success
    });

    $.ajax({
        type: "GET",
        url: "accountdata/" + account_id, // URL of the Perl script
        crossOrigin: true,
        async: false,
        error: function(XMLHttpRequest, textStatus, errorThrown) {
        document.body.innerHTML += "<div id=\"showDBData\" class=\"leftdiv\"></div>";
                                var divContainer = document.getElementById("showDBData");
                                divContainer.innerHTML = "<h2>Error</h2><br/>";
                                divContainer.innerHTML += XMLHttpRequest.responseText;
        }, // error
        success: function(data) {
            console.log(data);
            console.log(Object.keys(data).length);
            document.body.innerHTML += "<div id=\"showDBData\" class=\"rightdiv\"></div>";
            var divContainer = document.getElementById("showDBData");
            divContainer.innerHTML = "<h2>DB call to mt_account</h2><br/>";
            divContainer.innerHTML += createTable(data);
        } // success
    });

}


function getAccountUsers() {
    removedivs();
    var param = window.location.search.substring(1);
    var account_id = param.substring(param.lastIndexOf("=") + 1, param.lenght);
    $.ajax({
        type: "GET",
        url: configOptions.mainurl + "/account/" + account_id + "/users",
        crossOrigin: true,
        async: false,
        error: function(XMLHttpRequest, textStatus, errorThrown) {
                        document.body.innerHTML += "<div id=\"showAPIData\" class=\"leftdiv\"></div>";
                                    var divContainer = document.getElementById("showAPIData");
                                    divContainer.innerHTML = "<h2>Error</h2><br/>";
                                    divContainer.innerHTML += createErrorTable(JSON.parse(XMLHttpRequest.responseText));
        }, // error
        // script call was successful
        success: function(data) {
            var keys = Object.keys(data);
            var table = document.createElement("table");
            console.log(data);
            console.log(Object.keys(data).length);
            document.body.innerHTML += "<div id=\"showAPIUser2Account\" style=\"float:left;\"></div>";
            var divContainer = document.getElementById("showAPIUser2Account");
            divContainer.innerHTML = "<h2>API GET Account Users</h2><br/>";
            divContainer.innerHTML += createTable(data);
        }
    });
}


function getAccountGroups() {
    removedivs();
    var param = window.location.search.substring(1);
    var account_id = param.substring(param.lastIndexOf("=") + 1, param.lenght);
    $.ajax({
        type: "GET",
        url: configOptions.mainurl + "/account/" + account_id + "/groups",
        crossOrigin: true,
        async: false,
        error: function(XMLHttpRequest, textStatus, errorThrown) {
                        document.body.innerHTML += "<div id=\"showAPIData\" class=\"leftdiv\"></div>";
                                    var divContainer = document.getElementById("showAPIData");
                                    divContainer.innerHTML = "<h2>Error</h2><br/>";
                                    divContainer.innerHTML += createErrorTable(JSON.parse(XMLHttpRequest.responseText));
        }, // error
        // script call was successful
        success: function(data) {
            var keys = Object.keys(data);
            var table = document.createElement("table");
            console.log(data);
            console.log(Object.keys(data).length);
            document.body.innerHTML += "<div id=\"showAPIUser2Gr\" style=\"float:left;\"></div>";
            var divContainer = document.getElementById("showAPIUser2Gr");
            divContainer.innerHTML = "<h2>API GET Account Groups</h2><br/>";
            divContainer.innerHTML += createTable(data);
        }
    });
}

function getAccountMemberships() {
    removedivs();
    var param = window.location.search.substring(1);
    var account_id = param.substring(param.lastIndexOf("=") + 1, param.lenght);
    $.ajax({
        type: "GET",
        url: configOptions.mainurl + "/account/" + account_id + "/memberships",
        crossOrigin: true,
        async: false,
        error: function(XMLHttpRequest, textStatus, errorThrown) {
                       document.body.innerHTML += "<div id=\"showAPIData\" class=\"leftdiv\"></div>";
                                   divContainer.innerHTML = "<h2>Error</h2><br/>";
                                   divContainer.innerHTML += createErrorTable(JSON.parse(XMLHttpRequest.responseText));
        }, // error
        // script call was successful
        success: function(data) {
            var keys = Object.keys(data);
            var table = document.createElement("table");
            console.log(data);
            console.log(Object.keys(data).length);
            document.body.innerHTML += "<div id=\"showAPIUser2Mem\" style=\"float:left;\"></div>";
            var divContainer = document.getElementById("showAPIUser2Mem");
            divContainer.innerHTML = "<h2>API GET Account Groups</h2><br/>";
            divContainer.innerHTML += createTable(data);
        }
    });
}

function removedivs() {
    exclude1 = null;
    exclude2 = null;
    include1 = null;
    var divs = document.getElementsByTagName("div");
    var divlength = divs.length;
    for (var i = 0; i < divlength; i++) {
        //do something to each div like
        divs[0].remove();
    }
}

function getCookie(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length == 2) return parts.pop().split(";").shift();
}

function setSessionUserCookie(sessionUserId) {
    document.cookie = "sessionUser=" + sessionUserId;
}

function createTable(datax) {
    var keys = Object.keys(datax);
    var table_str = "<table border=\"1\">"
    for (var i = 0; i < keys.length; i++) {
        var valuestr;
        var currrentAttribute;
        if (typeof datax[keys[i]] != 'object' || datax[keys[i]] == null) {
            if (keys[i].indexOf('mint.') != -1 && datax[keys[i]] == "false")
                continue;
            table_str = table_str + "<tr>"
            table_str = table_str + "<td>"
            table_str = table_str + keys[i] + "</td>";
            table_str = table_str + "<td>"
            if (keys[i] == "group_Id") {
                table_str = table_str + "<a href=\"/teliaui/getgroup.html?id=" + datax[keys[i]] + " \" target=\"_blank\">" + datax[keys[i]] + "</a></td></tr>";
                continue;
            }
            if (keys[i] == "user_id") {
                table_str = table_str + "<a href=\"/teliaui/getuser.html?id=" + datax[keys[i]] + " \" target=\"_blank\">" + datax[keys[i]] + "</a></td></tr>";
                continue;
            }
            if (keys[i] == "account_id") {
                table_str = table_str + "<a href=\"/teliaui/getaccount.html?id=" + datax[keys[i]] + " \" target=\"_blank\">" + datax[keys[i]] + "</a></td></tr>";
                continue;
            }
            if (keys[i] == "sub_id") {
                table_str = table_str + "<a href=\"/teliaui/getsubscription.html?id=" + datax[keys[i]] + " \" target=\"_blank\">" + datax[keys[i]] + "</a></td></tr>";
                continue;
            }
            table_str = table_str + datax[keys[i]] + "</td></tr>";
            //            if(keys[i] == "id" && currrentAttribute == "user2AccountAssociations"){
            //                table_str = table_str + "<a href=\"/teliaui/getgroups?" + datax[keys[i]] +"target=\"_blank\">" + datax[keys[i]] + "</a></td></tr>";
            //            }


        } else {
            if (keys[i] == "user2SubAssociations") {
                continue;
            }
            table_str = table_str + "<tr>"
            table_str = table_str + "<td>"
            table_str = table_str + keys[i] + "</td>";
            table_str = table_str + "<td>"
            table_str = table_str + createTable(datax[keys[i]]);
            table_str = table_str + "</td></tr>";
        }
    }
    table_str = table_str + "</table>"
    return table_str;
}

function createAccountTable(datax) {
    var keys = Object.keys(datax);
    var table_str = "<table border=\"1\">"
    for (var i = 0; i < keys.length; i++) {
        var valuestr;
        var currrentAttribute;
        if (typeof datax[keys[i]] != 'object' || datax[keys[i]] == null) {
            if (keys[i].indexOf('mint.') != -1 && datax[keys[i]] == "false")
                continue;
            table_str = table_str + "<tr>"
            table_str = table_str + "<td>"
            table_str = table_str + keys[i] + "</td>";
            table_str = table_str + "<td>"
            if (keys[i] == "subscriptions") {
                continue;
            }
            table_str = table_str + datax[keys[i]] + "</td></tr>";
            //            if(keys[i] == "id" && currrentAttribute == "user2AccountAssociations"){
            //                table_str = table_str + "<a href=\"/teliaui/getAccounts?" + datax[keys[i]] +"target=\"_blank\">" + datax[keys[i]] + "</a></td></tr>";
            //            }


        } else {
            if (keys[i] == "subscriptions") {
                continue;
            }

            table_str = table_str + "<tr>"
            table_str = table_str + "<td>"
            table_str = table_str + keys[i] + "</td>";
            table_str = table_str + "<td>"
            table_str = table_str + createAccountTable(datax[keys[i]]);
            table_str = table_str + "</td></tr>";
        }
    }
    table_str = table_str + "</table>"
    return table_str;
}

function createErrorTable(datax) {
    var keys = Object.keys(datax);
    var table_str = "<table class=\"style1\">"
    for (var i = 0; i < keys.length; i++) {
        var valuestr;
        var currrentAttribute;
        if (typeof datax[keys[i]] != 'object' || datax[keys[i]] == null) {
            if (keys[i].indexOf('mint.') != -1 && datax[keys[i]] == "false")
                continue;
            if (keys[i] == "stackTrace")
                 continue;
            table_str = table_str + "<tr>"
            table_str = table_str + "<td>"
            table_str = table_str + keys[i] + "</td>";
            table_str = table_str + "<td>"
            if (keys[i] == "stackTrace") {
                continue;
            }
            table_str = table_str + datax[keys[i]] + "</td></tr>";

        } else {
            if (keys[i] == "subscriptions") {
                continue;
            }

            table_str = table_str + "<tr>";
            table_str = table_str + "<td>";
            table_str = table_str + keys[i] + "</td>";
            table_str = table_str + "<td>";
            table_str = table_str + createAccountTable(datax[keys[i]]);
            table_str = table_str + "</td></tr>";
        }
    }
    table_str = table_str + "</table>"
    return table_str;
}