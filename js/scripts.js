$(document).ready(function(){
    $('#myForm').validator({
	    feedback: {
          success: 'fa fa-check-square-o',
          error: 'fa fa-times'
        }
	});

    $('#myForm2').validator({
	    feedback: {
          success: 'fa fa-check-square-o',
          error: 'fa fa-times'
        }
	});

    var cbwidth;
    var cbheight;

    if ($("html").width() <= 768) {
        cbwidth = "80%";
        if ($('ul.portfolio-page-menu')) {
            $('ul.portfolio-page-menu').attr('class', 'portfolio-page-menu collapse');
        }
    }
    else {
        cbwidth = "60%";
    }

    if ($("html").width() > 380) {
        $(".colorbox-group").colorbox({rel:'gallery', width: cbwidth, height:"auto", opacity: 0.7, current: "", transition:"fade"});
    }

    var inwidth = "70%";
    var inheight = "70%";

    if ($("html").width() <= 380) {
        $('.colorbox-group').on('click', function(e){
            e.preventDefault()
        });
        inwidth = "80%";
        inheight = "80%";
    }

    $(".colorbox-video").colorbox({
        innerWidth: inwidth,
        innerHeight: inheight,
        iframe:true,
        rel:'gallery',
        maxWidth: "80%",
        maxHeight: "90%",
        current: false,
        fixed: true,
        opacity: 0.85,
    });

    /**
    * Events loading
    **/

    $('.more-events').click(function(){

        var page = $(this).attr('page');

        $.ajax({
            type: 'POST',
            url: agajax.url,
            data: {
                page: page,
                security: agajax.nonce,
                action: 'ag_me',
            },
            beforeSend: function() {
                $('.more-events span').attr('class', 'process');
                $('.more-events i').attr('class', 'fa fa-circle-o-notch fa-spin fa-3x fa-fw process');
            },
            success: function(res) {
                res = JSON.parse(res);
                $('.main-future-occ-block').append(res['code']);
                $('.more-events span').attr('class', '');
                $('.more-events i').attr('class', 'fa fa-circle-o-notch fa-spin fa-3x fa-fw');
                if (!res['next']) {
                    $('.more-events').hide();
                }
            },
            error: function() {
                alert('errror!');
            }
        });

    });

    $('.garik-form').submit(function(send){
        send.preventDefault();

        if ($(this).find('button').attr('sent') == 'sent') {
            return;
        }

        var form = $(this);
        var name = $(this).find('input[name=name]').val();
        var phone = $(this).find('input[name=phone]').val();
        var comment = $(this).find('textarea').val();

        if (name == '' || phone == '') return;

        $.ajax({
            type: 'POST',
            url: agajax.url,
            data: {
                formData: {
                    name: name,
                    phone: phone,
                    comment: comment
                },
                security: agajax.nonce,
                action: 'ag_contacts',
            },
            beforeSend: function() {
                form.find('button').attr('sent', 'sent');
                form.find('button').attr('class', 'order btn btn-default disabled');
            },
            success: function(res) {
                form.find('button').attr('sent', 'not-sent');
                form.find('button').attr('class', 'order btn btn-default been-sent');
            },
            error: function() {
                alert('error!');
            }
        });

    });

    $('iframe').find('.headers').hide();
});