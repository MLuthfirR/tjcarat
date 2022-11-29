

var dateClass='.datechk';
var formatter = new Intl.NumberFormat('id-ID');
var initialTime = new Date();

$(document).ready(function () {
    if (document.querySelector(dateClass) && document.querySelector(dateClass).type !== 'date')
    {
        var oCSS = document.createElement('link');
        oCSS.type='text/css'; oCSS.rel='stylesheet';
        oCSS.href='//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css';
        oCSS.onload=function()
        {
        var oJS = document.createElement('script');
        oJS.type='text/javascript';
        oJS.src='//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js';
        oJS.onload=function()
        {
            $(dateClass).datepicker({ dateFormat: 'yy-mm-dd' });
        }
        document.body.appendChild(oJS);
        }
        document.body.appendChild(oCSS);
    }
});

function toTitleCase(str) {
    return str.replace(
    /\w\S*/g,
    function(txt) {
        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
    }
    );
}

function formatPrice(price) {
    return formatter.format(parseInt(price || 0)) + ',00';
}

function addToast(titleMsg, titleClass, bodyMsg) {
    var html = `<div class="toast ml-auto" role="alert" data-delay="10000" data-autohide="true" style="pointer-events: auto">
                    <div class="toast-header">
                    <strong class="mr-auto ${titleClass ? titleClass : 'text-primary'}">${titleMsg}</strong>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="toast-body">${bodyMsg}</div>
                </div>`
    $('#toast-container').prepend(html);
    $('.toast').toast('show');
}

function stopBubbling(evt){
    evt.stopPropagation();
    evt.cancelBubble = true;
}

function jQueryAjax(url, type, data, handleSuccessFunction, handleErrorFunction, handleCompleteFunction, isFormData=false) {
    return $.ajax({
        url: url,
        type: type,
        processData: !isFormData,
        contentType: isFormData ? false : 'application/x-www-form-urlencoded',
        data: data,
        success: function (data) {
            handleSuccessFunction(data);
        },
        error: function (xhr, textStatus, errorThrown) {
            if (xhr.status != 0) {
                console.log(xhr);
                addToast(xhr.status + ' : ' + errorThrown, 'text-danger', xhr.responseJSON ? xhr.responseJSON.message : 'Error');
                handleErrorFunction(xhr, textStatus, errorThrown);
                if (xhr.status == 401) {
                    window.location.href = "/login";
                }
            }
        },
        complete: function () {
            handleCompleteFunction();
        },
    });
}

function pingToken() {
    $.ajax({
        url: '/ping-token',
        method: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}

function getGreetingTime (m) {
    var g = null; //return g

    if(!m || !m.isValid()) { return; } //if we can't find a valid or filled moment, we return.

    var split_afternoon = 12 //24hr time to split the afternoon
    var split_evening = 16 //24hr time to split the evening
    var currentHour = parseFloat(m.format("HH"));

    if(currentHour >= split_afternoon && currentHour <= split_evening) {
        g = "Afternoon";
    } else if(currentHour >= split_evening) {
        g = "Evening";
    } else {
        g = "Morning";
    }

    return g;
}

var checkSessionTimeout = function () {
    var minutes = Math.abs((initialTime - new Date()) / 1000 / 60);
    if (minutes > 60) {
        pingToken();
        initialTime = new Date();
    }
};
setInterval(checkSessionTimeout, 10000);
