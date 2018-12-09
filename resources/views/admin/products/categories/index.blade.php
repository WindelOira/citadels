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
          <div class="uploader-result">
            <div class="uploader-preview">
              <div class="rounded uploader-preview__image"></div>
            </div>
            {{ Form::hidden('_media', '', ['class' => 'uploader-input']) }}
          </div>
          <a href="javascript:;" data-toggle="modal" data-target="#uploader-modal">Choose Featured Image</a>
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
      <table class="table table-sm table-striped is-datatable" data-ajax="{{ route('admin.datatables.products.categories') }}" data-columns='[{"name" : "id"}, {"name" : "product_title", "orderable" : false, "searchable" : false}, {"name" : "parent"}, {"name" : "slug"}]' data-single='true'>
        <thead>
          <tr>
            <th></th>
            <th>Category</th>
            <th>Parent</th>
            <th>Slug</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

  @uploader([
    'title'   => 'Upload Featured Image',
    'single'  => TRUE
  ])
  @enduploader
@endsection