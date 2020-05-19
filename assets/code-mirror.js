jQuery( document ).ready(function($) {
    "use strict";

    $('.wp-customizer-tracking-codes-control-code-mirror').each(function(){
        var $textarea = $(this);
        var cm = CodeMirror.fromTextArea(this, {
            lineNumbers: true,
            mode: "htmlmixed",
            extraKeys: {
                "F11": function(cm) {
                    cm.setOption("fullScreen", !cm.getOption("fullScreen"));
                },
                "Esc": function(cm) {
                    if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
                }
            }
        });

        cm.on('change', function(){
            $textarea.val(cm.getValue()).trigger('change');
        });
    });

});