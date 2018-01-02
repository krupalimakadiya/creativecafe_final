function showError(msg) {
    showNotification(msg, 'danger');
}

function showSuccess(msg) {
    showNotification(msg, 'success');
}

function showNotification(msg, type) {

    var notificationTheme = 'alert-' + type;
    var placementFrom = 'bottom';
    var placementAlign = 'right';
    var animateEnter = 'animated fadeInRight';
    var animateExit = 'animated fadeOutRight';

    if (msg === null || msg === '') {
        msg = 'Turning standard Bootstrap alerts';
    }
    if (animateEnter === null || animateEnter === '') {
        animateEnter = 'animated fadeInDown';
    }
    if (animateExit === null || animateExit === '') {
        animateExit = 'animated fadeOutUp';
    }
    var allowDismiss = true;

    $.notify({
        message: msg
    },
            {
                type: notificationTheme,
                allow_dismiss: allowDismiss,
                newest_on_top: true,
                timer: 1000,
                placement: {
                    from: placementFrom,
                    align: placementAlign
                },
                animate: {
                    enter: animateEnter,
                    exit: animateExit
                },
                template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} ' + (allowDismiss ? "p-r-35" : "") + '" role="alert">' +
                        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                        '<span data-notify="icon"></span> ' +
                        '<span data-notify="title">{1}</span> ' +
                        '<span data-notify="message">{2}</span>' +
                        '<div class="progress" data-notify="progressbar">' +
                        '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                        '</div>' +
                        '<a href="{3}" target="{4}" data-notify="url"></a>' +
                        '</div>'
            });
}

function showConfirmation(type, yesEvent, noEvent, isDeleteMsg, message) {
    var msg = isDeleteMsg ? 'Are you sure you want to delete' : message;
    var notificationTheme = 'alert-' + type;
    var placementFrom = 'bottom';
    var placementAlign = 'right';
    var animateEnter = 'animated fadeInRight';
    var animateExit = 'animated fadeOutRight';

    if (animateEnter === null || animateEnter === '') {
        animateEnter = 'animated fadeInDown';
    }
    if (animateExit === null || animateExit === '') {
        animateExit = 'animated fadeOutUp';
    }
    var allowDismiss = true;

    $.notify({
        message: msg
    },
            {
                type: notificationTheme,
                allow_dismiss: allowDismiss,
                newest_on_top: true,
                timer: 5000,
                placement: {
                    from: placementFrom,
                    align: placementAlign
                },
                animate: {
                    enter: animateEnter,
                    exit: animateExit
                },
                template: '<div data-notify="container" class="bootstrap-notify-container stack-bar-bottom alert alert-dismissible {0} ' + (allowDismiss ? "p-r-35" : "") + '" role="alert">' +
                        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                        '<span data-notify="icon"></span> ' +
                        '<span data-notify="title">{1}</span> ' +
                        '<span data-notify="message" style="font-size:15px;">{2}</span>' +
                        '<div style="margin-top:15px;">' +
                        '<button type="button" class="btn btn-xs btn-default pull-right" onclick="' + noEvent + '">' +
                        '<label class="fa fa-remove label-btn-icon"></label>' +
                        '&nbsp;<label class="label-btn-fonts">No</label></button>' +
                        '<button type="button" class="btn btn-xs btn-success pull-right" style="margin-right:3px;" onclick="$(this).hide(); ' + yesEvent + ';">' +
                        '<label class="fa fa-check label-btn-icon"></label>' +
                        '&nbsp;<label class="label-btn-fonts">Yes</label></button>' +
                        '</div>' +
                        '<div class="progress" data-notify="progressbar">' +
                        '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                        '</div>' +
                        '<a href="{3}" target="{4}" data-notify="url"></a>' +
                        '</div>'
            });
}