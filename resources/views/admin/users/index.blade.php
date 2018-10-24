@extends('layouts.admin')

@section('content')
  @page_header(['title' => 'All Users'])
    Users
  @endpage_header

  <table class="table table-sm is-datatable">
    <thead>
      <tr>
        <th></th>
        <th>Email Address</th>
        <th>Role</th>
        <th></th>
      </tr>
    </thead>
  </table>
@endsection

@section('scripts')
<script>
  (function($) {
    $(function() {
      $('.is-datatable').DataTable({
        serverSide  : true,
        ajax        : "{{ route('admin.datatables.users') }}",
        columns     : [
          { name : 'name' },
          { name : 'email' },
          { name : 'role.title' },
          { name : 'action', orderable : false, searchable : false }
        ]
      });
    });
  })(jQuery);
</script>
@endsection