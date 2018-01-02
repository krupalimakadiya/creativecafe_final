/**
 * Get Today Date
 * @returns {String}
 */
function getTodayDate() {
    var d = new Date();
    var month = d.getMonth() + 1;
    var day = d.getDate();
    var year = d.getFullYear();
    return (day < 10 ? '0' : '') + day + '-' + (month < 10 ? '0' : '') + month + '-' + year;
}

/*
 * Gives a date string of yyyy-mm-dd format from Date object
 * Optional 'delimeter' can be passed
 */
function dateTo_YYYY_MM_DD(date, delimeter) {
    var delim = delimeter ? delimeter : '-';
    return date.getFullYear() + delim + (date.getMonth() + 1) + delim + date.getDate();
}

/*
 * Gives a date string of yyyy-mm-dd format from Date object
 * Optional 'delimeter' can be passed
 */
function dateTo_DD_MON_YYYY(dateObj, delimeter) {
    var curr_date = dateObj.getDate();
    if (curr_date < 10) {
        curr_date = '0' + curr_date;
    }
    var delim = delimeter ? delimeter : '-';
    return curr_date + delim + monthNames[dateObj.getMonth()] + delim + dateObj.getFullYear();
}

/*
 * Convert the string of dd-mm-yy format to Date object
 * Optional 'delimeter' can be passed
 */
function ddmmyyToDate(dateString, delimeter) {
    var delim = delimeter ? delimeter : '-';
    var dateParts = dateString.split(delim);
    return new Date(dateParts[2], dateParts[1] - 1, dateParts[0]); // Note: months are 0-based
}

/*
 * Gives a date string of dd-mm-yyyy format from Date object
 * Optional 'delimeter' can be passed
 */
function dateTo_DD_MM_YYYY(dateObj, delimeter) {
    var curr_date = dateObj.getDate();
    if (curr_date < 10) {
        curr_date = '0' + curr_date;
    }
    var curr_month = dateObj.getMonth() + 1; //Months are zero based
    if (curr_month < 10) {
        curr_month = '0' + curr_month;
    }
    var curr_year = dateObj.getFullYear();
    var delim = delimeter ? delimeter : '-';
    return curr_date + delim + curr_month + delim + curr_year;
}

/*
 * Convert the string of yyyy-mm-dd (MySql database format) to Date object
 * Optional 'delimeter' can be passed
 */
function yyyymmddToDate(dateString, delimeter) {
    var delim = delimeter ? delimeter : '-';
    var dateParts = dateString.split(delim);
    return new Date(dateParts[0], dateParts[1] - 1, dateParts[2]); // Note: months are 0-based
}

/*
 * Used in datatable to show date fields
 */
var displayDateRenderer = function (data, type, full, meta) {
    return dateTo_DD_MM_YYYY(yyyymmddToDate(data));
};