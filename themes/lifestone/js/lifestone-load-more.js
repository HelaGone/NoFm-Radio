jQuery(document).ready(function($){

    "use strict";

    (function() {

        var count =2;

        $('#load-more-button').click(function(){
            loadArticle(count);
            count++;
        });


        function loadArticle(pageNumber) {
            $.ajax({
                url: ajaxUrl,
                type: 'POST',
                data: "action=infinite_scroll&page_no=" + pageNumber + '&loop_file=post',
                success: function (html) {

                    console.log(html);

                    $("#masonry").append(html);
                    // This will be the div where our content will be loaded
                }
            });
            return false;
        }
    })();

});
