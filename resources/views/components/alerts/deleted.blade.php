@if( session()->has('deleted') )
<div class="alert alert-danger alert-dismissible fade show m-0" role="alert">
  <i class="material-icons">delete</i>
  {{ session()->get('deleted') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
  </button>
</div>
@endif