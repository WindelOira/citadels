{!! Form::open([
  'route'   => [
    'admin.products.categories.destroy', $category
  ],
  'method'  => 'DELETE'
]) !!}
<div class="btn-group btn-group-sm">
  <a href="{{ route('admin.products.categories.edit', $category) }}" class="btn btn-success btn-sm">
    <span class="fa fa-pencil"></span>
  </a>
  <button class="btn btn-danger" type="submit">
    <span class="fa fa-trash"></span>
  </button>
</div>
{!! Form::close() !!}