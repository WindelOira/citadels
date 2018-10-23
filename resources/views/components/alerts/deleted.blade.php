@if( session()->has('deleted') )
<div class="alert alert-danger" role="alert">{{ session()->get('deleted') }}</div>
@endif