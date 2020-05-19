jQuery( document ).ready(function($) {
    "use strict";

    $('.wp-customizer-tracking-codes-control-code-mirror').each(function(){

        var $textarea = $(this);

        var editor = wp.codeEditor.initialize($textarea, WP_Customizer_Tracking_Codes_Data.cm_settings);

        editor.codemirror.addKeyMap({
            "F11": function(cm) {
                cm.setOption("fullScreen", !cm.getOption("fullScreen"));
            },
            "Esc": function(cm) {
                if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
            }
        });

        editor.codemirror.on('change', function(){
            $textarea.val(editor.codemirror.getValue()).trigger('change');
        });

    });

});