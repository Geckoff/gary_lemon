$(document).ready(function(){

    /**
    * Hiding text area in admin dash in Video post from Portfolio category
    **/

    if (img.hide == 1) {
        $('#wp-content-wrap').hide();
        $('#postdivrich').hide();
    }

    /**
    * Adding new row for adding video in Video post from Portfolio category
    **/

    $('#add-video-row').on('click', function(){

        if ($("tr").is(".video-add-block")) {
            var lastblock = $('.video-add-block').last();
            var lastvideolink = lastblock.find('.choose-link-cell input').attr('name');
            var id = parseInt(lastvideolink.substring(9, lastvideolink.length)) + 1;
        }
        else var id = 1;
        var newrow = '<tr class="video-add-block">\
                        <td class="choose-link-cell">\
                            <input type="text" name="videolink' + id + '" value="">\
                        </td>\
                        <td class="choose-image-cell">\
                            <input type="hidden" name="videoimg' + id + '" />\
                            <button type="button" class="button choose-image insert-media-button" >Choose Image</button>\
                            <div class="img-container">\
                                <img src="' + img.url + '" alt="" />\
                            </div>\
                        </td>\
                        <td class="delete-cell">\
                            <button type="button" class="button delete-video"><span class="dashicons dashicons-no"></span></button>\
                        </td>\
                    </tr>';
        if ($("tr").is(".video-add-block")) $(newrow).insertAfter(lastblock);
        else $(newrow).insertAfter('.portfolio-video-insert tr');


    });

    $('body').on('click', '.delete-video', function(){
        $(this).parent().parent().remove();
    });

    /**
    * classes for setting styles in Main Gallery options page
    **/

    if ($('.main-portfolio-settings')) {
        var mainPortfolioTable = $('.main-portfolio-settings').parent().parent().parent().parent();
        mainPortfolioTable.attr('class','form-table main-portfolio-table');
        $(".main-portfolio-table").each(function(indx, element){
            $(element).find('tr').eq(1).attr('class','main-portfolio-picture');
        });

        $(".main-portfolio-settings").each(function(indx, element){
            var val = $(this).val();
            if (val == '1') $(this).parent().parent().parent().find('.main-portfolio-link').parent().parent().hide();
            if (val == '2') $(this).parent().parent().parent().find('.main-portfolio-link').parent().parent().show();
        });

    }

    $(".main-portfolio-settings").on('change', function(){
        var val = $(this).val();
        if (val == '1') $(this).parent().parent().parent().find('.main-portfolio-link').parent().parent().hide();
        if (val == '2') $(this).parent().parent().parent().find('.main-portfolio-link').parent().parent().show();
    });

 });