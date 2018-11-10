
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/*
 |--------------------------------------------------------------------------
 | Vue
 |--------------------------------------------------------------------------
 */
window.Vue = require('vue');

import 'bootstrap/dist/css/bootstrap.css';
import 'shards-ui/dist/css/shards.css';
import '../../../resources/assets/styles/shards-dashboards.1.2.0.min.css';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
  el: '#app'
});

/*
 |--------------------------------------------------------------------------
 | AJAX
 |--------------------------------------------------------------------------
 */
window.$.ajaxSetup({
  headers   : {
    'X-CSRF-TOKEN'  : window.$('meta[name="csrf-token"]').attr('content')
  }
});


/*
 |--------------------------------------------------------------------------
 | DataTable
 |--------------------------------------------------------------------------
 */
window.dt = require('datatables.net');
window.dtBs4 = require('datatables.net-bs4');

window.dt.defaults.serverSide = true;

if( window.$('.is-datatable').length > 0 ) {
  var datatable = window.$('.is-datatable').DataTable();

  window.$(document).on('submit', '.is-datatable tbody tr td form', function(evt) {
    evt.preventDefault();
    let a = $(this),
        b = a.closest('tr'),
        c = a.find('input[name=_method]'), 
        d = a.find('button[type=submit]');

    window.$.ajax({
      url       : a.attr('action'),
      type      : c.length > 0 ? c.val() : a.attr('method'),
      dataType  : 'json',
      data      : {
        id        : d.val()
      },
      success   : function(r) {
        var dtPage = datatable.page();

        if( r === 'success' )
          b.addClass('bg-light').fadeOut(500, function() {
            this.remove();

            // Reload and set page position
            datatable.ajax.reload().page(dtPage).draw('page');
          });
      },
      error     : function(r) {
        console.log(r);
      }
    });
  });
}

/*
 |--------------------------------------------------------------------------
 | Dropzone
 |--------------------------------------------------------------------------
 */
window.Dropzone = require('dropzone');

window.Dropzone.autoDiscover = false;

if( window.$('.dropzone').length > 0 ) {
  var dropzone = new Dropzone('.dropzone', {
    parallelUploads  : 1,
    init            : function() {
      this.on('success', function(f) {
        if( typeof datatable !== 'undefined' )
          var dtPage = datatable.page();

          // Reload and set page position
          datatable.ajax.reload().page(dtPage).draw('page');
      });
      this.on('complete', function(f) {
        dropzone.removeFile(f);
      });
    },
  });
}

/*
 |--------------------------------------------------------------------------
 | Quill
 |--------------------------------------------------------------------------
 */
window.Quill = require('quill');

if( window.$('#editor-container').length > 0 ) {
  var editor = new Quill('#editor-container', {
    modules       : {
      toolbar       : [
        [{ 'header'   : [1, 2, 3, 4, 5, false] }],
        ['bold', 'italic', 'underline', 'strike'],
        ['blockquote', 'code-block'],
        [{ 'header'   : 1 }, { 'header'   : 2 }],
        [{ 'list'     : 'ordered'}, { 'list'  : 'bullet' }],
        [{ 'script'   : 'sub'}, { 'script'    : 'super' }], 
        [{ 'indent'   : '-1'}, { 'indent'     : '+1' }],
      ]
    },
    placeholder   : 'Your content here...',
    theme         : 'snow'
  });

  window.$(document).on('submit', 'form', function() {
    let editorInput = window.$('#editor-input input');
    editorInput.val(editor.root.innerHTML);
  });
}