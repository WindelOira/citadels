@extends('layouts.admin')

@section('content')
  @page_header(['title' => 'Products'])
    Categories
  @endpage_header

  <div class="row">
    <div class="col-lg-4">
      {!! Form::open([
        'route'     => isset($category) ? ['admin.products.categories.update', $category] : 'admin.products.categories.store',
        'method'    => isset($category) ? 'PUT' : 'POST',
        'files'     => TRUE,
      ]) !!}
        <div class="form-group thumbnail-preview thumbnail-preview__category">
          <img src="https://via.placeholder.com/150/949494/FFFFFF?text=Thumbnail" alt="" class="mx-auto mb-2 rounded d-block thumbnail-preview__image">
          {{ Form::bsFile('thumbnail', ['class' => 'd-none thumbnail-preview__input']) }}
        </div>
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
      <table class="table table-sm table-striped is-datatable" data-ajax="{{ route('admin.datatables.products.categories') }}" data-columns='[{"name" : "title"}, {"name" : "parent"}, {"name" : "slug"}, {"name" : "product_categories_action", "orderable" : "false", "searchable" : "false"}]'>
        <thead>
          <tr>
            <th>Category</th>
            <th>Parent</th>
            <th>Slug</th>
            <th></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
@endsection