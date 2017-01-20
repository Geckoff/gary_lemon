jQuery(function($){

  // Set all variables to be used in scope
  var frame;
      /*metaBox = $('#meta-box-id.postbox'), // Your meta box id here
      addImgLink = metaBox.find('.upload-custom-img'),
      delImgLink = metaBox.find( '.delete-custom-img'),
      imgContainer = metaBox.find( '.custom-img-container'),
      imgIdInput = metaBox.find( '.custom-img-id' );*/

  // ADD IMAGE LINK
  $('body').on('click', '.choose-image', function(){
      var send_attachment_bkp = wp.media.editor.send.attachment;
      var button = $(this);
      wp.media.editor.send.attachment = function(props, attachment) {

          button.parent().find('.img-container img').attr('src', attachment.url);
          button.parent().find('input[type=hidden]').val(attachment.id);

          wp.media.editor.send.attachment = send_attachment_bkp;
      }
      wp.media.editor.open(button);
      return false;
  });




});