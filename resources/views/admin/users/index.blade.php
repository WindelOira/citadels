@extends('layouts.admin')

@section('content')
  @page_header(['title' => 'All Users'])
    Users
  @endpage_header

  <table class="table table-sm is-datatable" data-ajax="{{ route('admin.datatables.users') }}" data-columns='[{"name" : "name"}, {"name" : "email"}, {"name" : "role.title"}, {"name" : "users_action", "orderable" : "false", "searchable" : "false"}]'>
    <thead>
      <tr>
        <th>Name</th>
        <th>Email Address</th>
        <th>Role</th>
        <th></th>
      </tr>
    </thead>
  </table>
@endsection