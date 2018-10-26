@extends('layouts.admin')

@section('content')
  @page_header(['title' => 'Products'])
    Categories
  @endpage_header

  <div class="row">
    <div class="col-lg-4">
      {!! Form::open([
        'route'     => isset($category) ? ['admin.products.categories.update', $category] : 'admin.products.categories.store',
        'method'    => isset($category) ? 'PUT' : 'POST'
      ]) !!}
        <div class="form-group">
          {{ Form::bsText('title', isset($category) ? $category->title : '') }}
        </div>
        <div class="form-group">
          {{ Form::bsSelect('parent', $parent, isset($category) ? $category->parent : 0) }}
        </div>
        {{ Form::bsButton('publish', NULL, 'submit', ['title' => 'Publish', 'class' => 'btn btn-success']) }}
        @if( isset($category) ) 
        {{ link_to_route('admin.products.categories.index', 'Cancel', [], ['class' => 'btn btn-link float-right']) }}
        @endif
      {!! Form::close() !!}
    </div>
    <div class="col-lg-8">
      <table class="table table-sm table-striped is-datatable">
        <thead>
          <tr>
            <th>Parent</th>
            <th>Title</th>
            <th>Slug</th>
            <th></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
@endsection

@section('scripts')
<script>
  (function($) {
    $(function() {
      $('.is-datatable').DataTable({
        serverSide  : true,
        ajax        : "{{ route('admin.datatables.products.categories') }}",
        columns     : [
          { name : 'parent' },
          { name : 'title' },
          { name : 'slug' },
          { name : 'productcategoriesaction', orderable : false, searchable : false }
        ]
      });
    });
  })(jQuery);
</script>
@endsection