@extends('layouts.admin')

@section('content')
  @page_header(['title' => 'New Product'])
    Products
  @endpage_header

  {!! Form::open([
    'route'    => 'admin.products.store'
  ]) !!}
	<div class="row">
		<div class="col-lg-9 col-md-12">
      <!-- Add New Post Form -->
      <div class="card card-small mb-3">
        <div class="card-body">
            <div class="form-group">
              {{ Form::bsText('title', NULL, ['placeholder' => 'Product Title']) }}
            </div>
            
            {{ Form::bsEditor('content') }}
        </div>
      </div>
      <!-- / Add New Post Form -->
    </div>
    <div class="col-lg-3 col-md-12">
      <!-- Actions -->
      <div class='card card-small mb-3'>
        <div class="card-header border-bottom">
          <h6 class="m-0">Actions</h6>
        </div>
        <div class="card-body p-0">
          <ul class="list-group list-group-flush">
            <li class="list-group-item p-3">
              <span class="d-flex mb-2">
                <i class="material-icons mr-1">flag</i>
                <strong class="mr-1">Status:</strong> Draft
                <a class="ml-auto" href="#">Edit</a>
              </span>
              <span class="d-flex mb-2">
                <i class="material-icons mr-1">visibility</i>
                <strong class="mr-1">Visibility:</strong>
                <strong class="text-success">Public</strong>
                <a class="ml-auto" href="#">Edit</a>
              </span>
              <span class="d-flex mb-2">
                <i class="material-icons mr-1">calendar_today</i>
                <strong class="mr-1">Schedule:</strong> Now
                <a class="ml-auto" href="#">Edit</a>
              </span>
              <span class="d-flex">
                <i class="material-icons mr-1">score</i>
                <strong class="mr-1">Readability:</strong>
                <strong class="text-warning">Ok</strong>
              </span>
            </li>
            <li class="list-group-item d-flex px-3">
              {{ Form::bsButton('save', 'draft', 'submit', ['title' => '<i class="material-icons">save</i> Save Draft','class' => 'btn btn-sm btn-outline-accent']) }}
              {{ Form::bsButton('save', 'publish', 'submit', ['title' => '<i class="material-icons">file_copy</i> Publish','class' => 'btn btn-sm btn-accent ml-auto']) }}
            </li>
          </ul>
        </div>
      </div>
      <!-- / Actions -->
      <!-- Categories -->
      <admin-categories type="product"></admin-categories>
      <!-- / Categories -->
      <!-- Featured Image -->
      <div class="card card-small mb-3">
        <div class="card-header border-bottom">
          <div class="uploader-result">
            <div class="uploader-preview">
              <div class="rounded uploader-preview__image"></div>
            </div>
            {{ Form::hidden('_media', '', ['class' => 'uploader-input']) }}
          </div>
        </div>
        <div class="card-body">
          <a href="javascript:;" data-toggle="modal" data-target="#uploader-modal">Choose Featured Image</a>
        </div>
      </div>
      <!-- / Featured Image -->
    </div>
	</div>
  {!! Form::close() !!}

  @uploader([
    'title'   => 'Upload Featured Image',
    'single'  => TRUE
  ])
  @enduploader
@endsection