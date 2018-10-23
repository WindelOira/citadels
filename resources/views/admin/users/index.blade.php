@extends('layouts.admin')

@section('content')
  @page_header(['title' => 'All Users'])
    Users
  @endpage_header

  <table class="table table-sm">
    <thead>
      <tr>
        <th></th>
        <th>Email Address</th>
        <th>Role</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    @if( count($users) > 0 )
      @foreach( $users as $user )
      <tr>
        <td>{{ $user->getMeta('first_name') }} {{ $user->getMeta('last_name') }}</td>
        <td>{{ link_to('mailto:'. $user->email, $user->email) }}</td>
        <td>{{ $user->role }}</td>
        <td>
          {!! Form::open([
            'route'   => [
              'admin.users.destroy', $user
            ],
            'method'  => 'DELETE'
          ]) !!}
          <div class="btn-group btn-group-sm">
            <a href="" class="btn btn-success btn-sm">
              <span class="fa fa-pencil"></span>
            </a>
            <button class="btn btn-danger">
              <span class="fa fa-trash"></span>
            </button>
          </div>
          {!! Form::close() !!}
        </td>
      </tr>
      @endforeach
    @endif
    </tbody>
  </table>
@endsection