@if( session()->has('success') )
<div class="alert alert-success alert-dismissible fade show m-0" role="alert">
  <i class="material-icons">check</i>
  {{ session()->get('success') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
  </button>
</div>
@endif