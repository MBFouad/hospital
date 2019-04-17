function confirmDeleteNotification(functionToCall, funVariable) {
    (new PNotify({
        title: "Delete",
        text: "You sure you want delete this",
        icon: 'glyphicon glyphicon-question-sign',
        hide: false,
        confirm: {
            confirm: true,
            buttons: [{text: "Yes"}, {text: "No"}]
        },
        buttons: {
            closer: false,
            sticker: false
        },
        history: {
            history: false
        }
    })).get().on('pnotify.confirm', function () {
        window[functionToCall](funVariable);
    }).on('pnotify.cancel', function () {
    });
}
function confirmBookingNotification(functionToCall, funVariable,date) {
    (new PNotify({
        title: "Booking",
        text: "Want to book at "+date,
        icon: 'glyphicon glyphicon-question-sign',
        hide: false,
        confirm: {
            confirm: true,
            buttons: [{text: "Yes"}, {text: "No"}]
        },
        buttons: {
            closer: false,
            sticker: false
        },
        history: {
            history: false
        }
    })).get().on('pnotify.confirm', function () {
        window[functionToCall](funVariable);
    }).on('pnotify.cancel', function () {
    });
}
function showNotification(notifyType, titleMsg, textMsg) {
    var opts = {
        text: textMsg,
        title: titleMsg,
        type: notifyType,
    };
    new PNotify(opts);
}

