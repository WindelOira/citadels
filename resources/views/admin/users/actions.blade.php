{!! Form::open([
  'route'   => [
    'admin.users.destroy', $user
  ],
  'method'  => 'DELETE'
]) !!}
<div class="btn-group btn-group-sm">
  <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-success btn-sm">
    <span class="fa fa-pencil"></span>
  </a>
  <button class="btn btn-danger" type="submit">
    <span class="fa fa-trash"></span>
  </button>
</div>
{!! Form::close() !!}