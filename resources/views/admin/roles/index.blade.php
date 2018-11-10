@extends('layouts.admin')

@section('content')
  @page_header(['title' => 'Roles'])
    Users
  @endpage_header

  <div class="row">
    <div class="col-lg-4">
      {!! Form::open([
        'route'     => isset($role) ? ['admin.roles.update', $role] : 'admin.roles.store',
        'method'    => isset($role) ? 'PUT' : 'POST'
      ]) !!}
        <div class="form-group">
          {{ Form::bsText('title', isset($role) ? $role->title : '') }}
        </div>
        {{ Form::bsButton('publish', NULL, 'submit', ['title' => 'Publish', 'class' => 'btn btn-success']) }}
        @if( isset($role) ) 
        {{ link_to_route('admin.roles.index', 'Cancel', [], ['class' => 'btn btn-link float-right']) }}
        @endif
      {!! Form::close() !!}
    </div>
    <div class="col-lg-8">
      <table class="table table-sm table-striped is-datatable" data-ajax="{{ route('admin.datatables.roles') }}" data-columns='[{"name" : "title"}, {"name" : "slug"}, {"name" : "roles_action", "orderable" : "false", "searchable" : "false"}]'>
        <thead>
          <tr>
            <th>Title</th>
            <th>Slug</th>
            <th></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
@endsection