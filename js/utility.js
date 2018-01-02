(function ($) {
    $.fn.serializeFormJSON = function () {

        var o = {};
        var a = this.serializeArray();
        $.each(a, function () {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push($.trim(this.value) || '');
            } else {
                o[this.name] = $.trim(this.value) || '';
            }
        });
        return o;
    };
})(jQuery);
function datePicker() {
    $('.date_picker').datetimepicker();
    $('.date_picker').keyup(function (e) {
        e = e || window.event; //for pre-IE9 browsers, where the event isn't passed to the handler function
        if (e.keyCode == '37' || e.which == '37' || e.keyCode == '39' || e.which == '39') {
            var message = ' ' + $('.ui-state-hover').html() + ' ' + $('.ui-datepicker-month').html() + ' ' + $('.ui-datepicker-year').html();
            if ($(this).attr('id') == 'startDate') {
                $(".date_picker").val(message);
            }
        }
    });
}
function validateEmail(sEmail) {
    var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
    if (filter.test(sEmail)) {
        return true;
    } else {
        return false;
    }
}

function roundOff(obj) {
    var amount = obj.val();
    if ($.isNumeric(amount)) {
        obj.val(parseFloat(amount).toFixed(2));
    }
}


var width = parseFloat($(window).width());
if (width < 1400) {
    $('body').addClass('sidebar-collapse');
} else {
    $('body').removeClass('sidebar-collapse');
}
/**
 * delete confom model
 * @param {type} callback
 * @returns {undefined}
 */
function getConfirm(callback) {
    $('#delete_model').modal({"show": true, "backdrop": 'static', "keyboard": false});
    $('#cancel_delete').one('click', function () {
        $('#delete_model').modal('hide');
        if (callback)
            callback(false);
    });
    $('#confirm_delete').one('click', function () {
        $('#delete_model').modal('hide');
        if (callback)
            callback(true);
    });
}
/**
 * convert 24 hours to 12 hours with am pm
 * @param {type} time_format
 * @returns {unresolved}
 */
function convert24To12Hours(time_format) {
    var timeData = time_format.split(':');
    var hh = timeData[0];
    var m = timeData[1];
    var time = hh + ':' + m;
    // Check correct time format and split into components
    time = time.toString().match(/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];
    if (time.length > 1) { // If time format correct
        time = time.slice(1); // Remove full string match value
        time[5] = +time[0] < 12 ? 'AM' : 'PM'; // Set AM/PM
        time[0] = +time[0] % 12 || 12; // Adjust hours
    }
    return time.join(''); // return adjusted time or original string
}
/**
 * 12 hours to 24 hours time format
 * @param {type} date
 * @returns {changeDateFormatForSchedule.dateData}
 */
function changeTimeFormat(oldTime) {
    var newTime;
    if (oldTime.indexOf('PM') > -1) {
        var time = oldTime.replace('PM', '');
        var timeArray = time.split(':');
        if (Number(timeArray[0]) >= 12) {
            timeArray[0] = Number(timeArray[0]) - 12;
        }
        var addition = Number(timeArray[0]) + Number(12);
        newTime = addition + ":" + timeArray[1] + ":00";
    } else if (oldTime.indexOf('AM') > -1) {
        newTime = oldTime;
        if (newTime == '12:00AM') {
            newTime = '00:00:00';
        } else if (newTime == '12:30AM') {
            newTime = '00:30:00';
        } else {
            var amTime = newTime.replace('AM', '');
            var amTimeArray = amTime.split(':');
            if (Number(amTimeArray[0]) < 10) {
                amTimeArray[0] = "0" + amTimeArray[0];
            }
            newTime = amTimeArray[0] + ":" + amTimeArray[1] + ":00";
        }
    } else {
        return '00:00:00';
    }
    return newTime;
}

function renderOptionsForTwoDimensionalArrayForRates(dataArray, comboId) {
    if (!dataArray) {
        return false;
    }
    $('#' + comboId).html('<option value="">&nbsp;</option>');
    var data = {};
    var optionResult = "";
    $.each(dataArray, function (index, dataObject) {
        data = {"value_field": index, 'text_field': dataObject};
        optionResult = optionTemplate(data);
        $("#" + comboId).append(optionResult);
    });
}

/**
 * This Function Is Used To Create Dynamic Combo Box Pass Data And KeyId And Value Id And combo Id
 * @param {type} dataArray
 * @param {type} comboId
 * @param {type} keyId
 * @param {type} valueId
 * @returns {Boolean}
 */
function renderOptionsForTwoDimensionalArrayWithKeyValue(dataArray, comboId, keyId, valueId) {
    if (!dataArray) {
        return false;
    }
    $('#' + comboId).html('<option value="">&nbsp;</option>');
    var data = {};
    var optionResult = "";
    var textField = "";
    $.each(dataArray, function (index, dataObject) {
        if (dataObject != undefined) {
            textField = dataObject[valueId];
            data = {"value_field": dataObject[keyId], 'text_field': textField};
            optionResult = optionTemplate(data);
            $("#" + comboId).append(optionResult);
        }
    });
}
function displayImages(url, name, candidateId, s) {
    var row = '';
    row += '<div class="col-md-4" id="delete_image">';
    row += '<div class="thumbnail" style="border: 1px solid #ddd;border-radius: 4px;padding: 4px;">';
    row += '<div class="fa fa-trash-o" onclick="' + name + '.listview.deleteImage(\'' + s + '\',' + candidateId + ');" style="cursor: pointer;float: right;padding: 3px;"></div>';
    row += '<img src="' + url + candidateId + '/' + s + '" name="' + s + '" class="img-responsive"/>';
    row += '</div>';
    row += '</div>';
    return row;
}
function displayDefaultImages(url) {
    var row = '';
    row += '<div class="col-md-4" id="no_image">';
    row += '<div class="thumbnail" style="border: 1px solid #ddd;border-radius: 4px;padding: 4px;">';
    row += '<img src="' + url + '" class="img-responsive"/>';
    row += '</div>';
    row += '</div>';
    return row;
}

