
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
import 'quill/dist/quill.snow.css';

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
 | DataTable
 |--------------------------------------------------------------------------
 */
window.dt = require('datatables.net');
window.dtBs4 = require('datatables.net-bs4');

window.dt.defaults.serverSide = true;

window.$('.is-datatable').DataTable();

/*
 |--------------------------------------------------------------------------
 | Quill
 |--------------------------------------------------------------------------
 */
window.quill = require('quill');

window.quill.defaults = [{
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
}];