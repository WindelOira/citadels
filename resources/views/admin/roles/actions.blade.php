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
    <button class="btn btn-danger" type="submit">
      <i class="material-icons">delete</i>
    </button>
  </div>
{!! Form::close() !!}