/*
 bakend.js
 Author: Prajwal Shrestha - https://np.linkedin.com/in/prajwalstha
 Git: https://github.com/prajwalstha123
 */
( function($){
    "use strict";
    $('input.lifestone-upload-img').add('.custom_media_image').on('click', function (){
        var send_attachment_bkp = wp.media.editor.send.attachment;
        wp.media.editor.send.attachment = function (props, attachment) {
            $('.custom-img').val(attachment.url);
            wp.media.editor.send.attachment = send_attachment_bkp;
        }
        wp.media.editor.open();
        return false;
    });

})(jQuery);
