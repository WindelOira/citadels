'use strict';

(function($) {
  $(function() {
    $(document).on('click', 'table.dataTable tbody tr td .custom-control-label', function(){
      let a = $(this),
          b = a.closest('tr'),
          c = a.closest('table');

      if( c.data('single') ) {
        c
         .find('tr')
         .removeClass('file-manager__item--selected')
         .find('input[type=checkbox]')
         .prop('checked', 0);
      }

      b.toggleClass('file-manager__item--selected');
    });
  });
})(jQuery);