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
      <table class="table table-sm table-striped is-datatable">
        <thead>
          <tr>
            <th>Title</th>
            <th>Slug</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        @if( count($roles) > 0 )
          @foreach( $roles as $role )
          <tr>
            <td>{{ link_to_route('admin.roles.edit', $role->title, $role) }}</td>
            <td>{{ $role->slug }}</td>
            <td class="table__actions">
              {!! Form::open([
                'route'   => [
                  'admin.roles.destroy', $role
                ],
                'method'  => 'DELETE'
              ]) !!}
                <div class="btn-group btn-group-sm d-flex justify-content-end" role="group" aria-label="Roles Actions">
                  <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-success">
                    <i class="material-icons">edit</i>
                  </a>
                  <button class="btn btn-danger">
                    <i class="material-icons">delete</i>
                  </button>
                </div>
              {!! Form::close() !!}
            </td>
          </tr>
          @endforeach
        @endif
        </tbody>
      </table>
    </div>
  </div>
@endsection