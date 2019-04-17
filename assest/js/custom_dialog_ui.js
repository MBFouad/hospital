
//alert box
function alertDialog(output_msg, title)
{
    if (!title)
        title = 'Alert';

    if (!output_msg)
        output_msg = 'No Message to Display.';

    $("<div style='text-align:center'></div>").html(output_msg).dialog({
        title: title,
        resizable: false,
        modal: true,
        buttons: {
            "Ok": function()
            {
                $(this).dialog("close");
            }
        }
    });
}

//confirm dialog
function confirmDialog(output_msg, title, action, param) {

    if (!title)
        title = 'Alert';

    if (!output_msg)
        output_msg = 'No Message to Display.';


    $("<div style='text-align:center'></div>").html(output_msg).dialog({
        resizable: false,
        modal: true,
        title: title,
        buttons: {
            "Yes": function() {
                $(this).dialog('close');
                if (!param) {
                    action();
                } else {
                    action(param);
                }
            },
            "No": function() {
                $(this).dialog('close');
            }
        },
        // Focus on "No" when opening dialog:
        open: function() {
            $(this).siblings('.ui-dialog-buttonpane').find('button:eq(1)').focus();
        },
    });
}
