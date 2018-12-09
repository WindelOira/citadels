'use strict';

let $ = require('jquery'),
    ImageToBlog = require('image-to-blob'),
    domURL = window.URL || window.webkitURL || window;

(function($) {
  function renderResult(err, blob) {
    if(err) return false;

    var a = $('.uploader-table'),
        b = a.find('.file-manager__item--selected'),
        c = $('.uploader-result'),
        d = c.find('.uploader-preview');

    if( d.length === 0 ) return;
  
    d.find('.uploader-preview__image').addClass('contained').attr('style', 'background-image: url('+ domURL.createObjectURL(blob) +');');
  }
  $(function() {
    $(document).on('click', '#uploader-modal #uploader-button', function(evt) {
      evt.preventDefault();

      let a = $(this),
          b = a.closest('#uploader-modal'),
          c = b.find('.uploader-table'),
          d = c.find('.file-manager__item--selected'),
          e = $('.uploader-result'),
          f = e.find('.uploader-preview');

      if( e.length === 0 ) return;

      if( c.data('single') === true ) {
        e.find('.uploader-input').val(d.find('.custom-control-input').val());
        ImageToBlog(d.find('.file-manager__item-preview img')[0], renderResult);

        b.modal('hide');
      } else {
      }
    });
  });
})(jQuery);